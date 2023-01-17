(function( $ ) {
	$(document).ready(function () {
		class Linemail_setting {
			constructor () {
				this.submit = $('#Linemail_submit_save_settings');
			}

			submit_fun () {
				var host = $('#Linemail_host_SMTP').val();
				var port = $('#Linemail_port_SMTP').val();
				var username = $('#Linemail_username_SMTP').val();
				var password = $('#Linemail_password_SMTP').val();
				var messages = $('#Linemail_content_admin_messages');

				let errors = [];

				if (!host) {
					errors.push(php_vas_setting['error_host']);
				}

				if (!port) {
					errors.push(php_vas_setting['error_port']);
				}

				if (!username) {
					errors.push(php_vas_setting['error_username']);
				}

				if (!password) {
					errors.push(php_vas_setting['error_password']);
				}

				$.ajax({
					url: ajaxurl,
					type: 'POST',
					data: {
						action: 'LinemailSetting',
						port: port,
						host: host,
						username: username,
						password: password,
						errors: errors
					},
					beforeSend: function () {
						$(messages).html('');
						$(messages).html('<div class="notice notice-info is-dismissible">'+php_vas_setting['Wait']+'</div>');
					},
					success: function( data ) {
						$(messages).html('');
						$(messages).prepend(data.substring(0, data.length - 1));
					}
				});
			}

			run () {
				$(this.submit).on('click', this.submit_fun);
			}
		}

		let LinemailSetting = new Linemail_setting();
		LinemailSetting.run();
	});
})( jQuery );
