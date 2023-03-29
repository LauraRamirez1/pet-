<?php
/**
 * The template to display the main menu
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
 */
?>
<div class="top_panel_navi sc_layouts_row sc_layouts_row_type_compact sc_layouts_row_fixed
			scheme_<?php echo esc_attr(tails_is_inherit(tails_get_theme_option('menu_scheme')) 
												? (tails_is_inherit(tails_get_theme_option('header_scheme')) 
													? tails_get_theme_option('color_scheme') 
													: tails_get_theme_option('header_scheme')) 
												: tails_get_theme_option('menu_scheme')); ?>">
	<div class="content_wrap">
		<?php
		$tails_show_text_top_panel   = tails_is_on(tails_get_theme_option('show_text_top_panel'));
		if (!empty($tails_show_text_top_panel)) {?>
		<div class="columns_wrap row-flex">
			<div class="sc_layouts_column sc_layouts_column_align_left sc_layouts_column_icons_position_left column-1_3">
				<div class="sc_layouts_item">
					<div><strong><span class="header_custom_style"><?php echo esc_attr(tails_get_theme_option('t1_top_panel_text')); ?></span> <span class="header_custom_style_2"> <?php echo esc_attr(tails_get_theme_option('c1_top_panel_text')); ?></span></strong></div>
				</div>
			</div>
			<div class="sc_layouts_column sc_layouts_column_align_left sc_layouts_column_icons_position_left column-1_3">
				<div class="sc_layouts_item">
					<div><strong><span class="header_custom_style"><?php echo esc_attr(tails_get_theme_option('t2_top_panel_text')); ?></span><span class="header_custom_style_2"> <?php echo esc_attr(tails_get_theme_option('c2_top_panel_text')); ?></span></strong></div>
				</div>
			</div>
			<div class="sc_layouts_column sc_layouts_column_align_right sc_layouts_column_icons_position_left column-1_3">
				<div class="sc_layouts_item">
					<?php
					// Display search field
					get_search_form();
					?>
				</div>
			</div>
			<div class="sc_layouts_column sc_layouts_column_align_right sc_layouts_column_icons_position_left column-1_1">
				<div class="sc_layouts_item">
					<div class="separator"></div>
				</div>
			</div>
		</div>
		<?php }
		?>
		<div class="columns_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_left sc_layouts_column_icons_position_left column-1_4">
				<?php
				// Logo
				?><div class="sc_layouts_item"><?php
					get_template_part( 'templates/header-logo' );
				?></div>
			</div><?php
			
			// Attention! Don't place any spaces between columns!
			?><div class="sc_layouts_column sc_layouts_column_align_right sc_layouts_column_icons_position_left column-3_4">
				<div class="sc_layouts_item">
					<?php
					// Main menu
					$tails_menu_main = tails_get_nav_menu(array(
						'location' => 'menu_main', 
						'class' => 'sc_layouts_menu sc_layouts_menu_default sc_layouts_hide_on_mobile'
						)
					);
					if (empty($tails_menu_main)) {
						$tails_menu_main = tails_get_nav_menu(array(
							'class' => 'sc_layouts_menu sc_layouts_menu_default sc_layouts_hide_on_mobile'
							)
						);
					}
					tails_show_layout($tails_menu_main);
					// Mobile menu button
					?>
					<div class="sc_layouts_iconed_text sc_layouts_menu_mobile_button">
						<a class="sc_layouts_item_link sc_layouts_iconed_text_link" href="#">
							<span class="sc_layouts_item_icon sc_layouts_iconed_text_icon trx_addons_icon-menu"></span>
						</a>
					</div>
				</div><?php
			
				// Attention! Don't place any spaces between layouts items!
				?>

			</div>
		</div><!-- /.sc_layouts_row -->
	</div><!-- /.content_wrap -->
</div><!-- /.top_panel_navi -->