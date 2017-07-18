<?php
/**
 *
 * Lawyer Subscriptions Widget
 *
 */
if( ! class_exists( 'Lawyer_Subscriptions' ) ) {
	class Lawyer_Subscriptions extends WP_Widget {

		function __construct() {

			$widget_ops     = array(
				'classname'   => 'widget-subscribe',
				'description' => 'Lawyer Theme Widget.'
			);
			parent::__construct( 'Lawyer_Subscriptions', 'Lawyer - Subscriptions', $widget_ops );
		}

		function widget( $args, $instance ) {

			extract( $args );

			echo $before_widget;

			if ( ! empty( $instance['title'] ) ) {
				echo $before_title . $instance['title'] . $after_title;
			}

			if ( ! empty( $instance['description'] ) ) {
				echo '<p>' . esc_html( $instance['description'] ) . '</p>';
			}

			if ( ! empty( $instance['form'] ) ) {
				echo do_shortcode( '[mc4wp_form id="' . esc_html( $instance['form'] ) . '"]' );
			}

			echo $after_widget;

		}

		function update( $new_instance, $old_instance ) {

			$instance            	 = $old_instance;
			$instance['title']   	 = $new_instance['title'];
			$instance['description'] = $new_instance['description'];
			$instance['form']    	 = $new_instance['form'];

			return $instance;

		}

		function form( $instance ) {

			// set defaults
			// -------------------------------------------------
			$instance   = wp_parse_args( $instance, array(
				'title'   	  => 'Subscriptions',
				'description' => '',
				'form'    	  => '',
			));

			// text field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['title'] );
			$text_field = array(
				'id'    => $this->get_field_name('title'),
				'name'  => $this->get_field_name('title'),
				'type'  => 'text',
				'title' => 'Title',
			);

			echo cs_add_element( $text_field, $text_value );


			// description field
			// -------------------------------------------------
			$upload_value = esc_attr( $instance['description'] );
			$upload_field = array(
				'id'    => $this->get_field_name('description'),
				'name'  => $this->get_field_name('description'),
				'type'  => 'textarea',
				'title' => 'Description'
			);

			echo cs_add_element( $upload_field, $upload_value );

			// form field
			// -------------------------------------------------
			$args = array('post_type' => 'mc4wp-form', 'posts_per_page' => -1 );
			$switcher_value = esc_attr( $instance['form'] );
			$switcher_field = array(
				'id'      => $this->get_field_name('form'),
				'name'    => $this->get_field_name('form'),
				'type'    => 'select',
				'title'   => 'Select mailchimp form',
				'options' => lawyer_param_values('posts', $args, true)
			);

			echo cs_add_element( $switcher_field, $switcher_value );

		}
	}
}

if ( ! function_exists( 'lawyer_init_subscriptions_widget' ) ) {
	function lawyer_init_subscriptions_widget() {
		register_widget( 'Lawyer_Subscriptions' );
	}
	add_action( 'widgets_init', 'lawyer_init_subscriptions_widget', 2 );
}