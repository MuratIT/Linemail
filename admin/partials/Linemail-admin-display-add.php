<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 *  
 * @since      1.0.0
 *
 * @package    Linemail
 * @subpackage Linemail/admin/partials
 */
?>


<div id="Linemail_content_admin_messages_add"></div>
<div class="Linemail_content_admin_add">
	<h1><?php echo _e('Add messages', 'Linemail'); ?></h1>
	<div class="Linemail_content_admin_add-box">
		<div class="Linemail_content_admin_add-box-input">
			<label class="Linemail_label" for="Linemail_emailaddress"><?php echo _e('Whom:', 'Linemail'); ?></label>
			<input id="Linemail_emailaddress" type="text" placeholder="<?php echo _e('Enter who to send', 'Linemail'); ?>" value="<?php echo@ $array_data_list['emailaddress']; ?>">
			<button id="Linemail_send_all_button" class="button"><?php echo _e('Send All', 'Linemail'); ?></button>
		</div>
		<div class="Linemail_content_admin_add-box-input">
			<label class="Linemail_label" for="Linemail_topic"><?php echo _e('Topic:', 'Linemail'); ?></label>
			<input id="Linemail_topic" type="text" placeholder="<?php echo _e('Enter the subject of the email', 'Linemail'); ?>">
		</div>
		<?php 
			wp_editor( null, 'Linemailaddtextarea', array(
				'wpautop'       => 1,
				'media_buttons' => 1,
				'textarea_name' => 'Linemail_add_textarea',
				'textarea_rows' => 20,
				'tabindex'      => null,
				'editor_css'    => '',
				'editor_class'  => '',
				'teeny'         => 0,
				'dfw'           => 0,
				'tinymce'       => 1,
				'quicktags'     => 1,
				'drag_drop_upload' => false
			) );
		?>

		<div class="Linemail_content_admin_add-save-button">
			<button id="Linemail_content_admin_add_save_button" class="button"><?php echo _e('Send', 'Linemail'); ?></button>
		</div>
	</div>
</div>