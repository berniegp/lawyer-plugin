<?php 
/* Breadcrumbs Shortcode */

vc_map(
	array(
		'name'        => __( 'Breadcrumbs', 'js_composer' ),
		'base'        => 'lawyer_breadcrumbs',
		'icon'        => 'fp-shortcode-breadcrumbs',
		'params'      => array(
			array(
				'type'       => 'param_group',
				'heading'    => __( 'Items', 'js_composer' ),
				'param_name' => 'items',
				'params'     => array(
					array(
						'type' 		  => 'textfield',
						'heading' 	  => __( 'Title', 'js_composer' ),
						'param_name'  => 'title',
						'value' 	  => ''
					),
					array(
						'type' 		  => 'textfield',
						'heading' 	  => __( 'URL', 'js_composer' ),
						'param_name'  => 'url',
						'value' 	  => ''
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

class WPBakeryShortCode_lawyer_breadcrumbs extends WPBakeryShortCode{
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

				<div class="b-breadcrumbs <?php echo $class; ?>">
					<?php foreach ( $items as $item ) { ?>
						<?php if ( ! empty( $item['url'] ) && ! empty( $item['title'] ) ) { ?>

							<a href="<?php echo esc_url( $item['url'] ) ?>" class="b-breadcrumbs__link"><?php echo esc_html( $item['title'] ); ?></a>

						<?php } else { ?>

							<?php if ( ! empty( $item['title'] ) ): ?>
				
								<span class="b-breadcrumbs__link"><?php echo esc_html( $item['title'] ); ?></span>

							<?php endif ?>

						<?php } ?>
					<?php } ?>
				</div>

			<?php
			return ob_get_clean();			
		}
	}
}