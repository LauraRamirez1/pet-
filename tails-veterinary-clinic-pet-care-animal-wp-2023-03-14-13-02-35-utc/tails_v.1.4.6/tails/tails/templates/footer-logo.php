<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0.10
 */

// Logo
if (tails_is_on(tails_get_theme_option('logo_in_footer'))) {
	$tails_logo_image = '';
	if (tails_get_retina_multiplier(2) > 1)
		$tails_logo_image = tails_get_theme_option( 'logo_footer_retina' );
	if (empty($tails_logo_image)) 
		$tails_logo_image = tails_get_theme_option( 'logo_footer' );
	$tails_logo_text   = get_bloginfo( 'name' );
	if (!empty($tails_logo_image) || !empty($tails_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($tails_logo_image)) {
					$tails_attr = tails_getimagesize($tails_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($tails_logo_image).'" class="logo_footer_image" alt="'.esc_attr__('logo', 'tails').'"'.(!empty($tails_attr[3]) ? sprintf(' %s', $tails_attr[3]) : '').'></a>' ;
				} else if (!empty($tails_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($tails_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>