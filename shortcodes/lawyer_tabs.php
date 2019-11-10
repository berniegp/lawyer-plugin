<?php 
/* Tabs Shortcode */

vc_map(
	array(
		'name'               => esc_html__( 'Tabs', 'js_composer' ),
		'base'               => 'lawyer_tabs',
		'as_parent' 	     => array( 'only' => 'lawyer_tabs_item' ),
		'content_element'    => true,
		'show_settings_on_create' => false,
		'js_view'    			  => 'VcColumnView',
		'params'             => array(
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

class WPBakeryShortCode_lawyer_tabs extends WPBakeryShortCodesContainer{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'el_class'  => '',
			'css' 	    => ''
		), $atts ) );

		global $lawyer_tabs_item;
		do_shortcode( $content );

		ob_start();
		if ( ! empty( $lawyer_tabs_item ) ){
			$class  = ( ! empty( $el_class ) ) ? $el_class : '';
			$class .= vc_shortcode_custom_css_class( $css, ' ' );

			$tabs_title = '';
			$tabs_content = '';
			$counter = 0;
			
			foreach ( $lawyer_tabs_item as $item ) {
				if ( ! empty( $item['atts']['title'] ) && ! empty( $item['content'] ) ) {

					$active = $counter == 0 ? 'active' : '';

					$tabs_title .= '<li class="' . $active . ' "><a href="#">' . $item['atts']['title'] . '</a></li>';
					$tabs_content .= '<div class="tabs-item ' . $active . '">' . $item['content'] . '</div>';
					$counter++;
				}
			} ?>
			<div class="tabs <?php echo esc_attr( $class );?>">
				<div class="tabs-header">
					<ul>
						<?php echo wp_kses_post( $tabs_title ); ?>
					</ul>
				</div>
				<div class="tabs-content">
					<?php echo wpautop ( wp_kses_post( $tabs_content ) ); ?>
				</div>
			</div>
		<?php
		}
		return ob_get_clean();
	}
}

vc_map(
	array(
		'name'            => 'Tabs item',
		'base'            => 'lawyer_tabs_item',
		'as_child' 		  => array( 'only' => 'lawyer_tabs' ),
		'content_element' => true,
		'params'          => array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Title', 'js_composer' ),
				'param_name'  => 'title'
			),
			array(
				'type' 		  => 'textarea_html',
				'heading'     => esc_html__( 'Content', 'js_composer' ),
				'param_name'  => 'content'
			),
		)
	)
);

class WPBakeryShortCode_lawyer_tabs_item extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {
		global $lawyer_tabs_item;
		$lawyer_tabs_item[] = array( 'atts' => $atts, 'content' => $content);
		return;
	}
}