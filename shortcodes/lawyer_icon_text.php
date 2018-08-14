<?php
/*
 * Icon and text Shortcode 
 */

vc_map(
	array(
		'name'        => esc_html__( 'Icon and Text', 'js_composer' ),
		'base'        => 'lawyer_icon_text',
		'params'      => array(
			array(
				'type'        => 'dropdown',
				'heading' 	  => 'Style',
				'param_name'  => 'style',
				'value' 	  => array(
					'Style 1' => 'style1',
					'Style 2' => 'style2',
					// 'Style 3' => 'style3',
				),
				'admin_label' => true,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Title', 'js_composer' ),
				'param_name'  => 'title',
                'admin_label' => true,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Subtitle', 'js_composer' ),
				'param_name'  => 'subtitle',
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Link URL', 'js_composer' ),
				'param_name'  => 'url',
				'dependency'  => array( 'element' => 'style', 'value' => 'style1' )
			),
			array(
				'type'        => 'iconpicker',
				'heading'     => esc_html__( 'Icon', 'js_composer' ),
				'param_name'  => 'icon',
				'value'       => 'icon-adjustments',
				'settings'       => array(
					'emptyIcon'    => false,
					'type'         => 'flaticon',
					'source'       => lawyer_fontello_icons( true ),
					'iconsPerPage' => 4000,
				),
				// 'dependency'  => array( 'element' => 'icon_type', 'value' => 'ticon' ),
				'description' => esc_html__( 'Select icon from library.', 'js_composer' ),
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


class WPBakeryShortCode_lawyer_icon_text extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'style'    => 'style1',
			'title'    => '',
			'subtitle' => '',
			'url'      => '',
			'icon'     => '',
			'el_class' => '',
			'css' 	   => ''
		), $atts ) );

		$class  = ( ! empty( $el_class ) ) ? $el_class : '';
		$class .= vc_shortcode_custom_css_class( $css, ' ' );


		ob_start(); 
		if ( $style == 'style1' ) {
			$link = ! empty( $url ) ? $url : '#';
			# code...
			?>
				<div class="services-links-row <?php echo esc_attr( $class );?>">
					<a href="<?php echo esc_url( $link ); ?>">
						<div class="services-links__column">
							<?php if ( ! empty( $icon ) ): ?>
								<i class="<?php echo $icon; ?>"></i>
							<?php endif ?>
							<?php if ( ! empty( $title ) || ! empty( $subtitle ) ): ?>
								<div class="services-links__item">
									<?php if ( ! empty( $title ) ): ?>
										<h2 class="services-links__title"><?php echo esc_html( $title ); ?></h2>
									<?php endif ?>
									<?php if ( ! empty( $subtitle ) ): ?>
										<p class="services-links__item-content"><?php echo esc_html( $subtitle ); ?></p>
									<?php endif ?>
								</div>
							<?php endif ?>
						</div>
					</a>
				</div>
			<?php
		} else { ?>
			<div class="about-section__column <?php echo esc_attr( $class );?>">
				<?php if ( ! empty( $icon ) ): ?>
					<i class="<?php echo $icon; ?>"></i>
				<?php endif ?>

				<?php if ( ! empty( $title ) || ! empty( $subtitle ) ): ?>
				<div class="about-section__item">
					<?php if ( ! empty( $title ) ): ?>
						<h3 class="about-section__title"><?php echo esc_html( $title ); ?></h3>
					<?php endif ?>
					<?php if ( ! empty( $subtitle ) ): ?>
						<p class="about-section__item-content"><?php echo esc_html( $subtitle ); ?></p>
					<?php endif ?>
				</div>
				<?php endif ?>
			</div>
		<?php }
		return ob_get_clean();
	}
}