<?php 
/* Alert box Shortcode */

vc_map(
	array(
		'name'        => __( 'Alert box', 'js_composer' ),
		'base'        => 'lawyer_alert_box',
		'params'      => array(
			array(
				'type' 		  => 'dropdown',
				'heading' 	  => 'Type',
				'param_name'  => 'type',
				'value' 	  => array(
					'Info'	   => 'info',
					'Warning'  => 'warning',
					'Danger'   => 'danger',
					'Success'  => 'success',
					'White'	   => 'white',
				),
				'admin_label' => true,
			),
			array(
				'type' 		  => 'textfield',
				'heading' 	  => __( 'Title', 'js_composer' ),
				'param_name'  => 'title',
				'admin_label' => true
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

class WPBakeryShortCode_lawyer_alert_box extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'type' 	   => 'info',
			'title'    => '',
			'el_class' => '',
			'css' 	   => ''
		), $atts ) );

		$class  = ( ! empty( $el_class ) ) ? $el_class : '';
		$class .= vc_shortcode_custom_css_class( $css, ' ' );

		$class .= $type != 'white' ? ' alert--' . $type : '';

		ob_start(); ?>

			<div class="alert <?php echo $class; ?>">
				<?php if ( ! empty( $title ) ): ?>
					<span class="alert__title"><?php echo esc_html( $title ); ?></span>
				<?php endif ?>
				<i class="closebtn icon-cancel-circled"></i>
			</div>

		<?php
		return ob_get_clean();
	}
}