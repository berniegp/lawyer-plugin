<?php 
/* Text Shortcode */

vc_map(
	array(
		'name'        => esc_html__( 'Text block', 'js_composer' ),
		'base'        => 'lawyer_text',
		'params'      => array(
			array(
				'type'        => 'textarea_html',
				'heading'     => esc_html__( 'Content', 'js_composer' ),
				'param_name'  => 'content'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
				'value'       => ''
			),
			/* CSS editor */
			array(
				'type'        => 'css_editor',
				'heading'     => esc_html__( 'CSS box', 'js_composer' ),
				'param_name'  => 'css',
				'group'       => esc_html__( 'Design options', 'js_composer' )
			)
		)
	)
);

class WPBakeryShortCode_lawyer_text extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'el_class' => '',
			'css'      => ''
		), $atts ) );
		
		if ( ! empty( $content  ) ) {

			$class  = ( ! empty( $el_class ) ) ? $el_class : '';
			$class .= vc_shortcode_custom_css_class( $css, ' ' );

			ob_start(); ?>
				<div class="lawyer-text-block <?php echo esc_attr( $class ); ?>"><p><?php echo $content; ?></p></div>
			<?php
			return ob_get_clean();
		}
	}
}