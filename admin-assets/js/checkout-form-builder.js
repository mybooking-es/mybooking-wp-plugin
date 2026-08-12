/**
 * Mybooking Checkout Form Builder
 *
 * Architecture
 * ────────────
 * - State-first: JS state is always the source of truth.
 * - Every user action mutates state, then calls render().
 * - render() replaces the container HTML and re-wires jQuery UI Sortable.
 * - HTML5 drag API handles field movement (palette → slot, slot → slot).
 * - jQuery UI Sortable handles row and section reordering.
 * - Event delegation (on a static parent) — no re-binding on re-render.
 *
 * Container:  <div id="mybooking-checkout-form-builder"
 *                  data-config="..." data-fields="..."
 *                  data-langs="[...]" data-default-lang="es_ES">
 * Output:     <input type="hidden" id="mybooking-checkout-form-config-input">
 *
 * Section title schema (new in P2B):
 *   title: {
 *     preset:   'customer_details' | ... | 'custom',
 *     fallback: string,  // used when preset='custom' and no by_lang override
 *     by_lang:  { locale: string }  // per-lang override; empty string = use preset/fallback
 *   }
 *
 * field_overrides structure (by_lang):
 *   {
 *     customer_name: {
 *       required: bool,
 *       by_lang: {
 *         es_ES: { label: 'Nombre', placeholder: 'Tu nombre' },
 *         en_US: { label: '', placeholder: '' }
 *       }
 *     }
 *   }
 */
