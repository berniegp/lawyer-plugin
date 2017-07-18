<?php
/* Google maps Shortcode */

vc_map(
	array(
		'name'        => __( 'Google maps', 'js_composer' ),
		'base'        => 'lawyer_google_maps',
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Width', 'js_composer' ),
				'param_name'  => 'width'
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Height', 'js_composer' ),
				'param_name'  => 'height'
			),
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Location Mode', 'js_composer' ),
				'param_name'  => 'location_mode',
				'value' 	  =>  array(
					'Address' 	  => 'address',
					'Coordinates' => 'coordinates'
				)
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Marker Latitude', 'js_composer' ),
				'param_name'  => 'marker_latitude',
				'dependency'  => array( 'element' => 'location_mode', 'value' => 'coordinates' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Marker Longtitude', 'js_composer' ),
				'param_name'  => 'marker_longtitude',
				'dependency'  => array( 'element' => 'location_mode', 'value' => 'coordinates' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Address', 'js_composer' ),
				'param_name'  => 'address',
				'dependency'  => array( 'element' => 'location_mode', 'value' => 'address' )
			),
			array(
				'type'        => 'dropdown',
				'heading' 	  => 'Zoom',
				'param_name'  => 'zoom',
				'value' 	  => array(
					'1'  => '1',
					'2'  => '2',
					'3'  => '3',
					'4'  => '4',
					'5'  => '5',
					'6'  => '6',
					'7'  => '7',
					'8'  => '8',
					'9'  => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12',
					'13' => '13',
					'14' => '14',
					'15' => '15',
					'16' => '16',
					'17' => '17',
					'18' => '18',
					'19' => '19',
					'20' => '20'
				)
			),
			array(
				'type'        => 'dropdown',
				'heading' 	  => 'Map type',
				'param_name'  => 'map_type',
				'value' 	  => array(
					'Roadmap' 	=> 'roadmap',
					'Satellite' => 'satellite',
					'Terrain' 	=> 'terrain',
					'Hybrid'    => 'hybrid'
				)

			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Enable scrollwheel', 'js_composer' ),
				'param_name'  => 'enable_scroll'
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Marker is draggable', 'js_composer' ),
				'param_name'  => 'draggable'
			),
			array(
				'type'        => 'checkbox',
				'heading'     => __( 'Enable marker with popup', 'js_composer' ),
				'param_name'  => 'enable_popup',
			),
			array(
				'type' 		  => 'textarea',
				'heading' 	  => __( 'HTML content', 'js_composer' ),
				'param_name'  => 'html_content',
				'dependency'  => array( 'element' => 'enable_popup', 'value' => 'true' )
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

class WPBakeryShortCode_lawyer_google_maps extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'width'             => '',
			'height'            => '',
			'location_mode'     => 'address',
			'marker_latitude'   => '40.714623',
			'marker_longtitude' => '-74.006605',
			'address'           => 'London',
			'zoom'              => '11',
			'map_type'          => 'roadmap',
			'enable_scroll'     => '',
			'draggable'         => '',
			'enable_popup'      => '',
			'html_content'      => '',
			'el_class'          => '',
			'css' 	            => ''
		), $atts ) );

		$class  = ( ! empty( $el_class ) ) ? $el_class : '';
		$class .= vc_shortcode_custom_css_class( $css, ' ' );

		$enable_popup = $enable_popup == true ? 'show' : 'hide';
		$enable_scroll = $enable_scroll == true ? 'show' : 'hide';
		$draggable = $draggable == true ? 'show' : 'hide';

		ob_start(); 

		$style = '';
		$css_style = '';
		if  ( ! empty( $height ) ) {
			$style = is_numeric( $height ) ? 'height:' . $height . 'px; ' : 'height:' . $height . ';';
		}
		if  ( ! empty( $width ) ) {
			$style .= is_numeric( $width ) ? 'width:' . $width . 'px;' : 'width:' . $width . ';';
		}
		if( ! empty( $style ) ) {
			$css_style = ' style="' . $style . '"';
		} ?>

			<div class="single-location__map <?php echo esc_attr( $class );?>"<?php echo $css_style; ?>
				 data-lat="<?php echo esc_attr( $marker_latitude ); ?>"
				 data-lng="<?php echo esc_attr( $marker_longtitude ); ?>"
				 data-location="<?php echo esc_attr( $location_mode ); ?>"
				 data-address="<?php echo esc_attr( $address ); ?>"
				 data-zoom="<?php echo esc_attr( $zoom ); ?>"
				 data-map_type="<?php echo esc_attr( $map_type ); ?>"
				 data-enable_scroll="<?php echo esc_attr( $enable_scroll ); ?>"
				 data-content="<?php echo esc_attr( $html_content ); ?>"
				 data-popup="<?php echo esc_attr( $enable_popup ); ?>"
				 data-draggable="<?php echo esc_attr( $draggable ); ?>">
			</div>

		<?php

		return ob_get_clean();
	}
}