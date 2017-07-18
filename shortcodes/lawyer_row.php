<?php

$responsive_classes = array(
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Desctop marg top', 'js_composer' ),
		'param_name' => 'desctop_mt',
		'value'      => lawyer_get_classes( 'marg-lg', 't', 150 ),
		'group'      => 'Responsive margins'
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Desctop marg bottom', 'js_composer' ),
		'param_name' => 'desctop_mb',
		'value'      => lawyer_get_classes( 'marg-lg', 'b', 150 ),
		'group'      => 'Responsive margins',
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Tablets marg top', 'js_composer' ),
		'param_name' => 'tablets_mt',
		'value'      => lawyer_get_classes( 'marg-md', 't' ),
		'group'      => 'Responsive margins'
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Tablets marg bottom', 'js_composer' ),
		'param_name' => 'tablets_mb',
		'value'      => lawyer_get_classes( 'marg-md', 'b' ),
		'group'      => 'Responsive margins'
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Mobile marg top', 'js_composer' ),
		'param_name' => 'mobile_mt',
		'value'      => lawyer_get_classes( 'marg-xs', 't' ),
		'group'      => 'Responsive margins'
	),
	array(
		'type'       => 'dropdown',
		'heading'    => __( 'Mobile marg bottom', 'js_composer' ),
		'param_name' => 'mobile_mb',
		'value'      => lawyer_get_classes( 'marg-xs', 'b' ),
		'group'      => 'Responsive margins'
	)
);

vc_add_params( 'vc_row', $responsive_classes );