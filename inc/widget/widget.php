<?php

function linkpva_core_register_sidebars()
{

    register_sidebar(array(
        'name'          => esc_html__('Shop Sidebar', 'linkpva-core'),
        'id'            => 'shop_sidebar',
        'description'   => esc_html__('This sidebar will apply to your shop archive page', 'linkpva-core'),
        'before_widget' => '<div id="%1$s" class="single-widgets %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Blog Details', 'linkpva-core'),
        'id'            => 'blog_dt_sidebar',
        'description'   => esc_html__('This sidebar will apply to your blog single page', 'linkpva-core'),
        'before_widget' => '<div id="%1$s" class="single-widgets %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'linkpva_core_register_sidebars');
