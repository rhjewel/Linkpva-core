<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class linkpva_Demo_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'linkpva_demo';
    }

    public function get_title()
    {
        return esc_html__('LinkPVA Demo', 'linkpva-core');
    }

    public function get_icon()
    {
        return 'egns-widget-icon';
    }

    public function get_categories()
    {
        return ['linkpva_widgets'];
    }

    protected function register_controls() {}



    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>

<?php
    }
}

Plugin::instance()->widgets_manager->register(new linkpva_Demo_Widget());