(function ($) {
  'use strict';

  var BUILDER_ID = 'mybooking-checkout-form-builder';
  var INPUT_ID   = 'mybooking-checkout-form-config-input';

  var PARENT_GROUP_ORDER = ['general', 'accommodation', 'driver', 'vehicles', 'boats', 'activities', 'transfers'];

  var CUSTOMER_DETAILS_STRINGS = [
    "Customer's details", "Dades del client", "Kundendaten", "Datos del cliente",
    "Kliendi andmed", "Asiakkaan tiedot", "Informations du client", "Dati del cliente",
    "Klantgegevens", "Dane klienta", "Dados do cliente", "Данные клиента"
  ];

  var state = {
    config:             null,  // { sections, field_overrides }
    defaultConfig:      null,  // parsed from data-default-config; never mutated
    sectionTemplates:   {},    // catalog from data-section-templates
    fields:             {},    // catalog keyed by field key
    strings:            {},    // i18n from window.mybookingCheckoutFormStrings
    langs:              [],    // available locale codes, e.g. ['es_ES', 'en_US']
    defaultLang:        '',    // current admin locale, e.g. 'es_ES'
    profile:            null,  // from data-profile (account profile object)
    profilePreferences: null,  // from data-profile-preferences (mode + engines + renting_business_line)
    engineRequired:     [],    // from data-engine-required (array of field keys forced required by engine)
    showAll:            false  // true when profilePreferences.mode === 'show_all'
  };

  // Monotonic counter for profile AJAX requests. Handlers increment before each request;
  // callbacks compare before applying state to discard stale responses.
  var _profileReqSeq = 0;

  // ── Basic utilities ─────────────────────────────────────────────────────────

  function uuid() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
      var r = Math.random() * 16 | 0;
      return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
    });
  }

  function escHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  function escAttr(str) {
    return String(str).replace(/&/g, '&amp;').replace(/"/g, '&quot;');
  }

  function str(key, fallback) {
    return state.strings[key] || fallback;
  }

  function deepClone(obj) {
    return JSON.parse(JSON.stringify(obj));
  }

  function normalizeLangMap(v) {
    return v && typeof v === 'object' && !Array.isArray(v) ? v : {};
  }

  // ── Language helpers ─────────────────────────────────────────────────────────

  var LANG_NAMES = {
    'ar':    'عربي',       'bg_BG': 'Български',  'ca':    'Català',
    'cs_CZ': 'Čeština',    'da_DK': 'Dansk',      'de_DE': 'Deutsch',
    'el':    'Ελληνικά',   'en_AU': 'English',    'en_CA': 'English (CA)',
    'en_GB': 'English',    'en_US': 'English',    'es_AR': 'Español',
    'es_ES': 'Español',    'es_MX': 'Español',    'et':    'Eesti',
    'et_EE': 'Eesti',      'fi':    'Suomi',       'fi_FI': 'Suomi',
    'fr_BE': 'Français',   'fr_FR': 'Français',   'hr':    'Hrvatski',
    'hu_HU': 'Magyar',     'it_IT': 'Italiano',   'ja':    '日本語',
    'nb_NO': 'Norsk',      'nl_BE': 'Nederlands', 'nl_NL': 'Nederlands',
    'pl_PL': 'Polski',     'pt_BR': 'Português',  'pt_PT': 'Português',
    'ro_RO': 'Română',     'ru_RU': 'Русский',    'sk_SK': 'Slovenčina',
    'sl_SI': 'Slovenščina','sv_SE': 'Svenska',    'tr_TR': 'Türkçe',
    'uk':    'Українська', 'zh_CN': '中文',        'zh_TW': '中文'
  };

  function langFriendlyName(locale) {
    return LANG_NAMES[locale] || locale;
  }

  function langShortCode(locale) {
    var parts = locale.split('_');
    return (parts[0] || locale).toLowerCase().substring(0, 3);
  }

  function isLocked(fieldKey) {
    return !!(state.fields[fieldKey] && state.fields[fieldKey].removable === false);
  }

  // ── Profile helpers (P3.1) ──────────────────────────────────────────────────

  function computeActiveEngines() {
    var prefs = state.profilePreferences;
    if (prefs && prefs.mode === 'manual' && prefs.engines && prefs.engines.length) {
      return prefs.engines;
    }
    return state.profile && state.profile.engines ? state.profile.engines : ['renting', 'activities', 'transfers'];
  }

  function computeRentingBL() {
    var prefs = state.profilePreferences;
    if (prefs && prefs.mode === 'manual' && prefs.renting_business_line) {
      return prefs.renting_business_line;
    }
    return state.profile ? (state.profile.renting_business_line || 'generic') : 'generic';
  }

  function isFieldVisible(fieldKey) {
    var f = state.fields[fieldKey];
    if (!f) return true;
    // Account-feature guard for engine specials: must come before showAll to prevent
    // exposing feature-gated specials when feature is not enabled.
    if (f.special) {
      var feats = state.profile && state.profile.features ? state.profile.features : {};
      if (fieldKey === 'slot_time_from' && !feats.delivery_slots) return false;
      if (fieldKey === 'with_optional_external_driver' && !feats.optional_external_driver) return false;
    }
    if (state.showAll) return true;
    if (!f.engine_targets || !f.engine_targets.length) return true;
    var activeEngines = computeActiveEngines();
    var engineMatch = f.engine_targets.some(function (e) { return activeEngines.indexOf(e) !== -1; });
    if (!engineMatch) return false;
    if (f.engine_targets.indexOf('renting') === -1) return true;
    if (activeEngines.indexOf('renting') === -1) return true;
    var rentingBL = computeRentingBL();
    if (rentingBL === 'generic') return true;
    if (!f.business_lines || !f.business_lines.length) return true;
    return f.business_lines.indexOf('common') !== -1 || f.business_lines.indexOf(rentingBL) !== -1;
  }

  function isTemplateVisible(tplKey) {
    if (state.showAll) return true;
    var tpl = state.sectionTemplates[tplKey];
    if (!tpl) return false;
    return tpl.rows.some(function (row) {
      return row.some(function (fieldKey) {
        return fieldKey && isFieldVisible(fieldKey);
      });
    });
  }

  function isEngineForced(key) {
    return !!(state.engineRequired && state.engineRequired.indexOf(key) !== -1);
  }

  function isAccountRequired(key) {
    return !!(state.profile && state.profile.account_required_fields &&
      state.profile.account_required_fields.indexOf(key) !== -1);
  }

  function templateDisplayTitle(tplKey, tpl) {
    var byKey = state.strings['tmpl_' + tplKey] || '';
    if (byKey) return byKey;
    return str('preset_' + tpl.title_preset, tpl.title_preset);
  }

  function engineLabel(e) {
    var fromKey = str('engine_' + e, '');
    if (fromKey) return fromKey;
    return str('group_' + e, e);
  }

  function rentingFamilyLabel(bl) {
    var fromKey = str('family_' + bl, '');
    if (fromKey) return fromKey;
    var groupMap = { vehicle: 'group_vehicles', boat: 'group_boats', accommodation: 'group_accommodation', generic: 'family_generic' };
    return str(groupMap[bl] || ('family_' + bl), bl);
  }

  function applyProfileUpdate(newPrefs, newProfile, newEngineRequired) {
    if (newPrefs) {
      state.profilePreferences = newPrefs;
      state.showAll = !!(newPrefs.show_all);
    }
    if (newProfile) { state.profile = newProfile; }
    if (newEngineRequired) { state.engineRequired = newEngineRequired; }
  }

  function saveProfilePreferences(nextPrefs) {
    var ajaxUrl = str('_ajax_url', '');
    var nonce   = str('_nonce_profile_prefs', '');
    if (!ajaxUrl || !nonce) return;

    // Snapshot of current AUTHORITATIVE state taken BEFORE any mutation.
    // Handlers must NOT mutate state.profilePreferences before calling this.
    var snapshot = {
      profilePreferences: state.profilePreferences ? deepClone(state.profilePreferences) : null,
      profile:            state.profile            ? deepClone(state.profile)            : null,
      engineRequired:     state.engineRequired     ? state.engineRequired.slice()        : []
    };

    var $toolbar = $('.mbcf-profile-toolbar');
    $toolbar.find('input, select, button').prop('disabled', true);

    var seq = ++_profileReqSeq;

    $.ajax({
      url:    ajaxUrl,
      method: 'POST',
      data:   { action: 'mbcf_save_profile_prefs', nonce: nonce, prefs: JSON.stringify(nextPrefs) },
      success: function (resp) {
        if (seq !== _profileReqSeq) return; // stale: a newer request already owns state
        if (resp && resp.success && resp.data) {
          applyProfileUpdate(resp.data.prefs, resp.data.profile, resp.data.engine_required);
        } else {
          // Server returned an invalid/failed response: restore authoritative snapshot
          state.profilePreferences = snapshot.profilePreferences;
          state.profile            = snapshot.profile;
          state.engineRequired     = snapshot.engineRequired;
          state.showAll = !!(state.profilePreferences && state.profilePreferences.show_all);
          announce(str('profile_unavailable', 'Profile detection unavailable'));
        }
        render();
      },
      error: function () {
        if (seq !== _profileReqSeq) return; // stale error
        state.profilePreferences = snapshot.profilePreferences;
        state.profile            = snapshot.profile;
        state.engineRequired     = snapshot.engineRequired;
        state.showAll = !!(state.profilePreferences && state.profilePreferences.show_all);
        render();
        announce(str('profile_unavailable', 'Profile detection unavailable'));
      }
    });
  }

  function fieldsInForm() {
    var used = [];
    state.config.sections.forEach(function (s) {
      s.rows.forEach(function (r) {
        r.fields.forEach(function (k) { if (k) used.push(k); });
      });
    });
    return used;
  }

  function getSectionById(id) {
    return state.config.sections.find(function (s) { return s.id === id; }) || null;
  }

  function getRowContext(rowId) {
    for (var i = 0; i < state.config.sections.length; i++) {
      var section = state.config.sections[i];
      for (var j = 0; j < section.rows.length; j++) {
        if (section.rows[j].id === rowId) {
          return { section: section, row: section.rows[j] };
        }
      }
    }
    return null;
  }

  function syncInput() {
    $('#' + INPUT_ID).val(JSON.stringify(state.config));
  }

  // ── Section title helpers ────────────────────────────────────────────────────

  function migrateTitle(raw) {
    if (raw && typeof raw === 'object' && raw.preset !== undefined) {
      raw.by_lang = normalizeLangMap(raw.by_lang);
      return raw;
    }
    var s = typeof raw === 'string' ? raw : '';
    if (CUSTOMER_DETAILS_STRINGS.indexOf(s) !== -1) {
      return { preset: 'customer_details', fallback: '', by_lang: {} };
    }
    return { preset: 'custom', fallback: s, by_lang: {} };
  }

  function resolvedTitle(section, lang) {
    var title = section.title;
    if (!title || typeof title === 'string') return title || '';
    if (!title.preset) return title.fallback || '';
    var override = title.by_lang && lang ? (title.by_lang[lang] || '') : '';
    if (override && override.trim()) return override;
    if (title.fallback && title.fallback.trim()) return title.fallback;
    if (title.preset !== 'custom') {
      var presetName = str('preset_' + title.preset, title.preset);
      if (presetName) return presetName;
    }
    return title.fallback || '';
  }

  function buildLocalizedTextPills(byLang, cssModifier) {
    if (!state.langs.length) return '';
    byLang = byLang || {};
    var pills = '';
    state.langs.forEach(function (lang) {
      var val      = byLang[lang] || '';
      var hasVal   = !!(val && val.trim && val.trim());
      var friendly = langFriendlyName(lang);
      var status   = hasVal ? str('translated', 'Translated') : str('not_translated', 'Not translated');
      var ariaLabel = friendly + ' — ' + status;
      pills += '<span class="mbcf-lang-pill mbcf-lang-pill--' + (hasVal ? 'set' : 'empty') + '"'
        + ' title="' + escAttr(friendly) + '"'
        + ' aria-label="' + escAttr(ariaLabel) + '">'
        + escHtml(langShortCode(lang))
        + '</span>';
    });
    return pills
      ? '<div class="mbcf-section-' + cssModifier + '-langs">'
        + pills
        + '</div>'
      : '';
  }

  function buildSectionTitlePills(section) {
    var byLang = (section.title && section.title.by_lang) ? section.title.by_lang : {};
    return buildLocalizedTextPills(byLang, 'title');
  }

  function buildSectionSubtitlePills(section) {
    var byLang = (section.subtitle && section.subtitle.by_lang) ? section.subtitle.by_lang : {};
    return buildLocalizedTextPills(byLang, 'subtitle');
  }

  function isSectionTitleCustomized(section) {
    var title = section.title;
    if (!title || typeof title !== 'object') return false;
    if (title.preset === 'custom') return true;
    if (title.fallback && title.fallback.trim()) return true;
    if (title.by_lang) {
      var langs = Object.keys(title.by_lang);
      for (var i = 0; i < langs.length; i++) {
        var val = title.by_lang[langs[i]];
        if (val && val.trim && val.trim()) return true;
      }
    }
    return false;
  }

  function isSectionSubtitleSet(section) {
    var sub = section.subtitle;
    if (!sub || typeof sub !== 'object') return false;
    if (sub.fallback && sub.fallback.trim()) return true;
    if (sub.by_lang) {
      var keys = Object.keys(sub.by_lang);
      for (var i = 0; i < keys.length; i++) {
        var val = sub.by_lang[keys[i]];
        if (val && val.trim && val.trim()) return true;
      }
    }
    return false;
  }

  function resolvedSubtitle(section, lang) {
    var sub = section.subtitle;
    if (!sub || typeof sub !== 'object') return (typeof sub === 'string' ? sub : '');
    var override = sub.by_lang && lang ? (sub.by_lang[lang] || '') : '';
    if (override && override.trim()) return override;
    return sub.fallback || '';
  }

  function migrateSubtitle(raw) {
    if (raw && typeof raw === 'object' && raw.fallback !== undefined) {
      raw.by_lang = normalizeLangMap(raw.by_lang);
      return raw;
    }
    var s = typeof raw === 'string' ? raw : '';
    return { fallback: s, by_lang: {} };
  }

  function normalizeConfigShape(config) {
    if (!config.field_overrides || Array.isArray(config.field_overrides)) {
      config.field_overrides = {};
    }
    Object.keys(config.field_overrides).forEach(function (key) {
      var ov = config.field_overrides[key];
      if (ov && !ov.by_lang && (ov.label !== undefined || ov.placeholder !== undefined)) {
        var lang = state.defaultLang || '';
        var migrated = { required: ov.required, by_lang: {} };
        if (ov.label || ov.placeholder) {
          migrated.by_lang[lang] = { label: ov.label || '', placeholder: ov.placeholder || '' };
        }
        config.field_overrides[key] = migrated;
      }
      if (config.field_overrides[key]) {
        config.field_overrides[key].by_lang = normalizeLangMap(config.field_overrides[key].by_lang);
      }
    });
    config.sections.forEach(function (sec) {
      sec.title = migrateTitle(sec.title);
      sec.subtitle = migrateSubtitle(sec.subtitle);
    });
    return config;
  }

  function announce(message) {
    if (window.wp && wp.a11y && typeof wp.a11y.speak === 'function') {
      wp.a11y.speak(message);
    }
  }

  function showResetNotice() {
    var msg = str('reset_notice', 'Default form restored in the editor. Save changes to apply.');
    var $existing = $('.mbcf-reset-notice');
    if ($existing.length) {
      $existing.stop(true, true).show();
      $existing.find('p').text(msg);
      setTimeout(function () { $existing.fadeOut(400, function () { $existing.remove(); }); }, 4000);
      return;
    }
    var $notice = $('<div class="notice notice-success mbcf-reset-notice is-dismissible"><p>' + escHtml(msg) + '</p></div>');
    $('#' + BUILDER_ID).before($notice);
    setTimeout(function () { $notice.fadeOut(400, function () { $notice.remove(); }); }, 4000);
  }

  function resetToDefault() {
    if (!state.defaultConfig) return;
    var $trigger = $('#mbcf-reset-default');
    var opener   = $trigger.length ? $trigger[0] : null;
    MyBookingAdminModal.confirm({
      title:       str('reset_default', 'Reset to default'),
      message:     str('reset_confirm', 'Restore the default checkout form? Unsaved builder changes will be replaced.'),
      confirmText: str('reset_default', 'Reset to default'),
      variant:     'default',
      opener:      opener
    }).then(function (confirmed) {
      if (!confirmed) return;
      state.config = normalizeConfigShape(deepClone(state.defaultConfig));
      syncInput();
      render();
      showResetNotice();
      announce(str('reset_notice', 'Default form restored in the editor. Save changes to apply.'));
    });
  }

  // ── Override utilities (by_lang structure) ──────────────────────────────────

  function ensureOverride(key) {
    if (!state.config.field_overrides[key]) {
      state.config.field_overrides[key] = { by_lang: {} };
    }
    var ov = state.config.field_overrides[key];
    if (!ov.by_lang && (ov.label !== undefined || ov.placeholder !== undefined)) {
      var lang = state.defaultLang || '';
      var migrated = { required: ov.required, by_lang: {} };
      if (ov.label || ov.placeholder) {
        migrated.by_lang[lang] = {
          label:       ov.label       || '',
          placeholder: ov.placeholder || ''
        };
      }
      state.config.field_overrides[key] = migrated;
    }
    state.config.field_overrides[key].by_lang = normalizeLangMap(state.config.field_overrides[key].by_lang);
    return state.config.field_overrides[key];
  }

  function ensureByLang(key, lang) {
    var ov = ensureOverride(key);
    if (!ov.by_lang[lang]) {
      ov.by_lang[lang] = { label: '', placeholder: '' };
    }
    return ov.by_lang[lang];
  }

  function hasOverrideText(key, prop) {
    var ov = state.config.field_overrides[key];
    if (!ov || !ov.by_lang) return false;
    var langs = Object.keys(ov.by_lang);
    for (var i = 0; i < langs.length; i++) {
      if (ov.by_lang[langs[i]] && ov.by_lang[langs[i]][prop]) return true;
    }
    return false;
  }

  // ── Mutations ───────────────────────────────────────────────────────────────

  function sectionHasLockedFields(section) {
    return section.rows.some(function (r) {
      return r.fields.some(function (k) { return k && isLocked(k); });
    });
  }

  function removeSection(sectionId, opener) {
    var section = getSectionById(sectionId);
    if (!section) return;
    if (sectionHasLockedFields(section)) return;
    MyBookingAdminModal.confirm({
      title:       str('remove_section', 'Remove section'),
      message:     str('remove_section_confirm', 'Remove this section? Its fields will become available again in Section templates. Changes will not be saved until you click Save Changes.'),
      confirmText: str('remove_section', 'Remove section'),
      variant:     'danger',
      opener:      opener || null
    }).then(function (confirmed) {
      if (!confirmed) return;
      state.config.sections = state.config.sections.filter(function (s) { return s.id !== sectionId; });
      render();
      var $sections = $('#mbcf-sections');
      var $last = $sections.children('.mbcf-section').last();
      if ($last.length) {
        $last.find('.mbcf-section-card__remove-btn, .mbcf-section-card__handle').first().focus();
      } else {
        var $sidebar = $('#' + BUILDER_ID).find('.mbcf-builder-sidebar');
        var $quickAdd = $sidebar.find('.mbcf-tpl-quick-add:not(:disabled)').first();
        if ($quickAdd.length) { $quickAdd.focus(); }
        else { $sidebar.find('.mbcf-tpl-configure-btn').first().focus(); }
      }
      announce(str('section_removed', 'Section removed.'));
    });
  }

  function addRow(sectionId, layout) {
    var section = getSectionById(sectionId);
    if (!section) return;
    var slots = layout === '2col' ? [null, null] : [null];
    section.rows.push({ id: uuid(), layout: layout, fields: slots });
    render();
  }

  function removeRow(rowId) {
    var ctx = getRowContext(rowId);
    if (!ctx) return;
    var hasLocked = ctx.row.fields.some(function (k) { return k && isLocked(k); });
    if (hasLocked) {
      // eslint-disable-next-line no-alert
      alert(str('cannot_remove_row', 'This row contains required fields and cannot be removed.'));
      return;
    }
    ctx.section.rows = ctx.section.rows.filter(function (r) { return r.id !== rowId; });
    render();
  }

  function removeFieldFromSlot(rowId, slotIndex) {
    var ctx = getRowContext(rowId);
    if (!ctx) return;
    var key = ctx.row.fields[slotIndex];
    if (!key) return;
    if (isLocked(key)) {
      // eslint-disable-next-line no-alert
      alert(str('cannot_remove_field', 'This field is required and cannot be removed.'));
      return;
    }
    ctx.row.fields[slotIndex] = null;
    render();
  }

  function placeFieldInSlot(fieldKey, targetRowId, targetSlotIndex, sourceRowId, sourceSlotIndex) {
    var targetCtx = getRowContext(targetRowId);
    if (!targetCtx) return;

    var existingKeyInTarget = targetCtx.row.fields[targetSlotIndex];

    if (existingKeyInTarget && isLocked(existingKeyInTarget)) {
      // eslint-disable-next-line no-alert
      alert(str('cannot_replace_locked', 'Cannot replace a required field.'));
      return;
    }

    if (sourceRowId !== null && sourceRowId !== undefined) {
      var sourceCtx = getRowContext(sourceRowId);
      if (sourceCtx) {
        sourceCtx.row.fields[sourceSlotIndex] = existingKeyInTarget || null;
      }
    }

    targetCtx.row.fields[targetSlotIndex] = fieldKey;
    render();
  }

  function setSectionTitleByLang(sectionId, lang, value) {
    var s = getSectionById(sectionId);
    if (!s) return;
    if (!s.title || typeof s.title !== 'object') {
      s.title = { preset: 'custom', fallback: '', by_lang: {} };
    }
    s.title.by_lang = normalizeLangMap(s.title.by_lang);
    s.title.by_lang[lang] = value;
    syncInput();
  }

  function setSectionTitleFallback(sectionId, value) {
    var s = getSectionById(sectionId);
    if (!s) return;
    if (!s.title || typeof s.title !== 'object') {
      s.title = { preset: 'custom', fallback: '', by_lang: {} };
    }
    s.title.fallback = value;
    syncInput();
  }

  function setSectionSubtitleFallback(sectionId, value) {
    var s = getSectionById(sectionId);
    if (!s) return;
    if (!s.subtitle || typeof s.subtitle !== 'object') {
      s.subtitle = { fallback: '', by_lang: {} };
    }
    s.subtitle.fallback = value;
    syncInput();
  }

  function setSectionSubtitleByLang(sectionId, lang, value) {
    var s = getSectionById(sectionId);
    if (!s) return;
    if (!s.subtitle || typeof s.subtitle !== 'object') {
      s.subtitle = { fallback: '', by_lang: {} };
    }
    s.subtitle.by_lang = normalizeLangMap(s.subtitle.by_lang);
    s.subtitle.by_lang[lang] = value;
    syncInput();
  }

  function reorderSections(newOrder) {
    var map = {};
    state.config.sections.forEach(function (s) { map[s.id] = s; });
    var reordered = newOrder.map(function (id) { return map[id]; }).filter(Boolean);
    if (reordered.length === state.config.sections.length) {
      state.config.sections = reordered;
      syncInput();
    }
  }

  function reorderRows(sectionId, newOrder) {
    var section = getSectionById(sectionId);
    if (!section) return;
    var map = {};
    section.rows.forEach(function (r) { map[r.id] = r; });
    var reordered = newOrder.map(function (id) { return map[id]; }).filter(Boolean);
    if (reordered.length === section.rows.length) {
      section.rows = reordered;
      syncInput();
    }
  }

  // ── Section template insertion ───────────────────────────────────────────────

  function visibleTemplateFields(templateKey) {
    var tpl = state.sectionTemplates[templateKey];
    if (!tpl) return [];
    var result = [];
    tpl.rows.forEach(function (row) {
      row.forEach(function (k) {
        if (k && isFieldVisible(k)) result.push(k);
      });
    });
    return result;
  }

  function templateFieldsInForm(templateKey) {
    var keys   = visibleTemplateFields(templateKey);
    var inForm = fieldsInForm();
    return keys.filter(function (k) { return inForm.indexOf(k) !== -1; });
  }

  function templateAvailableFields(templateKey) {
    var keys   = visibleTemplateFields(templateKey);
    var inForm = fieldsInForm();
    return keys.filter(function (k) { return inForm.indexOf(k) === -1; });
  }

  function insertSectionFromPlan(options) {
    var allowedFields  = options.allowedFields;
    var selectedFields = options.selectedFields;
    var rows           = options.rows;
    var title          = options.title;
    var allowEmptyFields = !!options.allowEmptyFields;

    var uniqueSelected = [];
    var fieldCatalog   = state.fields;
    for (var si = 0; si < selectedFields.length; si++) {
      var sk = selectedFields[si];
      if (uniqueSelected.indexOf(sk) !== -1) { return; }
      if (allowedFields.indexOf(sk) === -1)  { return; }
      if (!fieldCatalog[sk])                 { return; }
      uniqueSelected.push(sk);
    }

    if (!allowEmptyFields && uniqueSelected.length === 0) { return; }

    var snapshot = deepClone(state.config);

    try {
      uniqueSelected.forEach(function (key) {
        state.config.sections.forEach(function (s) {
          s.rows.forEach(function (r) {
            for (var fi = 0; fi < r.fields.length; fi++) {
              if (r.fields[fi] === key) { r.fields[fi] = null; }
            }
          });
        });
      });

      state.config.sections.forEach(function (s) {
        s.rows = s.rows.filter(function (r) {
          return r.fields.some(function (k) { return k !== null; });
        });
      });

      var newSection = {
        id:       uuid(),
        title:    title,
        subtitle: { fallback: '', by_lang: {} },
        rows:     rows
      };

      state.config.sections.push(newSection);

      var allInForm = fieldsInForm();
      var seen = {};
      for (var di = 0; di < allInForm.length; di++) {
        if (seen[allInForm[di]]) {
          state.config = snapshot;
          return;
        }
        seen[allInForm[di]] = true;
      }

      syncInput();
      render();

      var $newSec = $('[data-section-id="' + newSection.id + '"]');
      if ($newSec.length) {
        $newSec.find('.mbcf-section-title-edit-btn').focus();
      }
      announce(str('section_added', 'Section added.'));

    } catch (e) {
      state.config = snapshot;
      if (window.console && console.error) {
        console.error('[mbcf] insertSectionFromPlan error:', e);
      }
    }
  }

  function insertSectionTemplate(templateKey, selectedFields) {
    var tpl = state.sectionTemplates[templateKey];
    if (!tpl) { return; }

    var tplVisibleKeys = visibleTemplateFields(templateKey);

    var newRows = [];
    tpl.rows.forEach(function (catalogRow) {
      var picked = catalogRow.filter(function (k) {
        return k && isFieldVisible(k) && selectedFields.indexOf(k) !== -1;
      });
      if (picked.length === 0) { return; }
      if (picked.length >= 2) {
        newRows.push({ id: uuid(), layout: '2col', fields: [ picked[0], picked[1] ] });
      } else {
        newRows.push({ id: uuid(), layout: '1col', fields: [ picked[0] ] });
      }
    });

    insertSectionFromPlan({
      allowedFields:   tplVisibleKeys,
      selectedFields:  selectedFields,
      rows:            newRows,
      title:           { preset: tpl.title_preset, fallback: '', by_lang: {} },
      allowEmptyFields: false
    });
  }

  function insertCustomSection(title, selectedFields) {
    var allFieldKeys = Object.keys(state.fields);
    var rows = [];
    var coveredKeys = {};

    Object.keys(state.sectionTemplates).forEach(function (tplKey) {
      var tpl = state.sectionTemplates[tplKey];
      tpl.rows.forEach(function (catalogRow) {
        catalogRow.forEach(function (k) { if (k) coveredKeys[k] = true; });
        var picked = catalogRow.filter(function (k) {
          return k && selectedFields.indexOf(k) !== -1;
        });
        if (!picked.length) return;
        if (picked.length >= 2) {
          rows.push({ id: uuid(), layout: '2col', fields: [picked[0], picked[1]] });
        } else {
          rows.push({ id: uuid(), layout: '1col', fields: [picked[0]] });
        }
      });
    });

    allFieldKeys.forEach(function (k) {
      if (!coveredKeys[k] && selectedFields.indexOf(k) !== -1) {
        rows.push({ id: uuid(), layout: '1col', fields: [k] });
      }
    });

    insertSectionFromPlan({
      allowedFields:   allFieldKeys,
      selectedFields:  selectedFields,
      rows:            rows,
      title:           { preset: 'custom', fallback: title.trim(), by_lang: {} },
      allowEmptyFields: true
    });
  }

  function confirmAndInsertSection(selectedFields, insertFn, ctaEl) {
    var inForm = fieldsInForm();
    var hasConflict = selectedFields.some(function (k) { return inForm.indexOf(k) !== -1; });
    if (hasConflict) {
      MyBookingAdminModal.confirm({
        title:       str('move_selected_fields', 'Move selected fields'),
        message:     str('move_selected_confirm', 'Some selected fields are already in the form. They will be moved to the new section. Continue?'),
        confirmText: str('add_section', '+ Add section'),
        variant:     'default',
        opener:      ctaEl || null
      }).then(function (confirmed) { if (!confirmed) return; insertFn(); });
    } else {
      insertFn();
    }
  }

  function openTemplateConfigurator(templateKey) {
    var $b = $('#' + BUILDER_ID);
    $b.find('.mbcf-tpl-configurator').each(function () {
      if ($(this).data('tpl') !== templateKey) {
        $(this).hide();
        var $btn = $b.find('.mbcf-tpl-configure-btn[data-tpl="' + $(this).data('tpl') + '"]');
        $btn.attr('aria-expanded', 'false');
      }
    });
    var $panel = $b.find('.mbcf-tpl-configurator[data-tpl="' + templateKey + '"]');
    var $configBtn = $b.find('.mbcf-tpl-configure-btn[data-tpl="' + templateKey + '"]');
    $panel.show();
    $configBtn.attr('aria-expanded', 'true');
  }

  // ── Rendering ───────────────────────────────────────────────────────────────

  function fieldDisplayLabel(key) {
    if (!state.fields[key]) return key;
    return state.fields[key].label || key;
  }

  function buildLangPills(key, prop) {
    var ov     = state.config.field_overrides[key];
    var byLang = ov && ov.by_lang ? ov.by_lang : {};
    var pills  = '';
    state.langs.forEach(function (lang) {
      var val    = byLang[lang] && byLang[lang][prop];
      var hasVal = !!(val && val.trim && val.trim());
      pills += '<span class="mbcf-lang-pill mbcf-lang-pill--' + (hasVal ? 'set' : 'empty') + '"'
        + ' title="' + escAttr(langFriendlyName(lang)) + '">'
        + escHtml(langShortCode(lang))
        + '</span>';
    });
    return pills;
  }

  function renderLocTextEditor(section, type, localizedText, labelStr, getPlaceholder) {
    var byLang     = (localizedText && localizedText.by_lang) ? localizedText.by_lang : {};
    var fallbackVal = (localizedText && localizedText.fallback) ? localizedText.fallback : '';

    var activeLang    = state.defaultLang || (state.langs.length ? state.langs[0] : '');
    var langsToRender = state.langs.length ? state.langs : (activeLang ? [activeLang] : ['']);
    var isMultiLang   = langsToRender.length > 1;

    var editorId = 'mbcf-section-' + type + '-editor-' + section.id;

    var html = '<div class="mbcf-section-' + type + '-editor" id="' + escAttr(editorId) + '" style="display:none">';

    if (!isMultiLang) {
      html += '<div class="mbcf-field-settings-row">'
        + '<span class="mbcf-field-settings-label">' + labelStr + '</span>'
        + '<input type="text" class="mbcf-section-' + type + '-fallback"'
          + ' data-section="' + escAttr(section.id) + '"'
          + ' value="' + escAttr(fallbackVal) + '"'
          + ' placeholder="' + escAttr(getPlaceholder('')) + '" />'
        + '</div>';
    } else {
      html += '<div class="mbcf-field-settings-row">'
        + '<span class="mbcf-field-settings-label">' + labelStr + '</span>'
        + '<input type="text" class="mbcf-section-' + type + '-fallback"'
          + ' data-section="' + escAttr(section.id) + '"'
          + ' value="' + escAttr(fallbackVal) + '"'
          + ' placeholder="' + escAttr(getPlaceholder('')) + '" />'
        + '</div>';

      html += '<div class="mbcf-lang-tabs">';
      langsToRender.forEach(function (lang) {
        var isActive = (lang === activeLang);
        html += '<button type="button"'
          + ' class="mbcf-section-' + type + '-tab mbcf-lang-tab' + (isActive ? ' mbcf-lang-tab--active' : '') + '"'
          + ' data-section-' + type + '="' + escAttr(section.id) + '" data-lang="' + escAttr(lang) + '"'
          + ' title="' + escAttr(lang) + '">'
          + escHtml(langFriendlyName(lang))
          + '</button>';
      });
      html += '</div>';

      langsToRender.forEach(function (lang) {
        var isActive    = (lang === activeLang);
        var overrideVal = byLang[lang] || '';
        var ph = (fallbackVal && fallbackVal.trim()) ? fallbackVal : getPlaceholder(lang);

        html += '<div class="mbcf-section-' + type + '-content mbcf-lang-content' + (isActive ? ' mbcf-lang-content--active' : '') + '"'
          + ' data-section-' + type + '="' + escAttr(section.id) + '" data-lang="' + escAttr(lang) + '">'
          + '<div class="mbcf-field-settings-row">'
            + '<span class="mbcf-field-settings-label">' + labelStr + '</span>'
            + '<input type="text" class="mbcf-section-' + type + '-by-lang"'
              + ' data-section="' + escAttr(section.id) + '" data-lang="' + escAttr(lang) + '"'
              + ' value="' + escAttr(overrideVal) + '"'
              + ' placeholder="' + escAttr(ph) + '" />'
          + '</div>'
          + '</div>';
      });
    }

    html += '<div class="mbcf-field-settings-row mbcf-field-settings-row--actions">'
      + '<button type="button"'
        + ' class="mbcf-section-' + type + '-editor-close button button-small"'
        + ' data-section="' + escAttr(section.id) + '"'
        + ' data-editor-type="' + escAttr(type) + '">'
        + str('field_settings_done', '&#10003; Done') + '</button>'
      + '</div>'
      + '</div>';

    return html;
  }

  function renderSectionTitleEditor(section) {
    var title = (section.title && typeof section.title === 'object')
      ? section.title
      : { preset: 'custom', fallback: (section.title || ''), by_lang: {} };
    var isCustom = (title.preset === 'custom');
    return renderLocTextEditor(section, 'title', title, str('section_title_label', 'Title'), function () {
      return isCustom ? '' : str('preset_' + title.preset, title.preset);
    });
  }

  function renderSectionSubtitleEditor(section) {
    var sub = (section.subtitle && typeof section.subtitle === 'object')
      ? section.subtitle
      : { fallback: (typeof section.subtitle === 'string' ? section.subtitle : ''), by_lang: {} };
    return renderLocTextEditor(section, 'subtitle', sub, str('section_subtitle_ph', 'Subtitle (optional)'), function () {
      return '';
    });
  }

  function renderProfileToolbar() {
    var prefs     = state.profilePreferences || { mode: 'auto' };
    var mode      = prefs.mode || 'auto';
    var showAll   = !!(prefs.show_all);
    var p         = state.profile;
    var noProfile = !p || p.source === 'fallback';

    var html = '<div class="mbcf-sidebar-panel mbcf-profile-toolbar">'
      + '<h3 class="mbcf-sidebar-panel__title">'
        + escHtml(str('profile_business_profile', 'Business profile'))
      + '</h3>';

    // Mode selector (2 radios only — show_all is a separate checkbox)
    html += '<div class="mbcf-profile-mode">';
    [
      { value: 'auto',   key: 'profile_auto',   fb: 'Automatic (MyBooking API)' },
      { value: 'manual', key: 'profile_manual',  fb: 'Manual override'           }
    ].forEach(function (opt) {
      html += '<label class="mbcf-profile-mode-opt">'
        + '<input type="radio" name="mbcf-profile-mode" class="mbcf-profile-mode-radio"'
          + ' value="' + escAttr(opt.value) + '"'
          + (mode === opt.value ? ' checked' : '')
          + ' /> '
        + escHtml(str(opt.key, opt.fb))
        + '</label>';
    });
    html += '</div>';

    // show_all: independent checkbox (not a mode)
    html += '<div class="mbcf-profile-show-all-row">'
      + '<label class="mbcf-profile-mode-opt">'
        + '<input type="checkbox" class="mbcf-profile-show-all-check"'
          + (showAll ? ' checked' : '')
          + ' /> '
        + escHtml(str('profile_show_all', 'Show all MyBooking fields'))
      + '</label>'
    + '</div>';

    // Auto: show detected profile info + refresh button
    if (mode === 'auto') {
      if (!noProfile) {
        var engineLabels = [];
        if (p.engines && p.engines.length) {
          p.engines.forEach(function (e) {
            engineLabels.push(escHtml(engineLabel(e)));
          });
        }
        html += '<div class="mbcf-profile-info">';
        html += '<div class="mbcf-profile-info-row">'
          + '<span class="mbcf-profile-info-label">'
            + escHtml(str('profile_detected_engines', 'Detected engines')) + ':'
          + '</span> '
          + '<span class="mbcf-profile-info-value">'
            + (engineLabels.length ? engineLabels.join(', ') : '—')
          + '</span>'
          + '</div>';
        if (p.engines && p.engines.indexOf('renting') !== -1 && p.renting_business_line) {
          html += '<div class="mbcf-profile-info-row">'
            + '<span class="mbcf-profile-info-label">'
              + escHtml(str('profile_renting_family', 'Renting family')) + ':'
            + '</span> '
            + '<span class="mbcf-profile-info-value">'
              + escHtml(rentingFamilyLabel(p.renting_business_line))
            + '</span>'
            + '</div>';
        }
        html += '</div>';
      } else {
        html += '<div class="mbcf-profile-unavailable">'
          + escHtml(str('profile_unavailable', 'Profile detection unavailable'))
          + '</div>';
      }
      html += '<div class="mbcf-profile-toolbar-actions">'
        + '<button type="button" class="mbcf-profile-refresh button button-small">'
          + escHtml(str('profile_refresh', 'Refresh profile'))
        + '</button>'
        + '</div>';
    }

    // Manual: engine checkboxes + renting business line select
    if (mode === 'manual') {
      var manualEngines = prefs.engines || [];
      var manualBL      = prefs.renting_business_line || 'generic';
      var hasRenting    = manualEngines.indexOf('renting') !== -1;

      html += '<div class="mbcf-profile-manual">';
      html += '<div class="mbcf-profile-manual-engines">';
      [
        { value: 'renting',    key: 'engine_renting',   fb: 'Renting'    },
        { value: 'activities', key: 'group_activities',  fb: 'Activities' },
        { value: 'transfers',  key: 'group_transfers',   fb: 'Transfers'  }
      ].forEach(function (eng) {
        html += '<label class="mbcf-profile-manual-engine">'
          + '<input type="checkbox" class="mbcf-profile-engine-check"'
            + ' value="' + escAttr(eng.value) + '"'
            + (manualEngines.indexOf(eng.value) !== -1 ? ' checked' : '')
            + ' /> '
          + escHtml(str(eng.key, eng.fb))
          + '</label>';
      });
      html += '</div>';

      if (hasRenting) {
        html += '<div class="mbcf-profile-manual-bl">'
          + '<label class="mbcf-profile-manual-bl-label">'
            + escHtml(str('profile_renting_family', 'Renting family'))
          + '</label>'
          + '<select class="mbcf-profile-bl-select">';
        [
          { value: 'generic',       key: 'family_generic',       fb: 'Generic renting'  },
          { value: 'vehicle',       key: 'group_vehicles',       fb: 'Vehicles'          },
          { value: 'boat',          key: 'group_boats',          fb: 'Boats / skipper'   },
          { value: 'accommodation', key: 'group_accommodation',  fb: 'Accommodation'     }
        ].forEach(function (opt) {
          html += '<option value="' + escAttr(opt.value) + '"'
            + (manualBL === opt.value ? ' selected' : '')
            + '>' + escHtml(str(opt.key, opt.fb)) + '</option>';
        });
        html += '</select></div>';
      }
      html += '</div>';
    }

    html += '</div>';
    return html;
  }

  function renderSlot(row, slotIndex) {
    var key = row.fields[slotIndex];

    if (key && state.fields[key]) {
      var locked   = isLocked(key);
      var f        = state.fields[key];
      var override = state.config.field_overrides[key] || {};
      var byLang   = override.by_lang || {};

      var typeBadges = '';
      if (f.type === 'date') typeBadges += '<span class="mbcf-badge mbcf-badge--date">' + escHtml(str('badge_date', 'date')) + '</span>';
      if (f.has_intl_tel) typeBadges += '<span class="mbcf-badge mbcf-badge--tel">' + escHtml(str('badge_tel', 'tel')) + '</span>';
      if (f.special)      typeBadges += '<span class="mbcf-badge mbcf-badge--special">&#9670;</span>';

      var removeBtn = locked
        ? '<span class="mbcf-locked dashicons dashicons-lock" title="' + escAttr(str('field_required', 'Required')) + '"></span>'
        : '<button type="button" class="mbcf-remove-field button-link"'
            + ' data-row="' + row.id + '" data-slot="' + slotIndex + '"'
            + ' title="' + escAttr(str('remove_field', 'Remove')) + '">&#x2715;</button>';

      var forcedByEngine  = isEngineForced(key);
      var forcedByAccount = isAccountRequired(key);
      var forcedRequired  = locked || forcedByEngine || forcedByAccount;
      var savedRequired   = (override.required !== undefined) ? override.required : (f.required || false);
      var currentRequired = forcedRequired ? true : savedRequired;

      if (forcedByAccount) {
        typeBadges += '<span class="mbcf-badge mbcf-badge--required-forced">'
          + escHtml(str('badge_required_by_account', 'Required by account')) + '</span>';
      } else if (forcedByEngine) {
        typeBadges += '<span class="mbcf-badge mbcf-badge--required-forced">'
          + escHtml(str('badge_required_by_engine', 'Required by engine')) + '</span>';
      }
      var multiLang = state.langs.length > 1;
      var tags = '';
      if (hasOverrideText(key, 'label')) {
        tags += '<span class="mbcf-slot-tag mbcf-slot-tag--label">'
          + escHtml(str('tag_label', 'Label'))
          + (multiLang ? buildLangPills(key, 'label') : '')
          + '</span>';
      }
      if (hasOverrideText(key, 'placeholder')) {
        tags += '<span class="mbcf-slot-tag mbcf-slot-tag--placeholder">'
          + escHtml(str('tag_placeholder', 'PH'))
          + (multiLang ? buildLangPills(key, 'placeholder') : '')
          + '</span>';
      }
      if (currentRequired) {
        tags += '<span class="mbcf-slot-tag mbcf-slot-tag--required">' + escHtml(str('tag_required', 'Req.')) + '</span>';
      }
      var tagsHtml = tags
        ? '<div class="mbcf-slot-tags">' + tags + '</div>'
        : '';

      var activeLang = state.defaultLang || (state.langs.length ? state.langs[0] : '');
      var langsToRender = state.langs.length ? state.langs : (activeLang ? [activeLang] : ['']);

      var tabsHtml = '';
      if (langsToRender.length > 1) {
        tabsHtml = '<div class="mbcf-lang-tabs">';
        langsToRender.forEach(function (lang) {
          var isActive = (lang === activeLang);
          tabsHtml += '<button type="button"'
            + ' class="mbcf-lang-tab' + (isActive ? ' mbcf-lang-tab--active' : '') + '"'
            + ' data-field="' + escAttr(key) + '" data-lang="' + escAttr(lang) + '"'
            + ' title="' + escAttr(lang) + '">'
            + escHtml(langFriendlyName(lang))
            + '</button>';
        });
        tabsHtml += '</div>';
      }

      var langContentsHtml = '';
      langsToRender.forEach(function (lang) {
        var lv = byLang[lang] || { label: '', placeholder: '' };
        var isActive = (lang === activeLang);
        langContentsHtml += '<div class="mbcf-lang-content' + (isActive ? ' mbcf-lang-content--active' : '') + '"'
          + ' data-field="' + escAttr(key) + '" data-lang="' + escAttr(lang) + '">'
          + '<div class="mbcf-field-settings-row">'
            + '<span class="mbcf-field-settings-label">' + str('field_label', 'Label') + '</span>'
            + '<input type="text" class="mbcf-field-label-override"'
              + ' data-field="' + escAttr(key) + '" data-lang="' + escAttr(lang) + '"'
              + ' value="' + escAttr(lv.label || '') + '"'
              + ' placeholder="' + escAttr(fieldDisplayLabel(key)) + '" />'
          + '</div>'
          + '<div class="mbcf-field-settings-row">'
            + '<span class="mbcf-field-settings-label">' + str('field_placeholder', 'Placeholder') + '</span>'
            + '<input type="text" class="mbcf-field-placeholder-override"'
              + ' data-field="' + escAttr(key) + '" data-lang="' + escAttr(lang) + '"'
              + ' value="' + escAttr(lv.placeholder || '') + '"'
              + ' placeholder="' + escAttr(f.placeholder || '') + '" />'
          + '</div>'
          + '</div>';
      });

      var requiredCheckHtml = '';
      if (!locked) {
        var checkDisabled = forcedByEngine || forcedByAccount;
        requiredCheckHtml = '<div class="mbcf-field-settings-row mbcf-field-settings-row--check">'
          + '<label>'
            + '<input type="checkbox" class="mbcf-field-required-override"'
              + ' data-field="' + escAttr(key) + '"'
              + (currentRequired ? ' checked' : '')
              + (checkDisabled ? ' disabled' : '')
              + ' />'
            + ' ' + str('field_required_label', 'Required field');
        if (checkDisabled) {
          // Precedence: account > engine (matches badge order above).
          var forcedNote = forcedByAccount
            ? str('badge_required_by_account', 'Required by account')
            : str('badge_required_by_engine', 'Required by engine');
          requiredCheckHtml += ' <em class="mbcf-forced-note">(' + escHtml(forcedNote) + ')</em>';
        }
        requiredCheckHtml += '</label></div>';
      }

      var settingsPanel = '<div class="mbcf-field-settings" draggable="false">'
        + tabsHtml
        + langContentsHtml
        + requiredCheckHtml
        + '<div class="mbcf-field-settings-row mbcf-field-settings-row--actions">'
          + '<button type="button" class="mbcf-field-settings-close button button-small">'
            + str('field_settings_done', '&#10003; Done') + '</button>'
        + '</div>'
        + '</div>';

      return '<div class="mbcf-slot mbcf-slot--filled" draggable="true"'
        + ' data-row="' + row.id + '" data-slot="' + slotIndex + '" data-field="' + escAttr(key) + '">'
        + '<div class="mbcf-slot-header">'
          + '<span class="mbcf-drag-handle dashicons dashicons-move"></span>'
          + '<span class="mbcf-field-label' + (locked ? ' mbcf-field-label--locked' : '') + '">'
            + escHtml(fieldDisplayLabel(key))
          + '</span>'
          + typeBadges
          + '<button type="button" class="mbcf-field-settings-btn button-link"'
            + ' data-field="' + escAttr(key) + '"'
            + ' title="' + escAttr(str('field_settings', 'Field settings')) + '">'
            + '<span class="dashicons dashicons-edit"></span></button>'
          + removeBtn
        + '</div>'
        + tagsHtml
        + settingsPanel
        + '</div>';
    }

    return '<div class="mbcf-slot mbcf-slot--empty"'
      + ' data-row="' + row.id + '" data-slot="' + slotIndex + '">'
      + '<span class="mbcf-slot-hint">' + str('drop_here', 'Drop field here') + '</span>'
      + '</div>';
  }

  function renderRow(row) {
    var slotsHtml = '';
    var slotCount = row.fields.length;
    for (var i = 0; i < slotCount; i++) {
      slotsHtml += renderSlot(row, i);
    }
    return '<div class="mbcf-row mbcf-row--' + row.layout + '" data-row-id="' + row.id + '">'
      + '<span class="mbcf-row-handle dashicons dashicons-menu" title="' + escAttr(str('drag_reorder', 'Drag to reorder')) + '"></span>'
      + '<div class="mbcf-row-slots mbcf-row-slots--' + row.layout + '">'
        + slotsHtml
      + '</div>'
      + '<button type="button" class="mbcf-remove-row button-link" data-row="' + row.id + '"'
        + ' title="' + escAttr(str('remove_row', 'Remove row')) + '">'
        + '<span class="dashicons dashicons-trash" aria-hidden="true"></span>'
        + '<span class="screen-reader-text">' + escHtml(str('remove_row', 'Remove row')) + '</span>'
      + '</button>'
      + '</div>';
  }

  function renderSection(section) {
    var rowsHtml           = section.rows.map(renderRow).join('');
    var titleText          = resolvedTitle(section, state.defaultLang);
    var titleEditorHtml    = renderSectionTitleEditor(section);
    var subtitleEditorHtml = renderSectionSubtitleEditor(section);
    var titlePillsHtml     = isSectionTitleCustomized(section) ? buildSectionTitlePills(section) : '';

    var subtitleText      = resolvedSubtitle(section, state.defaultLang);
    var subtitleIsSet     = isSectionSubtitleSet(section);
    var subtitlePillsHtml = subtitleIsSet ? buildSectionSubtitlePills(section) : '';

    var isLocked        = sectionHasLockedFields(section);
    var titleEditorId   = 'mbcf-section-title-editor-' + section.id;
    var subtitleEditorId = 'mbcf-section-subtitle-editor-' + section.id;

    // Title card
    var titleCardHtml = '<div class="mbcf-section-card mbcf-section-card--title">'
      + '<div class="mbcf-section-card__meta">'
        + '<span class="mbcf-section-card__text">' + escHtml(titleText) + '</span>'
        + '<button type="button"'
          + ' class="mbcf-section-title-edit-btn button-link"'
          + ' data-section="' + escAttr(section.id) + '"'
          + ' aria-label="' + escAttr(str('edit_section_title', 'Edit section title')) + '"'
          + ' aria-expanded="false"'
          + ' aria-controls="' + escAttr(titleEditorId) + '">'
          + '<span class="dashicons dashicons-edit" aria-hidden="true"></span>'
        + '</button>'
      + '</div>'
      + titlePillsHtml
      + '</div>';

    // Subtitle card
    var subtitleCardHtml;
    if (subtitleIsSet) {
      subtitleCardHtml = '<div class="mbcf-section-card mbcf-section-card--subtitle">'
        + '<div class="mbcf-section-card__meta">'
          + '<span class="mbcf-section-card__text">' + escHtml(subtitleText) + '</span>'
          + '<button type="button"'
            + ' class="mbcf-section-subtitle-edit-btn button-link"'
            + ' data-section="' + escAttr(section.id) + '"'
            + ' aria-label="' + escAttr(str('edit_section_subtitle', 'Edit section subtitle')) + '"'
            + ' aria-expanded="false"'
            + ' aria-controls="' + escAttr(subtitleEditorId) + '">'
            + '<span class="dashicons dashicons-edit" aria-hidden="true"></span>'
          + '</button>'
        + '</div>'
        + subtitlePillsHtml
        + '</div>';
    } else {
      subtitleCardHtml = '<div class="mbcf-section-card mbcf-section-card--subtitle mbcf-section-card--subtitle-empty">'
        + '<button type="button"'
          + ' class="mbcf-section-subtitle-edit-btn mbcf-section-subtitle-add button-link"'
          + ' data-section="' + escAttr(section.id) + '"'
          + ' aria-label="' + escAttr(str('edit_section_subtitle', 'Edit section subtitle')) + '"'
          + ' aria-expanded="false"'
          + ' aria-controls="' + escAttr(subtitleEditorId) + '">'
          + '<span class="mbcf-section-card__text mbcf-section-card__text--muted">'
            + escHtml(str('section_subtitle_ph', 'Subtitle (optional)'))
          + '</span>'
          + ' <span class="dashicons dashicons-edit" aria-hidden="true"></span>'
        + '</button>'
        + '</div>';
    }

    // Remove / protected action
    var removeHtml;
    if (isLocked) {
      removeHtml = '<span class="mbcf-section-protected dashicons dashicons-lock"'
        + ' title="' + escAttr(str('cannot_remove_section', 'This section contains required fields and cannot be removed.')) + '"'
        + ' aria-hidden="true"></span>';
    } else {
      removeHtml = '<button type="button"'
        + ' class="mbcf-section-card__remove-btn button-link"'
        + ' data-section="' + escAttr(section.id) + '">'
        + '<span class="dashicons dashicons-trash" aria-hidden="true"></span>'
        + ' ' + escHtml(str('remove_section', 'Remove section'))
        + '</button>';
    }

    // Build title editor HTML with stable ID
    var titleEditorWithId = titleEditorHtml.replace(
      'class="mbcf-section-title-editor"',
      'class="mbcf-section-title-editor" id="' + escAttr(titleEditorId) + '"'
    );
    var subtitleEditorWithId = subtitleEditorHtml.replace(
      'class="mbcf-section-subtitle-editor"',
      'class="mbcf-section-subtitle-editor" id="' + escAttr(subtitleEditorId) + '"'
    );

    return '<div class="mbcf-section postbox" data-section-id="' + escAttr(section.id) + '">'
      + '<div class="mbcf-section-header inside">'
        + '<span class="mbcf-section-handle dashicons dashicons-menu" title="' + escAttr(str('drag_reorder', 'Drag to reorder')) + '"></span>'
        + '<div class="mbcf-section-meta-cols">'
          + '<div class="mbcf-section-meta-col">' + titleCardHtml + '</div>'
          + '<div class="mbcf-section-meta-col">' + subtitleCardHtml + '</div>'
        + '</div>'
        + '<div class="mbcf-section-actions">' + removeHtml + '</div>'
      + '</div>'
      + titleEditorWithId
      + subtitleEditorWithId
      + '<div class="mbcf-rows" data-section-id="' + escAttr(section.id) + '">' + rowsHtml + '</div>'
      + '<div class="mbcf-section-footer inside">'
        + '<button type="button" class="mbcf-add-row button button-secondary" data-section="' + escAttr(section.id) + '" data-layout="1col">'
          + str('add_row_1col', '+ Row (1 column)') + '</button>'
        + '<button type="button" class="mbcf-add-row button button-secondary" data-section="' + escAttr(section.id) + '" data-layout="2col">'
          + str('add_row_2col', '+ Row (2 columns)') + '</button>'
      + '</div>'
      + '</div>';
  }

  function renderSectionTemplatesPanel() {
    var templates = state.sectionTemplates;
    var keys = Object.keys(templates);
    if (!keys.length) return '';

    var html = '<div class="mbcf-sidebar-panel mbcf-section-templates-panel">'
      + '<h3 class="mbcf-sidebar-panel__title">' + escHtml(str('section_templates', 'Section templates')) + '</h3>';

    // Group template keys by parent_group
    var byGroup = {};
    PARENT_GROUP_ORDER.forEach(function (g) { byGroup[g] = []; });
    keys.forEach(function (key) {
      var g = templates[key].parent_group || 'general';
      if (!byGroup[g]) byGroup[g] = [];
      byGroup[g].push(key);
    });

    PARENT_GROUP_ORDER.forEach(function (groupKey) {
      var visibleTemplates = (byGroup[groupKey] || []).filter(function (key) {
        return isTemplateVisible(key);
      });
      if (!visibleTemplates.length) return;

      html += '<div class="mbcf-tpl-group">';
      html += '<div class="mbcf-tpl-group-label">' + escHtml(str('group_' + groupKey, groupKey)) + '</div>';

      visibleTemplates.forEach(function (key) {
        var tpl      = templates[key];
        var tplTitle = templateDisplayTitle(key, tpl);
        var placed   = templateFieldsInForm(key);
        var available = templateAvailableFields(key);
        var tplAllKeys = [];
        tpl.rows.forEach(function (row) { row.forEach(function (k) { if (k) tplAllKeys.push(k); }); });
        var allPlaced = (available.length === 0);
        var panelId   = 'mbcf-tpl-configurator-' + escAttr(key);

        html += '<div class="mbcf-tpl-card" data-tpl="' + escAttr(key) + '">';
        html += '<div class="mbcf-tpl-card__header">'
          + '<span class="mbcf-tpl-card__title">' + escHtml(tplTitle) + '</span>'
          + '<div class="mbcf-tpl-card__actions">';

        if (allPlaced) {
          html += '<button type="button" class="mbcf-tpl-quick-add button button-secondary" data-tpl="' + escAttr(key) + '" disabled>'
            + escHtml(str('add_section', '+ Add section')) + '</button>';
        } else {
          html += '<button type="button" class="mbcf-tpl-quick-add button button-secondary" data-tpl="' + escAttr(key) + '">'
            + escHtml(str('add_section', '+ Add section')) + '</button>';
        }

        html += '<button type="button" class="mbcf-tpl-configure-btn button-link" data-tpl="' + escAttr(key) + '"'
          + ' aria-expanded="false" aria-controls="' + escAttr(panelId) + '">'
          + escHtml(str('configure', 'Configure'))
          + ' <span class="mbcf-tpl-configure-caret" aria-hidden="true">&#9660;</span>'
          + '</button>';

        html += '</div>'; // .mbcf-tpl-card__actions

        if (allPlaced) {
          html += '<div class="mbcf-tpl-card__notice">'
            + escHtml(str('all_fields_in_template', 'All fields in this template are already in the form.'))
            + '</div>';
        }

        html += '</div>'; // .mbcf-tpl-card__header

        html += '<div class="mbcf-tpl-configurator" id="' + escAttr(panelId) + '" data-tpl="' + escAttr(key) + '" style="display:none">';
        html += '<div class="mbcf-tpl-field-list">';

        tpl.rows.forEach(function (row) {
          row.forEach(function (fieldKey) {
            if (!fieldKey) return;
            if (!isFieldVisible(fieldKey) && placed.indexOf(fieldKey) === -1) return;
            var fieldDef   = state.fields[fieldKey];
            var label      = fieldDef ? (fieldDef.label || fieldKey) : fieldKey;
            var isInForm   = (placed.indexOf(fieldKey) !== -1);
            var fieldLocked = isLocked(fieldKey);
            var checkId    = 'mbcf-tpl-chk-' + escAttr(key) + '-' + escAttr(fieldKey);

            html += '<div class="mbcf-tpl-field-row">'
              + '<label class="mbcf-tpl-field-label">'
                + '<input type="checkbox" class="mbcf-tpl-field-check"'
                  + ' id="' + escAttr(checkId) + '"'
                  + ' data-tpl="' + escAttr(key) + '"'
                  + ' data-field="' + escAttr(fieldKey) + '"'
                  + (isInForm ? '' : ' checked')
                  + ' />'
                + ' ' + escHtml(label);

            if (isInForm) {
              var status = str('already_in_form', 'Already in form');
              if (fieldLocked) { status += ' — ' + str('field_required', 'Required'); }
              html += ' <span class="mbcf-tpl-field-status">' + escHtml(status) + '</span>';
            }

            html += '</label></div>';
          });
        });

        html += '</div>'; // .mbcf-tpl-field-list

        var ctaId = 'mbcf-tpl-confirm-' + escAttr(key);
        html += '<div class="mbcf-tpl-configurator__cta">'
          + '<button type="button" class="mbcf-tpl-confirm-btn button button-secondary" id="' + escAttr(ctaId) + '" data-tpl="' + escAttr(key) + '">'
            + escHtml(str('add_section', '+ Add section'))
          + '</button></div>';

        html += '</div>'; // .mbcf-tpl-configurator
        html += '</div>'; // .mbcf-tpl-card
      });

      html += '</div>'; // .mbcf-tpl-group
    });

    // ── Custom section card (always last) ─────────────────────────────────────
    var inFormForCustom = fieldsInForm();
    var coveredByTpl    = {};

    html += '<div class="mbcf-tpl-card mbcf-tpl-card--custom">';
    html += '<div class="mbcf-tpl-card__header">'
      + '<span class="mbcf-tpl-card__title">'
        + '<span class="mbcf-custom-btn__plus" aria-hidden="true">+</span> '
        + escHtml(str('custom_section', 'Custom section'))
      + '</span>'
      + '</div>';
    html += '<div class="mbcf-tpl-custom-title-row">'
      + '<input type="text" class="mbcf-custom-section-title regular-text"'
        + ' placeholder="' + escAttr(str('section_title_label', 'Title')) + '" />'
      + '</div>';
    html += '<div class="mbcf-tpl-custom-utils">'
      + '<button type="button" class="mbcf-custom-select-available button-link">'
        + escHtml(str('select_available_fields', 'Select available fields'))
      + '</button>'
      + ' <button type="button" class="mbcf-custom-clear-selection button-link">'
        + escHtml(str('clear_selection', 'Clear selection'))
      + '</button>'
      + '</div>';
    html += '<div class="mbcf-tpl-field-list">';

    // 3-level: parent group → template subgroup → fields
    PARENT_GROUP_ORDER.forEach(function (groupKey) {
      var groupHtml = '';
      Object.keys(state.sectionTemplates).forEach(function (tplKey) {
        var tpl = state.sectionTemplates[tplKey];
        if ((tpl.parent_group || 'general') !== groupKey) return;
        var subgroupFields = [];
        tpl.rows.forEach(function (row) {
          row.forEach(function (fieldKey) {
            if (!fieldKey) return;
            coveredByTpl[fieldKey] = true;
            if (!isFieldVisible(fieldKey) && inFormForCustom.indexOf(fieldKey) === -1) return;
            subgroupFields.push(fieldKey);
          });
        });
        if (!subgroupFields.length) return;

        groupHtml += '<div class="mbcf-tpl-custom-subgroup">'
          + '<div class="mbcf-tpl-custom-subgroup-label">' + escHtml(templateDisplayTitle(tplKey, tpl)) + '</div>';

        subgroupFields.forEach(function (fieldKey) {
          var fieldDef   = state.fields[fieldKey];
          var label      = fieldDef ? (fieldDef.label || fieldKey) : fieldKey;
          var isInForm   = (inFormForCustom.indexOf(fieldKey) !== -1);
          var fieldLocked = isLocked(fieldKey);
          var checkId    = 'mbcf-custom-chk-' + escAttr(fieldKey);

          groupHtml += '<div class="mbcf-tpl-field-row">'
            + '<label class="mbcf-tpl-field-label">'
              + '<input type="checkbox" class="mbcf-tpl-field-check mbcf-custom-field-check"'
                + ' id="' + escAttr(checkId) + '"'
                + ' data-field="' + escAttr(fieldKey) + '"'
                + (isInForm ? '' : ' checked')
                + ' />'
              + ' ' + escHtml(label);
          if (isInForm) {
            var status = str('already_in_form', 'Already in form');
            if (fieldLocked) { status += ' — ' + str('field_required', 'Required'); }
            groupHtml += ' <span class="mbcf-tpl-field-status">' + escHtml(status) + '</span>';
          }
          groupHtml += '</label></div>';
        });

        groupHtml += '</div>'; // .mbcf-tpl-custom-subgroup
      });

      if (!groupHtml) return;

      html += '<div class="mbcf-tpl-custom-group">'
        + '<div class="mbcf-tpl-custom-group-label">' + escHtml(str('group_' + groupKey, groupKey)) + '</div>'
        + groupHtml
        + '</div>';
    });

    // Engine specials (not covered by any template)
    var engineSpecials = Object.keys(state.fields).filter(function (k) {
      return !coveredByTpl[k] && isFieldVisible(k);
    });
    if (engineSpecials.length) {
      html += '<div class="mbcf-tpl-custom-group">'
        + '<div class="mbcf-tpl-custom-group-label">' + escHtml(str('group_engine', 'Engine fields')) + '</div>';
      engineSpecials.forEach(function (fieldKey) {
        var fieldDef   = state.fields[fieldKey];
        var label      = fieldDef ? (fieldDef.label || fieldKey) : fieldKey;
        var isInForm   = (inFormForCustom.indexOf(fieldKey) !== -1);
        var fieldLocked = isLocked(fieldKey);
        var checkId    = 'mbcf-custom-chk-' + escAttr(fieldKey);
        html += '<div class="mbcf-tpl-field-row">'
          + '<label class="mbcf-tpl-field-label">'
            + '<input type="checkbox" class="mbcf-tpl-field-check mbcf-custom-field-check"'
              + ' id="' + escAttr(checkId) + '"'
              + ' data-field="' + escAttr(fieldKey) + '"'
              + (isInForm ? '' : ' checked')
              + ' />'
            + ' ' + escHtml(label);
        if (isInForm) {
          var status = str('already_in_form', 'Already in form');
          if (fieldLocked) { status += ' — ' + str('field_required', 'Required'); }
          html += ' <span class="mbcf-tpl-field-status">' + escHtml(status) + '</span>';
        }
        html += '</label></div>';
      });
      html += '</div>';
    }

    html += '</div>'; // .mbcf-tpl-field-list
    html += '<div class="mbcf-tpl-configurator__cta">'
      + '<button type="button" class="mbcf-custom-confirm-btn button button-secondary" disabled>'
        + escHtml(str('add_section', '+ Add section'))
      + '</button>'
      + '</div>';
    html += '</div>'; // .mbcf-tpl-card--custom

    html += '</div>'; // .mbcf-sidebar-panel
    return html;
  }

  function render() {
    var sectionsHtml = state.config.sections.map(renderSection).join('');
    var sectionTemplatesLabel = str('section_templates', 'Section templates');

    var html = '<div class="mbcf-layout">'
      + '<div class="mbcf-form-area">'
        + '<div id="mbcf-sections">' + sectionsHtml + '</div>'
      + '</div>'
      + '<aside class="mbcf-builder-sidebar" aria-label="' + escAttr(sectionTemplatesLabel) + '">'
        + renderProfileToolbar()
        + renderSectionTemplatesPanel()
      + '</aside>'
    + '</div>';

    $('#' + BUILDER_ID).html(html);
    syncInput();
    initSortable();
  }

  // ── jQuery UI Sortable (re-wired after each render) ─────────────────────────

  function initSortable() {
    if (typeof $.fn.sortable === 'undefined') return;

    $('#mbcf-sections').sortable({
      handle:      '.mbcf-section-handle',
      placeholder: 'mbcf-section-placeholder',
      tolerance:   'pointer',
      cursor:      'grabbing',
      update: function () {
        var newOrder = [];
        $(this).children('.mbcf-section').each(function () {
          newOrder.push($(this).data('section-id'));
        });
        reorderSections(newOrder);
      }
    });

    $('.mbcf-rows').sortable({
      handle:               '.mbcf-row-handle',
      placeholder:          'mbcf-row-placeholder',
      forcePlaceholderSize: true,
      tolerance:            'pointer',
      cursor:               'grabbing',
      update: function (e, ui) {
        if (this !== ui.item.parent()[0]) return;
        var sectionId = $(this).data('section-id');
        var newOrder  = [];
        $(this).children('.mbcf-row').each(function () {
          newOrder.push($(this).data('row-id'));
        });
        reorderRows(sectionId, newOrder);
      }
    });
  }

  // ── HTML5 Drag-and-Drop ─────────────────────────────────────────────────────

  var drag = { field: null, fromRow: null, fromSlot: null };

  function initDragEvents() {
    var $doc = $(document);

    $doc.on('dragstart.mbcf', '.mbcf-slot--filled', function (e) {
      if ($(this).hasClass('mbcf-slot--settings-open')) {
        e.preventDefault();
        return;
      }
      if ($(e.target).hasClass('mbcf-row-handle') || $(e.target).hasClass('mbcf-section-handle')) {
        e.preventDefault();
        return;
      }
      drag.field    = $(this).data('field');
      drag.fromRow  = $(this).data('row');
      drag.fromSlot = parseInt($(this).data('slot'), 10);
      e.originalEvent.dataTransfer.effectAllowed = 'move';
      e.originalEvent.dataTransfer.setData('text/plain', drag.field);
      $(this).addClass('mbcf-is-dragging');
    });

    $doc.on('dragend.mbcf', '.mbcf-slot--filled', function () {
      drag.field = drag.fromRow = drag.fromSlot = null;
      $(this).removeClass('mbcf-is-dragging');
    });

    $doc.on('dragover.mbcf', '.mbcf-slot', function (e) {
      if (!drag.field) return;
      e.preventDefault();
      e.originalEvent.dataTransfer.dropEffect = 'move';
      $(this).addClass('mbcf-drag-over');
    });

    $doc.on('dragleave.mbcf', '.mbcf-slot', function () {
      $(this).removeClass('mbcf-drag-over');
    });

    $doc.on('drop.mbcf', '.mbcf-slot', function (e) {
      e.preventDefault();
      $(this).removeClass('mbcf-drag-over');
      if (!drag.field) return;
      var targetRow  = $(this).data('row');
      var targetSlot = parseInt($(this).data('slot'), 10);
      if (drag.fromRow === targetRow && drag.fromSlot === targetSlot) return;
      placeFieldInSlot(drag.field, targetRow, targetSlot, drag.fromRow, drag.fromSlot);
    });
  }

  // ── Button and input events ─────────────────────────────────────────────────

  function initEvents() {
    var $b = $('#' + BUILDER_ID);

    $b.on('click.mbcf', '.mbcf-section-card__remove-btn', function () {
      var sectionId = $(this).data('section');
      removeSection(sectionId, this);
    });

    $b.on('click.mbcf', '.mbcf-add-row', function () {
      addRow($(this).data('section'), $(this).data('layout'));
    });

    $b.on('click.mbcf', '.mbcf-remove-row', function () {
      removeRow($(this).data('row'));
    });

    $b.on('click.mbcf', '.mbcf-remove-field', function (e) {
      e.stopPropagation();
      removeFieldFromSlot($(this).data('row'), parseInt($(this).data('slot'), 10));
    });

    // Section title editor — open/close with aria-expanded + focus
    $b.on('click.mbcf', '.mbcf-section-title-edit-btn', function (e) {
      e.stopPropagation();
      var $btn   = $(this);
      var $sec   = $btn.closest('.mbcf-section');
      var isOpen = $sec.hasClass('mbcf-section--title-open');
      $b.find('.mbcf-section--title-open').each(function () {
        $(this).removeClass('mbcf-section--title-open');
        $(this).find('.mbcf-section-title-editor').hide();
        $(this).find('.mbcf-section-title-edit-btn').attr('aria-expanded', 'false');
      });
      if (!isOpen) {
        $sec.addClass('mbcf-section--title-open');
        var $editor = $sec.find('.mbcf-section-title-editor');
        $editor.show();
        $btn.attr('aria-expanded', 'true');
        $editor.find('input, button').first().focus();
      }
    });

    $b.on('click.mbcf', '.mbcf-section-title-editor-close', function (e) {
      e.stopPropagation();
      var sectionId = $(this).data('section');
      var $sec = $b.find('[data-section-id="' + sectionId + '"]');
      $sec.removeClass('mbcf-section--title-open');
      $sec.find('.mbcf-section-title-editor').hide();
      var $opener = $sec.find('.mbcf-section-title-edit-btn');
      $opener.attr('aria-expanded', 'false');
      $opener.focus();
    });

    // Section subtitle editor — open/close with aria-expanded + focus
    $b.on('click.mbcf', '.mbcf-section-subtitle-edit-btn', function (e) {
      e.stopPropagation();
      var $btn   = $(this);
      var $sec   = $btn.closest('.mbcf-section');
      var isOpen = $sec.hasClass('mbcf-section--subtitle-open');
      $b.find('.mbcf-section--subtitle-open').each(function () {
        $(this).removeClass('mbcf-section--subtitle-open');
        $(this).find('.mbcf-section-subtitle-editor').hide();
        $(this).find('.mbcf-section-subtitle-edit-btn').attr('aria-expanded', 'false');
      });
      if (!isOpen) {
        $sec.addClass('mbcf-section--subtitle-open');
        var $editor = $sec.find('.mbcf-section-subtitle-editor');
        $editor.show();
        $btn.attr('aria-expanded', 'true');
        $editor.find('input, button').first().focus();
      }
    });

    $b.on('click.mbcf', '.mbcf-section-subtitle-editor-close', function (e) {
      e.stopPropagation();
      var sectionId = $(this).data('section');
      var $sec = $b.find('[data-section-id="' + sectionId + '"]');
      $sec.removeClass('mbcf-section--subtitle-open');
      $sec.find('.mbcf-section-subtitle-editor').hide();
      var $opener = $sec.find('.mbcf-section-subtitle-edit-btn');
      $opener.attr('aria-expanded', 'false');
      $opener.focus();
    });

    // Section title lang tab switch
    $b.on('click.mbcf', '.mbcf-section-title-tab', function (e) {
      e.stopPropagation();
      var $editor = $(this).closest('.mbcf-section-title-editor');
      var lang    = $(this).data('lang');
      $editor.find('.mbcf-section-title-tab').removeClass('mbcf-lang-tab--active');
      $(this).addClass('mbcf-lang-tab--active');
      $editor.find('.mbcf-section-title-content').removeClass('mbcf-lang-content--active');
      $editor.find('.mbcf-section-title-content[data-lang="' + lang + '"]').addClass('mbcf-lang-content--active');
    });

    // Section subtitle lang tab switch
    $b.on('click.mbcf', '.mbcf-section-subtitle-tab', function (e) {
      e.stopPropagation();
      var $editor = $(this).closest('.mbcf-section-subtitle-editor');
      var lang    = $(this).data('lang');
      $editor.find('.mbcf-section-subtitle-tab').removeClass('mbcf-lang-tab--active');
      $(this).addClass('mbcf-lang-tab--active');
      $editor.find('.mbcf-section-subtitle-content').removeClass('mbcf-lang-content--active');
      $editor.find('.mbcf-section-subtitle-content[data-lang="' + lang + '"]').addClass('mbcf-lang-content--active');
    });

    // Section title inputs
    $b.on('input.mbcf', '.mbcf-section-title-by-lang', function () {
      setSectionTitleByLang($(this).data('section'), $(this).data('lang'), $(this).val());
    });

    $b.on('input.mbcf', '.mbcf-section-title-fallback', function () {
      setSectionTitleFallback($(this).data('section'), $(this).val());
    });

    // Section subtitle inputs
    $b.on('input.mbcf', '.mbcf-section-subtitle-fallback', function () {
      setSectionSubtitleFallback($(this).data('section'), $(this).val());
    });

    $b.on('input.mbcf', '.mbcf-section-subtitle-by-lang', function () {
      setSectionSubtitleByLang($(this).data('section'), $(this).data('lang'), $(this).val());
    });

    // Toggle field settings panel
    $b.on('click.mbcf', '.mbcf-field-settings-btn', function (e) {
      e.stopPropagation();
      var $slot  = $(this).closest('.mbcf-slot--filled');
      var isOpen = $slot.hasClass('mbcf-slot--settings-open');
      $b.find('.mbcf-slot--settings-open')
        .removeClass('mbcf-slot--settings-open')
        .attr('draggable', 'true');
      if (!isOpen) {
        $slot.addClass('mbcf-slot--settings-open').attr('draggable', 'false');
      }
    });

    $b.on('click.mbcf', '.mbcf-field-settings-close', function (e) {
      e.stopPropagation();
      render();
    });

    // Language tab switch for field settings (scoped to .mbcf-field-settings)
    $b.on('click.mbcf', '.mbcf-field-settings .mbcf-lang-tab', function (e) {
      e.stopPropagation();
      var $panel  = $(this).closest('.mbcf-field-settings');
      var lang    = $(this).data('lang');
      $panel.find('.mbcf-lang-tab').removeClass('mbcf-lang-tab--active');
      $(this).addClass('mbcf-lang-tab--active');
      $panel.find('.mbcf-lang-content').removeClass('mbcf-lang-content--active');
      $panel.find('.mbcf-lang-content[data-lang="' + lang + '"]').addClass('mbcf-lang-content--active');
    });

    $b.on('input.mbcf', '.mbcf-field-label-override', function () {
      var key  = $(this).data('field');
      var lang = $(this).data('lang');
      var val  = $(this).val();
      ensureByLang(key, lang).label = val;
      syncInput();
    });

    $b.on('input.mbcf', '.mbcf-field-placeholder-override', function () {
      var key  = $(this).data('field');
      var lang = $(this).data('lang');
      var val  = $(this).val();
      ensureByLang(key, lang).placeholder = val;
      syncInput();
    });

    $b.on('change.mbcf', '.mbcf-field-required-override', function () {
      var key = $(this).data('field');
      var val = $(this).prop('checked');
      ensureOverride(key).required = val;
      syncInput();
    });

    // Reset to default — delegated from parent form (button is in static PHP action bar)
    $b.closest('form').on('click.mbcf', '#mbcf-reset-default', function () {
      resetToDefault();
    });

    // ── Section template events ────────────────────────────────────────────────

    // Quick Add button
    $b.on('click.mbcf', '.mbcf-tpl-quick-add', function () {
      var key = $(this).data('tpl');
      var tpl = state.sectionTemplates[key];
      if (!tpl) return;

      var placed    = templateFieldsInForm(key);
      var available = templateAvailableFields(key);

      if (available.length === 0) {
        // All placed — do nothing (button is disabled, but guard anyway)
        return;
      }

      if (placed.length > 0) {
        // Any already placed → open Configure instead, no mutation
        openTemplateConfigurator(key);
        return;
      }

      // All available → insert immediately
      var allKeys = [];
      tpl.rows.forEach(function (row) {
        row.forEach(function (k) { if (k) allKeys.push(k); });
      });
      insertSectionTemplate(key, allKeys);
    });

    // Configure disclosure toggle
    $b.on('click.mbcf', '.mbcf-tpl-configure-btn', function () {
      var key = $(this).data('tpl');
      var $panel = $b.find('.mbcf-tpl-configurator[data-tpl="' + key + '"]');
      var isOpen = $panel.is(':visible');

      // Close all other configurators
      $b.find('.mbcf-tpl-configurator').each(function () {
        if ($(this).data('tpl') !== key) {
          $(this).hide();
          var $btn = $b.find('.mbcf-tpl-configure-btn[data-tpl="' + $(this).data('tpl') + '"]');
          $btn.attr('aria-expanded', 'false');
        }
      });

      if (isOpen) {
        $panel.hide();
        $(this).attr('aria-expanded', 'false');
      } else {
        $panel.show();
        $(this).attr('aria-expanded', 'true');
        // Focus first checkbox
        $panel.find('.mbcf-tpl-field-check').first().focus();
      }
    });

    // Checkbox change — enable/disable CTA (standard templates only)
    $b.on('change.mbcf', '.mbcf-tpl-field-check', function () {
      if ($(this).closest('.mbcf-tpl-card--custom').length) return;
      var key = $(this).data('tpl');
      var $panel = $b.find('.mbcf-tpl-configurator[data-tpl="' + key + '"]');
      var anyChecked = $panel.find('.mbcf-tpl-field-check:checked').length > 0;
      $panel.find('.mbcf-tpl-confirm-btn').prop('disabled', !anyChecked);
    });

    // Confirm CTA inside standard template configurator
    $b.on('click.mbcf', '.mbcf-tpl-confirm-btn', function () {
      var key = $(this).data('tpl');
      var $panel = $b.find('.mbcf-tpl-configurator[data-tpl="' + key + '"]');
      var selectedFields = [];
      $panel.find('.mbcf-tpl-field-check:checked').each(function () {
        selectedFields.push($(this).data('field'));
      });
      if (selectedFields.length === 0) return;
      var ctaEl = this;
      confirmAndInsertSection(selectedFields, function () {
        insertSectionTemplate(key, selectedFields);
      }, ctaEl);
    });

    // ── Custom section events ──────────────────────────────────────────────────

    $b.on('input.mbcf', '.mbcf-custom-section-title', function () {
      var titleVal = $(this).val().trim();
      $(this).closest('.mbcf-tpl-card--custom').find('.mbcf-custom-confirm-btn')
        .prop('disabled', titleVal === '');
    });

    $b.on('click.mbcf', '.mbcf-custom-select-available', function () {
      var inForm = fieldsInForm();
      $(this).closest('.mbcf-tpl-card--custom').find('.mbcf-custom-field-check').each(function () {
        var fieldKey = $(this).data('field');
        $(this).prop('checked', inForm.indexOf(fieldKey) === -1);
      });
    });

    $b.on('click.mbcf', '.mbcf-custom-clear-selection', function () {
      $(this).closest('.mbcf-tpl-card--custom').find('.mbcf-custom-field-check')
        .prop('checked', false);
    });

    $b.on('click.mbcf', '.mbcf-custom-confirm-btn', function () {
      var $card = $(this).closest('.mbcf-tpl-card--custom');
      var titleVal = $card.find('.mbcf-custom-section-title').val().trim();
      if (!titleVal) return;
      var selectedFields = [];
      $card.find('.mbcf-custom-field-check:checked').each(function () {
        selectedFields.push($(this).data('field'));
      });
      var ctaEl = this;
      confirmAndInsertSection(selectedFields, function () {
        insertCustomSection(titleVal, selectedFields);
        $card.find('.mbcf-custom-section-title').val('');
        $card.find('.mbcf-custom-confirm-btn').prop('disabled', true);
      }, ctaEl);
    });

    // ── Profile toolbar events (P3.1) ─────────────────────────────────────────

    $b.on('change.mbcf', '.mbcf-profile-mode-radio', function () {
      var newMode = $(this).val();
      var nextPrefs = deepClone(state.profilePreferences || { mode: 'auto' });
      nextPrefs.mode = newMode;
      saveProfilePreferences(nextPrefs);
      // render() is called inside saveProfilePreferences on success/error.
    });

    $b.on('change.mbcf', '.mbcf-profile-show-all-check', function () {
      var nextPrefs = deepClone(state.profilePreferences || { mode: 'auto' });
      nextPrefs.show_all = $(this).prop('checked');
      saveProfilePreferences(nextPrefs);
    });

    $b.on('change.mbcf', '.mbcf-profile-engine-check', function () {
      var engines = [];
      $b.find('.mbcf-profile-engine-check:checked').each(function () {
        engines.push($(this).val());
      });
      var nextPrefs = deepClone(state.profilePreferences || { mode: 'auto' });
      nextPrefs.engines = engines;
      saveProfilePreferences(nextPrefs);
    });

    $b.on('change.mbcf', '.mbcf-profile-bl-select', function () {
      var nextPrefs = deepClone(state.profilePreferences || { mode: 'auto' });
      nextPrefs.renting_business_line = $(this).val();
      saveProfilePreferences(nextPrefs);
    });

    $b.on('click.mbcf', '.mbcf-profile-refresh', function () {
      var ajaxUrl = str('_ajax_url', '');
      var nonce   = str('_nonce_profile_prefs', '');
      if (!ajaxUrl || !nonce) return;

      var $btn = $(this);
      $btn.prop('disabled', true);

      var seq = ++_profileReqSeq;

      $.ajax({
        url:    ajaxUrl,
        method: 'POST',
        data:   { action: 'mbcf_flush_profile_cache', nonce: nonce },
        success: function (resp) {
          if (seq !== _profileReqSeq) return; // stale: a newer request already owns state
          if (resp && resp.success && resp.data) {
            applyProfileUpdate(null, resp.data.profile, resp.data.engine_required);
          }
          render();
        },
        error: function () {
          if (seq !== _profileReqSeq) return;
          render();
          announce(str('profile_unavailable', 'Profile detection unavailable'));
        }
      });
    });
  }

  // ── Bootstrap ───────────────────────────────────────────────────────────────

  $(document).ready(function () {
    var $builder = $('#' + BUILDER_ID);
    if (!$builder.length) return;

    var rawConfig           = $builder.data('config');
    var rawFields           = $builder.data('fields');
    var rawLangs            = $builder.data('langs');
    var rawDefaultLang      = $builder.data('default-lang');
    var rawDefaultConfig    = $builder.data('default-config');
    var rawSectionTemplates = $builder.data('section-templates');
    var rawProfile          = $builder.data('profile');
    var rawProfilePrefs     = $builder.data('profile-preferences');
    var rawEngineRequired   = $builder.data('engine-required');

    if (!rawConfig || !rawFields) {
      $builder.html('<p class="notice notice-error">' +
        (window.mybookingCheckoutFormStrings && window.mybookingCheckoutFormStrings.no_data
          ? window.mybookingCheckoutFormStrings.no_data
          : 'Error: builder data not found.') + '</p>');
      return;
    }

    try {
      state.config      = typeof rawConfig === 'string' ? JSON.parse(rawConfig) : rawConfig;
      state.fields      = typeof rawFields === 'string' ? JSON.parse(rawFields) : rawFields;
      state.strings     = window.mybookingCheckoutFormStrings || {};
      state.langs       = rawLangs
        ? (typeof rawLangs === 'string' ? JSON.parse(rawLangs) : rawLangs)
        : [];
      state.defaultLang = rawDefaultLang || (state.langs.length ? state.langs[0] : '');

      if (!state.langs.length && state.defaultLang) {
        state.langs = [state.defaultLang];
      }

      state.defaultConfig = rawDefaultConfig
        ? (typeof rawDefaultConfig === 'string' ? JSON.parse(rawDefaultConfig) : rawDefaultConfig)
        : null;

      state.sectionTemplates = rawSectionTemplates
        ? (typeof rawSectionTemplates === 'string' ? JSON.parse(rawSectionTemplates) : rawSectionTemplates)
        : {};

      state.profile = rawProfile
        ? (typeof rawProfile === 'string' ? JSON.parse(rawProfile) : rawProfile)
        : null;
      state.profilePreferences = rawProfilePrefs
        ? (typeof rawProfilePrefs === 'string' ? JSON.parse(rawProfilePrefs) : rawProfilePrefs)
        : { mode: 'auto' };
      state.engineRequired = rawEngineRequired
        ? (typeof rawEngineRequired === 'string' ? JSON.parse(rawEngineRequired) : rawEngineRequired)
        : [];
      state.showAll = !!(state.profilePreferences && state.profilePreferences.show_all);

      state.config = normalizeConfigShape(state.config);

      initEvents();
      initDragEvents();
      $builder.closest('form').on('submit.mbcf', function () {
        syncInput();
      });
      render();
    } catch (err) {
      $builder.html('<p class="notice notice-error">' + escHtml(str('builder_error', 'Builder error:')) + ' ' + escHtml(String(err)) + '</p>');
      if (window.console && console.error) {
        console.error('[mbcf] init error:', err);
      }
    }
  });

})(jQuery);
