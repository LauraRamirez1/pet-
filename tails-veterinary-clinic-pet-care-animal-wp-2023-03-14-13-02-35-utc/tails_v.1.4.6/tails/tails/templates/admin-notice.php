<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage TAILS
 * @since TAILS 1.0.1
 */
?>
<div class="update-nag" id="tails_admin_notice">
	<h3 class="tails_notice_title"><?php echo sprintf(esc_html__('Welcome to %s', 'tails'), wp_get_theme()->name); ?></h3>
	<?php
	if (!tails_exists_trx_addons()) {
		?><p><?php echo wp_kses_data(__('<b>Attention!</b> Plugin "ThemeREX Addons is required! Please, install and activate it!', 'tails')); ?></p><?php
	}
	?><p><?php
		if (tails_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'tails'); ?></a>
			<?php
		}
		if (function_exists('tails_exists_trx_addons') && tails_exists_trx_addons()) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Data', 'tails'); ?></a>
			<?php
		}
		?>
        <a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'tails'); ?></a>
        <a href="#" class="button tails_hide_notice"><i class="dashicons dashicons-dismiss"></i> <?php esc_html_e('Hide Notice', 'tails'); ?></a>
	</p>
</div>