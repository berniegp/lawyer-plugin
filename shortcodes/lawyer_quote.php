<?php
/* Quote text Shortcode */

vc_map(
	array(
		'name'        => __( 'Quote', 'js_composer' ),
		'base'        => 'lawyer_quote_text',
		'params'      => array(
			array(
				'type'        => 'dropdown',
				'heading' 	  => 'Style',
				'param_name'  => 'style',
				'value' 	  => array(
					'Style 1'  => 'style1',
					'Style 2'  => 'style2'
				)
			),

			array(
				'type'        => 'textarea',
				'heading'     => __( 'Quote text', 'js_composer' ),
				'param_name'  => 'quote'
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Quote author', 'js_composer' ),
				'param_name'  => 'author'
			),
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Author position', 'js_composer' ),
				'param_name'  => 'position'
			),
			array(
				'type'        => 'attach_image',
				'heading'     => __( 'Author Photo', 'js_composer' ),
				'param_name'  => 'image',
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


class WPBakeryShortCode_lawyer_quote_text extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'style'     => 'style1',
			'quote'     => '',
			'author'    => '',
			'position'  => '',
			'image'     => '',
			'el_class'  => '',
			'css' 	    => ''
		), $atts ) );

		$class  = ( ! empty( $el_class ) ) ? $el_class : '';
		$class .= vc_shortcode_custom_css_class( $css, ' ' );

		$img_url = ! empty( $image ) ? wp_get_attachment_image_url( $image ) : '';

		ob_start();
		if ( $style == 'style1' ) { ?>

			<div class="testimonial-item testimonial-item--style-2 <?php echo $class; ?>">
				<?php if ( ! empty( $quote ) ): ?>
					<blockquote class="blockquote blockquote--style-2"><?php echo esc_html( $quote ); ?></blockquote>
				<?php endif ?>
				<div class="blockquote-author">
					<?php if ( ! empty( $img_url ) ): ?>
						<img src="<?php echo esc_url( $img_url ); ?>" alt="" class="blockquote-author__photo">
					<?php endif ?>
					<div class="blockquote-author__info">
						<?php if ( ! empty( $author ) ): ?>
							<cite class="blockquote-author__name"><?php echo esc_html( $author ); ?></cite>
						<?php endif ?>

						<?php if ( ! empty( $position ) ): ?>
							<cite class="blockquote-author__position"><?php echo esc_html( $position ); ?></cite>
						<?php endif ?>
					</div>
				</div>
			</div>

		<?php }
		if ( $style == 'style2' ) { ?>
			
			<div class="testimonial-item">
				<?php if ( ! empty( $quote ) ): ?>
					<blockquote class="blockquote blockquote--style-1 <?php echo $class; ?>"><?php echo esc_html( $quote ); ?></blockquote>
				<?php endif ?>
				<div class="blockquote-author">
					<?php if ( ! empty( $img_url ) ): ?>
						<img src="<?php echo esc_url( $img_url ); ?>" alt="" class="blockquote-author__photo">
					<?php endif ?>
					<div class="blockquote-author__info">
						<?php if ( ! empty( $author ) ): ?>
							<cite class="blockquote-author__name"><?php echo esc_html( $author ); ?></cite>
						<?php endif ?>
						<?php if ( ! empty( $author ) ): ?>
							<cite class="blockquote-author__position"><?php echo esc_html( $position ); ?></cite>
						<?php endif ?>
					</div>
				</div>
			</div>

		<?php } 
		return ob_get_clean();
	}
}