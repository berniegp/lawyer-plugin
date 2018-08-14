<?php 
/* List Shortcode */

vc_map(
	array(
		'name'        => esc_html__( 'List', 'js_composer' ),
		'base'        => 'lawyer_list',
		'params'      => array(
			array(
				'type' 		  => 'dropdown',
				'heading' 	  => 'List type',
				'param_name'  => 'type',
				'value' 	  => array(
					'Ordered' 	=> 'ordered',
					'Unordered' => 'unordered'
				),
				'admin_label' => true,
			),
			array(
				'type'       => 'param_group',
				'heading'    => esc_html__( 'Items', 'js_composer' ),
				'param_name' => 'items',
				'params'     => array(
					array(
						'type' 		  => 'textarea',
						'heading' 	  => esc_html__( 'Text', 'js_composer' ),
						'param_name'  => 'text'
					)
				),
				'callbacks' => array(
					'after_add' => 'vcChartParamAfterAddCallback'
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

class WPBakeryShortCode_lawyer_list extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'type'     => 'ordered',
			'items'    => '',
			'el_class' => '',
			'css' 	   => ''
		), $atts ) );

		$items = json_decode( urldecode( $items ), true );
		
		if ( ! empty( $items  ) ) {

			$class  = ( ! empty( $el_class ) ) ? $el_class : '';
			$class .= vc_shortcode_custom_css_class( $css, ' ' );

			$wrapper_tag = $type == 'ordered' ? 'ol' : 'ul';

			ob_start(); ?>
			<<?php echo $wrapper_tag; ?> class="<?php echo esc_attr( $class );?>">

				<?php foreach ( $items as $item ) { ?>

					<?php if ( ! empty( $item['text'] ) ) : ?>
						<li>
							<?php  echo esc_html( $item['text'] ); ?>
						</li>
					<?php endif; ?>

				<?php } ?>

			</<?php echo $wrapper_tag; ?>>
			<?php
			return ob_get_clean();
		}
	}
}