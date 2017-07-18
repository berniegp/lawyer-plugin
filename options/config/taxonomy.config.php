<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// TAXONOMY OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options     = array();

// -----------------------------------------
// Taxonomy Options                        -
// -----------------------------------------
$options[]   = array(
	'id'       => 'practice_fields',
	'taxonomy' => 'practice',
	'fields'   => array(
		array(
			'id'    => 'icon',
			'type'  => 'icon',
			'title' => 'Area icon',
		),
		array(
			'id'    => 'image',
			'type'  => 'image',
			'title' => 'Area image',
		),
		array(
			'id'    => 'number',
			'type'  => 'text',
			'title' => 'Number of shown attorneys',
			'desc'  => 'Null for no limits. Empty for using WordPress option value.',
		),
		array(
			'id'    => 'random',
			'type'  => 'switcher',
			'title' => 'Random lawyers',
		),
		array(
			'id'    => 'descr',
			'type'  => 'wysiwyg',
			'title' => 'Description',
		),
	),
);

CSFramework_Taxonomy::instance( $options );