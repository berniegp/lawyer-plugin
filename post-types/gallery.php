<?php

// Locations post type
if ( ! function_exists( 'lawyer_register_gallery_post_type' ) ) {
	function lawyer_register_gallery_post_type() { 
		// New Post Type
		register_post_type( 'gallery',
			array(
				'labels' => array(
					'name' => esc_html__( 'Gallery', 'lawyer-plugin' ),
					'singular_name' => esc_html__( 'Gallery', 'lawyer-plugin' )
				),
				'menu_icon'   		 => 'dashicons-format-gallery',
				'public' 	  		 => true,
				'publicly_queryable' => false,
				'supports'    		 => array( 'title', 'thumbnail' ),
				'has_archive' 		 => true,
				'rewrite'     		 => array('slug' => 'gallery'),
			)
		);

		// Post type taxonomy
		register_taxonomy(
			'gallery-category',
			'gallery',
			array(
				'label' 	   => esc_html__( 'Categories', 'lawyer-plugin' ),
				'rewrite' 	   => array( 
					'slug' => 'gallery-category' 
				),
				'hierarchical' => false,
			)
		);
	}
}
add_action('init', 'lawyer_register_gallery_post_type', 8 );