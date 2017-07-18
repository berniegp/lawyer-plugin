<?php 
/* CTA Shortcode */

vc_map(
	array(
		'name'        => __( 'Call to action', 'js_composer' ),
		'base'        => 'lawyer_cta',
		'params'      => array(

			array(
				'type' 		  => 'textfield',
				'heading' 	  => __( 'Title', 'js_composer' ),
				'param_name'  => 'title'
			),
			array(
				'type'        => 'vc_link',
				'heading'     => __( 'Button', 'js_composer' ),
				'param_name'  => 'button'
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

class WPBakeryShortCode_lawyer_cta extends WPBakeryShortCode{
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

				<div class="get-a-quote <?php echo $class; ?>">
					<div class="row align-center">
						<div class="column small-12 medium-expand">
							<?php if ( ! empty( $title ) ): ?>
								<h3 class="get-a-quote__text"><?php echo esc_html( $title ); ?></h3>
							<?php endif ?>
						</div>
						<div class="column small-12 shrink">
							<?php if( ! empty( $button ) ) {
								$button_text = ! empty( $btn['title'] ) ? $btn['title'] : 'Get a Quote';
								$button_target = ( ! empty( $btn['target'] ) ) ? 'target="' . $btn['target'] . '"' : '';
								$button_url = ( ! empty( $btn['url'] ) ) ? $btn['url'] : '#';
							 	?>
								<a href="<?php echo esc_url( $button_url ); ?>" <?php echo $button_target; ?> class="btn get-a-quote__link"><?php echo esc_html( $button_text ); ?></a>
							<?php } ?>
						</div>
					</div>
				</div>

			<?php
			return ob_get_clean();			
		}
	}
}

