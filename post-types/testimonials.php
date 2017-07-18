<?php

// Testimonials post type
if ( ! function_exists( 'lawyer_register_testimonials_post_type' ) ) {
	function lawyer_register_testimonials_post_type() { 
		// New Post Type
		register_post_type( 'testimonials',
			array(
				'labels' => array(
					'name' => __( 'Testimonials', 'lawyer' ),
					'singular_name' => __( 'Testimonial', 'lawyer' )
				),
				'menu_icon'   		 => 'dashicons-format-chat',
				'public' 	  		 => true,
				'publicly_queryable' => false,
				'supports'    		 => array( 'title', 'editor', 'thumbnail' ),
				'has_archive' 		 => true,
				'rewrite'     		 => array('slug' => 'testimonials'),
			)
		);

		// Post type taxonomy
		register_taxonomy(
			'testimonials-category',
			'testimonials',
			array(
				'label' 	   => __( 'Categories' ),
				'rewrite' 	   => array( 
					'slug' => 'testimonials-category' 
				),
				'hierarchical' => false,
			)
		);
	}
}
add_action('init', 'lawyer_register_testimonials_post_type', 8 );