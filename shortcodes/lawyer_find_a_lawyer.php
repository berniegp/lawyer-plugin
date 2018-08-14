<?php 
/* Find a lawyer Shortcode */

vc_map(
	array(
		'name'        => esc_html__( 'Find a lawyer', 'js_composer' ),
		'base'        => 'lawyer_find_a_lawyer',
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Title', 'js_composer' ),
				'param_name'  => 'title'
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Show name', 'js_composer' ),
				'param_name'  => 'show_name'
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Show areas', 'js_composer' ),
				'param_name'  => 'show_areas'
			),
			array(
				'type'        => 'checkbox',
				'heading'     => esc_html__( 'Show offices', 'js_composer' ),
				'param_name'  => 'show_offices'
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

class WPBakeryShortCode_lawyer_find_a_lawyer extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'title' 	  => '',
			'show_name'   => '',
			'show_areas'  => '',
			'show_offices'=> '',
			'el_class'    => '',
			'css' 	      => ''
		), $atts ) );

		$class  = ( ! empty( $el_class ) ) ? $el_class : '';
		$class .= vc_shortcode_custom_css_class( $css, ' ' );

		ob_start();
		?>

		<section class="widget widget-find-lawyer <?php echo esc_attr( $class ); ?>">
			<?php if ( ! empty( $title ) ) { ?>
				<h3 class="block-title"><?php  echo esc_html( $title ); ?></h3>
			<?php } ?>
			<form class="search-form" method="get" action="<?php echo home_url( '/' ); ?>">
				<?php if ( $show_name ): ?>
					<label><?php esc_html_e( 'Name', 'lawyer-plugin' ); ?></label>
					<input type="text" name="s" value="">
				<?php endif ?>

				<?php if ( $show_areas ):
					$practices = get_terms( 
							array(
								'taxonomy'   => 'practice',
								'hide_empty' => false,
							) 
					); ?>

					<label><?php esc_html_e( 'Areas of Practice', 'lawyer-plugin' ); ?></label>
					<select name="legal">
						<option disabled selected value="">&nbsp;</option>
						<?php if ( ! empty( $practices ) ): ?>
							<?php foreach ( $practices as $key => $practice ) { ?>
								<option value="<?php echo $practice->slug; ?>"><?php echo $practice->name; ?></option>
							<?php } ?>
						<?php endif ?>
					</select>
				<?php endif ?>

				<?php if ( $show_offices ):
					$offices_args = array('post_type' => 'locations', 'posts_per_page' => -1 );
					$offices = lawyer_param_values('posts', $offices_args, true, false); ?>

					<label><?php esc_html_e( 'Offices', 'lawyer-plugin' ); ?></label>
					<select name="office">
						<option disabled selected value="">&nbsp;</option>
						<?php if ( ! empty( $offices ) ): ?>
							<?php foreach ( $offices as $key => $office ) { ?>
								<option value="<?php echo $key; ?>"><?php echo $office; ?></option>
							<?php } ?>
						<?php endif ?>
					</select>
				<?php endif ?>
				<input type="hidden" name="post_type" value="people">
				<button class="btn btn--small search-form__submit" type="submit"><?php esc_html_e( 'Search', 'lawyer-plugin' ); ?></button>

			</form>
		</section>
		<?php
		return ob_get_clean();
	}
}