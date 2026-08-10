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

  var state = {
    config:      null,  // { sections, field_overrides }
    fields:      {},    // catalog keyed by field key
    strings:     {},    // i18n from window.mybookingCheckoutFormStrings
    langs:       [],    // available locale codes, e.g. ['es_ES', 'en_US']
    defaultLang: ''     // current admin locale, e.g. 'es_ES'
  };

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

  // ── Override utilities (by_lang structure) ──────────────────────────────────

  // Returns or creates the override object for a field, migrating old flat structure.
  function ensureOverride(key) {
    if (!state.config.field_overrides[key]) {
      state.config.field_overrides[key] = { by_lang: {} };
    }
    var ov = state.config.field_overrides[key];
    // Migrate old flat structure: { label, placeholder, required } → { required, by_lang: {...} }
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
    if (!state.config.field_overrides[key].by_lang) {
      state.config.field_overrides[key].by_lang = {};
    }
    return state.config.field_overrides[key];
  }

  // Returns or creates the by_lang entry for a specific language.
  function ensureByLang(key, lang) {
    var ov = ensureOverride(key);
    if (!ov.by_lang[lang]) {
      ov.by_lang[lang] = { label: '', placeholder: '' };
    }
    return ov.by_lang[lang];
  }

  // Returns true if any language has a non-empty value for the given property.
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

  function addSection() {
    state.config.sections.push({
      id:       uuid(),
      title:    str('new_section', 'New section'),
      subtitle: '',
      rows:     []
    });
    render();
  }

  function removeSection(sectionId) {
    var section = getSectionById(sectionId);
    if (!section) return;
    var hasLocked = section.rows.some(function (r) {
      return r.fields.some(function (k) { return k && isLocked(k); });
    });
    if (hasLocked) {
      // eslint-disable-next-line no-alert
      alert(str('cannot_remove_section', 'This section contains required fields and cannot be removed.'));
      return;
    }
    state.config.sections = state.config.sections.filter(function (s) { return s.id !== sectionId; });
    render();
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

  // Place fieldKey into a slot, swapping with existing content if needed.
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
      // Moving from another slot — swap
      var sourceCtx = getRowContext(sourceRowId);
      if (sourceCtx) {
        sourceCtx.row.fields[sourceSlotIndex] = existingKeyInTarget || null;
      }
    } else {
      // From palette — remove any other occurrence in the form
      state.config.sections.forEach(function (s) {
        s.rows.forEach(function (r) {
          r.fields = r.fields.map(function (k, i) {
            return (k === fieldKey && !(r.id === targetRowId && i === targetSlotIndex)) ? null : k;
          });
        });
      });
    }

    targetCtx.row.fields[targetSlotIndex] = fieldKey;
    render();
  }

  function setSectionTitle(sectionId, title) {
    var s = getSectionById(sectionId);
    if (s) { s.title = title; syncInput(); }
  }

  function setSectionSubtitle(sectionId, subtitle) {
    var s = getSectionById(sectionId);
    if (s) { s.subtitle = subtitle; syncInput(); }
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

  // ── Rendering ───────────────────────────────────────────────────────────────

  var GROUP_LABELS = {
    customer:            'Customer',
    address:             'Address',
    flight_arrival:      'Flight (arrival)',
    flight_departure:    'Flight (departure)',
    driver:              'Driver',
    additional_driver_1: 'Additional driver 1',
    additional_driver_2: 'Additional driver 2',
    engine:              'Engine fields'
  };

  function groupLabel(group) {
    return str('group_' + group, GROUP_LABELS[group] || group);
  }

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

  function renderSlot(row, slotIndex) {
    var key = row.fields[slotIndex];

    if (key && state.fields[key]) {
      var locked   = isLocked(key);
      var f        = state.fields[key];
      var override = state.config.field_overrides[key] || {};
      var byLang   = override.by_lang || {};

      var typeBadges = '';
      if (f.datepicker)   typeBadges += '<span class="mbcf-badge mbcf-badge--date">' + escHtml(str('badge_date', 'date')) + '</span>';
      if (f.has_intl_tel) typeBadges += '<span class="mbcf-badge mbcf-badge--tel">' + escHtml(str('badge_tel', 'tel')) + '</span>';
      if (f.special)      typeBadges += '<span class="mbcf-badge mbcf-badge--special">&#9670;</span>';

      var removeBtn = locked
        ? '<span class="mbcf-locked dashicons dashicons-lock" title="' + escAttr(str('field_required', 'Required')) + '"></span>'
        : '<button type="button" class="mbcf-remove-field button-link"'
            + ' data-row="' + row.id + '" data-slot="' + slotIndex + '"'
            + ' title="' + escAttr(str('remove_field', 'Remove')) + '">&#x2715;</button>';

      // Customization tags — lang pills show per-language state in multi-lang sites
      var currentRequired = (override.required !== undefined) ? override.required : (f.required || false);
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

      // Language tabs and per-language input blocks
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
        requiredCheckHtml = '<div class="mbcf-field-settings-row mbcf-field-settings-row--check">'
          + '<label>'
            + '<input type="checkbox" class="mbcf-field-required-override"'
              + ' data-field="' + escAttr(key) + '"'
              + (currentRequired ? ' checked' : '') + ' />'
            + ' ' + str('field_required_label', 'Required field')
          + '</label>'
          + '</div>';
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
        + ' title="' + escAttr(str('remove_row', 'Remove row')) + '">&#x2715;</button>'
      + '</div>';
  }

  function renderSection(section) {
    var rowsHtml = section.rows.map(renderRow).join('');
    return '<div class="mbcf-section postbox" data-section-id="' + section.id + '">'
      + '<div class="mbcf-section-header inside">'
        + '<span class="mbcf-section-handle dashicons dashicons-menu" title="' + escAttr(str('drag_reorder', 'Drag to reorder')) + '"></span>'
        + '<div class="mbcf-section-titles">'
          + '<input type="text" class="mbcf-section-title regular-text" data-section="' + section.id + '"'
            + ' value="' + escAttr(section.title) + '"'
            + ' placeholder="' + escAttr(str('section_title_ph', 'Section title')) + '" />'
          + '<input type="text" class="mbcf-section-subtitle" data-section="' + section.id + '"'
            + ' value="' + escAttr(section.subtitle) + '"'
            + ' placeholder="' + escAttr(str('section_subtitle_ph', 'Subtitle (optional)')) + '" />'
        + '</div>'
        + '<button type="button" class="mbcf-remove-section button-link" data-section="' + section.id + '"'
          + ' title="' + escAttr(str('remove_section', 'Remove section')) + '">&#x2715;</button>'
      + '</div>'
      + '<div class="mbcf-rows" data-section-id="' + section.id + '">' + rowsHtml + '</div>'
      + '<div class="mbcf-section-footer inside">'
        + '<button type="button" class="mbcf-add-row button button-small" data-section="' + section.id + '" data-layout="1col">'
          + str('add_row_1col', '+ Row (1 column)') + '</button>'
        + '&nbsp;'
        + '<button type="button" class="mbcf-add-row button button-small" data-section="' + section.id + '" data-layout="2col">'
          + str('add_row_2col', '+ Row (2 columns)') + '</button>'
      + '</div>'
      + '</div>';
  }

  function renderPalette() {
    var used = fieldsInForm();
    var groups = {};
    var groupOrder = [];

    Object.keys(state.fields).forEach(function (key) {
      if (used.indexOf(key) !== -1) return;
      var group = state.fields[key].group || 'other';
      if (!groups[group]) {
        groups[group] = [];
        groupOrder.push(group);
      }
      groups[group].push(key);
    });

    var html = '<div class="mbcf-palette"><h3 class="mbcf-palette-title">'
      + str('available_fields', 'Available fields') + '</h3>';

    if (groupOrder.length === 0) {
      html += '<p class="mbcf-palette-empty">'
        + str('all_placed', 'All fields are placed in the form.') + '</p>';
    } else {
      groupOrder.forEach(function (group) {
        html += '<div class="mbcf-palette-group">'
          + '<div class="mbcf-palette-group-label">' + escHtml(groupLabel(group)) + '</div>'
          + '<div class="mbcf-palette-items">';
        groups[group].forEach(function (key) {
          var f = state.fields[key];
          var badges = '';
          if (f.datepicker)   badges += '<span class="mbcf-badge mbcf-badge--date">' + escHtml(str('badge_date', 'date')) + '</span>';
          if (f.has_intl_tel) badges += '<span class="mbcf-badge mbcf-badge--tel">' + escHtml(str('badge_tel', 'tel')) + '</span>';
          if (f.special)      badges += '<span class="mbcf-badge mbcf-badge--special">&#9670;</span>';
          html += '<div class="mbcf-palette-item" draggable="true" data-field="' + escAttr(key) + '">'
            + '<span class="mbcf-palette-item-label">' + escHtml(fieldDisplayLabel(key)) + '</span>'
            + badges
            + '</div>';
        });
        html += '</div></div>';
      });
    }

    html += '</div>';
    return html;
  }

  function render() {
    var sectionsHtml = state.config.sections.map(renderSection).join('');

    var html = '<div class="mbcf-layout">'
      + '<div class="mbcf-form-area">'
        + '<div class="mbcf-add-section-bar">'
          + '<button type="button" class="button button-secondary" id="mbcf-add-section">'
            + str('add_section', '+ Add section') + '</button>'
        + '</div>'
        + '<div id="mbcf-sections">' + sectionsHtml + '</div>'
      + '</div>'
      + '<div class="mbcf-palette-area">'
        + renderPalette()
      + '</div>'
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

    $doc.on('dragstart.mbcf', '.mbcf-palette-item', function (e) {
      drag.field    = $(this).data('field');
      drag.fromRow  = null;
      drag.fromSlot = null;
      e.originalEvent.dataTransfer.effectAllowed = 'move';
      e.originalEvent.dataTransfer.setData('text/plain', drag.field);
      $(this).addClass('mbcf-is-dragging');
    });

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

    $doc.on('dragend.mbcf', '.mbcf-palette-item, .mbcf-slot--filled', function () {
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

    $b.on('click.mbcf', '#mbcf-add-section', addSection);

    $b.on('click.mbcf', '.mbcf-remove-section', function () {
      removeSection($(this).data('section'));
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

    $b.on('input.mbcf', '.mbcf-section-title', function () {
      setSectionTitle($(this).data('section'), $(this).val());
    });

    $b.on('input.mbcf', '.mbcf-section-subtitle', function () {
      setSectionSubtitle($(this).data('section'), $(this).val());
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

    // Close field settings — re-render so tags update
    $b.on('click.mbcf', '.mbcf-field-settings-close', function (e) {
      e.stopPropagation();
      render();
    });

    // Language tab switch (no re-render, pure DOM toggle)
    $b.on('click.mbcf', '.mbcf-lang-tab', function (e) {
      e.stopPropagation();
      var $panel  = $(this).closest('.mbcf-field-settings');
      var lang    = $(this).data('lang');
      $panel.find('.mbcf-lang-tab').removeClass('mbcf-lang-tab--active');
      $(this).addClass('mbcf-lang-tab--active');
      $panel.find('.mbcf-lang-content').removeClass('mbcf-lang-content--active');
      $panel.find('.mbcf-lang-content[data-lang="' + lang + '"]').addClass('mbcf-lang-content--active');
    });

    // Label override — save to by_lang structure
    $b.on('input.mbcf', '.mbcf-field-label-override', function () {
      var key  = $(this).data('field');
      var lang = $(this).data('lang');
      var val  = $(this).val();
      ensureByLang(key, lang).label = val;
      syncInput();
    });

    // Placeholder override — save to by_lang structure
    $b.on('input.mbcf', '.mbcf-field-placeholder-override', function () {
      var key  = $(this).data('field');
      var lang = $(this).data('lang');
      var val  = $(this).val();
      ensureByLang(key, lang).placeholder = val;
      syncInput();
    });

    // Required override
    $b.on('change.mbcf', '.mbcf-field-required-override', function () {
      var key = $(this).data('field');
      var val = $(this).prop('checked');
      ensureOverride(key).required = val;
      syncInput();
    });
  }

  // ── Bootstrap ───────────────────────────────────────────────────────────────

  $(document).ready(function () {
    var $builder = $('#' + BUILDER_ID);
    if (!$builder.length) return;

    var rawConfig      = $builder.data('config');
    var rawFields      = $builder.data('fields');
    var rawLangs       = $builder.data('langs');
    var rawDefaultLang = $builder.data('default-lang');

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

      // Ensure langs has at least one entry
      if (!state.langs.length && state.defaultLang) {
        state.langs = [state.defaultLang];
      }

      // Ensure field_overrides is a plain object
      if (!state.config.field_overrides || Array.isArray(state.config.field_overrides)) {
        state.config.field_overrides = {};
      }

      // Migrate any flat field_overrides to by_lang structure
      Object.keys(state.config.field_overrides).forEach(function (key) {
        var ov = state.config.field_overrides[key];
        if (ov && !ov.by_lang && (ov.label !== undefined || ov.placeholder !== undefined)) {
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
      });

      initEvents();
      initDragEvents();
      render();
    } catch (err) {
      $builder.html('<p class="notice notice-error">' + escHtml(str('builder_error', 'Builder error:')) + ' ' + escHtml(String(err)) + '</p>');
      if (window.console && console.error) {
        console.error('[mbcf] init error:', err);
      }
    }
  });

})(jQuery);
