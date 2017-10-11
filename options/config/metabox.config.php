<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options      = array();

// -----------------------------------------
// Testimonials Metabox Options            -
// -----------------------------------------
$options[]    = array(
	'id'        => 'testimonial_options',
	'title'     => 'Testimonials Options',
	'post_type' => 'testimonials',
	'context'   => 'side',
	'priority'  => 'default',
	'sections'  => array(
		array(
			'name'   => 'section',
			'fields' => array(
				array(
					'id'    => 'position',
					'type'  => 'text',
					'title' => 'Position',
				)
			)
		)
	)
);
// -----------------------------------------
// People Metabox Options            	   -
// -----------------------------------------
$options[]    = array(
	'id'        => 'people_page_options',
	'title'     => 'People Page Options',
	'post_type' => 'people',
	'context'   => 'side',
	'priority'  => 'default',
	'sections'  => array(
		array(
			'name'   => 'section',
			'fields' => array(
				array(
					'id'    => 'heading',
					'type'  => 'switcher',
					'title' => 'Page heading',
				),
				array(
					'id'        => 'heading_background',
					'type'      => 'upload',
					'title'     => 'Background image',
					'settings'      => array(
						'upload_type'  => 'image',
						'button_title' => 'Upload',
						'frame_title'  => 'Select an image',
						'insert_title' => 'Use this image',
					),
					'dependency' => array( 'heading', '==', true )
				),
				array(
					'id'    	 => 'heading_text',
					'type'  	 => 'text',
					'title' 	 => 'Heading text',
					'dependency' => array( 'heading', '==', true )
				),
				array(
					'id'    => 'beadcrumbs',
					'type'  => 'switcher',
					'title' => 'Page beadcrumbs',
				),
				array(
					'id'              => 'socials',
					'type'            => 'group',
					'title'           => 'Socials',
					'button_title'    => 'Add New',
					'accordion_title' => 'Add New Field',
					'fields'          => array(
						array(
							'id'    => 'url',
							'type'  => 'text',
							'title' => 'URL',
						),
						array(
							'id'    => 'icon',
							'type'  => 'icon',
							'title' => 'Icon',
						),
					),
				),
			)
		)
	)
);

// -----------------------------------------
// People Metabox Options        	       -
// -----------------------------------------
$options[]    = array(
	'id'        => 'people_options',
	'title'     => 'People Options',
	'post_type' => 'people',
	'context'   => 'normal',
	'priority'  => 'high',
	'sections'  => array(
		array(
			'name'   => 'section',
			'fields' => array(
				array(
					'id'    => 'position',
					'type'  => 'text',
					'title' => 'Position',
				),
				array(
					'id'    => 'phone',
					'type'  => 'text',
					'title' => 'Phone',
				),
				array(
					'id'    => 'fax',
					'type'  => 'text',
					'title' => 'Fax',
				),
				array(
					'id'    => 'email',
					'type'  => 'text',
					'title' => 'Email',
				),
				array(
					'id'    => 'cv',
					'type'  => 'upload',
					'title' => 'CV',
					'settings'      => array(
					   'upload_type'  => '*'
					)
				),
				array(
					'id'    => 'education',
					'type'  => 'textarea',
					'title' => 'Education',
				),
				array(
					'id'    => 'awards',
					'type'  => 'textarea',
					'title' => 'Awards & Recognition',
				),
				array(
					'id'              => 'tabs',
					'type'            => 'group',
					'title'           => 'Tabs',
					'button_title'    => 'Add New',
					'accordion_title' => 'Add New Field',
					'fields'          => array(
						array(
							'id'    => 'title',
							'type'  => 'text',
							'title' => 'Title',
						),
						array(
							'id'    => 'content',
							'type'  => 'wysiwyg',
							'title' => 'Content'
						),
					),
				),
			)
		)
	)
);

// -----------------------------------------
// Locations Metabox Options        	   -
// -----------------------------------------
$options[]    = array(
	'id'        => 'location_address',
	'title'     => 'Locations address',
	'post_type' => 'locations',
	'context'   => 'normal',
	'priority'  => 'low',
	'sections'  => array(
		array(
			'name'   => 'section',
			'fields' => array(
				array(
					'id'    => 'country',
					'type'  => 'text',
					'title' => 'Country',
				),
				array(
					'id'    => 'region',
					'type'  => 'text',
					'title' => 'Region',
				),
				array(
					'id'    => 'zip',
					'type'  => 'text',
					'title' => 'Zip code',
				),
				array(
					'id'    => 'city',
					'type'  => 'text',
					'title' => 'City',
				),
				array(
					'id'    => 'address',
					'type'  => 'text',
					'title' => 'Address',
				),
				array(
					'id'    => 'phone',
					'type'  => 'text',
					'title' => 'Phone',
				),
				array(
					'id'    => 'fax',
					'type'  => 'text',
					'title' => 'Fax',
				),
				array(
					'id'    => 'email',
					'type'  => 'text',
					'title' => 'Email',
				),
			)
		)
	)
);

// -----------------------------------------
// Location Metabox Options            	   -
// -----------------------------------------
$options[]    = array(
	'id'        => 'location_page_options',
	'title'     => 'Location Page Options',
	'post_type' => 'locations',
	'context'   => 'side',
	'priority'  => 'default',
	'sections'  => array(
		array(
			'name'   => 'section',
			'fields' => array(
				array(
					'id'    => 'heading',
					'type'  => 'switcher',
					'title' => 'Page heading',
				),
				array(
					'id'        => 'heading_background',
					'type'      => 'upload',
					'title'     => 'Background image',
					'settings'      => array(
						'upload_type'  => 'image',
						'button_title' => 'Upload',
						'frame_title'  => 'Select an image',
						'insert_title' => 'Use this image',
					),
					'dependency' => array( 'heading', '==', true )
				),
				array(
					'id'    	 => 'heading_text',
					'type'  	 => 'text',
					'title' 	 => 'Heading text',
					'dependency' => array( 'heading', '==', true )
				),
				array(
					'id'    => 'beadcrumbs',
					'type'  => 'switcher',
					'title' => 'Page beadcrumbs',
				),
			)
		)
	)
);

// -----------------------------------------
// Page Metabox Options        	  		   -
// -----------------------------------------
$options[]    = array(
	'id'        => 'page_options',
	'title'     => 'Page options',
	'post_type' => array('page','post'),
	'context'   => 'side',
	'priority'  => 'high',
	'sections'  => array(
		array(
			'name'   => 'section',
			'fields' => array(
				array(
					'id'        => 'heading_background',
					'type'      => 'upload',
					'title'     => 'Heading background image',
					'settings'      => array(
						'upload_type'  => 'image',
						'button_title' => 'Upload',
						'frame_title'  => 'Select an image',
						'insert_title' => 'Use this image',
					)
				),
				array(
					'id'       => 'header_style',
					'type'     => 'select',
					'title'    => 'Header style',
					'options'  => array(
						'default' => 'Default(theme options)',
						'one'     => 'Style 1',
						'two'     => 'Style 2',
						'three'   => 'Style 3'
					)
				)
			)
		)
	)
);


CSFramework_Metabox::instance( $options );
