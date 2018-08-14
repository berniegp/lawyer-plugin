<?php 
/* Button Shortcode */

vc_map(
	array(
		'name'        => esc_html__( 'Theme button', 'js_composer' ),
		'base'        => 'lawyer_button',
		'params'      => array(
			array(
				'type'        => 'vc_link',
				'heading'     => esc_html__( 'Button', 'js_composer' ),
				'param_name'  => 'button'
			),
			array(
				'type'        => 'dropdown',
				'heading' 	  => 'Align',
				'param_name'  => 'align',
				'value' 	  => array(
					'Left' 	 => 'text-left',
					'Right'  => 'text-right',
					'Center' => 'text-center'
				)
			),
			array(
				'type' 		  => 'dropdown',
				'heading' 	  => 'Color',
				'param_name'  => 'color',
				'value' 	  => array(
					'Red' 	=> 'red',
					'White' => 'btn--ghost'
				)
			),

			array(
				'type' 		  => 'dropdown',
				'heading' 	  => esc_html__( 'Size', 'js_composer' ),
				'param_name'  => 'size',
				'value' 	  => array(
					'Small' 	=> 'btn btn--small',
					'Medium'    => 'btn',
					'Large'     => 'btn btn--large'
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

class WPBakeryShortCode_lawyer_button extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'button'    => '',
			'align'     => 'text-left',
			'color'     => 'red',
			'size'      => 'btn btn--small',
			'el_class'  => '',
			'css' 	    => ''
		), $atts ) );

		if( ! empty( $button ) ) {
			$class  = ( ! empty( $el_class ) ) ? $el_class : '';
			$class .= vc_shortcode_custom_css_class( $css, ' ' );
			$class .= ' ' . $size;
			$class .= ' ' . $color;
			
			$btn = vc_build_link( $button );
			$button_text = ! empty( $btn['title'] ) ? $btn['title'] : 'Button title';
			$button_target = ( ! empty( $btn['target'] ) ) ? 'target="' . $btn['target'] . '"' : '';
			$button_url = ( ! empty( $btn['url'] ) ) ? $btn['url'] : '#';

			ob_start(); ?>
			
			<div class="<?php echo $align; ?>">
				<a <?php echo $button_target; ?> href="<?php echo esc_url( $button_url ); ?>" class="<?php echo esc_attr( $class );?>"><?php echo esc_html( $button_text); ?></a>
			</div>

			<?php
			return ob_get_clean();
		}
	}
}