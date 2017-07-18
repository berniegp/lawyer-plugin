<?php
/* Testimonials Shortcode */
$args = array( 'post_type' => 'testimonials', 'numberposts' => -1 );
vc_map(
	array(
		'name'        => __( 'Testimonials', 'js_composer' ),
		'base'        => 'lawyer_testimonials',
		'params'      => array(
			array(
				'type'        => 'dropdown',
				'heading'     => 'Style',
				'param_name'  => 'style',
				'value'       => array(
					'Style 1'  => 'style-1',
					'Style 2'  => 'style-2',
					'Cite'     => 'cite'
				)
			),           
			array(
				'type'        => 'dropdown',
				'heading' 	  => 'Show testimonials',
				'param_name'  => 'testimonials',
				'value' 	  => array(
					'Predefined' => 'predefined',
					'Random'     => 'random',
					'Specific' 	 => 'specific',
					'Latest' 	 => 'latest'
				)
			),
			array(
				'type'        => 'dropdown',
				'heading'     => 'Select testimonials',
				'param_name'  => 'testimonial_id',
				'value'       => lawyer_param_values( 'posts', $args ),
				'dependency'  => array( 'element' => 'testimonials', 'value' => 'specific' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Type testimonials ids', 'js_composer' ),
				'param_name'  => 'predefined',
				'dependency'  => array( 'element' => 'testimonials', 'value' => array( 'predefined' ) ),
				'description' => 'Testimonials post ids, comma separated(ex. 12, 23, 152).'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => 'Number of items',
				'param_name'  => 'number',
				'value'       => array(
					'All items'     => '-1',
					'1'             => '1',
					'2'             => '2',
					'3'             => '3',
					'4'             => '4',
					'5'             => '5'
				),
				'dependency'  => array( 'element' => 'testimonials', 'value' => array( 'random', 'latest' ) ),
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Show Position', 'js_composer' ),
				'param_name'  => 'show_position',
				'dependency'  => array( 'element' => 'style', 'value' => array( 'style-1', 'style-2' ) )
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Show Thumbnail', 'js_composer' ),
				'param_name'  => 'thumbnail',
				'dependency'  => array( 'element' => 'style', 'value' => array( 'style-1', 'style-2' ) )
			),
			array(
				'type'        => 'dropdown',
				'heading' 	  => 'Animation effect',
				'param_name'  => 'effect',
				'value' 	  => array(
					'Fade'  => 'fade',
					'Slide' => 'slide'
				),
				'dependency'  => array( 'element' => 'testimonials', 'value' => array( 'random', 'latest', 'predefined' ) )
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Timeout speed', 'js_composer' ),
				'param_name'  => 'timeout_speed',
				'value' 	  => '5000',
				'dependency'  => array( 'element' => 'testimonials', 'value' => array( 'random', 'latest', 'predefined' ) )
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Slide speed', 'js_composer' ),
				'param_name'  => 'slide_speed',
				'value' 	  => '300',
				'dependency'  => array( 'element' => 'testimonials', 'value' => array( 'random', 'latest', 'predefined' ) )
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


class WPBakeryShortCode_lawyer_testimonials extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'style'          => 'style-1',
			'testimonials'   => 'predefined',
			'predefined'     => '',
			'testimonial_id' => '',
			'number'         => '-1',
			'show_position'  => '',
			'thumbnail'      => '',
			'effect'         => 'fade',
			'timeout_speed'  => '5000',
			'slide_speed'    => '300',
			'el_class'       => '',
			'css' 	         => ''
		), $atts ) );

		$class  = ( ! empty( $el_class ) ) ? $el_class : '';
		$class .= vc_shortcode_custom_css_class( $css, ' ' );

		ob_start();

		$args = array(
			'post_type'      	  => 'testimonials',
			'posts_per_page' 	  => $number,
			'ignore_sticky_posts' => true,
		);

		if ( $testimonials == 'predefined' && ! empty( $predefined ) ) {
			$args['post__in'] = explode( ',', $predefined );
		}

		if ( $testimonials == 'specific' ) {
			$args['post__in'] = array( $testimonial_id );
		}

		if ( $testimonials == 'latest' ) {
			$args['orderby'] = 'ID';
			$args['order'] = 'desc';
		}

		if ( $testimonials == 'rand' ) {
			$args['orderby'] = 'rand';
		}

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) { ?>
			<?php if ( $testimonials == 'specific' ): ?>

				<?php if ( $style == 'style-1' ): ?>
					<?php while ( $query->have_posts() ) {
						$query->the_post();
						$content = get_the_content(); ?>
						<div class="swiper-slide">
							<blockquote class="blockquote blockquote--style-1"><?php echo esc_html( $content ); ?></blockquote>
							<div class="blockquote-author">
								<?php
								if ( $thumbnail == true ) {
									the_post_thumbnail( 'medium', array( 'class' => 'blockquote-author__photo' ) );
								} ?>
								<div class="blockquote-author__info">
									<?php the_title( '<cite class="blockquote-author__name">', '</cite>' ); ?>
									<?php if ( $show_position == true ){
										$meta = get_post_meta( get_the_ID(), 'testimonial_options', true ); ?>
										<?php if ( ! empty( $meta['position'] ) ): ?>
											<cite class="blockquote-author__position"><?php echo esc_html( $meta['position'] ); ?></cite>
										<?php endif ?>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php }
					wp_reset_postdata(); ?>
				<?php elseif ( $style == 'style-2' ): ?>
					<?php while ( $query->have_posts() ) {
						$query->the_post();
						$content = get_the_content(); ?>
						<div class="swiper-slide">
							<blockquote class="blockquote blockquote--style-2"><?php echo esc_html( $content ); ?></blockquote>
							<div class="blockquote-author">
								<?php
								if ( $thumbnail == true ) {
									the_post_thumbnail( 'medium', array( 'class' => 'blockquote-author__photo' ) );
								} ?>
								<div class="blockquote-author__info">
									<?php the_title( '<cite class="blockquote-author__name">', '</cite>' ); ?>
									<?php if ( $show_position == true ){
										$meta = get_post_meta( get_the_ID(), 'testimonial_options', true ); ?>
										<?php if ( ! empty( $meta['position'] ) ): ?>
											<cite class="blockquote-author__position"><?php echo esc_html( $meta['position'] ); ?></cite>
										<?php endif ?>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php }
					wp_reset_postdata(); ?>
				<?php else: ?>
					<?php while ( $query->have_posts() ) {
						$query->the_post();
						$content = get_the_content(); ?>
						<div class="swiper-slide service-blockquote">
							<blockquote class="blockquote service-blockquote__text"><?php echo esc_html( $content ); ?></blockquote>
							<?php the_title( '<cite class="service-blockquote__author">', '</cite>' ); ?>
						</div>
					<?php }
					wp_reset_postdata(); ?>
				<?php endif ?>

			<?php else: ?>

			
				<?php if ( $style == 'style-1' ): ?>
					<div class="widget widget-blockquote <?php echo esc_attr( $class ); ?>">
						<div class="swiper-container" data-slides-per-view="1" data-loop="true" data-autoplay="<?php echo esc_attr( $slide_speed ); ?>" data-speed="<?php echo esc_attr( $timeout_speed ); ?>" data-space-between="70" data-slide-effect="<?php echo esc_attr( $effect ); ?>">
							<!-- Additional required wrapper -->
							<div class="swiper-wrapper">
								<!-- Slides -->
								<?php while ( $query->have_posts() ) {
									$query->the_post();
									$content = get_the_content(); ?>
									<div class="swiper-slide">
										<blockquote class="blockquote blockquote--style-1"><?php echo esc_html( $content ); ?></blockquote>
										<div class="blockquote-author">
											<?php
											if ( $thumbnail == true ) {
												the_post_thumbnail( 'medium', array( 'class' => 'blockquote-author__photo' ) );
											} ?>
											<div class="blockquote-author__info">
												<?php the_title( '<cite class="blockquote-author__name">', '</cite>' ); ?>
												<?php if ( $show_position == true ){
													$meta = get_post_meta( get_the_ID(), 'testimonial_options', true ); ?>
													<?php if ( ! empty( $meta['position'] ) ): ?>
														<cite class="blockquote-author__position"><?php echo esc_html( $meta['position'] ); ?></cite>
													<?php endif ?>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php }
								wp_reset_postdata(); ?>

							</div>
						</div>
					</div>

				<?php elseif ( $style == 'style-2' ): ?>

					<div class="widget widget-blockquote <?php echo esc_attr( $class ); ?>">
						<div class="swiper-container" data-slides-per-view="1" data-loop="true" data-autoplay="<?php echo esc_attr( $slide_speed ); ?>" data-speed="<?php echo esc_attr( $timeout_speed ); ?>" data-space-between="70" data-slide-effect="<?php echo esc_attr( $effect ); ?>">
							<!-- Additional required wrapper -->
							<div class="swiper-wrapper">
								<!-- Slides -->
								<?php while ( $query->have_posts() ) {
									$query->the_post();
									$content = get_the_content(); ?>
									<div class="swiper-slide">
										<blockquote class="blockquote blockquote--style-2"><?php echo esc_html( $content ); ?></blockquote>
										<div class="blockquote-author">
											<?php
											if ( $thumbnail == true ) {
												the_post_thumbnail( 'medium', array( 'class' => 'blockquote-author__photo' ) );
											} ?>
											<div class="blockquote-author__info">
												<?php the_title( '<cite class="blockquote-author__name">', '</cite>' ); ?>
												<?php if ( $show_position == true ){
													$meta = get_post_meta( get_the_ID(), 'testimonial_options', true ); ?>
													<?php if ( ! empty( $meta['position'] ) ): ?>
														<cite class="blockquote-author__position"><?php echo esc_html( $meta['position'] ); ?></cite>
													<?php endif ?>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php }
								wp_reset_postdata(); ?>

							</div>
						</div>
					</div>

				<?php else: ?>

					<div class="align-center service-blockquote-wrapper <?php echo esc_attr( $class ); ?>">
						<!-- Slider main container -->
						<div class="swiper-container" data-slides-per-view="1" data-loop="true" data-autoplay="<?php echo esc_attr( $slide_speed ); ?>" data-speed="<?php echo esc_attr( $timeout_speed ); ?>" data-space-between="70" data-slide-effect="<?php echo esc_attr( $effect ); ?>">
							<!-- Additional required wrapper -->
							<div class="swiper-wrapper">
								<!-- Slides -->
								<?php while ( $query->have_posts() ) {
									$query->the_post();
									$content = get_the_content(); ?>
									<div class="swiper-slide service-blockquote">
										<blockquote class="blockquote service-blockquote__text"><?php echo esc_html( $content ); ?></blockquote>
										<?php the_title( '<cite class="service-blockquote__author">', '</cite>' ); ?>
									</div>
								<?php }
								wp_reset_postdata(); ?>
							</div>
						</div>
					</div>

				<?php endif ?>
			<?php endif ?>
		<?php }
		return ob_get_clean();
	}
}