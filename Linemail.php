<?php

/**
 * The plugin bootstrap file
 *
 *
 * @since             1.0.0
 * @package           Linemail
 *
 * Plugin Name:       Linemail
 * Description:       The plugin allows you to work with E-mail servers and send messages to E-mail addresses.
 * Version:           1.0.0
 * Author:            Murat Mazitov
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       Linemail
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


define( 'LINEMAILVERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-Linemail-activator.php
 */
function activate_Linemail() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-Linemail-activator.php';
	Linemail_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-Linemail-deactivator.php
 */
function deactivate_Linemail() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-Linemail-deactivator.php';
	Linemail_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Linemail' );
register_deactivation_hook( __FILE__, 'deactivate_Linemail' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-Linemail.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Linemail() {

	$plugin = new Linemail();
	$plugin->run();

}
run_Linemail();
