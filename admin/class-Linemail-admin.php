<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Linemail
 * @subpackage Linemail/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Linemail
 * @subpackage Linemail/admin
 * @author     Murat Mazitov <j.murat@yandex.ru>
 */
class Linemail_Admin {

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
	 * @param      string    $Linemail       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $Linemail, $version ) {

		$this->Linemail = $Linemail;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {


		wp_enqueue_style( $this->Linemail, plugin_dir_url( __FILE__ ) . 'css/Linemail-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {


		wp_enqueue_script( $this->Linemail, plugin_dir_url( __FILE__ ) . 'js/Linemail-admin-settings.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( $this->Linemail.'-create', plugin_dir_url( __FILE__ ) . 'js/Linemail-admin-create.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( $this->Linemail.'-list', plugin_dir_url( __FILE__ ) . 'js/Linemail-admin-list.js', array( 'jquery' ), $this->version, false );

		$array_setting = array(
			'error_host' => __('Enter the SMTP host','Linemail'),
			'error_port' => __('Enter the SMTP port','Linemail'),
			'error_username' => __('Enter the SMTP username','Linemail'),
			'error_password' => __('Enter the SMTP password','Linemail'),
			'Wait' => __('Wait','Linemail'),
		);

		$array_add = array(
			'error_emailaddress' => __('Enter who this email will be sent to', 'Linemail'),
			'error_messages' => __('Enter messages', 'Linemail'),
			'Wait' => __('Wait','Linemail'),
		);

		wp_localize_script($this->Linemail, 'php_vas_setting', $array_setting);
		wp_localize_script($this->Linemail.'-create', 'php_vas_add', $array_add);

	}

	public function register_add_menu_admin() {

		add_menu_page(
			__('Linemail Add', 'Linemail'),
			__('Linemail Add', 'Linemail'),
			'manage_options',
			'Linemail-add',
			array($this, 'Linemail_add_admin'),
			'dashicons-email'
		);

		add_submenu_page(
			'Linemail-add',
			__('Linemail List', 'Linemail'),
			__('Linemail List', 'Linemail'),
			'manage_options',
			'Linemail-list',
			array($this, 'Linemail_list_admin')
		);

		add_submenu_page(
			'Linemail-add',
			__('Linemail Settings', 'Linemail'),
			__('Linemail Settings', 'Linemail'),
			'manage_options',
			'Linemail-settings',
			array($this, 'Linemail_settings_admin')
		);
	}

	public function Linemail_add_admin() {
		global $wpdb;
		$table_name = $wpdb->get_blog_prefix() . 'linemail_db';
		$list_db = $wpdb->get_results( 'SELECT * FROM '.$table_name, ARRAY_A);

		if (!empty($_GET['id'])) {
			foreach ($list_db as $value) {
				if ($value['id'] == $_GET['id']) {
					$array_data_list = $value;
				}
			}
		}

		include plugin_dir_path( __FILE__ ).'partials/Linemail-admin-display-add.php';
	}

	public function Linemail_list_admin() {
		global $wpdb;
		$table_name = $wpdb->get_blog_prefix() . 'linemail_db';
		$list_db = $wpdb->get_results( 'SELECT * FROM '.$table_name, ARRAY_A);
		
		include plugin_dir_path( __FILE__ ).'partials/Linemail-admin-display-list.php';
	}

	public function Linemail_settings_admin() {
		include plugin_dir_path( __FILE__ ).'partials/Linemail-admin-display-settings.php';
	}

	public function Linemail_setting() {
		if (!$_POST['errors']) {

			$array_data = array(
				'host' => $_POST['host'],
				'port' => $_POST['port'],
				'username' => $_POST['username'],
				'password' => $_POST['password']
			);

			$updata = update_option('LINEMAIL_OPTION', $array_data);
			if ($updata) {
				echo '<div class="notice notice-success is-dismissible">
					    <p>'.__('Successful saving', 'Linemail').'</p>
					</div>';
			}else {
				echo '<div class="notice notice-warning is-dismissible">
				    	<p>'.__('Something went wrong! Perhaps the data is the same.','Linemail').'</p>
					</div>';
			}

		}else {
			echo '<div class="notice notice-error is-dismissible">
				    <p>'.$_POST['errors'][0].'</p>
				</div>';
		}
	}

	public function send_button_linemail_table() {
		echo admin_url('admin.php?page=Linemail-add&id='.$_POST['id']);
	}

	public function delete_button_linemail_table() {
		global $wpdb;
		$table_name = $wpdb->get_blog_prefix() . 'linemail_db';
		$data = $wpdb->delete( $table_name, array('id' => $_POST['id']));
		if ($data) {
			echo true;
		}
	}

	public function get_button_linemail_add() {
		global $wpdb;
		$table_name = $wpdb->get_blog_prefix() . 'linemail_db';
		$list_db = $wpdb->get_results( 'SELECT * FROM '.$table_name, ARRAY_A);
		$emailaddress = '';
		foreach ($list_db as $value) {
			$emailaddress .= $value['emailaddress'].',';
		}
		echo $emailaddress;
	}

	public function Linemail_add() {
		if (!$_POST['errors']) {

			require plugin_dir_path(__dir__).'includes/phpmailer/PHPMailerAutoload.php';

			if (!empty(get_option('LINEMAIL_OPTION'))) {

				$host = get_option('LINEMAIL_OPTION')['host'];
				$port = get_option('LINEMAIL_OPTION')['port'];
				$username = get_option('LINEMAIL_OPTION')['username'];
				$password = get_option('LINEMAIL_OPTION')['password'];

				$emailaddress = explode(",", $_POST['emailaddress']);
				$topic = $_POST['topic'];
				$content = $_POST['content'];

				$phpmailer = new PHPMailer();

				$phpmailer->CharSet = 'utf-8';

				$phpmailer->isSMTP();

				$phpmailer->Host = $host;

				$phpmailer->SMTPAuth = true;

				$phpmailer->Username = $username;

				$phpmailer->Password = $password;

				$phpmailer->SMTPSecure = 'ssl';

				$phpmailer->Port = $port;

				$phpmailer->setFrom($username);

				foreach ($emailaddress as $value) {
					$phpmailer->addAddress($value); 
				}

				$phpmailer->isHTML(true);

				$phpmailer->Subject = $topic;

				$phpmailer->Body    = $content;

				$phpmailer->AltBody = '';


				if($phpmailer->send()) {
				    echo '<div class="notice notice-success is-dismissible">
					    <p>'.__('Messages sent successfully', 'Linemail').'</p>
					</div>';
				} else {
				    echo '<div class="notice notice-error is-dismissible">
				    <p>'.__('Something went wrong! Unable to send messages. Please check if you entered the SMTP server data correctly','Linemail').'</p>
				</div>';
				}

			}else {
				echo '<div class="notice notice-error is-dismissible">
				    <p>'.__('Something went wrong! No SMTP data available','Linemail').'</p>
				</div>';
			}

		}else {
			echo '<div class="notice notice-error is-dismissible">
				    <p>'.$_POST['errors'][0].'</p>
				</div>';
		}
	}


}
