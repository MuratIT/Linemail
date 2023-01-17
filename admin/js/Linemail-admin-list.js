(function( $ ) {
	$(document).ready(function () {
		class Linemail_list {
			constructor () {
				this.table = $('.Linemail_table');
			}

			submit_table_fun () {
				var closents = $(this).closest('tr');
				var id = closents.find('.Linemail_table_id').text();
				var button = $(this).attr('data-value');
				if (button == 'send') {
					$.ajax({
						url: ajaxurl,
						type: 'POST',
						data: {
							action: 'send_button_linemail_table',
							id: id,
						},
						success: function( data ) {
							var data = data.substring(0, data.length - 1)
							window.location.replace(data);
						}
					});
				}
				else if (button == 'delete') {
					$.ajax({
						url: ajaxurl,
						type: 'POST',
						data: {
							action: 'delete_button_linemail_table',
							id: id,
						},
						success: function( data ) {
							var data = data.substring(0, data.length - 1)
							if (data == true) {
								$('.Linemail_table_id-'+id).remove();
							}
						}
					});
				}
			}


			run () {

				$(this.table).on('click', '.Linemail_table_button', this.submit_table_fun);
				
			}
		}

		let Linemaillist = new Linemail_list();
		Linemaillist.run();
	});
})( jQuery );
