<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
 */

tails_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'classie', tails_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'imagesloaded' );
wp_enqueue_script( 'masonry' );
wp_enqueue_script( 'tails-gallery-script', tails_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$tails_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$tails_sticky_out = is_array($tails_stickies) && count($tails_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$tails_cat = tails_get_theme_option('parent_cat');
	$tails_post_type = tails_get_theme_option('post_type');
	$tails_taxonomy = tails_get_post_type_taxonomy($tails_post_type);
	$tails_show_filters = tails_get_theme_option('show_filters');
	$tails_tabs = array();
	if (!tails_is_off($tails_show_filters)) {
		$tails_args = array(
			'type'			=> $tails_post_type,
			'child_of'		=> $tails_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $tails_taxonomy,
			'pad_counts'	=> false
		);
		$tails_portfolio_list = get_terms($tails_args);
		if (is_array($tails_portfolio_list) && count($tails_portfolio_list) > 0) {
			$tails_tabs[$tails_cat] = esc_html__('All', 'tails');
			foreach ($tails_portfolio_list as $tails_term) {
				if (isset($tails_term->term_id)) $tails_tabs[$tails_term->term_id] = $tails_term->name;
			}
		}
	}
	if (count($tails_tabs) > 0) {
		$tails_portfolio_filters_ajax = true;
		$tails_portfolio_filters_active = $tails_cat;
		$tails_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters tails_tabs tails_tabs_ajax">
			<ul class="portfolio_titles tails_tabs_titles">
				<?php
				foreach ($tails_tabs as $tails_id=>$tails_title) {
					?><li><a href="<?php echo esc_url(tails_get_hash_link(sprintf('#%s_%s_content', $tails_portfolio_filters_id, $tails_id))); ?>" data-tab="<?php echo esc_attr($tails_id); ?>"><?php echo esc_html($tails_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$tails_ppp = tails_get_theme_option('posts_per_page');
			if (tails_is_inherit($tails_ppp)) $tails_ppp = '';
			foreach ($tails_tabs as $tails_id=>$tails_title) {
				$tails_portfolio_need_content = $tails_id==$tails_portfolio_filters_active || !$tails_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $tails_portfolio_filters_id, $tails_id)); ?>"
					class="portfolio_content tails_tabs_content"
					data-blog-template="<?php echo esc_attr(tails_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(tails_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($tails_ppp); ?>"
					data-post-type="<?php echo esc_attr($tails_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($tails_taxonomy); ?>"
					data-cat="<?php echo esc_attr($tails_id); ?>"
					data-parent-cat="<?php echo esc_attr($tails_cat); ?>"
					data-need-content="<?php echo (false===$tails_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($tails_portfolio_need_content) 
						tails_show_portfolio_posts(array(
							'cat' => $tails_id,
							'parent_cat' => $tails_cat,
							'taxonomy' => $tails_taxonomy,
							'post_type' => $tails_post_type,
							'page' => 1,
							'sticky' => $tails_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		tails_show_portfolio_posts(array(
			'cat' => $tails_cat,
			'parent_cat' => $tails_cat,
			'taxonomy' => $tails_taxonomy,
			'post_type' => $tails_post_type,
			'page' => 1,
			'sticky' => $tails_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>