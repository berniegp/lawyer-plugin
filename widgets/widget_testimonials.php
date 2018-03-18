<?php
/**
 *
 * Lawyer Testimonials Widget
 *
 */
if( ! class_exists( 'Lawyer_Testimonials' ) ) {
	class Lawyer_Testimonials extends WP_Widget {

		function __construct() {

			$widget_ops     = array(
				'classname'   => 'lawyer_testimonials',
				'description' => 'Lawyer Theme Widget.'
			);
			parent::__construct( 'Lawyer_Testimonials', 'Lawyer - Testimonials', $widget_ops );
		}

		function widget( $args, $instance ) {

			extract( $args );

			echo $before_widget;

			if ( ! empty( $instance['title'] ) ) {
				echo $before_title . $instance['title'] . $after_title;
			}
			// ---------------------------------------------------------------------------------
			// ---------------------------------------------------------------------------------
			/*	'type' 			 => 'latest',
				- 'predefined' 	 => '',
				- 'number' 		 => 3,
				'show_title' 	 => true,
				- 'show_position'  => true,
				- 'show_thumbnail' => true,
				- 'animation' 	 => 'fade',
				- 'time_speed' 	 => 5000,
				- 'slide_speed' 	 => 300,*/

			$type  			= isset( $instance['type'] ) ? $instance['type'] : 'latest';
			$limit 			= isset( $instance['number'] ) ? $instance['number'] : 3;
			$animation 		= isset( $instance['animation'] ) ? $instance['animation'] : 'fade';
			$time_speed 	= isset( $instance['time_speed'] ) ? $instance['time_speed'] : 5000;
			$slide_speed 	= isset( $instance['slide_speed'] ) ? $instance['slide_speed'] : 300;

			$show_thumbnail = $instance['show_thumbnail'];
			$show_position 	= $instance['show_position'];
			$show_title 	= $instance['show_title'];

			$args = array(
				'post_type'      	  => 'testimonials',
				'posts_per_page' 	  => $limit,
				'ignore_sticky_posts' => true,
			);

			if ( $type == 'predefined' && ! empty( $instance['predefined'] ) ) {
				$args['post__in'] = explode( ',', $instance['predefined'] );
			}

			if ( $type == 'latest' ) {
				$args['orderby'] = 'ID';
				$args['order'] = 'desc';
			}

			if ( $type == 'latest' ) {
				$args['orderby'] = 'rand';
			}

			$artcl = new WP_Query( $args );

			if ( $artcl->have_posts() ) { ?>

				<div class="swiper-container" data-slides-per-view="1" data-loop="true" data-autoplay="<?php echo esc_html( $slide_speed ); ?>" data-speed="<?php echo esc_html( $time_speed ); ?>" data-space-between="70" data-slide-effect="<?php echo esc_attr( $animation ); ?>">
					<!-- Additional required wrapper -->
					<div class="swiper-wrapper">
						<!-- Slides -->
						<?php 
						while ( $artcl->have_posts() ) {
							$artcl->the_post(); 
							$content = get_the_content(); ?>

							<div class="swiper-slide">
								<blockquote class="blockquote blockquote--style-1"><?php echo esc_html( $content ); ?></blockquote>
								<div class="blockquote-author">
									<?php if ( $show_thumbnail && has_post_thumbnail() ) {
										the_post_thumbnail( 'medium', array( 'class' => 'blockquote-author__photo' ) );
									} ?>
									<div class="blockquote-author__info">
										<?php if ( $show_title ) {
											the_title( '<cite class="blockquote-author__name">', '</cite>' );
										}

										if ( $show_position ) {
											$meta = get_post_meta( get_the_ID(), 'testimonial_options', true ); 
											if ( ! empty( $meta['position'] ) ) { ?>
												<cite class="blockquote-author__position"><?php echo esc_html( $meta['position'] ); ?></cite>
											<?php }
										} ?>
									</div>
								</div>
							</div>
							<?php 
						}
						 
						wp_reset_postdata(); ?>
					</div>
				</div>

				<?php
			}

			echo $after_widget;

		}

		function update( $new_instance, $old_instance ) {

			$instance            		= $old_instance;
			$instance['title']   		= $new_instance['title'];
			$instance['type']    		= $new_instance['type'];
			$instance['predefined']    	= $new_instance['predefined'];
			$instance['number']    		= $new_instance['number'];
			$instance['show_title']     = $new_instance['show_title'];
			$instance['show_position']  = $new_instance['show_position'];
			$instance['show_thumbnail'] = $new_instance['show_thumbnail'];
			$instance['animation']    	= $new_instance['animation'];
			$instance['time_speed']     = $new_instance['time_speed'];
			$instance['slide_speed']    = $new_instance['slide_speed'];

			return $instance;

		}

		function form( $instance ) {

			// set defaults
			// -------------------------------------------------
			$instance   = wp_parse_args( $instance, array(
				'title'   		 => 'Testimonials',
				'type' 			 => 'latest',
				'predefined' 	 => '',
				'number' 		 => 3,
				'show_title' 	 => true,
				'show_position'  => true,
				'show_thumbnail' => true,
				'animation' 	 => 'fade',
				'time_speed' 	 => 5000,
				'slide_speed' 	 => 300,
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

			
			// type field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['type'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('type'),
				'name'  => $this->get_field_name('type'),
				'type'  => 'select',
				'title' => 'Show testimonials',
				'options'  => array(
					'predefined' => esc_html__( 'Predefined', 'lawyer-plugin' ),
					'random' 	 => esc_html__( 'Random', 'lawyer-plugin' ),
					'latest' 	 => esc_html__( 'Latest', 'lawyer-plugin' ),
				),
			);

			echo cs_add_element( $switcher_field, $switcher_value );

	
			// textarea field
			// -------------------------------------------------
			$textarea_value = esc_attr( $instance['predefined'] );
			$textarea_field = array(
				'id'    	 => $this->get_field_name('predefined'),
				'name'  	 => $this->get_field_name('predefined'),
				'type'  	 => 'text',
				'title' 	 => 'Predefined',
				'info'  	 => 'Specifies items ids to be shown',
				'dependency' => array( $this->get_field_name('type'), '==', 'predefined' )
			);

			echo cs_add_element( $textarea_field, $textarea_value );

	
			// number field
			// -------------------------------------------------
			$textarea_value = esc_attr( $instance['number'] );
			$textarea_field = array(
				'id'    	 => $this->get_field_name('number'),
				'name'  	 => $this->get_field_name('number'),
				'type'  	 => 'select',
				'title' 	 => 'Number of items',
				'options'  => array(
					'all' 	 => esc_html__( 'All items', 'lawyer-plugin' ),
					'1' => 1,
					'2' => 2,
					'3' => 3,
					'4' => 4,
					'5' => 5
				),
			);

			echo cs_add_element( $textarea_field, $textarea_value );


			// show_title field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['show_title'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('show_title'),
				'name'  => $this->get_field_name('show_title'),
				'type'  => 'switcher',
				'title' => 'Show Name/Company'
			);

			echo cs_add_element( $switcher_field, $switcher_value );


			// show_position field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['show_position'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('show_position'),
				'name'  => $this->get_field_name('show_position'),
				'type'  => 'switcher',
				'title' => 'Show Position'
			);

			echo cs_add_element( $switcher_field, $switcher_value );


			// show_thumbnail field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['show_thumbnail'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('show_thumbnail'),
				'name'  => $this->get_field_name('show_thumbnail'),
				'type'  => 'switcher',
				'title' => 'Show Thumbnail'
			);

			echo cs_add_element( $switcher_field, $switcher_value );


			// animation field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['animation'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('animation'),
				'name'  => $this->get_field_name('animation'),
				'type'  => 'select',
				'title' => 'Animation effect',
				'options' => array(
					'fade'  => esc_html__( 'Fade', 'lawyer-plugin' ),
					'slide' => esc_html__( 'Slide', 'lawyer-plugin' ),
				)
			);

			echo cs_add_element( $switcher_field, $switcher_value );


			// time_speed field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['time_speed'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('time_speed'),
				'name'  => $this->get_field_name('time_speed'),
				'type'  => 'text',
				'title' => 'Timeout speed'
			);

			echo cs_add_element( $switcher_field, $switcher_value );


			// slide_speed field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['slide_speed'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('slide_speed'),
				'name'  => $this->get_field_name('slide_speed'),
				'type'  => 'text',
				'title' => 'Slide speed'
			);

			echo cs_add_element( $switcher_field, $switcher_value );

		}
	}
}

if ( ! function_exists( 'lawyer_init_testimonials_widget' ) ) {
	function lawyer_init_testimonials_widget() {
		register_widget( 'Lawyer_Testimonials' );
	}
	add_action( 'widgets_init', 'lawyer_init_testimonials_widget', 2 );
}