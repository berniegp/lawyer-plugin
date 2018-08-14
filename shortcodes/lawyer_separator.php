<?php 
/* Separator Shortcode */

vc_map(
	array(
		'name'        => esc_html__( 'Separator', 'js_composer' ),
		'base'        => 'lawyer_separator',
		'params'      => array(
			array(
				'type' 		  => 'dropdown',
				'heading' 	  => 'List type',
				'param_name'  => 'type',
				'value' 	  => array(
					'Dashed' 	 => 'separator--dashed"',
					'Solid gray' => 'separator--solid',
					'Solid dark' => 'separator--solid-black'
				)
			),
			array(
				'type' 		  => 'textfield',
				'heading' 	  => esc_html__( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
				'value' 	  => ''
			),
			 /* CSS editor */
			array(
				'type' 		  => 'css_editor',
				'heading' 	  => esc_html__( 'CSS box', 'js_composer' ),
				'param_name'  => 'css',
				'group' 	  => esc_html__( 'Design options', 'js_composer' )
			)

		)
	)
);

class WPBakeryShortCode_lawyer_separator extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'type'     => 'separator--dashed',
			'el_class' => '',
			'css'      => ''
		), $atts ) );

		$class  = ( ! empty( $el_class ) ) ? $el_class : '';
		$class .= vc_shortcode_custom_css_class( $css, ' ' );
		$class .= ' ' . $type;

		ob_start(); ?>
		<hr class="separator <?php echo esc_attr( $class );?>">
		<?php
			return ob_get_clean();
	}
}