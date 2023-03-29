<?php
/* Cookie Information support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'tails_wp_gdpr_compliance_feed_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'tails_wp_gdpr_compliance_theme_setup9', 9 );
	function tails_wp_gdpr_compliance_theme_setup9() {
		if ( is_admin() ) {
			add_filter( 'tails_filter_tgmpa_required_plugins', 'tails_wp_gdpr_compliance_tgmpa_required_plugins' );
		}
	}
}


// Filter to add in the required plugins list
if ( !function_exists( 'tails_wp_gdpr_compliance_tgmpa_required_plugins' ) ) {
	
	function tails_wp_gdpr_compliance_tgmpa_required_plugins($list=array()) {
		if (in_array('wp-gdpr-compliance', tails_storage_get('required_plugins')))
			$list[] = array(
				'name' 		=> esc_html__('Cookie Information', 'tails'),
				'slug' 		=> 'wp-gdpr-compliance',
				'required' 	=> false
			);
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'tails_exists_wp_gdpr_compliance' ) ) {
	function tails_exists_wp_gdpr_compliance() {
		return class_exists( 'WPGDPRC\WPGDPRC' );
	}
}
