<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
 */

$tails_blog_style = explode('_', tails_get_theme_option('blog_style'));
$tails_columns = empty($tails_blog_style[1]) ? 2 : max(2, $tails_blog_style[1]);
$tails_expanded = !tails_sidebar_present() && tails_is_on(tails_get_theme_option('expand_content'));
$tails_post_format = get_post_format();
$tails_post_format = empty($tails_post_format) ? 'standard' : str_replace('post-format-', '', $tails_post_format);
$tails_animation = tails_get_theme_option('blog_animation');

?><div class="<?php echo esc_html($tails_blog_style[0]) == 'classic' ? 'column' : 'masonry_item masonry_item'; ?>-1_<?php echo esc_attr($tails_columns); ?>"><article id="post-<?php the_ID(); ?>"
	<?php post_class( 'post_item post_format_'.esc_attr($tails_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($tails_columns)
					. ' post_layout_'.esc_attr($tails_blog_style[0]) 
					. ' post_layout_'.esc_attr($tails_blog_style[0]).'_'.esc_attr($tails_columns)
					); ?>
	<?php echo (!tails_is_off($tails_animation) ? ' data-animation="'.esc_attr(tails_get_animation_classes($tails_animation)).'"' : ''); ?>
	>

	<?php

	// Title and post meta
	if (get_the_title() != '') {
		?>
		<div class="post_header entry-header">
			<?php
			do_action('tails_action_before_post_title');

			// Post meta
			tails_show_post_meta(array(
					'categories' => true,
					'date' => false,
					'edit' => false,
					'seo' => false,
					'share' => false,
					'counters' => ''	
				)
			);

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

			do_action('tails_action_before_post_meta');


			?>
		</div><!-- .post_header --><?php
	}

	// Featured image
	tails_show_post_featured( array( 'thumb_size' => tails_get_thumb_size($tails_blog_style[0] == 'classic'
													? (strpos(tails_get_theme_option('body_style'), 'full')!==false 
															? ( $tails_columns > 2 ? 'big' : 'huge' )
															: (	$tails_columns > 2
																? ($tails_expanded ? 'med' : 'small')
																: ($tails_expanded ? 'big' : 'med')
																)
														)
													: (strpos(tails_get_theme_option('body_style'), 'full')!==false 
															? ( $tails_columns > 2 ? 'masonry-big' : 'full' )
															: (	$tails_columns <= 2 && $tails_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($tails_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>

		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$tails_show_learn_more = false;
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($tails_post_format, array('link', 'aside', 'status', 'quote'))) {
				the_content();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// More button ?><p><a class="sc_button sc_button_default sc_button_size_normal sc_button_icon_left sc_button_hover_slide_left" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'tails'); ?></a></p><?php


		?>
		<div class="post_meta under-btn">
			<div class="post_meta_item post_date_info"><span class="post_meta_label"><?php esc_html_e('Date:', 'tails'); ?></span><?php
				// Post meta
				tails_show_post_meta(array(
						'categories' => false,
						'date' => true,
						'edit' => false,
						'seo' => false,
						'share' => false,
						'counters' => ''	
					)
				);
				?></div><?php

			// Post Author
			echo  '<div class="post_meta_item post_author"><span class="post_meta_label">'.esc_html__('Author:', 'tails').'</span><span class="author-name">'.get_the_author().'</span></div>';

			// Post taxonomies
			the_tags( '<div class="post_meta_item post_tags"><span class="post_meta_label">'.esc_html__('Tags:', 'tails').'</span> ', ', ', '</div>' );

			?>
		</div>
	</div><!-- .entry-content -->

</article></div>