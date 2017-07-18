<?php 
/* Video Shortcode */

vc_map(
	array(
		'name'        => __( 'Video', 'js_composer' ),
		'base'        => 'lawyer_video',
		'icon'        => 'fp-shortcode-video',
		'params'      => array(
			array(
				'type'        => 'attach_image',
				'heading'     => __( 'Background image', 'js_composer' ),
				'param_name'  => 'image'
			),
			array(
				'type' 		  => 'textfield',
				'heading'     => __( 'Youtube video ID', 'js_composer' ),
				'param_name'  => 'video',
				'value' 	  => ''
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

class WPBakeryShortCode_lawyer_video extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'image'    => '',
			'video'    => '',
			'el_class' => '',
			'css'	   => ''
		), $atts ) );

		if( ! empty( $video ) && ! empty( $image ) && is_numeric( $image ) ) {

			$class  = ( ! empty( $el_class ) ) ? $el_class : '';
			$class .= vc_shortcode_custom_css_class( $css, ' ' );

			$src = wp_get_attachment_image_url( $image, 'full' );
			
			ob_start(); ?>
				<div class="video-banner">
					<img src="<?php echo $src; ?>" alt="" class="s-img-switch">
					<button class="play-btn">
						<svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" class="play-btn__svg">
							<g transform="translate(2.000000, 2.000000)" fill="transparent">
								<path d="M20,10 C20,4.4775 15.5228125,0 10,0 C4.4771875,0 0,4.4775 0,10 C0,15.5228125 4.4771875,20 10,20 C15.5228125,20 20,15.5228125 20,10"></path>
								<path d="M7.428625,6.04975 C7.428625,5.71525 7.795,5.50975 8.08075,5.684125 L14.54425,9.634375 C14.818,9.80125 14.818,10.198375 14.54425,10.365625 L8.08075,14.315875 C7.795,14.49025 7.428625,14.28475 7.428625,13.95025 L7.428625,6.04975 Z" fill="#fff" class="style-scope iron-icon"></path>
							</g>
						</svg>
					</button>
					<div class="video-popup">
						<span class="close-btn"></span>
						<iframe width="1200" height="675" src="about:blank" data-src="https://www.youtube.com/embed/<?php echo $video; ?>?rel=0&amp;autoplay=1&amp;controls=0&amp;loop=1&amp;showinfo=0"></iframe>
					</div>
				</div>
			<?php
			return ob_get_clean();
		}
	}
}