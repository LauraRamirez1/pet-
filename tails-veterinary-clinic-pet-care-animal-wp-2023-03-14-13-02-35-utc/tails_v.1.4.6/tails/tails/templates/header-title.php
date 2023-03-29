<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
 */

// Page (category, tag, archive, author) title

if ( tails_need_page_title() ) {
	tails_sc_layouts_showed('title', true);
	tails_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
        <?php if(!is_home()) { ?>
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title">
						<?php
						// Post meta on the single post
						if ( is_single() )  {
							?><div class="sc_layouts_title_meta"><?php
								tails_show_post_meta(array(
									'date' => true,
									'categories' => true,
									'seo' => true,
									'share' => false,
									'counters' => 'views,comments,likes'
									)
								);
							?></div><?php
						}
						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$tails_blog_title = tails_get_blog_title();
							$tails_blog_title_text = $tails_blog_title_class = $tails_blog_title_link = $tails_blog_title_link_text = '';
							if (is_array($tails_blog_title)) {
								$tails_blog_title_text = $tails_blog_title['text'];
								$tails_blog_title_class = !empty($tails_blog_title['class']) ? ' '.$tails_blog_title['class'] : '';
								$tails_blog_title_link = !empty($tails_blog_title['link']) ? $tails_blog_title['link'] : '';
								$tails_blog_title_link_text = !empty($tails_blog_title['link_text']) ? $tails_blog_title['link_text'] : '';
							} else
								$tails_blog_title_text = $tails_blog_title;
							?>
							<h1 class="sc_layouts_title_caption<?php echo esc_attr($tails_blog_title_class); ?>"><?php
								$tails_top_icon = tails_get_category_icon();
								if (!empty($tails_top_icon)) {
									$tails_attr = tails_getimagesize($tails_top_icon);
									?><img src="<?php echo esc_url($tails_top_icon); ?>" alt="'.esc_attr__('icon', 'tails').'" <?php if (!empty($tails_attr[3])) tails_show_layout($tails_attr[3]);?>><?php
								}
								echo wp_kses_post($tails_blog_title_text);
							?></h1>
							<?php
							if (!empty($tails_blog_title_link) && !empty($tails_blog_title_link_text)) {
								?><a href="<?php echo esc_url($tails_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($tails_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'tails_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
        <?php } ?>
	</div>
	<?php
}
?>