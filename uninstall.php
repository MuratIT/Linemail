<?php

/**
 * Fired when the plugin is uninstalled.
 *
 *  
 * @since      1.0.0
 *
 * @package    Linemail
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb;
$table_name = $wpdb->get_blog_prefix() . 'linemail_db';

$wpdb->query('DROP TABLE '.$table_name);

delete_option('LINEMAIL_OPTION');

delete_option('LINEMAIL_OPTION_FOR_WIDGET');