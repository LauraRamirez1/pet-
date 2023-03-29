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
$tails_columns = empty($tails_blog_style[1]) ? 1 : max(1, $tails_blog_style[1]);
$tails_expanded = !tails_sidebar_present() && tails_is_on(tails_get_theme_option('expand_content'));
$tails_post_format = get_post_format();
$tails_post_format = empty($tails_post_format) ? 'standard' : str_replace('post-format-', '', $tails_post_format);
$tails_animation = tails_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($tails_columns).' post_format_'.esc_attr($tails_post_format) ); ?>
	<?php echo (!tails_is_off($tails_animation) ? ' data-animation="'.esc_attr(tails_get_animation_classes($tails_animation)).'"' : ''); ?>
	>

	<?php
	// Add anchor
	if ($tails_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}



	// Featured image
	tails_show_post_featured( array(
											'class' => $tails_columns == 1 ? 'trx-stretch-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => tails_get_thumb_size(
																	strpos(tails_get_theme_option('body_style'), 'full')!==false
																		? ( $tails_columns > 1 ? 'huge' : 'original' )
																		: (	$tails_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('tails_action_before_post_title');

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
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$tails_show_learn_more = !in_array($tails_post_format, array('link', 'aside', 'status', 'quote'));
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
			// Post meta
			if (in_array($tails_post_format, array('link', 'aside', 'status', 'quote'))) {
                tails_show_post_meta(array(
                        'categories' => false,
                        'date' => true,
                        'edit' => false,
                        'seo' => false,
                        'share' => false,
                        'counters' => ''
                    )
                );
			}
			// More button
			if ( $tails_show_learn_more ) {
				?><p><a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'tails'); ?></a></p><?php
			}
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

	</div></div><!-- .post_inner -->

</article>