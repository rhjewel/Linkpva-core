<?php
/*-------------------------------------------------------
		   ** 404 page options
--------------------------------------------------------*/

CSF::createSection($prefix, array(
	'id'     => '404_page',
	'title'  => esc_html__('404 Page', 'linkpva-core'),
	'icon'   => 'fa fa-exclamation-triangle',
	'fields' => array(
		array(
			'type'    => 'subheading',
			'content' => '<h3>' . esc_html__('404 Page Options', 'linkpva-core') . '</h3>',
		),
		array(
			'id'      => '404_title',
			'title'   => esc_html__('Title', 'linkpva-core'),
			'type'    => 'text',
			'default' => wp_kses_post('We Couldn’t Find That Page'),
		),
		array(
			'id'      => '404_button_text',
			'title'   => esc_html__('Button label', 'linkpva-core'),
			'type'    => 'text',
			'info'    => wp_kses_post('You can change <mark>button text</mark> of 404 page'),
			'default' => esc_html__('Go to homepage', 'linkpva-core')
		),
		array(
			'id'      => '404_content',
			'title'   => esc_html__('Short Description', 'linkpva-core'),
			'type'    => 'textarea',
			'class' => 'egns_desc',
			'default' => esc_html__("The page may have moved, the link may be incorrect, or the content may no longer be available.", 'linkpva-core')
		),

	)
));
