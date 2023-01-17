<?php

/**
 * Fired during plugin activation
 *
 *  
 * @since      1.0.0
 *
 * @package    Linemail
 * @subpackage Linemail/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Linemail
 * @subpackage Linemail/includes
 * @author     Murat Mazitov <j.murat@yandex.ru>
 */
class Linemail_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		$table_name = $wpdb->get_blog_prefix() . 'linemail_db';
		$charset_collate = "DEFAULT CHARACTER SET ".$wpdb->charset." COLLATE ".$wpdb->collate;

		$sql = "CREATE TABLE ".$table_name." (
				id  bigint(20) unsigned NOT NULL auto_increment,
				emailaddress varchar(255) NOT NULL default '',
				firstname varchar(255) NOT NULL default '',
				lastname varchar(255) NOT NULL default '',
				PRIMARY KEY  (id)
				)
				".$charset_collate.";";

		dbDelta($sql);

		if (get_option('LINEMAIL_OPTION', false)) {
			add_option('LINEMAIL_OPTION');
		}

		if (get_option('LINEMAIL_OPTION_FOR_WIDGET', false)) {
			add_option('LINEMAIL_OPTION_FOR_WIDGET');
		}

	}

}
