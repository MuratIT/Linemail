<?php
class Linemail_email_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'Linemail_email_widget',
			__('E-mail subscription', 'Linemail'),
			array('description' => __('For the user to apply for an email newsletter', 'Linemail'))
		);
	}

	// Вывод виджета
	function widget( $args, $instance ){
		$title_widget = apply_filters( 'widget_title_widget', $instance['title_widget'] );
		$decription_widget = apply_filters( 'decription_widget', $instance['decription_widget'] );
		$button = apply_filters( 'button', $instance['button'] );

		echo $args['before_widget'];
		?>

			<div id="Linemail_box">
				<p id="Linemail_box_title"><?php echo $title_widget; ?></p>
				<p id="Linemail_box_description"><?php echo $decription_widget; ?></p>
				<form id="Linemail_form_box" class="Linemail_form_box" action="">
					<input name="firstname" id="Linemail_form_box_input" class="Linemail_form_box_input" type="text" placeholder="<?php _e('Enter a name','Linemail'); ?>">

					<input name="lastname" id="Linemail_form_box_input" class="Linemail_form_box_input" type="text" placeholder="<?php _e('Enter your last name','Linemail'); ?>">

					<input name="emailaddress" id="Linemail_form_box_input" class="Linemail_form_box_input" type="email" placeholder="<?php _e('Enter your E-mail address','Linemail'); ?>">

					<input id="Linemail_form_box_submit" class="Linemail_form_box_submit" type="submit" value="<?php echo $button; ?>">
				</form>
			</div>


		<?php


		echo $args['after_widget'];
	}

	// Сохранение настроек виджета (очистка)
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title_widget'] = ( ! empty( $new_instance['title_widget'] ) ) ? strip_tags( $new_instance['title_widget'] ) : '';
		$instance['decription_widget'] = ( ! empty( $new_instance['decription_widget'] ) ) ? strip_tags( $new_instance['decription_widget'] ) : '';
		$instance['button'] = ( ! empty( $new_instance['button'] ) ) ? strip_tags( $new_instance['button'] ) : '';

		return $instance;

	}

	// html форма настроек виджета в Админ-панели
	function form( $instance ) {
		$title_widget = @ $instance['title_widget'] ?: '';
		$decription_widget = @ $instance['decription_widget'] ?: '';
		$button = @ $instance['button'] ?: '';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title_widget' ); ?>"><?php _e( 'Title:', 'Linemail'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title_widget' ); ?>" name="<?php echo $this->get_field_name( 'title_widget' ); ?>" type="text" value="<?php echo esc_attr( $title_widget ); ?>" placeholder="<?php echo esc_attr('Enter a title','Linemail'); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'decription_widget' ); ?>"><?php _e( 'Decription:', 'Linemail'); ?></label> 
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'decription_widget' ); ?>" name="<?php echo $this->get_field_name( 'decription_widget' ); ?>" type="text" placeholder="<?php echo esc_attr('Enter descriptions','Linemail'); ?>"><?php echo $decription_widget; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'button' ); ?>"><?php _e( 'button name:', 'Linemail'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'button' ); ?>" name="<?php echo $this->get_field_name( 'button' ); ?>" type="text" value="<?php echo esc_attr( $button ); ?>" placeholder="<?php echo esc_attr('Enter a name for the button','Linemail'); ?>">
		</p>
		<?php 
	}
}