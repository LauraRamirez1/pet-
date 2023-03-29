/* global jQuery:false */

// Disable init VC prettyPhoto on the gallery images
window.vc_prettyPhoto = function() {};

(function() {
	"use strict";

	jQuery(document).on('action.init_shortcodes', trx_addons_js_composer_init);
	jQuery(document).on('action.init_hidden_elements', trx_addons_js_composer_init);
	
	function trx_addons_js_composer_init(e, container) {
		if (arguments.length < 2) var container = jQuery('body');
		if (container===undefined || container.length === undefined || container.length == 0) return;
	
		container.find('.vc_message_box_closeable:not(.inited)').addClass('inited').on('click', function(e) {
			jQuery(this).fadeOut();
			e.preventDefault();
			return false;
		});
	}
})();