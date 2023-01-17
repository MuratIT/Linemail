(function( $ ) {
	$(document).ready(function () {
		class Linemail_widget_email {
			constructor () {
				this.form = $('.Linemail_form_box');
			}

			submit_fun (form) {
				
			}

			run () {

				let classMain = this;
				classMain.form.each(function () {
					$(this).validate({
						rules: {
						    firstname: {
						      required: true
						    },
						    lastname: {
						      required: true
						    },
						    emailaddress: {
						    	email: true,
						        required: true
						    }
						},
						submitHandler : function (form) {
							let array_data = [];

							$(form).find('.Linemail_form_box_input').each(function () {
								array_data.push($(this).val());
							});

							$.ajax({
								url: Linemail_ajax.ajaxurl,
								method: 'POST',
								data: {
									action: 'saveindataemail',
									datas: array_data
								},
								success: function (data) {
									console.log(data);
									var data = data.substring(0, data.length - 1)
									if (data != false) {
										$(form).html(`<p style="padding: 7%;" id="Linemail_box_description">${data}<p>`);
									}
								}
							});
						},
						errorClass: "Linemail_form_box_errors",
						validClass: "Linemail_form_box_valid",
						errorPlacement: function () {},
						highlight: function (element, errorClass, validClass) {
							 $(element).addClass(errorClass).removeClass(validClass);
							 $(element).css('border-bottom', '3px solid #ff0000');
							 setTimeout(() => {$(element).css('border', 'none');}, 3000);
						},
						unhighlight: function (element, errorClass, validClass) {
							$(element).removeClass(errorClass).addClass(validClass);
							$(element).css('border', 'none');
						}
					});
				});
			}
		}

		let Linemailwidgetemail = new Linemail_widget_email();
		Linemailwidgetemail.run();
	});
})( jQuery );
