<?php
/* Recent posts Shortcode */

vc_map(
	array(
		'name'        => __( 'Recent posts', 'js_composer' ),
		'base'        => 'recent_posts',
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Title', 'js_composer' ),
				'param_name'  => 'title',
				'admin_label' => true,
			),
			array(
				'type'        => 'vc_efa_chosen',
				'heading'     => __( 'Posts category', 'js_composer' ),
				'param_name'  => 'category',
				'placeholder' => 'Choose category (optional)',
				'value'       => lawyer_get_categories( 'post' ),
				'std'         => '',
				'description' => __( 'You can choose specific categories for blog, default is all categories', 'js_composer' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Specified posts', 'js_composer' ),
				'param_name'  => 'specified_posts',
				'description' => 'Post IDs, comma separated.'
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Posts number', 'js_composer' ),
				'param_name'  => 'posts_number'
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Hide dividers between posts', 'js_composer' ),
				'param_name'  => 'hide_dividers'
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Show thumbnail', 'js_composer' ),
				'param_name'  => 'show_thumbnail'
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Hide post date', 'js_composer' ),
				'param_name'  => 'show_post_date'
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Excerpt post title', 'js_composer' ),
				'param_name'  => 'post_title'
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Title excerpt symbol count', 'js_composer' ),
				'param_name'  => 'symbol_count',
				'dependency'  => array( 'element' => 'post_title', 'value' => 'true' )
			),	
			array(
				'type' 		  => 'textfield',
				'heading' 	  => __( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
				'value' 	  => ''
			),
			/* CSS editor */
			array(
				'type' 		  => 'css_editor',
				'heading' 	  => __( 'CSS box', 'js_composer' ),
				'param_name'  => 'css',
				'group' 	  => __( 'Design options', 'js_composer' )
			)

		)
	)
);

class WPBakeryShortCode_recent_posts extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'title'            => '',
			'category'         => 'all',
			'specified_posts'  => '',
			'posts_number'     => '',
			'hide_dividers'    => '',
			'show_thumbnail'   => '',
			'show_post_date'   => '',
			'post_title'       => '',
			'symbol_count'     => '',
			'el_class'         => '',
			'css' 	           => ''
		), $atts ) );

		$class  = ( ! empty( $el_class ) ) ? $el_class : '';
		$class .= vc_shortcode_custom_css_class( $css, ' ' );
		$class .= $hide_dividers ? ' hide-dividers' : '';

		ob_start();

		$cat_args = '';
		if ( ! empty( $category ) && $category != 'all' ) {
			$cats = explode( ',', $category );
			$cat_args = array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $cats
			);
		}

		$posts_number = ! empty( $posts_number ) ? $posts_number : 3;
		$args = array(
			'post_type'      	  => 'post',
			'posts_per_page' 	  => $posts_number,
			'ignore_sticky_posts' => true,
			'orderby'             => 'ID',
			'order'               => 'ASC',
			'tax_query'      	  => array(
				$cat_args
			)
		);
		if ( ! empty( $specified_posts ) ) {
			$args['post__in'] = explode(',', $specified_posts);
		}
		
		$artcl = new WP_Query( $args );

	   	if ( $artcl->have_posts() ) { 
	   		if ( $show_thumbnail ) { ?>
	   			<div class="widget widget-latest-posts-thumb <?php echo esc_attr( $class ); ?>">
	   				<?php if ( ! empty( $title ) ): ?>
	   					<h3 class="widget-title"><?php echo esc_html( $title ); ?></h3>
	   				<?php endif ?>
					<ul>
						<?php while ( $artcl->have_posts() ) :
							$artcl->the_post(); 
							$archive_year  = get_the_time('Y'); 
							$archive_month = get_the_time('m'); 
							$archive_day   = get_the_time('d'); ?>
							<li>
								<?php if ( has_post_thumbnail() ): ?>
									<a href="<?php the_permalink(); ?>" class="widget-latest-posts-thumb__thumb effect-apollo">
										<?php the_post_thumbnail('lawyer-shortcode-recent-posts'); ?>
										<div class="effect-apollo__overlay"></div>
									</a>
								<?php endif ?>

								<div class="widget-latest-posts-thumb__item-meta">
									<?php if ( ! $show_post_date ): ?>
										<a class="widget__date" href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php the_time( get_option('date_format') ); ?></a>
									<?php endif ?>
									<?php
										$post_title_str = get_the_title();
										if ( $post_title && ! empty( $symbol_count ) && is_numeric( $symbol_count ) ) {
											$post_title_str_len = strlen( $post_title_str );
											$post_title_str = substr( get_the_title(), 0, $symbol_count );

											if ( strlen( $post_title_str ) != $post_title_str_len ) {
												$post_title_str = $post_title_str . '...';
											}
										}
									?>
									<h4><a href="<?php the_permalink(); ?>"><?php echo $post_title_str; ?></a></h4>
								</div>
							</li>
							<?php endwhile; 
						wp_reset_postdata(); ?>
					</ul>
				</div>

	   		<?php } else { ?>

		   		<div class="widget widget-latest-posts <?php echo esc_attr( $class ); ?>">
					<?php if ( ! empty( $title ) ): ?>
	   					<h3 class="widget-title"><?php echo esc_html( $title ); ?></h3>
	   				<?php endif ?>
					<ul>
						<?php while ( $artcl->have_posts() ) :
							$artcl->the_post(); 
							$archive_year  = get_the_time('Y'); 
							$archive_month = get_the_time('m'); 
							$archive_day   = get_the_time('d'); ?>
							<li>
								<?php if ( ! $show_post_date ): ?>
									<a class="widget__date" href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php the_time( get_option('date_format') ); ?></a>
								<?php endif ?>
								<?php
									$post_title_str = get_the_title();
									if ( $post_title && ! empty( $symbol_count ) && is_numeric( $symbol_count ) ) {
										$post_title_str_len = strlen( $post_title_str );
										$post_title_str = substr( get_the_title(), 0, $symbol_count );

										if ( strlen( $post_title_str ) != $post_title_str_len ) {
											$post_title_str = $post_title_str . '...';
										}
									}
								?>
								<h4><a href="<?php the_permalink(); ?>"><?php echo $post_title_str; ?></a></h4>
							</li>
							<?php endwhile; 
						wp_reset_postdata(); ?>

					</ul>
				</div>

	   		<?php }
		}
		
		return ob_get_clean();
	}
}