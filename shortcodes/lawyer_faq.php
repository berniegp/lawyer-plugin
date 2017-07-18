<?php 
/* FAQ Shortcode */

vc_map(
	array(
		'name'        => __( 'FAQ', 'js_composer' ),
		'base'        => 'lawyer_faq',
		'params'      => array(
			array(
				'type'       => 'param_group',
				'heading'    => __( 'Items', 'js_composer' ),
				'param_name' => 'items',
				'params'     => array(
					array(
						'type' 		  => 'textfield',
						'heading' 	  => __( 'Question', 'js_composer' ),
						'param_name'  => 'question'
					),
					array(
						'type' 		  => 'textarea',
						'heading' 	  => __( 'Answer', 'js_composer' ),
						'param_name'  => 'answer'
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

class WPBakeryShortCode_lawyer_faq extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'items' 		=> '',
			'el_class' 		=> '',
			'css' 			=> ''
		), $atts ) );

		$items = json_decode( urldecode( $items ), true );

		if( ! empty( $items ) ) {

			$class  = ( ! empty( $el_class ) ) ? $el_class : '';
			$class .= vc_shortcode_custom_css_class( $css, ' ' );

			ob_start(); ?>

				<div class="faq-items <?php echo $class; ?>">
					<?php foreach ( $items as $item ) { ?>
						<?php if ( ! empty( $item['question'] ) && ! empty( $item['answer'] ) ) { ?>
							<div class="faq-item">
								<div class="faq-item__question">
									<span class="faq-item__letter">Q</span>
									<h4><?php echo esc_html( $item['question'] ); ?></h4>
								</div>
								<div class="faq-item__answer">
									<span class="faq-item__letter faq-item__letter--red">A</span>
									<p><?php  echo esc_html( $item['answer'] ); ?></p>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				</div>

			<?php
			return ob_get_clean();			
		}
	}
}