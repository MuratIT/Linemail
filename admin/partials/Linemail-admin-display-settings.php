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

<div id="Linemail_content_admin_messages"></div>
<div class="Linemail_content_admin">
	<div class="Linemail_content_admin-left">
		<h1><?php echo _e('SMTP server', 'Linemail'); ?></h1>
		<div class="Linemail_content_admin-box">
			<h2><?php echo _e('Host SMTP', 'Linemail'); ?></h2>
			<span class="Linemail_content_admin_box-line"></span>
			<div class="Linemail_content_admin_box-input">
				<input id="Linemail_host_SMTP" class="Linemail_content_admin_box-input-text" type="text" placeholder="<?php echo _e('Enter the SMTP host', 'Linemail'); ?>" value="<?php echo@ get_option('LINEMAIL_OPTION')['host']; ?>">
			</div>
		</div>
		<div class="Linemail_content_admin-box">
			<h2><?php echo _e('Port SMTP', 'Linemail'); ?></h2>
			<span class="Linemail_content_admin_box-line"></span>
			<div class="Linemail_content_admin_box-input">
				<input id="Linemail_port_SMTP" class="Linemail_content_admin_box-input-text" type="text" placeholder="<?php echo _e('Enter the SMTP Port', 'Linemail'); ?>" value="<?php echo@ get_option('LINEMAIL_OPTION')['port']; ?>">
			</div>
		</div>
	</div>
	<div class="Linemail_content_admin-right">
		<h1><?php echo _e('SMTP user', 'Linemail'); ?></h1>
		<div class="Linemail_content_admin-box">
			<h2><?php echo _e('Username SMTP', 'Linemail'); ?></h2>
			<span class="Linemail_content_admin_box-line"></span>
			<div class="Linemail_content_admin_box-input">
				<input id="Linemail_username_SMTP" class="Linemail_content_admin_box-input-text" type="text" placeholder="<?php echo _e('Enter the SMTP Username', 'Linemail'); ?>" value="<?php echo@ get_option('LINEMAIL_OPTION')['username']; ?>">
			</div>
		</div>
		<div class="Linemail_content_admin-box">
			<h2><?php echo _e('Password SMTP', 'Linemail'); ?></h2>
			<span class="Linemail_content_admin_box-line"></span>
			<div class="Linemail_content_admin_box-input">
				<input id="Linemail_password_SMTP" class="Linemail_content_admin_box-input-text" type="password" placeholder="<?php echo _e('Enter the SMTP Password', 'Linemail'); ?>" value="<?php echo@ get_option('LINEMAIL_OPTION')['password']; ?>">
			</div>
		</div>
		<div class="Linemail_content_admin-box-save">
			<button id="Linemail_submit_save_settings" class="Linemail_content_admin-box-save-button button"><?php echo _e('Save', 'Linemail'); ?></button>
		</div>
	</div>
</div>