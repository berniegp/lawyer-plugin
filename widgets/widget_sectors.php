<?php
/**
 *
 * Lawyer Practice areas Widget
 *
 */
if( ! class_exists( 'Lawyer_Sectors' ) ) {
	class Lawyer_Sectors extends WP_Widget {

		function __construct() {

			$widget_ops     = array(
				'classname'   => 'lawyer_practice_areas',
				'description' => esc_html__( 'Lawyer Theme Widget.', 'lawyer-plugin' )
			);
			parent::__construct( 'Lawyer_Sectors', esc_html__( 'Lawyer - Sectors', 'lawyer-plugin' ), $widget_ops );
		}

		function widget( $args, $instance ) {

			extract( $args );

			echo $before_widget;

			$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );

			if ( ! empty( $instance['title'] ) ) {
				echo $before_title . $title . $after_title;
			}

			if ( isset( $instance['locations'] ) ) {
				$areas = array();
				$args  = array( 
					'post_type'   	 => 'people', 
					'posts_per_page' => -1,
					'fields' 		 => 'ids'
				);

				if( $instance['locations'] != 'all' ) {
					$args['meta_key'] 	= 'people-location';
					$args['meta_value'] = $instance['locations'];
				}

				$people = new WP_Query( $args );

				if ( ! empty( $people->posts ) ) {
					$areas = wp_get_object_terms($people->posts, 'sectors');
				}

				if ( ! empty( $areas ) ) {
					echo '<ul>';
					foreach ($areas as $key => $value) {?>
						<li class="cat-item">
							<a href="<?php echo get_term_link( $value->term_id, 'sectors' ); ?>"><?php echo $value->name; ?></a>
						</li>
					<?php }
					echo '</ul>';
				}
			}

			echo $after_widget;

		}

		function update( $new_instance, $old_instance ) {

			$instance              = $old_instance;
			$instance['title']     = $new_instance['title'];
			$instance['locations'] = $new_instance['locations'];

			return $instance;
		}

		function form( $instance ) {

			// set defaults
			// -------------------------------------------------
			$instance   = wp_parse_args( $instance, array(
				'title'     => esc_html__( 'Sectors', 'lawyer-plugin' ),
				'locations' => 'all',
			));

			// title field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['title'] );
			$text_field = array(
				'id'    => $this->get_field_name('title'),
				'name'  => $this->get_field_name('title'),
				'type'  => 'text',
				'title' => esc_html__( 'Title', 'lawyer-plugin' )
			);

			echo cs_add_element( $text_field, $text_value );

			// category field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['locations'] );
			$args = array( 'post_type' => 'locations', 'numberposts' => -1 );
			$switcher_field = array(
				'id'      => $this->get_field_name('locations'),
				'name'    => $this->get_field_name('locations'),
				'type'    => 'select',
				'title'   => esc_html__( 'Locations', 'lawyer-plugin' ),
				'options' => lawyer_param_values( 'posts', $args, true, true )
			);

			echo cs_add_element( $switcher_field, $switcher_value );

		}
	}
}

if ( ! function_exists( 'lawyer_init_sectors_widget' ) ) {
	function lawyer_init_sectors_widget() {
		register_widget( 'Lawyer_Sectors' );
	}
	add_action( 'widgets_init', 'lawyer_init_sectors_widget', 2 );
}