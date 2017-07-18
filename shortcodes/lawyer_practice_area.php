<?php
/* Practice areas Shortcode */

$args = array( 'post_type' => 'locations', 'numberposts' => -1 );
vc_map(
	array(
		'name'        => __( 'Practice areas', 'js_composer' ),
		'base'        => 'lawyer_practice_areas',
		'params'      => array(
			array(
				'type' 		  => 'dropdown',
				'heading' 	  => 'Options type',
				'param_name'  => 'type',
				'value' 	  => array(
					'Custom' 		 => 'custom',
					'Predefined ids' => 'predefined'
				),
				'admin_label' => true,
			),
			array(
				'type' 		  => 'textfield',
				'heading' 	  => __( 'Predefined ids', 'js_composer' ),
				'param_name'  => 'predefined',
				'description' => __( 'Practice ids, comma separated(ex. 12, 23, 152).', 'js_composer' ),
				'value' 	  => '',
				'dependency'  => array( 'element' => 'type', 'value' => 'predefined' )
			),
			array(
				'type' 		  => 'dropdown',
				'heading' 	  => 'Locations',
				'param_name'  => 'locations',
				'value' 	  =>  lawyer_param_values( 'posts', $args, false, true ),
				'dependency'  => array( 'element' => 'type', 'value' => 'custom' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Limit', 'js_composer' ),
				'param_name'  => 'limit',
				'description' => 'Count items to display.',
				'dependency'  => array( 'element' => 'type', 'value' => 'custom' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Excerpt length', 'js_composer' ),
				'param_name'  => 'excerpt_length',
				'description' => 'Count symbols to display. Must be a number.'
			),
			array(
				'type' 		  => 'dropdown',
				'heading' 	  => 'Style',
				'param_name'  => 'style',
				'value' 	  => array(
					'Style 1' => '',
					'Style 2' => 'tile-col--style-2',
					'Style 3' => 'tile-practice-2-row',
				),
				'admin_label' => true,
			),
			array(
				'type' 		  => 'dropdown',
				'heading' 	  => 'Order by',
				'param_name'  => 'orderby',
				'admin_label' => true,
				'value' 	  => array(
					'ID' 		=> 'term_id',
					'Name' 		=> 'name',
					'Slug' 		=> 'slug',
				)
			),
			array(
				'type' 		  => 'dropdown',
				'heading' 	  => 'Order type',
				'param_name'  => 'order',
				'value' 	  => array(
					'Ascending'  => 'ASC',
					'Descending' => 'DESC'
				)
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


class WPBakeryShortCode_lawyer_practice_areas extends WPBakeryShortCode
{
	protected function content( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'type'     	 	 => 'custom',
			'predefined'     => '',
			'limit'     	 => '',
			'locations' 	 => 'all',
			'excerpt_length' => '',
			'style'     	 => '',
			'orderby'     	 => 'term_id',
			'order'     	 => 'ASC',
			'el_class'  	 => '',
			'css'       	 => ''
		), $atts));

		$class = (!empty($el_class)) ? $el_class : '';
		$class .= vc_shortcode_custom_css_class($css, ' ');
		$terms = array();

		ob_start();

		if ( $type == 'custom' ) {

			if ( $locations == 'all' ) {

				$args = array(
					'taxonomy' 	 => 'practice',
					'hide_empty' => false,
					'orderby' 	 => $orderby,
					'order' 	 => $order
				);

				if ( ! empty( $limit ) ) {
					$args['number'] = $limit;
				}

				$terms = get_terms( $args );
			} else {
				$args  = array( 
					'post_type'   	 => 'people', 
					'posts_per_page' => -1,
					'fields' 		 => 'ids',
					'meta_key' 		 => 'people-location',
					'meta_value' 	 => $locations
				);

				$people = new WP_Query( $args );

				if ( ! empty( $people->posts ) ) {
					$args  = array( 'orderby' => $orderby, 'order' => $order );
					$terms = wp_get_object_terms( $people->posts, 'practice', $args );
				}
			}
		} else {
			$args = array(
				'taxonomy' 	 => 'practice',
				'hide_empty' => false,
				'orderby' 	 => $orderby,
				'order' 	 => $order
			);

			if ( ! empty( $predefined ) ) {
				$args['include'] = $predefined;
			}
			
			$terms = get_terms( $args );
		}

		if ( ! empty( $terms ) ) {

			if ( $style == '' ) { ?>

				<div class="row">
					<?php
					foreach ( $terms as $term ) :
						$description = esc_html( $term->description );
						if ( ! empty( $excerpt_length ) && is_numeric( $excerpt_length ) ) {
							$description_len = strlen( $description );
							$description = substr( $description, 0, $excerpt_length );
							if ( strlen( $description ) != $description_len ) {
								$description = $description . '...';
							}
						}

						$term_link = get_term_link( $term->term_id, 'practice' );
						$practice_fields = get_term_meta( $term->term_id, 'practice_fields', true ); ?>
						<div class="small-12 medium-6 large-4 columns tile-col <?php echo esc_attr( $class ); ?>">
							<section class="tile effect-bubba">
								<div class="tile__icon <?php echo esc_attr( $practice_fields['icon'] ); ?>"></div>
								<h3 class="tile__title"><?php echo esc_html( $term->name ); ?></h3>
								<p class="tile__description"><?php echo $description; ?></p>
								<i class="tile__arrow icon-right-4"></i>
								<a href="<?php echo esc_html( $term_link ); ?>" class="tile__link"></a>
							</section>
						</div>
						<?php
					endforeach; ?>
				</div>

			<?php } else { ?>

				<div class="row <?php if ( $style == 'tile-practice-2-row' ) { echo esc_attr( $style ); } ?> ">
					<?php 
					foreach ( $terms as $term ) :
						$description = esc_html( $term->description );
						if ( ! empty( $excerpt_length ) && is_numeric( $excerpt_length ) ) {
							$description_len = strlen( $description );
							$description = substr( $description, 0, $excerpt_length );
							if ( strlen( $description ) != $description_len ) {
								$description = $description . '...';
							}
						}
						
						$term_link = get_term_link( $term->term_id, 'practice' );
						$practice_fields = get_term_meta( $term->term_id, 'practice_fields', true ); ?>
						
						<div class="small-12 medium-6 <?php if ( $style == 'tile-practice-2-row' ) { echo 'large-3'; } else{ echo 'large-4'; } ?>  columns tile-col tile-col--style-2">
							<section class="tile tile--style-2">
								<?php if ( ! empty( $practice_fields['image'] ) ): 
									$attachment = wp_get_attachment_image_url( $practice_fields['image'], 'full' ); ?>
									<div class="effect-apollo">
										<img src="<?php echo esc_html( $attachment ); ?>" alt="">
										<div class="effect-apollo__overlay"></div>
										<a href="<?php echo esc_html( $term_link ); ?>" class="tile__link"></a>
									</div>
								<?php endif ?>
								<h3 class="tile__title"><?php echo esc_html( $term->name ); ?></h3>
								<p class="tile__description"><?php echo $description; ?></p>
							</section>
						</div>

					<?php endforeach; ?>
				</div>
			<?php }
		}
		return ob_get_clean();
	}
}
