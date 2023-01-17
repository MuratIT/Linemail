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


<div class="Linemail_table_content">
	<h1><?php _e('List email address','Linemail'); ?></h1>
	<table class="Linemail_table">
		<thead>
			<tr>
				<th><?php _e('id','Linemail'); ?></th>
				<th><?php _e('First Name','Linemail'); ?></th>
				<th><?php _e('Last Name','Linemail'); ?></th>
				<th><?php _e('E-mail','Linemail'); ?></th>
				<th><?php _e('Actions','Linemail'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($list_db as $value) { ?>
			<tr class="Linemail_table_id-<?php echo $value['id']; ?>">
				<td class="Linemail_table_id"><?php echo $value['id']; ?></td>
				<td><?php echo $value['firstname']; ?></td>
				<td><?php echo $value['lastname']; ?></td>
				<td><?php echo $value['emailaddress']; ?></td>
				<td calss="Linemail_tabletd_button">
					<button class="Linemail_table_button" data-value="send"><?php _e('Send','Linemail'); ?></button>
					<button class="Linemail_table_button" data-value="delete"><?php _e('Delete','Linemail'); ?></button>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>