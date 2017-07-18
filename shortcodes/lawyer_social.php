<?php 
/* Social icon Shortcode */

vc_map(
	array(
		'name'        => __( 'Social icon', 'js_composer' ),
		'base'        => 'lawyer_social',
		'params'      => array(
			array(
				'type'        => 'iconpicker',
				'heading'     => __( 'Icon', 'js_composer' ),
				'param_name'  => 'icon',
				'value'       => 'icon-adjustments',
				'settings'       => array(
					'emptyIcon'    => false,
					'type'         => 'flaticon',
					'source'       => lawyer_fontello_icons( true ),
					'iconsPerPage' => 4000,
				),
				'description' => __( 'Select icon from library.', 'js_composer' ),
			),
			array(
				'type' 		  => 'textfield',
				'heading' 	  => __( 'Icon link', 'js_composer' ),
				'param_name'  => 'url',
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

class WPBakeryShortCode_lawyer_social extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'icon' 	   => '',
			'url'      => '',
			'el_class' => '',
			'css' 	   => ''
		), $atts ) );


		if ( ! empty( $icon ) ) {
			$class  = ( ! empty( $el_class ) ) ? $el_class : '';
			$class .= vc_shortcode_custom_css_class( $css, ' ' );

			$class .= ' ' . $icon;

			$icon_html = '<i class="' . $class . '"></i>';

			if ( ! empty( $url ) ) {
				$icon_html = '<a href="' . esc_url( $url ) . '">' . $icon_html . '';
			}

			ob_start();

				echo $icon_html;

			return ob_get_clean();
		}
	}
}