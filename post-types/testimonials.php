<?php

// Testimonials post type
if ( ! function_exists( 'lawyer_register_testimonials_post_type' ) ) {
	function lawyer_register_testimonials_post_type() { 
		// New Post Type
		register_post_type( 'testimonials',
			array(
				'labels' => array(
					'name' => esc_html__( 'Testimonials', 'lawyer-plugin' ),
					'singular_name' => esc_html__( 'Testimonial', 'lawyer-plugin' )
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
				'label' 	   => esc_html__( 'Categories', 'lawyer-plugin' ),
				'rewrite' 	   => array( 
					'slug' => 'testimonials-category' 
				),
				'hierarchical' => false,
			)
		);
	}
}
add_action('init', 'lawyer_register_testimonials_post_type', 8 );