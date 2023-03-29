<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0.14
 */
$tails_header_video = tails_get_header_video();
$tails_embed_video = '';
if (!empty($tails_header_video) && !tails_is_from_uploads($tails_header_video)) {
	if (tails_is_youtube_url($tails_header_video) && preg_match('/[=\/]([^=\/]*)$/', $tails_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$tails_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($tails_header_video) . '[/embed]' ));
			$tails_embed_video = tails_make_video_autoplay($tails_embed_video);
		} else {
			$tails_header_video = str_replace('/watch?v=', '/embed/', $tails_header_video);
			$tails_header_video = tails_add_to_url($tails_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$tails_embed_video = '<iframe src="' . esc_url($tails_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php tails_show_layout($tails_embed_video); ?></div><?php
	}
}
?>