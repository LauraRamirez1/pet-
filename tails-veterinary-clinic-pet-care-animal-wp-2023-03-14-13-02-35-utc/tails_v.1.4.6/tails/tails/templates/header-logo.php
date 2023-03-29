<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
 */

$tails_args = get_query_var('tails_logo_args');

// Site logo
$tails_logo_image  = tails_get_logo_image(isset($tails_args['type']) ? $tails_args['type'] : '');
$tails_logo_text   = tails_is_on(tails_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$tails_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($tails_logo_image) || !empty($tails_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php
		if (!empty($tails_logo_image)) {
			$tails_attr = tails_getimagesize($tails_logo_image);
			echo '<img src="'.esc_url($tails_logo_image).'" alt="'.esc_attr__('logo', 'tails').'"'.(!empty($tails_attr[3]) ? sprintf(' %s', $tails_attr[3]) : '').'>' ;
		} else {
			tails_show_layout(tails_prepare_macros($tails_logo_text), '<span class="logo_text">', '</span>');
			tails_show_layout(tails_prepare_macros($tails_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>