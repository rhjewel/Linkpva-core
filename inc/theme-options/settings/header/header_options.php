<?php

CSF::createSection($prefix, array(
    'parent' => 'header_options',
    'title'  => esc_html__('Header Options', 'linkpva-core'),
    'id'     => 'theme_header_style_options',
    'icon'   => 'fab fa-algolia',
    'fields' => array(
        array(
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__('Look Header Layout', 'linkpva-core') . '</h3>'
        ),
        array(
            'id'      => 'header_menu_style',
            'type'    => 'image_select',
            'class'   => 'egns_header_select',
            'options' => array(
                'header_one'   => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/header/header-one.png'),
            ),
            'default' => 'header_one',
        ),
        // *************** Header content ***************
        array(
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__('Header Template', 'linkpva-core') . '</h3>'
        ),
        array(
            'id'          => 'header_one_template',
            'type'        => 'select',
            'title'       => esc_html__('Select Header', 'linkpva-core'),
            'chosen'      => true,
            'placeholder' => esc_html__('select a header', 'linkpva-core'),
            'options'     => \Egns_Core\Egns_Helper::get_custom_template_list('header-blocks'),
            'default'     => 'header',
            'desc'        => wp_kses_post('You must select a <mark>Header</mark> for this layout. You can create a header here ( <a href="' . home_url() . '/wp-admin/edit.php?post_type=header-blocks">Header Template</a> )'),
        ),

    )
));
