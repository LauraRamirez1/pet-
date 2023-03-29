<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0.22
 */

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
if ( !function_exists('tails_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'tails_customizer_theme_setup1', 1 );
	function tails_customizer_theme_setup1() {
		
		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		
		tails_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Raleway',
				'family' => 'sans-serif',
				'styles' => '400,500,700,800,900'		// Parameter 'style' used only for the Google fonts
				),
            array(
                'name'	 => 'Roboto Slab',
                'family' => 'serif',
                'styles' => '400,700'		// Parameter 'style' used only for the Google fonts
            ),
            array(
                'name'	 => 'Pacifico',
                'family' => 'cursive',
                'styles' => '400'		// Parameter 'style' used only for the Google fonts
            ),
			// Font-face packed with theme
			array(
				'name'   => 'Montserrat',
				'family' => 'sans-serif'
				)
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		tails_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		tails_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'tails'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'tails'),
				'font-family'		=> 'Raleway, sans-serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.5em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'tails'),
				'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '3.75rem',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '4.5rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '1.6em',
				'margin-bottom'		=> '0.76em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'tails'),
				'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '3rem',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '3.438rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '2.1em',
				'margin-bottom'		=> '0.75em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'tails'),
				'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '2.25rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '3rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '2.8em',
				'margin-bottom'		=> '0.65em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'tails'),
				'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '1.875rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '2.25rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0',
				'margin-top'		=> '3.5em',
				'margin-bottom'		=> '0.61em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'tails'),
				'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '1.5rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.875rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '4.4em',
				'margin-bottom'		=> '0.75em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'tails'),
				'font-family'		=> 'Roboto Slab, serif',
				'font-size' 		=> '1.25rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '5.4em',
				'margin-bottom'		=> '0.65em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'tails'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'tails'),
				'font-family'		=> 'Roboto Slab, sans-serif',
				'font-size' 		=> '1.667rem',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'tails'),
				'font-family'		=> 'Raleway, sans-serif',
				'font-size' 		=> '12px',
				'font-weight'		=> '900',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.4px'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'tails'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'tails'),
				'font-family'		=> 'Raleway, sans-serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'tails'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'tails'),
				'font-family'		=> 'Raleway, sans-serif',
				'font-size' 		=> '13px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'tails'),
				'description'		=> esc_html__('Font settings of the main menu items', 'tails'),
				'font-family'		=> 'Raleway, sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.8px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'tails'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'tails'),
				'font-family'		=> 'Raleway, sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				),
			'other' => array(
				'title'				=> esc_html__('Custom elements', 'tails'),
				'description'		=> esc_html__('Font settings for custom elements', 'tails'),
				'font-family'		=> 'Pacifico, cursive'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		tails_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'tails'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#ffffff',
					'bd_color'				=> '#e5e5e5',
		
					// Text and links colors
					'text'					=> '#817c77',
					'text_light'			=> '#b7b7b7',
					'text_dark'				=> '#524d48',
					'text_link'				=> '#bbdc56',
					'text_hover'			=> '#daad86',
		
					// Alternative blocks (submenu, buttons, tabs, etc.)
					'alter_bg_color'		=> '#f7f5f0',
					'alter_bg_hover'		=> '#524d48',
					'alter_bd_color'		=> '#5f5954',
					'alter_bd_hover'		=> '#716c68',
					'alter_text'			=> '#a8c941',
					'alter_light'			=> '#a19c97',
					'alter_dark'			=> '#716b64',
					'alter_link'			=> '#daad86',
					'alter_hover'			=> '#a8c941',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#f7f5f0',
					'input_bg_hover'		=> '#f7f5f0',
					'input_bd_color'		=> '#f7f5f0',
					'input_bd_hover'		=> '#daad86',
					'input_text'			=> '#8b8b8b',
					'input_light'			=> '#e5e5e5',
					'input_dark'			=> '#1d1d1d',
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#1d1d1d',
					'inverse_light'			=> '#ffffff',
					'inverse_dark'			=> '#000000',
					'inverse_link'			=> '#ffffff',
					'inverse_hover'			=> '#ffffff',
		
					// Additional accented colors (if used in the current theme)
                    'transparent'			=> 'transparent',
				
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'tails'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#524d48',
					'bd_color'				=> '#1c1b1f',
		
					// Text and links colors
					'text'					=> '#f9f9f9',
					'text_light'			=> '#5f5f5f',
					'text_dark'				=> '#ffffff',
					'text_link'				=> '#daad86',
					'text_hover'			=> '#bbdc56',
		
					// Alternative blocks (submenu, buttons, tabs, etc.)
					'alter_bg_color'		=> '#1e1d22',
					'alter_bg_hover'		=> '#f7f5f0',
					'alter_bd_color'		=> '#313131',
					'alter_bd_hover'		=> '#3d3d3d',
					'alter_text'			=> '#e9e8e8',
					'alter_light'			=> '#5f5f5f',
					'alter_dark'			=> '#ffffff',
					'alter_link'			=> '#bbdc56',
					'alter_hover'			=> '#ffffff',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#2e2d32',
					'input_bg_hover'		=> '#2e2d32',
					'input_bd_color'		=> '#2e2d32',
					'input_bd_hover'		=> '#353535',
					'input_text'			=> '#b7b7b7',
					'input_light'			=> '#5f5f5f',
					'input_dark'			=> '#ffffff',
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#f9f9f9',
					'inverse_light'			=> '#524d48',
					'inverse_dark'			=> '#000000',
					'inverse_link'			=> '#ffffff',
					'inverse_hover'			=> '#daad86',
				
					// Additional accented colors (if used in the current theme)
                    'transparent'			=> 'transparent',
				)
			)
		
		));
	}
}

			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('tails_customizer_add_theme_colors')) {
	function tails_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['bg_color_0']  = tails_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = tails_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_07']  = tails_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = tails_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = tails_hex2rgba( $colors['bg_color'], 0.9 );
			$colors['alter_bg_color_07']  = tails_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = tails_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = tails_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = tails_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['alter_bg_hover_004']  = tails_hex2rgba( $colors['alter_bg_hover'], 0.04 );
			$colors['text_dark_015']  = tails_hex2rgba( $colors['text_dark'], 0.15 );
			$colors['text_dark_07']  = tails_hex2rgba( $colors['text_dark'], 0.7 );
			$colors['text_link_02']  = tails_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_07']  = tails_hex2rgba( $colors['text_link'], 0.7 );
			$colors['text_link_08']  = tails_hex2rgba( $colors['text_link'], 0.8 );
			$colors['text_link_blend'] = tails_hsb2hex(tails_hex2hsb( $colors['text_link'], 2, -5, 5 ));
			$colors['alter_link_blend'] = tails_hsb2hex(tails_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
		} else {
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['alter_bg_hover_004'] = '{{ data.alter_bg_hover_004 }}';
			$colors['text_dark_015'] = '{{ data.text_dark_015 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['text_link_08'] = '{{ data.text_link_08 }}';
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('tails_customizer_add_theme_fonts')) {
	function tails_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {
			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !tails_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !tails_is_inherit($font['font-size'])
														? 'font-size:' . tails_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !tails_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !tails_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !tails_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !tails_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !tails_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !tails_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !tails_is_inherit($font['margin-top'])
														? 'margin-top:' . tails_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !tails_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . tails_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}


//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------

if ( !function_exists('tails_customizer_theme_setup') ) {
	add_action( 'after_setup_theme', 'tails_customizer_theme_setup' );
	function tails_customizer_theme_setup() {

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('tails_filter_add_thumb_sizes', array(
			'tails-thumb-huge'		=> array(1170, 658, true),
			'tails-thumb-big' 		=> array( 1540, 860, true),
			'tails-thumb-team' 		=> array( 740, 760, true),
			'tails-thumb-med' 		=> array( 740, 500, true),
			'tails-thumb-blogger'     => array( 540, 420, true),
			'tails-thumb-tiny' 		=> array(  180,  180, true),
			'tails-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'tails-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = tails_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'tails_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}

	}
}

if ( !function_exists('tails_customizer_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'tails_customizer_image_sizes' );
	function tails_customizer_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('tails_filter_add_thumb_sizes', array(
			'tails-thumb-huge'		=> esc_html__( 'Fullsize image', 'tails' ),
			'tails-thumb-big'			=> esc_html__( 'Large image', 'tails' ),
			'tails-thumb-team'			=> esc_html__( 'Team image', 'tails' ),
			'tails-thumb-med'			=> esc_html__( 'Medium image', 'tails' ),
			'tails-thumb-blogger'			=> esc_html__( 'Blogger image', 'tails' ),
			'tails-thumb-tiny'		=> esc_html__( 'Small square avatar', 'tails' ),
			'tails-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'tails' ),
			'tails-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'tails' ),
			)
		);
		$mult = tails_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'tails' );
		}
		return $sizes;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'tails_customizer_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'tails_customizer_trx_addons_add_thumb_sizes');
	function tails_customizer_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-team',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-blogger',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'tails_customizer_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'tails_customizer_trx_addons_get_thumb_size');
	function tails_customizer_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-team',
							'trx_addons-thumb-team-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
							'trx_addons-thumb-blogger',
							'trx_addons-thumb-blogger-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'tails-thumb-huge',
							'tails-thumb-huge-@retina',
							'tails-thumb-big',
							'tails-thumb-big-@retina',
							'tails-thumb-team',
							'tails-thumb-team-@retina',
							'tails-thumb-med',
							'tails-thumb-med-@retina',
							'tails-thumb-blogger',
							'tails-thumb-blogger-@retina',
							'tails-thumb-tiny',
							'tails-thumb-tiny-@retina',
							'tails-thumb-masonry-big',
							'tails-thumb-masonry-big-@retina',
							'tails-thumb-masonry',
							'tails-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}
?>