<?php
/*-------------------------------------------------------
		  ** Breadcrumbs Options
--------------------------------------------------------*/

CSF::createSection($prefix, array(
	'title'  => esc_html__('Breadcrumb', 'linkpva-core'),
	'id'     => 'breadcrumb_options',
	'icon'   => 'fa fa-sliders',
	'fields' => array(
		array(
			'type'    => 'subheading',
			'content' => '<h3>' . esc_html__('Breadcrumb Options', 'linkpva-core') . '</h3>'
		),
		array(
			'id'      => 'breadcrumb_enable',
			'title'   => esc_html__('Enable Breadcrumb', 'linkpva-core'),
			'type'    => 'switcher',
			'desc'    => wp_kses(__('You can turn <mark>ON/OFF</mark> to show, hide breadcrumb globally', 'linkpva-core'), wp_kses_allowed_html('post')),
			'default' => true,
		),
		array(
			'id'         => 'breadcrumb_heading',
			'type'       => 'text',
			'title'      => esc_html__('Heading', 'linkpva-core'),
			'dependency' => array('breadcrumb_enable', '==', 'true'),
		),
		array(
			'id'         => 'breadcrumb_background_color',
			'type'       => 'color',
			'title'      => 'Background Color',
			'desc'       => esc_html__('set the banner background color', 'linkpva-core'),
			'dependency' => array('breadcrumb_enable', '==', 'true'),
		),
		array(
			'id'         => 'breadcrumb_bg_image',
			'type'       => 'media',
			'title'      => esc_html__('Background Image', 'linkpva-core'),
			'desc'       => esc_html__('set the banner background image', 'linkpva-core'),
			'dependency' => array('breadcrumb_enable', '==', 'true'),
		),
	)
));
