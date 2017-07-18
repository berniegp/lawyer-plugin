<?php 
/* Toggle/Accordion Shortcode */

vc_map(
	array(
		'name'        => __( 'Toggle/Accordion', 'js_composer' ),
		'base'        => 'lawyer_accordion',
		'params'      => array(
			array(
				'type' 		  => 'dropdown',
				'heading' 	  => 'Type',
				'param_name'  => 'type',
				'value' 	  => array(
					'Toggle' 	=> 'toggle',
					'Accordion' => 'acc',
				),
				'admin_label' => true,
			),

			array(
				'type'       => 'param_group',
				'heading'    => __( 'Items', 'js_composer' ),
				'param_name' => 'items',
				'params'     => array(
					array(
						'type' 		  => 'textfield',
						'heading' 	  => __( 'Item title', 'js_composer' ),
						'param_name'  => 'title',
						'value' 	  => '',
						'admin_label' => true,
					),
					array(
						'type' 		  => 'textarea',
						'heading' 	  => __( 'Item Content', 'js_composer' ),
						'param_name'  => 'text'
					)
				),
				'callbacks' => array(
					'after_add' => 'vcChartParamAfterAddCallback'
				)
			),

			array(
				'type' 		  => 'textfield',
				'heading' 	  => __( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
				'value' 	  => '',
				'admin_label' => true,
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

class WPBakeryShortCode_lawyer_accordion extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'title'     => '',
			'type'      => 'toggle',
			'items'     => '',
			'el_class'  => '',
			'css' 	    => ''
		), $atts ) );

		$items = json_decode( urldecode( $items ), true );

		$class  = ( ! empty( $el_class ) ) ? $el_class : '';
		$class .= vc_shortcode_custom_css_class( $css, ' ' );
		$class .= ' ' . $type;

		ob_start();
		?>
			<ul class="accordion <?php echo esc_attr( $class ); ?>" role="tablist">
				<?php foreach ( $items as $item ) { ?>
					<?php if( ! empty( $item['title'] ) && ! empty( $item['text'] ) ) { ?>
						<li class="accordion-item">
							<div role="tab" class="accordion-title"> <?php echo esc_html( $item['title'] ); ?> </div>
							<div class="accordion-content" role="tabpanel"><?php echo esc_html( $item['text'] ); ?></div>
						</li>
					<?php } ?>
				<?php } ?>
			</ul>
		<?php
		return ob_get_clean();
	}
}