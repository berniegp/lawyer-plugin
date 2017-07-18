<?php

// Locations post type
if ( ! function_exists( 'lawyer_register_gallery_post_type' ) ) {
	function lawyer_register_gallery_post_type() { 
		// New Post Type
		register_post_type( 'gallery',
			array(
				'labels' => array(
					'name' => __( 'Gallery', 'lawyer' ),
					'singular_name' => __( 'Gallery', 'lawyer' )
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
				'label' 	   => __( 'Categories' ),
				'rewrite' 	   => array( 
					'slug' => 'gallery-category' 
				),
				'hierarchical' => false,
			)
		);
	}
}
add_action('init', 'lawyer_register_gallery_post_type', 8 );