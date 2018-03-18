<?php
/**
 *
 * Lawyer Offices Widget
 *
 */
if( ! class_exists( 'Lawyer_Offices' ) ) {
	class Lawyer_Offices extends WP_Widget {

		function __construct() {

			$widget_ops     = array(
				'classname'   => 'lawyer_offices',
				'description' => esc_html__( 'Lawyer Theme Widget.', 'lawyer-plugin' )
			);
			parent::__construct( 'Lawyer_Offices', esc_html__( 'Lawyer - Offices', 'lawyer-plugin' ), $widget_ops );
		}

		function widget( $args, $instance ) {

			extract( $args );

			echo $before_widget;

			if ( ! empty( $instance['title'] ) ) {
				echo $before_title . $instance['title'] . $after_title;
			}

			$args = array(
				'post_type'      	  => 'locations',
				'posts_per_page' 	  => -1,
				'ignore_sticky_posts' => true,
				'orderby' 			  => 'title',
				'order' 			  => 'ASC'
			);

			if ( isset( $instance['exclude'] ) && ! empty( $instance['exclude'] ) ) {
				$args = array( 'author__not_in' => $instance['exclude'] ); 
			}

			$artcl = new WP_Query( $args );

			if ( $artcl->have_posts() ) {
				echo '<ul>';
				while ( $artcl->have_posts() ) {
					$artcl->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php
				}
				echo '</ul>';
				wp_reset_postdata();
			}

			echo $after_widget;

		}

		function update( $new_instance, $old_instance ) {

			$instance            = $old_instance;
			$instance['title']   = $new_instance['title'];
			$instance['exclude'] = $new_instance['exclude'];

			return $instance;

		}

		function form( $instance ) {

			// set defaults
			// -------------------------------------------------
			$instance   = wp_parse_args( $instance, array(
				'title'   => 'Offices',
				'exclude' => ''
			));


			// title field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['title'] );
			$text_field = array(
				'id'    => $this->get_field_name('title'),
				'name'  => $this->get_field_name('title'),
				'type'  => 'text',
				'title' => 'Title',
			);

			echo cs_add_element( $text_field, $text_value );


			// exclude field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['exclude'] );
			$text_field = array(
				'id'    => $this->get_field_name('exclude'),
				'name'  => $this->get_field_name('exclude'),
				'type'  => 'text',
				'title' => 'Exclude',
				'attributes' => array(
					'placeholder' => 'e.g.: 1, 2, 3',
				),
				'desc'  => 'Comma separated. Office ids will be excluded from a list on frontend',
			);

			echo cs_add_element( $text_field, $text_value );

		}
	}
}

if ( ! function_exists( 'lawyer_init_offices_widget' ) ) {
	function lawyer_init_offices_widget() {
		register_widget( 'Lawyer_Offices' );
	}
	add_action( 'widgets_init', 'lawyer_init_offices_widget', 2 );
}