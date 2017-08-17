<?php
/**
 *
 * Lawyer Recent Posts Widget
 *
 */
if( ! class_exists( 'Lawyer_Recent_Posts' ) ) {
	class Lawyer_Recent_Posts extends WP_Widget {

		function __construct() {

			$widget_ops     = array(
				'classname'   => 'widget-latest-posts',
				// 'classname'   => 'widget-latest-posts-thumb',
				'description' => 'Lawyer Theme Widget.'
			);
			parent::__construct( 'Lawyer_Recent_Posts', 'Lawyer - Recent posts', $widget_ops );
		}

		function widget( $args, $instance ) {

			extract( $args );

			echo $before_widget;

			if ( ! empty( $instance['title'] ) ) {
				echo $before_title . $instance['title'] . $after_title;
			}
			
			$category = '';
			if ( ! empty( $instance['category'] ) && $instance['category'] != 'all' ) {
				$cats = explode( ',', $instance['category'] );
				$category = array(
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => $cats
				);
			}

			$limit = ! empty( $instance['limit'] ) ? $instance['limit'] : 3;

			$args = array(
				'post_type'      	  => 'post',
				'posts_per_page' 	  => $limit,
				'ignore_sticky_posts' => true,
				'tax_query'      	  => array(
					$category
				)
			);

			$artcl = new WP_Query( $args );

			if ( $artcl->have_posts() ) {
				$wrapper_class = isset( $instance['thumbnail'] ) && $instance['thumbnail'] ? 'has-thumbnail' : 'has-no-thumbnail';
				echo '<ul class="' . $wrapper_class . '">';
				while ( $artcl->have_posts() ) {
					$artcl->the_post(); 

					$title = get_the_title();
					if ( isset( $instance['ex_title'] ) && $instance['ex_title'] ) {
						$title_len = strlen( $title );
						$title = substr( get_the_title(), 0, $instance['lenght'] );
						if ( strlen( $title ) != $title_len ) {
							$title = $title . '...';
						}
					} ?>

					<li>
						<?php if ( ! empty( $instance['thumbnail'] ) && $instance['thumbnail'] && has_post_thumbnail() ): ?>
							<a href="<?php the_permalink(); ?>" class="widget-latest-posts-thumb__thumb effect-apollo">
								<?php the_post_thumbnail('lawyer-shortcode-recent-posts'); ?>
								<div class="effect-apollo__overlay"></div>
							</a>
						<?php endif ?>
							<div class="widget-latest-posts-thumb__item-meta">

								<?php if ( ! empty( $instance['date'] ) && $instance['date'] ): 
									$archive_year  = get_the_time('Y'); 
									$archive_month = get_the_time('m'); 
									$archive_day   = get_the_time('d'); ?>
									<a class="widget__date" href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php the_time( 'F d, Y' ); ?></a>
								<?php endif ?>
								<h4><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h4>

								<?php if ( isset( $instance['description'] ) && $instance['description'] ): 
									$description = get_the_excerpt(); 
									if ( isset( $instance['description_lenght'] ) && $instance['description_lenght'] > 0 ) {
										$description = substr( $description, 0, $instance['description_lenght'] ); 
									} ?>
									<p><?php echo $description; ?></p>
								<?php endif ?>

							</div>
					</li>

					<?php 
				}
				echo '</ul>';
				wp_reset_postdata();
			}

			echo $after_widget;

		}

		function update( $new_instance, $old_instance ) {

			$instance             			= $old_instance;
			$instance['title']    			= $new_instance['title'];
			$instance['category'] 			= $new_instance['category'];
			$instance['limit']    			= $new_instance['limit'];
			$instance['thumbnail'] 			= $new_instance['thumbnail'];
			$instance['date'] 				= $new_instance['date'];

			$instance['ex_title'] 			= $new_instance['ex_title'];
			$instance['lenght'] 			= $new_instance['lenght'];
			$instance['description'] 		= $new_instance['description'];
			$instance['description_lenght'] = $new_instance['description_lenght'];

			return $instance;
		}

		function form( $instance ) {

			// set defaults
			// -------------------------------------------------
			$instance   = wp_parse_args( $instance, array(
				'title'  			 => 'Recent posts',
				'category'   		 => 'all',
				'limit'   			 => 3,
				'thumbnail'   		 => false,
				'date'   			 => true,
				'ex_title'   		 => true,
				'lenght'    		 => 25,
				'description'    	 => true,
				'description_lenght' => 60,
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


			// category field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['category'] );
			$switcher_field = array(
				'id'      => $this->get_field_name('category'),
				'name'    => $this->get_field_name('category'),
				'type'    => 'select',
				'title'   => 'Posts category',
				'options' => lawyer_param_values('categories', array(), true, true)
			);

			echo cs_add_element( $switcher_field, $switcher_value );


			// limit field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['limit'] );
			$text_field = array(
				'id'    => $this->get_field_name('limit'),
				'name'  => $this->get_field_name('limit'),
				'type'  => 'number',
				'title' => 'Posts number',
			);

			echo cs_add_element( $text_field, $text_value );


			// thumbnail field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['thumbnail'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('thumbnail'),
				'name'  => $this->get_field_name('thumbnail'),
				'type'  => 'switcher',
				'title' => 'Show thumbnail'
			);

			echo cs_add_element( $switcher_field, $switcher_value );


			// date field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['date'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('date'),
				'name'  => $this->get_field_name('date'),
				'type'  => 'switcher',
				'title' => 'Show post date'
			);

			echo cs_add_element( $switcher_field, $switcher_value );


			// ex_title field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['ex_title'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('ex_title'),
				'name'  => $this->get_field_name('ex_title'),
				'type'  => 'switcher',
				'title' => 'Excerpt post title'
			);

			echo cs_add_element( $switcher_field, $switcher_value );


			// lenght field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['lenght'] );
			$text_field = array(
				'id'    	 => $this->get_field_name('lenght'),
				'name' 		 => $this->get_field_name('lenght'),
				'type'  	 => 'number',
				'title' 	 => 'Title excerpt symbol count',
				'dependency' => array( $this->get_field_name('ex_title'), '==', true )
			);

			echo cs_add_element( $text_field, $text_value );


			// description field
			// -------------------------------------------------
			$switcher_value = esc_attr( $instance['description'] );
			$switcher_field = array(
				'id'    => $this->get_field_name('description'),
				'name'  => $this->get_field_name('description'),
				'type'  => 'switcher',
				'title' => 'Show post description'
			);

			echo cs_add_element( $switcher_field, $switcher_value );


			// description_lenght field
			// -------------------------------------------------
			$text_value = esc_attr( $instance['description_lenght'] );
			$text_field = array(
				'id'    	 => $this->get_field_name('description_lenght'),
				'name'  	 => $this->get_field_name('description_lenght'),
				'type'  	 => 'number',
				'title' 	 => 'Description excerpt symbol count',
				'dependency' => array( $this->get_field_name('description'), '==', true )
			);

			echo cs_add_element( $text_field, $text_value );

		}
	}
}

if ( ! function_exists( 'lawyer_init_recent_posts_widget' ) ) {
	function lawyer_init_recent_posts_widget() {
		register_widget( 'Lawyer_Recent_Posts' );
	}
	add_action( 'widgets_init', 'lawyer_init_recent_posts_widget', 2 );
}