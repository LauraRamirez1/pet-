<?php
/* WPBakery Page Builder Extensions Bundle support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('tails_vc_extensions_theme_setup9')) {
	add_action( 'after_setup_theme', 'tails_vc_extensions_theme_setup9', 9 );
	function tails_vc_extensions_theme_setup9() {
		if (tails_exists_visual_composer()) {
			add_action( 'wp_enqueue_scripts', 								'tails_vc_extensions_frontend_scripts', 1100 );
			add_filter( 'tails_filter_merge_styles',						'tails_vc_extensions_merge_styles' );
		}
	
		if (is_admin()) {
			add_filter( 'tails_filter_tgmpa_required_plugins',		'tails_vc_extensions_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'tails_vc_extensions_tgmpa_required_plugins' ) ) {
	
	function tails_vc_extensions_tgmpa_required_plugins($list=array()) {
		if (in_array('vc-extensions-bundle', tails_storage_get('required_plugins'))) {
			$path = tails_get_file_dir('plugins/vc-extensions-bundle/vc-extensions-bundle.zip');
			$list[] = array(
					'name' 		=> esc_html__('WPBakery Page Builder Extensions Bundle', 'tails'),
					'slug' 		=> 'vc-extensions-bundle',
					'version'	=> '3.6.3',
					'source'	=> !empty($path) ? $path : 'upload://vc-extensions-bundle.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if VC Extensions installed and activated
if ( !function_exists( 'tails_exists_vc_extensions' ) ) {
	function tails_exists_vc_extensions() {
		return class_exists('Vc_Manager') && class_exists('VC_Extensions_CQBundle');
	}
}
	
// Enqueue VC custom styles
if ( !function_exists( 'tails_vc_extensions_frontend_scripts' ) ) {
	
	function tails_vc_extensions_frontend_scripts() {
		if (tails_is_on(tails_get_theme_option('debug_mode')) && tails_get_file_dir('plugins/vc-extensions-bundle/vc-extensions-bundle.css')!='')
			wp_enqueue_style( 'tails-vc-extensions-bundle',  tails_get_file_url('plugins/vc-extensions-bundle/vc-extensions-bundle.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'tails_vc_extensions_merge_styles' ) ) {
	
	function tails_vc_extensions_merge_styles($list) {
		$list[] = 'plugins/vc-extensions-bundle/vc-extensions-bundle.css';
		return $list;
	}
}
?>