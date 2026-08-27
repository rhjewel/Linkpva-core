<?php
/*-----------------------------------
		Footer Style  
------------------------------------*/

CSF::createSection($prefix, array(
    'parent' => 'footer_options',
    'title'  => esc_html__('Footer Style', 'linkpva-core'),
    'id'     => 'theme_footer_style_options',
    'icon'   => 'fab fa-algolia',
    'fields' => array(
        array(
            'type'    => 'subheading',
            'content' => '<h3>' . esc_html__('Select Footer Global Layout', 'linkpva-core') . '</h3>'
        ),
        array(
            'id'      => 'footer_layout_style',
            'type'    => 'image_select',
            'class'   => 'egns_header_select',
            'options' => array(
                'footer_one'   => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/footer/footer-one.png'),
                'footer_two'   => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/footer/footer-two.png'),
                'footer_three' => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/footer/footer-three.png'),
            ),
            'desc'    => wp_kses(__('You can select <mark>Footer Style </mark> for global footer', 'linkpva-core'), wp_kses_allowed_html('linkpva-core')),
            'default' => 'footer_one',
        ),

    ),

));
