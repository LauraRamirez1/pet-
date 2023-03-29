<?php
/* Elegro Crypto Payment support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'tails_elegro_payment_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'tails_elegro_payment_theme_setup9', 9 );
	function tails_elegro_payment_theme_setup9() {
		if ( is_admin() ) {
			add_filter( 'tails_filter_tgmpa_required_plugins', 'tails_elegro_payment_tgmpa_required_plugins' );
		}
	}
}


// Filter to add in the required plugins list
if ( !function_exists( 'tails_elegro_payment_tgmpa_required_plugins' ) ) {
    function tails_elegro_payment_tgmpa_required_plugins($list=array()) {
        if (in_array('essential-grid', tails_storage_get('required_plugins'))) {
            $list[] = array(
                'name' 		=> esc_html__('Elegro Crypto Payment', 'tails'),
                'slug' 		=> 'elegro-payment',
                'required' 	=> false
            );
        }
        return $list;
    }
}

// Check if this plugin installed and activated
if ( ! function_exists( 'tails_exists_elegro_payment' ) ) {
	function tails_exists_elegro_payment() {
		return class_exists( 'WC_Elegro_Payment' );
	}
}
