// Compatibility with themes that uses jquery-modal
if ((typeof jQuery.fn.modal !== 'undefined') && (typeof jQuery.fn.modal.noConflict !== 'undefined')) {
  var bootstrapModal = jQuery.fn.modal.noConflict();
  jQuery.fn.bootstrapModal = bootstrapModal;
}
