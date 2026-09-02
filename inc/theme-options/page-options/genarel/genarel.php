<?php
/*-----------------------------------
PAGE MENU SECTION
------------------------------------*/
CSF::createSection(
    $prefix,
    array(
        'title'  => esc_html__('Header', 'linkpva-core'),
        'parent' => 'page_meta_option',
        'fields' => array(
            //Page Header Options
            array(
                'type'    => 'subheading',
                'content' => esc_html__('Header Options', 'linkpva-core'),
            ),
            array(
                'id'      => 'page_main_header_enable',
                'type'    => 'select',
                'title'   => esc_html__('Main Header', 'linkpva-core'),
                'desc'    => wp_kses(__('you can enable/disable <mark>Main Header </mark> for header section', 'linkpva-core'), wp_kses_allowed_html('post')),
                'options' => array(
                    'enable'  => esc_html('Enable'),
                    'disable' => esc_html('Disable'),
                ),
                'default' => 1
            ),
            array(
                'id'      => 'page_header_menu_style',
                'title'   => esc_html__('Select Style', 'linkpva-core'),
                'type'    => 'image_select',
                'class'   => 'egns_header_select',
                'options' => array(
                    'default'      => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/header/default.png'),
                    'header_one'   => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/header/header-one.png'),
                ),
                'desc'       => wp_kses(__('you can select <mark>Header Style </mark> for header section', 'linkpva-core'), wp_kses_allowed_html('post')),
                'default'    => 'default',
                'dependency' => array('page_main_header_enable', '==', 'enable'),
            ),
            // *************** Header content ***************
            array(
                'type'       => 'subheading',
                'content'    => '<h3>' . esc_html__('Header Template', 'linkpva-core') . '</h3>',
                'dependency' => array(
                    array('page_main_header_enable', '==', 'enable'),
                    // array('page_header_menu_style', '==', 'header_one', 'header_two', 'header_three'),
                ),
            ),
            array(
                'id'          => 'header_one_template',
                'type'        => 'select',
                'title'       => esc_html__('Select Header', 'linkpva-core'),
                'chosen'      => true,
                'placeholder' => esc_html__('select a header', 'linkpva-core'),
                'options'     => \Egns_Core\Egns_Helper::get_custom_template_list('header-blocks'),
                'desc'        => wp_kses_post('You must select a <mark>Header</mark> for this layout. You can create a header here ( <a href="' . home_url() . '/wp-admin/edit.php?post_type=header-blocks">Header Template</a> )'),
                'dependency'  => array(
                    array('page_main_header_enable', '==', 'enable'),
                ),
            ),

        ),
    )
);

// Footer Options

CSF::createSection(
    $prefix,
    array(
        'title'  => esc_html__('Footer', 'linkpva-core'),
        'parent' => 'page_meta_option',
        'fields' => array(
            //Page Footer Options
            array(
                'type'    => 'subheading',
                'content' => esc_html__('Footer Options', 'linkpva-core'),
            ),

            array(
                'id'      => 'page_main_footer_enable',
                'type'    => 'select',
                'title'   => esc_html__('Main footer', 'linkpva-core'),
                'desc'    => wp_kses(__('You can enable/disable <mark>Main Footer </mark> for this page', 'linkpva-core'), wp_kses_allowed_html('post')),
                'options' => array(
                    'enable'  => esc_html('Enable'),
                    'disable' => esc_html('Disable'),
                ),
                'default' => 1
            ),
            array(
                'id'      => 'page_footer_layout',
                'title'   => esc_html__('Select Style', 'linkpva-core'),
                'type'    => 'image_select',
                'class'   => 'egns_header_select',
                'options' => array(
                    'default'      => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/header/default.png'),
                    'footer_one'   => esc_url(EGNS_CORE_THEME_OPTIONS_IMAGES . '/footer/footer-one.png'),
                ),
                'desc'       => wp_kses(__('You can select <mark>Footer Style </mark> for this page', 'linkpva-core'), wp_kses_allowed_html('post')),
                'default'    => 'default',
                'dependency' => array('page_main_footer_enable', '==', 'enable'),
            ),
            // *************** Footer content ***************
            array(
                'type'       => 'subheading',
                'content'    => '<h3>' . esc_html__('Footer Template', 'linkpva-core') . '</h3>',

                'dependency' => array('page_main_footer_enable', '==', 'enable'),
            ),
            array(
                'id'          => 'footer_one_template',
                'type'        => 'select',
                'title'       => esc_html__('Select Footer', 'linkpva-core'),
                'chosen'      => true,
                'placeholder' => esc_html__('select a footer', 'linkpva-core'),
                'options'     => \Egns_Core\Egns_Helper::get_custom_template_list('footer-blocks'),
                'desc'        => wp_kses_post('You must select a <mark>Footer</mark> for this layout. You can create a footer here ( <a href="' . home_url() . '/wp-admin/edit.php?post_type=footer-blocks">Footer Template</a> )'),
                'dependency' => array('page_main_footer_enable', '==', 'enable'),
            ),

        ),
    )
);
