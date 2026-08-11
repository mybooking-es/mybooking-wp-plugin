/**
 * MyBooking Admin Modal — reusable confirm dialog
 *
 * Public API:
 *   window.MyBookingAdminModal.confirm({
 *     title, message, confirmText, cancelText,
 *     variant: 'default'|'danger', opener: HTMLElement|null
 *   }) → Promise<boolean>
 *
 * Uses native <dialog>; falls back to window.confirm if unsupported.
 * One dialog node reused across calls.
 */
(function () {
  'use strict';

  var _dialog   = null;
  var _resolve  = null;
  var _opener   = null;

  var strings = (typeof window.mybookingAdminModalStrings !== 'undefined')
    ? window.mybookingAdminModalStrings
    : {};

  var TEXT_CANCEL = strings.cancel || 'Cancel';
  var TEXT_CLOSE  = strings.close  || 'Close';

  function getOrCreateDialog() {
    if (_dialog) return _dialog;

    var d = document.createElement('dialog');
    d.className = 'mybooking-admin-modal';
    d.setAttribute('aria-labelledby',  'mybooking-admin-modal-title');
    d.setAttribute('aria-describedby', 'mybooking-admin-modal-message');

    d.innerHTML =
      '<div class="mybooking-admin-modal__surface">' +
        '<div class="mybooking-admin-modal__header">' +
          '<h2 class="mybooking-admin-modal__title" id="mybooking-admin-modal-title"></h2>' +
          '<button type="button" class="mybooking-admin-modal__close"' +
                  ' aria-label="' + escAttr(TEXT_CLOSE) + '">×</button>' +
        '</div>' +
        '<div class="mybooking-admin-modal__body">' +
          '<p id="mybooking-admin-modal-message"></p>' +
        '</div>' +
        '<div class="mybooking-admin-modal__actions">' +
          '<button type="button" class="button mybooking-admin-modal__cancel"></button>' +
          '<button type="button" class="button button-primary mybooking-admin-modal__confirm"></button>' +
        '</div>' +
      '</div>';

    document.body.appendChild(d);

    d.querySelector('.mybooking-admin-modal__close').addEventListener('click', function () {
      resolve(false);
    });

    d.querySelector('.mybooking-admin-modal__cancel').addEventListener('click', function () {
      resolve(false);
    });

    d.querySelector('.mybooking-admin-modal__confirm').addEventListener('click', function () {
      resolve(true);
    });

    d.addEventListener('cancel', function (e) {
      e.preventDefault();
      resolve(false);
    });

    d.addEventListener('click', function (e) {
      if (e.target === d) {
        resolve(false);
      }
    });

    _dialog = d;
    return d;
  }

  function escAttr(s) {
    return String(s)
      .replace(/&/g, '&amp;')
      .replace(/"/g, '&quot;');
  }

  function resolve(confirmed) {
    if (!_resolve) return;
    var cb = _resolve;
    _resolve = null;

    if (_dialog) {
      _dialog.close();
      _dialog.removeAttribute('data-variant');
    }

    var opener = _opener;
    _opener = null;
    if (opener && opener.isConnected) {
      opener.focus();
    }

    cb(confirmed);
  }

  function confirm(opts) {
    opts = opts || {};

    var title       = opts.title       || '';
    var message     = opts.message     || '';
    var confirmText = opts.confirmText || 'OK';
    var cancelText  = opts.cancelText  || TEXT_CANCEL;
    var variant     = opts.variant     === 'danger' ? 'danger' : 'default';
    var opener      = opts.opener      || document.activeElement || null;

    if (typeof HTMLDialogElement === 'undefined' ||
        typeof HTMLDialogElement.prototype.showModal !== 'function') {
      return new Promise(function (res) {
        res(window.confirm(message));
      });
    }

    var d = getOrCreateDialog();

    _opener = opener;

    d.querySelector('#mybooking-admin-modal-title').textContent  = title;
    d.querySelector('#mybooking-admin-modal-message').textContent = message;
    d.querySelector('.mybooking-admin-modal__cancel').textContent  = cancelText;
    d.querySelector('.mybooking-admin-modal__confirm').textContent = confirmText;

    if (variant === 'danger') {
      d.setAttribute('data-variant', 'danger');
    } else {
      d.removeAttribute('data-variant');
    }

    return new Promise(function (res) {
      _resolve = res;
      d.showModal();
      d.querySelector('.mybooking-admin-modal__cancel').focus();
    });
  }

  window.MyBookingAdminModal = { confirm: confirm };

}());
