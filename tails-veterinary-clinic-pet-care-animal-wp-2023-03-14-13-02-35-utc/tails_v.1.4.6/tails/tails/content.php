<?php
/**
 * The default template to display the content of the single post, page or attachment
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_item_single post_type_'.esc_attr(get_post_type())
												. ' post_format_'.esc_attr(str_replace('post-format-', '', get_post_format())) 
												. ' itemscope'
												); ?>
		itemscope itemtype="//schema.org/<?php echo esc_attr(is_single() ? 'BlogPosting' : 'Article'); ?>">
	<?php
	// Structured data snippets
	if (tails_is_on(tails_get_theme_option('seo_snippets'))) {
		?>
		<div class="structured_data_snippets">
			<meta itemprop="headline" content="<?php the_title_attribute(); ?>">
			<meta itemprop="datePublished" content="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
			<meta itemprop="dateModified" content="<?php echo esc_attr(get_the_modified_date('Y-m-d')); ?>">
			<meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?php the_permalink(); ?>" content="<?php the_title_attribute(); ?>"/>
			<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
				<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
					<?php 
					$tails_logo_image = tails_get_retina_multiplier(2) > 1 
										? tails_get_theme_option( 'logo_retina' )
										: tails_get_theme_option( 'logo' );
					if (!empty($tails_logo_image)) {
						$tails_attr = tails_getimagesize($tails_logo_image);
						?>
						<img itemprop="url" src="<?php echo esc_url($tails_logo_image); ?>">
						<meta itemprop="width" content="<?php echo esc_attr($tails_attr[0]); ?>">
						<meta itemprop="height" content="<?php echo esc_attr($tails_attr[1]); ?>">
						<?php
					}
					?>
				</div>
				<meta itemprop="name" content="<?php echo esc_attr(get_bloginfo( 'name' )); ?>">
				<meta itemprop="telephone" content="">
				<meta itemprop="address" content="">
			</div>
		</div>
		<?php
	}





	// Title and post meta
	if ( (!tails_sc_layouts_showed('title') || !tails_sc_layouts_showed('postmeta')) && !in_array(get_post_format(), array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php

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
			?>
		</div><!-- .post_header -->
		<?php
	}

    // Featured image
    if ( !tails_sc_layouts_showed('featured'))
        tails_show_post_featured();

	// Post content
	?>
	<div class="post_content entry-content" itemprop="articleBody">
		<?php
			the_content( );

			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'tails' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'tails' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

			// Taxonomies and share
			if ( is_single() && !is_attachment() ) {
				?>
				<div class="post_meta under-btn post_meta_single"><div class="post_meta_item post_date_info"><span class="post_meta_label"><?php esc_html_e('Date:', 'tails'); ?></span><?php
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
				<?php
			}
		?>
	</div><!-- .entry-content -->


</article>
