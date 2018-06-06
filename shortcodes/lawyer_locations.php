<?php 
/* Locations Shortcode */

// Check if plugin is active
if ( class_exists( 'Interactive_Map_Builder' ) ) {
	$maps = Interactive_Map::get_maps();
	$maps_list = array( 'Select map' => '' );

	if (( count( $maps ) ) > 0) {
		foreach ( $maps as $key => $map ) {
			$maps_list[ esc_html( $map->get_name() ) ] = $map->get_id();
		}
	
		vc_map(
			array(
				'name'        => __( 'Locations', 'js_composer' ),
				'base'        => 'lawyer_locations',
				'params'      => array(
					array(
						'type'        => 'dropdown',
						'heading' 	  => 'Style',
						'param_name'  => 'style',
						'value' 	  => array(
							'Style 1'  => 'style1',
							'Style 2'  => 'style2'
						)
					),
					array(
						'type' 		  => 'dropdown',
						'heading' 	  => 'Map',
						'param_name'  => 'map',
						'value' 	  => $maps_list,
						'admin_label' => true,
					),
					array(
						'type'        => 'dropdown',
						'heading' 	  => 'Locations',
						'param_name'  => 'locations',
						'value' 	  => array(
							'Hide'   	=> 'hide',
							'Show'    	=> 'show'
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

		class WPBakeryShortCode_lawyer_locations extends WPBakeryShortCode{
			protected function content( $atts, $content = null ) {

				extract( shortcode_atts( array(
					'style'     => 'style1',
					'map'       => '',
					'locations' => 'hide',
					// 'columns'   => '6',
					'el_class'  => '',
					'css' 	    => ''
				), $atts ) );

				$classes = array(
					'6' => 'small-6 medium-3 large-2 column',
					// '4' => 'small-6 medium-4 large-3 column',
					// '3' => 'small-6 medium-4 large-4 column',
					'2' => 'small-6 large-2 column'
				);

				$columns = $style == 'style1' ? 6 : 2;

				$class  = ( ! empty( $el_class ) ) ? $el_class : '';
				$class .= vc_shortcode_custom_css_class( $css, ' ' );

				ob_start(); 
					if ( $style == 'style1' ) { ?>
						<div class="find-people-map find-people-map--big <?php echo $class; ?>">
							<?php if ( ! empty( $map ) ) { ?>
								<div class="row">
									<div class="column find-people-map__img">
										<?php echo do_shortcode( '[interactive_map id="' . $map . '"]' ); ?>
									</div>
								</div>
							<?php } ?>
						
							<?php
							if ( $locations == 'show' ) {
								$offices_args = array( 'post_type' => 'locations', 'posts_per_page' => -1 );
								$offices = lawyer_param_values( 'posts', $offices_args, true, false );
								if ( ! empty( $offices ) ) { 
									$size = ceil( count( $offices ) / $columns );
									$parts = array_chunk( $offices, $size, true ); ?>

									<div class="row">
										<?php foreach ( $parts as $part ) { ?>
											<div class="<?php echo $classes[ $columns ];  ?>">
												<ul class="find-people-map__list">
													<?php foreach ( $part as $id => $location ) { ?>
														<li><a class="find-people-map__link" href="<?php the_permalink( $id ); ?>"><?php echo $location; ?></a></li>
													<?php } ?>
												</ul>
											</div>
										<?php } ?>
									</div>

								<?php }
							} ?>
						</div>
					<?php }
					if ( $style == 'style2' ) { ?>
						<div class="row find-people-map-inner <?php echo $class; ?>">
							<?php if ( ! empty( $map ) ) { ?>
								<div class="small-12 large-8 column find-people-map__img">
									<?php echo do_shortcode( '[interactive_map id="' . $map . '"]' ); ?>
								</div>
							<?php } ?>

							<?php
							if ( $locations == 'show' ) {
								$offices_args = array( 'post_type' => 'locations', 'posts_per_page' => -1 );
								$offices = lawyer_param_values( 'posts', $offices_args, true, false );
								if ( ! empty( $offices ) ) { 
									$size = ceil( count( $offices ) / $columns );
									$parts = array_chunk( $offices, $size, true ); ?>

									<?php foreach ( $parts as $part ) { ?>
										<div class="<?php echo $classes[ $columns ];  ?>">
											<ul class="find-people-map__list">
												<?php foreach ( $part as $id => $location ) { ?>
													<li><a class="find-people-map__link" href="<?php the_permalink( $id ); ?>"><?php echo $location; ?></a></li>
												<?php } ?>
											</ul>
										</div>
									<?php } ?>

								<?php }
							} ?>

						</div>
					<?php }
					?>
				
					

				<?php
				return ob_get_clean();
			}
		}
	}
}

/*
<div class="small-6 medium-3 large-2 column">
	<ul class="find-people-map__list">
		<li><a class="find-people-map__link" href="single-location.html">Moscow</a></li>
		<li><a class="find-people-map__link" href="single-location.html">Munich</a></li>
		<li><a class="find-people-map__link" href="single-location.html">New York</a></li>
		<li><a class="find-people-map__link" href="single-location.html">Paris</a></li>
		<li><a class="find-people-map__link" href="single-location.html">Prague</a></li>
		<li><a class="find-people-map__link" href="single-location.html">Rome</a></li>
	</ul>
</div>
*/