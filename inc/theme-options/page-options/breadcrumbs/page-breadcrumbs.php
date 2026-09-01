<?php
/*-----------------------------------
    PAGE BARNER SECTION
------------------------------------*/

CSF::createSection(
	$prefix,
	array(
		'title'  => esc_html__('Breadcrumb', 'linkpva-core'),
		'parent' => 'page_meta_option',
		'fields' => array(
			array(
				'type'    => 'subheading',
				'content' => esc_html__('Breadcrumb Options', 'linkpva-core'),
			),
			array(
				'id'      => 'breadcrumb_enable_page',
				'type'    => 'switcher',
				'title'   => esc_html__('Enable Breadcrumb', 'linkpva-core'),
				'desc'    => esc_html__('If you want to show or hide page banner you can toggle ( ON / OFF ).', 'linkpva-core'),
				'default' => true,
			),
			array(
				'id'         => 'breadcrumb_page_heading',
				'type'       => 'text',
				'title'      => esc_html__('Heading', 'linkpva-core'),
				'dependency' => array('breadcrumb_enable_page', '==', 'true'),
			),
			array(
				'id'         => 'breadcrumb_page_short_desc',
				'type'       => 'textarea',
				'class'      => 'egns_desc',
				'title'      => esc_html__('Short Description', 'linkpva-core'),
				'dependency' => array('breadcrumb_enable_page', '==', 'true'),
			),
			array(
				'id'         => 'breadcrumb_page_bg_color',
				'type'       => 'color',
				'title'      => esc_html__('Background Color', 'linkpva-core'),
				'dependency' => array('breadcrumb_enable_page', '==', 'true'),
			),
			array(
				'id'         => 'breadcrumb_page_bg_image',
				'type'       => 'media',
				'title'      => esc_html__('Breadcrumb Background Image', 'linkpva-core'),
				'desc'       => esc_html__('Set the banner background image', 'linkpva-core'),
				'dependency' => array('breadcrumb_enable_page', '==', 'true'),
			),
		)
	)
);
