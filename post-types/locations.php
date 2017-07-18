<?php

// Locations post type
if ( ! function_exists( 'lawyer_register_locations_post_type' ) ) {
	function lawyer_register_locations_post_type() { 
		// New Post Type
		register_post_type( 'locations',
			array(
				'labels' => array(
					'name' => __( 'Locations', 'lawyer' ),
					'singular_name' => __( 'Location', 'lawyer' )
				),
				'menu_icon'   		 => 'dashicons-location-alt',
				'public' 	  		 => true,
				// 'publicly_queryable' => false,
				'supports'    		 => array( 'title', 'editor' ),
				'has_archive' 		 => true,
				'rewrite'     		 => array('slug' => 'locations'),
			)
		);

		// Post type taxonomy
		register_taxonomy(
			'locations-category',
			'locations',
			array(
				'label' 	   => __( 'Categories' ),
				'rewrite' 	   => array( 
					'slug' => 'locations-category' 
				),
				'hierarchical' => false,
			)
		);
	}
}
add_action('init', 'lawyer_register_locations_post_type', 8 );