<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
 */

						// Widgets area inside page content
						tails_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					tails_create_widgets_area('widgets_below_page');

					$tails_body_style = tails_get_theme_option('body_style');
					if ($tails_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$tails_footer_style = tails_get_theme_option("footer_style");
			if (strpos($tails_footer_style, 'footer-custom-')===0) $tails_footer_style = 'footer-custom';
			get_template_part( "templates/{$tails_footer_style}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (tails_is_on(tails_get_theme_option('debug_mode')) && tails_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(tails_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>