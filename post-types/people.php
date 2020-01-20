<?php

// People post type
if ( ! function_exists( 'lawyer_register_people_post_type' ) ) {
	function lawyer_register_people_post_type() { 
		// New Post Type
		register_post_type( 'people',
			array(
				'labels' => array(
					'name' => esc_html__( 'People', 'lawyer-plugin' ),
					'singular_name' => esc_html__( 'People', 'lawyer-plugin' )
				),
				'menu_icon'   		 => 'dashicons-groups',
				'public' 	  		 => true,
				'supports'    		 => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
				'has_archive' 		 => true,
				'rewrite'     		 => array('slug' => 'people'),
			)
		);

		// Post type taxonomy
		register_taxonomy(
			'practice',
			'people',
			array(
				'label' 	   => esc_html__( 'Practice areas', 'lawyer-plugin' ),
				'rewrite' 	   => array( 
					'slug' => 'practice' 
				),
				'hierarchical' => false,
				'labels' 	   => array(
					'add_new_item' => 'Add New Practice area',
				)
			)
		);
		// Post type taxonomy
		register_taxonomy(
			'languages',
			'people',
			array(
				'label' 	   => esc_html__( 'Languages', 'lawyer-plugin' ),
				'rewrite' 	   => array( 
					'slug' => 'languages' 
				),
				'hierarchical' => false,
			)
		);
		// Post type taxonomy
		register_taxonomy(
			'sectors',
			'people',
			array(
				'label' 	   => esc_html__( 'Sectors', 'lawyer-plugin' ),
				'rewrite' 	   => array( 
					'slug' => 'sectors' 
				),
				'hierarchical' => false,
			)
		);
	}
}
add_action('init', 'lawyer_register_people_post_type', 8 );