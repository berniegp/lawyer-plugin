<?php
/*
 * Banner Shortcode 
 */

vc_map(
	array(
		'name'        => esc_html__( 'Banner', 'js_composer' ),
		'base'        => 'lawyer_banner',
		'params'      => array(
			array(
				'type' 		  => 'dropdown',
				'heading' 	  => 'Style',
				'param_name'  => 'style',
				'value' 	  => array(
					'Style 1' 	=> 'style1',
					'Style 2' 	=> 'style2',
					'Style 3' 	=> 'style3',
					'Style 4' 	=> 'style4',
					'Style 5' 	=> 'style5',
				)
			),
			array(
				'type' 		  => 'textfield',
				'heading' 	  => esc_html__( 'Title', 'js_composer' ),
				'param_name'  => 'title',
				'dependency'  => array( 'element' => 'style', 'value' => array( 'style2', 'style3', 'style4', 'style5' ) )
			),
			array(
				'type'        => 'attach_image',
				'heading'     => esc_html__( 'Banner image', 'js_composer' ),
				'param_name'  => 'image',
				'dependency'  => array( 'element' => 'style', 'value' => array( 'style1', 'style2', 'style4', 'style5' ) )
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


class WPBakeryShortCode_lawyer_banner extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'style'    => 'style1',
			'title'    => '',
			'image'    => '',
			'el_class' => '',
			'css' 	   => ''
		), $atts ) );

		$class  = ( ! empty( $el_class ) ) ? $el_class : '';
		$class .= vc_shortcode_custom_css_class( $css, ' ' );

		$img_url = wp_get_attachment_image_url( $image, 'full' );
		ob_start();
		if ( $style == 'style1' && ! empty( $image ) ) { ?>

				<div class="slider-1 <?php echo esc_attr( $class );?>">
					<img src="<?php echo esc_url( $img_url ); ?>" alt="">
				</div>

			<?php
		} 
		if ( $style == 'style2' && ! empty( $image ) ) { ?>

			<div class="page-heading page-heading--height-3 overlay <?php echo esc_attr( $class );?>">
				<img class="s-img-switch" src="<?php echo esc_url( $img_url ); ?>" alt="" />
				<?php if ( ! empty( $title ) ): ?>
					<h2 class="page-heading__title"><?php echo esc_html( $title ); ?></h2>
				<?php endif ?>
			</div>

		<?php }
		if ( $style == 'style3' && ! empty( $title ) ) { ?>

			<div class="page-heading page-heading--no-img s-back-switch <?php echo esc_attr( $class );?>">
				<h2 class="page-heading__title"><?php echo esc_html( $title ); ?></h2>
			</div>

		<?php }
		if ( $style == 'style4' && ! empty( $image ) ) { ?>

			<div class="page-heading overlay <?php echo esc_attr( $class );?>">
				<img class="s-img-switch" src="<?php echo esc_url( $img_url ); ?>" alt="" />
				<?php if ( ! empty( $title ) ): ?>
					<h2 class="page-heading__title"><?php echo esc_html( $title ); ?></h2>
				<?php endif ?>
			</div>

		<?php }
		if ( $style == 'style5' && ! empty( $image ) ) { ?>

			<div class="page-heading page-heading--height-2 overlay <?php echo esc_attr( $class );?>">
				<img class="s-img-switch" src="<?php echo esc_url( $img_url ); ?>" alt="" />
				<?php if ( ! empty( $title ) ): ?>
					<h2 class="page-heading__title"><?php echo esc_html( $title ); ?></h2>
				<?php endif ?>
			</div>

		<?php }

		return ob_get_clean();
	}
}

