<?php 
/*
 * Gallery Shortcode
 */

vc_map( array(
	'name'            => __( 'Gallery', 'js_composer' ),
	'base'            => 'lawyer_portfolio',
	'params'          => array(
		array(
			'type'        => 'vc_efa_chosen',
			'heading'     => __( 'Custom Categories', 'js_composer' ),
			'param_name'  => 'categories',
			'placeholder' => 'Choose category (optional)',
			'value'       => lawyer_param_values( 'terms', array( 'taxonomies' => 'gallery-category' ) ),
			'std'         => '',
			'admin_label' => true,
			'description' => __( 'You can choose spesific categories for gallery, default is all categories', 'js_composer' ),
		),
		array(
			'type' 		  => 'dropdown',
			'heading' 	  => 'Filter',
			'param_name'  => 'filter',
			'value' 	  => array(
				'Show' => 'show',
				'Hide' => 'hide'
			)
		),
		array(
			'type' 		  => 'dropdown',
			'heading' 	  => 'Order by',
			'param_name'  => 'orderby',
			'admin_label' => true,
			'value' 	  => array(
				'ID' 		    => 'ID',
				'Author' 	    => 'author',
				'Post Title'    => 'title',
				'Date' 		    => 'date',
				'Last Modified' => 'modified',
				'Random Order'  => 'rand',
				'Menu Order'    => 'menu_order'
			)
		),		
		array(
			'type' 		  => 'dropdown',
			'heading' 	  => 'Order type',
			'param_name'  => 'order',
			'value' 	  => array(
				'Ascending'  => 'ASC',
				'Descending' => 'DESC'
			)
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Count items', 'js_composer' ),
			'param_name'  => 'limit',
			'value'       => '',
			'admin_label' => true,
			'description' => __( 'Default 6 items.', 'js_composer' )
		),
		array(
			'type' 		  => 'dropdown',
			'heading' 	  => 'Style',
			'param_name'  => 'style',
			'admin_label' => true,
			'value' 	  => array(
				'Style 1'  => 'style1',
				'Style 2'  => 'style2',
				'Style 3'  => 'style3',
				'Style 4'  => 'style4',
			)
		),
		/* Portfolio style */
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
));




class WPBakeryShortCode_lawyer_portfolio extends WPBakeryShortCode{



	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'categories' => '',
			'filter' 	 => 'show',
			'orderby' 	 => 'ID',
			'order' 	 => 'ASC',
			'limit' 	 => '',
			'style' 	 => 'style1',
			'el_class' 	 => '',
			'css' 		 => ''
		), $atts ) );

		$class  = ( ! empty( $el_class ) ) ? $el_class : '';
		$class .= vc_shortcode_custom_css_class( $css, ' ' );

		$limit = ( ! empty( $limit ) && is_numeric( $limit ) ) ? $limit : 6;
		
		$container_class = array(
			'style1' => 'isotope-container',
			'style2' => 'isotope-container isotope-container--4cols',
			'style3' => 'isotope-container',
			'style4' => 'isotope-container isotope-container--4cols'
		);

		// get $categories
		if ( empty( $categories ) ){
			// get all category potfolio
			$categories = array();
			$terms = get_terms( 'gallery-category', 'orderby=name&hide_empty=0');
			foreach($terms as $term){
				$categories[] = $term->slug;
			}
		} else {
			$categories = explode( ',', $categories );
		}

		// params output
		$args = array(
			'posts_per_page' => $limit,
			'post_type'   	 => 'gallery',
			'orderby'   	 => $orderby,
			'order'   		 => $order,
			'tax_query' 	 => array(
				array(
					'taxonomy'  => 'gallery-category',
					'field'     => 'slug',
					'terms'     => $categories
				)
			)
		);

		// get portfolio posts
		$gallery = new WP_Query( $args );

		if ( $gallery->have_posts() ) {
			ob_start(); ?>

			<div class="gallery-container <?php echo $class; ?>">
				<?php if ( $filter == 'show' ): ?>
					<!-- Gallery filter -->
					<div class="filter-wrap align-center">
						<button class="btn-filter active" data-filter="*"><?php esc_html_e( 'View all', 'lawyer' ); ?></button>
						<?php foreach ( $categories as $category_slug ) { 
							$category = get_term_by('slug', $category_slug, 'gallery-category'); ?>
							<button class="btn-filter" data-filter=".isf-year-<?php echo esc_html( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></button>
						<?php } ?>
					</div>
				<?php endif ?>


				<div class="<?php echo $container_class[ $style ]; ?>">
					<div class="grid-sizer"></div>
					<div class="gutter-sizer"></div>

					<?php while ( $gallery->have_posts() ) : 
						$gallery->the_post();

						if ( has_post_thumbnail() ) {
						
							$terms = get_the_terms( get_the_ID() , 'gallery-category' );
							$item_class = '';
							foreach ( $terms as $term ) {
								$item_class .= ' isf-year-' . $term->slug;
							} 

							$img_url = get_the_post_thumbnail_url();

							switch ( $style ) {
								case 'style1': ?>
									<div class="gallery-item <?php echo $item_class; ?>">
										<a href="<?php echo $img_url; ?>">
											<figure class="effect-apollo">
												<img src="<?php echo $img_url; ?>" alt="">
												<div class="effect-apollo__overlay"></div>
											</figure>
											<?php the_title( '<h4 class="gallery-item__title">', '</h4>' ); ?>
										</a>
									</div>
									<?php
									break;
								case 'style2': ?>
									<div class="gallery-item <?php echo $item_class; ?>">
										<a href="<?php echo $img_url; ?>">
											<figure class="effect-apollo">
												<img src="<?php echo $img_url; ?>" alt="">
												<div class="effect-apollo__overlay"></div>
											</figure>
											<?php the_title( '<h4 class="gallery-item__title">', '</h4>' ); ?>
										</a>
									</div>
									<?php
									break;
								case 'style3': ?>
									<figure class="gallery-item effect-bubba <?php echo $item_class; ?>">
										<a href="<?php echo $img_url; ?>">
											<div class="gallery-item__img">
												<img src="<?php echo $img_url; ?>" alt="" class="s-img-switch">
											</div>
											<figcaption>
												<?php the_title( '<h3 class="gallery-item__title">', '</h3>' ); ?>
											</figcaption>
										</a>
									</figure>
									<?php
									break;
								case 'style4': ?>
									<figure class="gallery-item effect-bubba <?php echo $item_class; ?>">
										<a href="<?php echo $img_url; ?>">
											<div class="gallery-item__img">
												<img src="<?php echo $img_url; ?>" alt="" class="s-img-switch">
											</div>
											<figcaption>
												<?php the_title( '<h3 class="gallery-item__title">', '</h3>' ); ?>
											</figcaption>
										</a>
									</figure>
									<?php
									break;
								
							}
						}

					endwhile;
					wp_reset_postdata(); ?>



				</div>
			</div>


			<?php return ob_get_clean();
		}		
	}	
}