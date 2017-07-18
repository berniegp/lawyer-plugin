<?php
/* Title Shortcode */

vc_map(
	array(
		'name'        => __( 'Title', 'js_composer' ),
		'base'        => 'lawyer_title',
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => __( 'Title', 'js_composer' ),
				'param_name'  => 'title',
				'admin_label' => true
			),
			array(
				'type'        => 'dropdown',
				'heading' 	  => 'Title tag',
				'param_name'  => 'tag',
				'value' 	  => array(
					'H1' 	=> 'h1',
					'H2'    => 'h2',
					'H3'    => 'h3',
					'H4'    => 'h4',
					'H5'    => 'h5',
					'H6'    => 'h6'
				)
			),
			array(
				'type'        => 'dropdown',
				'heading' 	  => 'Align',
				'param_name'  => 'align',
				'value' 	  => array(
					'Left' 	 => 'text-left',
					'Right'  => 'text-right',
					'Center' => 'text-center'
				)
			),
			array(
				'type'        => 'dropdown',
				'heading' 	  => 'Style',
				'param_name'  => 'style',
				'value' 	  => array(
					'Widget'           => 'widget-title',
					'Banner'           => 'banner-title',
					'Block'            => 'block-title',
					'Honors Awards'    => 'honors-awards__title',
					'Page Heading'     => 'page-heading__title',
					'Contacts Section' => 'contacts-section__title',
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

class WPBakeryShortCode_lawyer_title extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'title'     => '',
			'tag'     	=> 'h1',
			'align'     => 'text-left',
			'style'		=> 'widget-title',
			'el_class'  => '',
			'css' 	    => ''
		), $atts ) );

		if ( ! empty( $title ) ) {

			$class  = ( ! empty( $el_class ) ) ? $el_class : '';
			$class .= vc_shortcode_custom_css_class( $css, ' ' );
			$class .= ' ' . $align . ' ' . $style;

			ob_start(); ?>
				<<?php echo $tag; ?> class="<?php echo esc_attr( $class ); ?>">
					<?php  echo esc_html( $title ); ?>
				</<?php echo $tag; ?>>
			<?php
			return ob_get_clean();
		}
	}
}

