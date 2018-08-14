<?php
/* Contacts Shortcode */

vc_map(
	array(
		'name'        => esc_html__( 'Contacts', 'js_composer' ),
		'base'        => 'lawyer_contacts',
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Address', 'js_composer' ),
				'param_name'  => 'address'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'City', 'js_composer' ),
				'param_name'  => 'city'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Region', 'js_composer' ),
				'param_name'  => 'region'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Postal Code', 'js_composer' ),
				'param_name'  => 'code'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Country', 'js_composer' ),
				'param_name'  => 'country'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Phone', 'js_composer' ),
				'param_name'  => 'phone'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Fax', 'js_composer' ),
				'param_name'  => 'fax'
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Email', 'js_composer' ),
				'param_name'  => 'email'
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Show labels', 'js_composer' ),
				'param_name'  => 'labels'
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

class WPBakeryShortCode_lawyer_contacts extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'address'   => '',
			'city'      => '',
			'region'    => '',
			'code'      => '',
			'country'   => '',
			'phone'     => '',
			'fax'       => '',
			'email'     => '',
			'labels'    => 'false',
			'el_class'  => '',
			'css' 	    => ''
		), $atts ) );

		$class  = ( ! empty( $el_class ) ) ? $el_class : '';
		$class .= vc_shortcode_custom_css_class( $css, ' ' );

		ob_start();
		if ( $labels != 'true' ) { ?>
			<div class="<?php echo esc_attr( $class ); ?>">
				<div class="widget widget-address">
					<?php if ( ! empty( $address ) ) : ?>
						<p class="widget-address__text"><?php echo esc_html( $address ); ?>
							<br> <?php echo esc_html( $city ); ?> <?php echo esc_html( $code ); ?>, <?php echo esc_html( $country ); ?>
						</p>
					<?php endif; ?>

					<?php if ( ! empty( $phone ) ) : ?>
						<p class="widget-address__info icon-phone-3"><?php echo esc_html( $phone ); ?></p>
					<?php endif; ?>

					<?php if ( ! empty( $fax ) ) : ?>
						<p class="widget-address__info icon-fax"><?php echo esc_html( $fax ); ?></p>
					<?php endif; ?>

					<?php if ( ! empty( $email ) ) : ?>
						<p class="widget-address__info icon-mail-3">
							<a class="widget-address__link" href="mailto:<?php echo esc_html( $email ); ?>"><?php echo esc_html( $email ); ?></a>
						</p>
					<?php endif; ?>
				</div>
			</div>
		<?php } else { ?>
			<div class="<?php echo esc_attr( $class ); ?>">
				<?php if ( ! empty( $title ) ) : ?> 
					<h4><?php echo esc_html( $title ); ?></h4>
				<?php endif; ?>
				<div class="widget widget-address">
					<?php if ( ! empty( $address ) ) : ?>
						<p class="widget-address__text"><?php esc_html_e( 'Address:', 'lawyer-plugin' ); ?> <?php echo esc_html( $address ); ?>
							<br> <?php echo esc_html( $city ); ?> <?php echo esc_html( $code ); ?>, <?php echo esc_html( $country ); ?>
						</p>
					<?php endif; ?>

					<?php if ( ! empty( $phone ) ) : ?>
						<p class="widget-address__info icon-phone-3"><?php esc_html_e( 'Phone:', 'lawyer-plugin' ); ?> <?php echo esc_html( $phone ); ?></p>
					<?php endif; ?>

					<?php if ( ! empty( $fax ) ) : ?>
						<p class="widget-address__info icon-fax"><?php esc_html_e( 'Fax:', 'lawyer-plugin' ); ?> <?php echo esc_html( $fax ); ?></p>
					<?php endif; ?>

					<?php if ( ! empty( $email ) ) : ?>
						<p class="widget-address__info icon-mail-3"><?php esc_html_e( 'Email:', 'lawyer-plugin' ); ?>
							<a class="widget-address__link" href="mailto:<?php echo esc_html( $email ); ?>"><?php echo esc_html( $email ); ?></a>
						</p>
					<?php endif; ?>
				</div>
			</div>
		<?php }
		return ob_get_clean();
	}
}