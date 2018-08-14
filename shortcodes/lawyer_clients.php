<?php
/* Clients Shortcode */

vc_map(
	array(
		'name'        => esc_html__( 'Clients', 'js_composer' ),
		'base'        => 'lawyer_clients',
		'params'      => array(
			array(
				'type'        => 'dropdown',
				'heading' 	  => 'Number of items per row',
				'param_name'  => 'number_items',
				'value' 	  => array(
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6'
				),
				'admin_label' => true,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Timeout speed', 'js_composer' ),
				'param_name'  => 'timeout_speed',
				'value' 	  => '5000',
				'admin_label' => true,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Slide speed', 'js_composer' ),
				'param_name'  => 'slide_speed',
				'value' 	  => '300',
				'admin_label' => true,
			),

			array(
				'type'       => 'param_group',
				'heading'    => esc_html__( 'Items', 'js_composer' ),
				'param_name' => 'items',
				'params'     => array(
					array(
						'type'        => 'attach_image',
						'heading'     => esc_html__( 'Client Logo', 'js_composer' ),
						'param_name'  => 'client_logo',
					),
					array(
						'type'        => 'vc_link',
						'heading'     => esc_html__( 'Client url', 'js_composer' ),
						'param_name'  => 'client_url',
					),
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


class WPBakeryShortCode_lawyer_clients extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'number_items'  => '3',
			'timeout_speed' => '5000',
			'slide_speed'   => '300',
			'items'         => '',
			'el_class'      => '',
			'css' 	        => ''
		), $atts ) );

		$items = json_decode( urldecode( $items ), true );
		if ( ! empty( $items ) ) {
			$class  = ( ! empty( $el_class ) ) ? $el_class : '';
			$class .= vc_shortcode_custom_css_class( $css, ' ' );

			ob_start(); ?>

			<div class="swiper-container client-item-slider <?php echo esc_attr( $class );?>" data-slides-per-view="<?php echo esc_attr( $number_items ); ?>" data-loop="true" data-autoplay="<?php echo esc_attr( $timeout_speed ); ?>" data-speed="<?php echo esc_attr( $slide_speed ); ?>" data-space-between="20" data-md-slides="3,20" data-sm-slides="2,20" data-xs-slides="1,20">
				<div class="swiper-wrapper">
					<?php foreach ( $items as $item ) {
						if( ! empty( $item['client_logo'] ) && ! empty( $item['client_url'] ) ) {
							$link = vc_build_link( $item['client_url'] ); ?>
							<div class="swiper-slide client-item">
								<a href="<?php echo esc_url( $link['url'] );?>" target="<?php if ( ! empty ( $link['target'] ) ) : ?><?php echo esc_attr( $link['target'] );?><?php endif ?>">
									<img src="<?php echo esc_url( wp_get_attachment_image_url( $item['client_logo'] ) ); ?>" alt="">
								</a>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
			<?php
			return ob_get_clean();
		}
	}
}