<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('tails_essential_grid_theme_setup9')) {
	add_action( 'after_setup_theme', 'tails_essential_grid_theme_setup9', 9 );
	function tails_essential_grid_theme_setup9() {
		if (tails_exists_essential_grid()) {
			add_action( 'wp_enqueue_scripts', 							'tails_essential_grid_frontend_scripts', 1100 );
			add_filter( 'tails_filter_merge_styles',					'tails_essential_grid_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'tails_filter_tgmpa_required_plugins',		'tails_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'tails_exists_essential_grid' ) ) {
	function tails_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH') || defined( 'ESG_PLUGIN_PATH' );
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'tails_essential_grid_tgmpa_required_plugins' ) ) {
	
	function tails_essential_grid_tgmpa_required_plugins($list=array()) {
		if (in_array('essential-grid', tails_storage_get('required_plugins'))) {
			$path = tails_get_file_dir('plugins/essential-grid/essential-grid.zip');
			$list[] = array(
						'name' 		=> esc_html__('Essential Grid', 'tails'),
						'slug' 		=> 'essential-grid',
						'version'	=> '3.0.17.1',
						'source'	=> !empty($path) ? $path : 'upload://essential-grid.zip',
						'required' 	=> false
			);
		}
		return $list;
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'tails_essential_grid_frontend_scripts' ) ) {
	
	function tails_essential_grid_frontend_scripts() {
		if (tails_is_on(tails_get_theme_option('debug_mode')) && tails_get_file_dir('plugins/essential-grid/essential-grid.css')!='')
			wp_enqueue_style( 'tails-essential-grid',  tails_get_file_url('plugins/essential-grid/essential-grid.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'tails_essential_grid_merge_styles' ) ) {
	
	function tails_essential_grid_merge_styles($list) {
		$list[] = 'plugins/essential-grid/essential-grid.css';
		return $list;
	}
}
?>