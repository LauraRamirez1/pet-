<?php
/* ThemeREX Updater support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'wellspring_trx_updater_theme_setup9' ) ) {
    add_action('after_setup_theme', 'wellspring_trx_updater_theme_setup9', 9);
    function wellspring_trx_updater_theme_setup9()  {
        if (is_admin()) {
            add_filter('tails_filter_tgmpa_required_plugins', 'tails_trx_updater_tgmpa_required_plugins', 8);
        }
    }
}
// Filter to add in the required plugins list
if ( !function_exists( 'tails_trx_updater_tgmpa_required_plugins' ) ) {
    function tails_trx_updater_tgmpa_required_plugins($list=array()) {
        if (in_array('trx_updater', tails_storage_get('required_plugins'))) {
            $path = tails_get_file_dir('plugins/trx_updater/trx_updater.zip');
            $list[] = array(
                'name' 		=> esc_html__('ThemeREX Updater', 'tails'),
                'slug' 		=> 'trx_updater',
                'version'	=> '1.9.9',
                'source'	=> !empty($path) ? $path : 'upload://trx_updater.zip',
                'required' 	=> false
            );
        }
        return $list;
    }
}
