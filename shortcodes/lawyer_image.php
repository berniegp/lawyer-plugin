<?php
/* Image Shortcode */

vc_map(
	array(
		'name'        => __( 'Image', 'js_composer' ),
		'base'        => 'lawyer_image',
		'params'      => array(
			array(
				'type'        => 'attach_image',
				'heading'     => __( 'Image URL', 'js_composer' ),
				'param_name'  => 'image'
			),
			array(
				'type'        => 'dropdown',
				'heading' 	  => 'Action',
				'param_name'  => 'action',
				'value' 	  => array(
					'No link'  => 'no-link',
					'Link'     => 'link'
				)
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Target url', 'js_composer' ),
				'param_name'  => 'target_url',
				'dependency'  => array( 'element' => 'action', 'value' => 'link' )
			),
			array(
				'type'        => 'dropdown',
				'heading' 	  => 'Link target',
				'param_name'  => 'link_target',
				'value' 	  => array(
					'Self'     => 'self',
					'Blank'    => 'blank'
				),
				'dependency'  => array( 'element' => 'action', 'value' => 'link' )
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Image Alt', 'js_composer' ),
				'param_name'  => 'alt'
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

class WPBakeryShortCode_lawyer_image extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'image'     		=> '',
			'action'     		=> 'no-link',
			'target_url'     	=> '',
			'link_target'       => 'self',
			'alt'     			=> '',
			'el_class' 			=> '',
			'css'      			=> ''
		), $atts ) );

		$class  = ( ! empty( $el_class ) ) ? $el_class : '';
		$class .= vc_shortcode_custom_css_class( $css, ' ' );
		

		ob_start(); 
		if ( ! empty( $image ) ) {
			$img_url = wp_get_attachment_image_url( $image, 'full' );

			$alt = ! empty( $alt ) ? 'alt="' . $alt . '"' : '';

//			$target_url = ( $action != 'no-link' );
			
			if ( $action != 'no-link' && ! empty( $target_url ) ): ?><a href="<?php echo $target_url ?>" target="_<?php echo $link_target; ?>"><?php endif; ?>
				<figure class="post__thumb effect-apollo <?php echo $class; ?>">
					<img src="<?php echo esc_url( $img_url ); ?>" <?php echo $alt; ?> alt="">
					<div class="effect-apollo__overlay"></div>
				</figure>
			<?php if ( $action != 'no-link' && ! empty( $target_url ) ): ?></a><?php endif; 

		}
		return ob_get_clean();
	}
}