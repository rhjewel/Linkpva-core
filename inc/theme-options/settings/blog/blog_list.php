<?php
/*-------------------------------------------------------
		  ** Blog Page  Options
--------------------------------------------------------*/

CSF::createSection($prefix, array(
	'parent' => 'blog_settings',
	'id'     => 'blog_post_options',
	'title'  => esc_html__('Blog Post', 'linkpva-core'),
	'icon'   => 'fa fa-list-ul',
	'fields' => array(
		array(
			'id'      => 'blog_layout_options',
			'title'   => esc_html__('Blog Layout', 'linkpva-core'),
			'type'    => 'image_select',
			'options' => array(
				'grid'     => EGNS_CORE_THEME_OPTIONS_IMAGES . '/blog/grid.png',
				'standard' => EGNS_CORE_THEME_OPTIONS_IMAGES . '/blog/standard.png',
			),
			'default' => 'standard',
			'desc'    => wp_kses(__('You can set <mark>blog layout</mark> for blog archive page', 'linkpva-core'), wp_kses_allowed_html('post')),
		),
		// A Subheading
		array(
			'type'    => 'subheading',
			'content' => esc_html__('Post archive', 'linkpva-core'),
		),
		array(
			'id'         => 'breadcrumb_post_heading',
			'type'       => 'text',
			'title'      => esc_html__('Breadcrumb Heading', 'linkpva-core'),
		),
		array(
			'id'         => 'breadcrumb_post_short_desc',
			'type'       => 'textarea',
			'class'      => 'egns_desc',
			'title'      => esc_html__('Breadcrumb Description', 'linkpva-core'),
		),
	),

));
