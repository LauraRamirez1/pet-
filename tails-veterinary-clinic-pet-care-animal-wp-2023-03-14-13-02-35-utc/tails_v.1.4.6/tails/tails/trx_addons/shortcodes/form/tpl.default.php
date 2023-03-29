<?php
/**
 * The style "default" of the Contact form
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

$args = get_query_var('trx_addons_args_sc_form');
$form_style = $args['style'] = empty($args['style']) || trx_addons_is_inherit($args['style']) ? trx_addons_get_option('input_hover') : $args['style'];

?><div
	<?php if (!empty($args['id'])) echo ' id="'.esc_attr($args['id']).'"'; ?>
	class="sc_form sc_form_<?php 
		echo esc_attr($args['type']);
		if (!empty($args['class'])) echo ' '.esc_attr($args['class']);
		if (!empty($args['align']) && !trx_addons_is_off($args['align'])) echo ' sc_align_'.esc_attr($args['align']);
		?>"<?php
	if (!empty($args['css'])) echo ' style="'.esc_attr($args['css']).'"'; 
?>>
	<?php trx_addons_sc_show_titles('sc_form', $args);
	do_action('trx_addons_action_fields_start', $args); ?>
		<div class="sc_form_details <?php echo esc_attr(trx_addons_get_columns_wrap_class()); ?>"><?php
			// Contact form. Attention! Column's tags can't start with new line
			?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, 2)); ?>"><?php
				trx_addons_get_template_part('shortcodes/form/tpl.form-field.php',
												'trx_addons_args_sc_form_field',
												array_merge($args, array(
																'field_name'  => 'name',
																'field_type'  => 'text',
																'field_req'   => true,
																'field_icon'  => 'trx_addons_icon-user-alt',
																'field_title' => esc_html__('Name', 'tails'),
																'field_placeholder' => esc_html__('Your name', 'tails')
																))
											);
				?>
			</div><div class="<?php echo esc_attr(trx_addons_get_column_class(1, 2)); ?>"><?php
				trx_addons_get_template_part('shortcodes/form/tpl.form-field.php',
												'trx_addons_args_sc_form_field',
												array_merge($args, array(
																'field_name'  => 'email',
																'field_type'  => 'text',
																'field_req'   => true,
																'field_icon'  => 'trx_addons_icon-mail',
																'field_title' => esc_html__('E-mail', 'tails'),
																'field_placeholder' => esc_html__('Your e-mail', 'tails')
																))
											);
				?>
			</div><?php
		?></div><?php
		trx_addons_get_template_part('shortcodes/form/tpl.form-field.php',
										'trx_addons_args_sc_form_field',
										array_merge($args, array(
														'field_name'  => 'message',
														'field_type'  => 'textarea',
														'field_req'   => true,
														'field_icon'  => 'trx_addons_icon-feather',
														'field_title' => esc_html__('Message', 'tails'),
														'field_placeholder' => esc_html__('Your message', 'tails')
														))
									);
		static $cnt = 0;
		$cnt++;
		$privacy = trx_addons_get_privacy_text();
		if (!empty($privacy)) {
		?><div class="sc_form_field sc_form_field_checkbox"><?php
			?><input type="checkbox" id="i_agree_privacy_policy_sc_form_<?php echo esc_attr($cnt); ?>" name="i_agree_privacy_policy" class="sc_form_privacy_checkbox" value="1">
			<label for="i_agree_privacy_policy_sc_form_<?php echo esc_attr($cnt); ?>"><?php trx_addons_show_layout($privacy); ?></label>
		</div><?php
		}
		?>
		<div class="sc_form_field sc_form_field_button"><button><?php esc_html_e('Make an appointment', 'tails'); ?></button></div>
		<div class="trx_addons_message_box sc_form_result"></div>
	</form>
</div><!-- /.sc_form -->
