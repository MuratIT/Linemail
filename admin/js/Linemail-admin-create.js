(function( $ ) {
	$(document).ready(function () {
		class Linemail_add {
			constructor () {
				this.submits = $('#Linemail_content_admin_add_save_button');
				this.wsend = $('#Linemail_send_all_button');
			}

			submit_funs () {
				$('html, body').animate({scrollTop: 0}, 600);
				var emailaddress = $('#Linemail_emailaddress').val();
				var topic = $('#Linemail_topic').val();

				window.tinyMCE.triggerSave();
				let content = $('#Linemailaddtextarea').val();

				var messages = $('#Linemail_content_admin_messages_add');

				let errors = [];

				if (!emailaddress) {
					errors.push(php_vas_add['error_emailaddress']);
				}

				if (!content) {
					errors.push(php_vas_add['error_messages']);
				}

				$.ajax({
					url: ajaxurl,
					type: 'POST',
					data: {
						action: 'LinemailAdd',
						emailaddress: emailaddress,
						topic: topic,
						content: content,
						errors: errors
					},
					beforeSend: function () {
						$(messages).html('');
						$(messages).html('<div class="notice notice-info is-dismissible">'+php_vas_add['Wait']+'</div>');
					},
					success: function( data ) {
						$(messages).html('');
						$(messages).prepend(data.substring(0, data.length - 1));
					}
				});

			}


			wsend_fun () {
				$.ajax({
						url: ajaxurl,
						type: 'POST',
						data: {
							action: 'get_button_linemail_add'
						},
						success: function( data ) {
							var data = data.substring(0, data.length - 1)
							$('#Linemail_emailaddress').val(data);
						}
					});
			}

			run () {
				$(this.submits).on('click', this.submit_funs);

				$(this.table).on('click', '.Linemail_table_button', this.submit_table_fun);
				
				$(this.wsend).on('click', this.wsend_fun);
			}
		}

		let Linemailadd = new Linemail_add();
		Linemailadd.run();
	});
})( jQuery );
