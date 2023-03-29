<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0.10
 */

// Copyright area
$tails_footer_scheme =  tails_is_inherit(tails_get_theme_option('footer_scheme')) ? tails_get_theme_option('color_scheme') : tails_get_theme_option('footer_scheme');
$tails_copyright_scheme = tails_is_inherit(tails_get_theme_option('copyright_scheme')) ? $tails_footer_scheme : tails_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($tails_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				$tails_copyright = tails_prepare_macros(tails_get_theme_option('copyright'));
				if (!empty($tails_copyright)) {
					tails_show_layout(do_shortcode(str_replace(array('{{Y}}', '{Y}'), date('Y'), tails_get_theme_option('copyright'))));
				}
			?></div>
		</div>
	</div>
</div>
