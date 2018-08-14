<?php 
/* Sidebar Shortcode */

vc_map(
	array(
		'name'        => esc_html__( 'Sidebar', 'js_composer' ),
		'base'        => 'lawyer_sidebar',
		'params'      => array(
			array(
				'type' 		  => 'dropdown',
				'heading' 	  => 'Sidebar',
				'param_name'  => 'sidebar',
				'value' 	  => lawyer_sidebars()
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

class WPBakeryShortCode_lawyer_sidebar extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'sidebar' 		=> 'none',
			'el_class' 		=> '',
			'css' 			=> ''
		), $atts ) );

		if( $sidebar != 'none' && is_active_sidebar( $sidebar ) ) {

			$class  = ( ! empty( $el_class ) ) ? $el_class : '';
			$class .= vc_shortcode_custom_css_class( $css, ' ' );

			ob_start(); ?>

				<div class="<?php echo $class; ?>">
					<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( $sidebar ) ); ?>
				</div>


			<?php
			return ob_get_clean();			
		}
	}
}