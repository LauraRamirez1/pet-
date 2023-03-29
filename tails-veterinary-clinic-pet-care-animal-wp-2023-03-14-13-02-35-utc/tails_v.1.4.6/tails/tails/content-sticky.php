<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
 */

$tails_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$tails_post_format = get_post_format();
$tails_post_format = empty($tails_post_format) ? 'standard' : str_replace('post-format-', '', $tails_post_format);
$tails_full_content = tails_get_theme_option('blog_content') != 'excerpt' || in_array($tails_post_format, array('link', 'aside', 'status', 'quote'));
$tails_animation = tails_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($tails_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($tails_post_format) ); ?>
	<?php echo (!tails_is_off($tails_animation) ? ' data-animation="'.esc_attr(tails_get_animation_classes($tails_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"><?php esc_html_e('Sticky', 'tails'); ?></span><?php
	}

	// Featured image
	tails_show_post_featured(array(
		'thumb_size' => tails_get_thumb_size($tails_columns==1 ? 'big' : ($tails_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($tails_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );

			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
		<div class="post_content entry-content"><?php
			if ($tails_full_content) {
				// Post content area
				?><div class="post_content_inner"><?php
				the_content( '' );
				?></div><?php
				// Inner pages
				wp_link_pages( array(
					'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'tails' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'tails' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );

			} else {

				$tails_show_learn_more = !in_array($tails_post_format, array('link', 'aside', 'status', 'quote'));

				// Post content area
				?><div class="post_content_inner"><?php
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($tails_post_format, array('link', 'aside', 'status', 'quote'))) {
					the_content();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
				?></div><?php
				// More button
				if ( $tails_show_learn_more ) {
					?><p><a class="sc_button sc_button_default sc_button_size_large sc_button_icon_left sc_button_hover_slide_left" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'tails'); ?></a></p><?php
				}

				?>

				<?php



			}
			?></div>
</article></div>