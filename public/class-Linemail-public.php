<?php

/**
 * The public-facing functionality of the plugin.
 *
 *  
 * @since      1.0.0
 *
 * @package    Linemail
 * @subpackage Linemail/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Linemail
 * @subpackage Linemail/public
 * @author     Murat Mazitov <j.murat@yandex.ru>
 */
class Linemail_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $Linemail    The ID of this plugin.
	 */
	private $Linemail;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $Linemail       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $Linemail, $version ) {

		$this->Linemail = $Linemail;
		$this->version = $version;

	}

	public function register_widgets() {
		require_once plugin_dir_path( __FILE__ ).'widgets/Linemail_email_widget.php';

		register_widget('Linemail_email_widget');
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->Linemail, plugin_dir_url( __FILE__ ) . 'css/Linemail-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->Linemail, plugin_dir_url( __FILE__ ) . 'js/Linemail-public.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( $this->Linemail.'-validate', plugin_dir_url( __FILE__ ) . 'js/jquery.validate.min.js', array( 'jquery' ), $this->version, false );


		$array_url = array(
			'ajaxurl' => admin_url('admin-ajax.php')
		);
		wp_localize_script($this->Linemail, 'Linemail_ajax', $array_url);

	}

	public function save_in_data_email() {
		global $wpdb;
		$table_name = $wpdb->get_blog_prefix() . 'linemail_db';

		if (!$_POST['datas'][2]) {
			$add = false;
		}
		if (!$_POST['datas'][1]) {
			$add = false;
		}
		if (!$_POST['datas'][0]) {
			$add = false;
		}

		$list_db = $wpdb->get_results( 'SELECT * FROM '.$table_name, ARRAY_A);
		foreach ($list_db as $value) {
			if ($value['emailaddress'] == $_POST['datas'][2]) {
				_e('You are already with us', 'Linemail');
				return;
			}
		}

		$data = array(
			"emailaddress" => $_POST['datas'][2],
			"firstname" => $_POST['datas'][0],
			"lastname" => $_POST['datas'][1]
		);

		$add = $wpdb->insert( $table_name, $data);

		if ($add) {
			if (get_option('LINEMAIL_OPTION_FOR_WIDGET', false)) {
				echo get_option('LINEMAIL_OPTION_FOR_WIDGET');
			}else {
				_e('Thank you for being with them', 'Linemail');
			}
		}else {
			echo false;
		}
	}

}
