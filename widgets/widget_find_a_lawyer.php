<?php
/**
 *
 * Lawyer Find a lawyer Widget
 *
 */
if( ! class_exists( 'Lawyer_Find_Lawyer' ) ) {
	class Lawyer_Find_Lawyer extends WP_Widget {

		function __construct() {

			$widget_ops     = array(
				'classname'   => 'lawyer_find_a_lawyer',
				'description' => esc_html__( 'Lawyer Theme Widget.', 'lawyer-plugin' )
			);
			parent::__construct( 'Lawyer_Find_Lawyer', esc_html__( 'Lawyer - Find a lawyer', 'lawyer-plugin' ), $widget_ops );
		}

		function widget( $args, $instance ) {

			extract( $args );

			echo $before_widget;

			if ( ! empty( $instance['title'] ) ) {
				echo $before_title . $instance['title'] . $after_title;
			} ?>

			<form method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
				<?php if ( isset( $instance['name'] ) && $instance['name'] ): ?>
					<label><?php esc_html_e( 'Name', 'lawyer-plugin' ); ?></label>
					<input type="text" name="s">
				<?php endif ?>
				
				
				<?php if ( isset( $instance['areas'] ) && $instance['areas'] ): 
					// 
					$practices = get_terms( 
						array(
							'taxonomy'   => 'practice',
							'hide_empty' => false,
						) 
					); ?>
					
					<label><?php esc_html_e( 'Areas of Practice', 'lawyer-plugin' ); ?></label>
					<select name="legal">
						<option disabled selected value="">&nbsp;</option>
						<?php if ( ! empty( $practices ) ): ?>
							<?php foreach ( $practices as $key => $practice ) { ?>
								<option value="<?php echo $practice->slug; ?>"><?php echo $practice->name; ?></option>
							<?php } ?>
						<?php endif ?>
					</select>
				<?php endif ?>
				
				<?php if ( isset( $instance['offices'] ) && $instance['offices'] ): 
					$offices_args = array('post_type' => 'locations', 'posts_per_page' => -1 );
					$offices = lawyer_param_values('posts', $offices_args, true, false); ?>

					<label><?php esc_html_e( 'Offices', 'lawyer-plugin' ); ?></label>
					<select name="office">
						<option disabled selected value="">&nbsp;</option>
						<?php if ( ! empty( $offices ) ): ?>
							<?php foreach ( $offices as $key => $office ) { ?>
								<option value="<?php echo $key; ?>"><?php echo $office; ?></option>
							<?php } ?>
						<?php endif ?>
					</select>
				<?php endif ?>
				<input type="hidden" name="post_type" value="people">
				<button class="btn btn--small search-form__submit" type="submit"><?php esc_html_e( 'Search', 'lawyer-plugin' ); ?></button>
			</form>

			<?php
			// ----------------------------------------------------------------------------------
			// ----------------------------------------------------------------------------------
			// ----------------------------------------------------------------------------------

			echo $after_widget;

		}

		function update( $new_instance, $old_instance ) {

			$instance            = $old_instance;
			$instance['title']   = $new_instance['title'];
			$instance['name']    = $new_instance['name'];
			$instance['areas']   = $new_instance['areas'];
			$instance['offices'] = $new_instance['offices'];

			return $instance;

		}

		function form( $instance ) {

			//
			// set defaults
			// -------------------------------------------------
			$instance   = wp_parse_args( $instance, array(
				'title'   => 'Find a lawyer',
				'name'    => true,
				'areas'   => true,
				'offices' => true
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


			// name field 
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['name'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('name'),
				'name'  => $this->get_field_name('name'),
				'type'  => 'switcher',
				'title' => 'Show name'
			);

			echo cs_add_element( $switcher_field, $switcher_value );

			
			// name field 
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['areas'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('areas'),
				'name'  => $this->get_field_name('areas'),
				'type'  => 'switcher',
				'title' => 'Show areas'
			);

			echo cs_add_element( $switcher_field, $switcher_value );


			// name field 
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['offices'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('offices'),
				'name'  => $this->get_field_name('offices'),
				'type'  => 'switcher',
				'title' => 'Show offices'
			);

			echo cs_add_element( $switcher_field, $switcher_value );

		}
	}
}

if ( ! function_exists( 'lawyer_init_find_a_lawyer_widget' ) ) {
	function lawyer_init_find_a_lawyer_widget() {
		register_widget( 'Lawyer_Find_Lawyer' );
	}
}
add_action( 'widgets_init', 'lawyer_init_find_a_lawyer_widget', 2 );