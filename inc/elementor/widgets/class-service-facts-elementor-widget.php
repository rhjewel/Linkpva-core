<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit;
}

class linkpva_Service_Facts_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'linkpva_service_facts';
    }

    public function get_title()
    {
        return esc_html__('LinkPVA Service Facts', 'linkpva-core');
    }

    public function get_icon()
    {
        return 'egns-widget-icon';
    }

    public function get_categories()
    {
        return array('linkpva_widgets');
    }

    protected function register_controls()
    {
        $this->register_facts_controls();
        $this->register_section_style_controls();
        $this->register_grid_style_controls();
        $this->register_item_style_controls();
        $this->register_icon_style_controls();
        $this->register_title_style_controls();
        $this->register_subtitle_style_controls();
    }

    private function register_facts_controls()
    {
        $this->start_controls_section(
            'linkpva_service_facts_content',
            array(
                'label' => esc_html__('Service Facts', 'linkpva-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'linkpva_service_facts_aria_label',
            array(
                'label'       => esc_html__('Accessibility Label', 'linkpva-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('LinkPVA service facts', 'linkpva-core'),
                'label_block' => true,
            )
        );
        $this->add_control(
            'linkpva_service_facts_show_icons',
            array(
                'label'        => esc_html__('Show Icons', 'linkpva-core'),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );
        $this->add_control(
            'linkpva_service_facts_show_subtitles',
            array(
                'label'        => esc_html__('Show Subtitles', 'linkpva-core'),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'icon',
            array(
                'label'   => esc_html__('Icon', 'linkpva-core'),
                'type'    => Controls_Manager::ICONS,
                'default' => array(
                    'value'   => 'bi bi-card-text',
                    'library' => 'bootstrap',
                ),
            )
        );
        $repeater->add_control(
            'title',
            array(
                'label'       => esc_html__('Title', 'linkpva-core'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            )
        );
        $repeater->add_control(
            'subtitle',
            array(
                'label'       => esc_html__('Subtitle', 'linkpva-core'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            )
        );

        $this->add_control(
            'linkpva_service_facts_items',
            array(
                'label'       => esc_html__('Facts', 'linkpva-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
                'default'     => $this->get_default_facts(),
            )
        );

        $this->end_controls_section();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section(
            'linkpva_service_facts_style_section',
            array(
                'label' => esc_html__('Section', 'linkpva-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'linkpva_service_facts_style_section_background',
                'selector' => '{{WRAPPER}} .linkpva-service-facts',
            )
        );
        $this->add_control(
            'linkpva_service_facts_style_section_color',
            array(
                'label'     => esc_html__('Base Text Color', 'linkpva-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array('{{WRAPPER}} .linkpva-service-facts' => 'color: {{VALUE}};'),
            )
        );
        $this->add_responsive_control(
            'linkpva_service_facts_style_section_padding',
            array(
                'label'      => esc_html__('Padding', 'linkpva-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%', 'rem'),
                'selectors'  => array('{{WRAPPER}} .linkpva-service-facts' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'),
            )
        );

        $this->end_controls_section();
    }

    private function register_grid_style_controls()
    {
        $this->start_controls_section(
            'linkpva_service_facts_style_grid',
            array(
                'label' => esc_html__('Grid', 'linkpva-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_responsive_control(
            'linkpva_service_facts_style_grid_columns',
            array(
                'label'          => esc_html__('Columns', 'linkpva-core'),
                'type'           => Controls_Manager::SELECT,
                'default'        => '4',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options'        => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ),
                'selectors'      => array('{{WRAPPER}} .linkpva-facts-grid' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));'),
            )
        );
        $this->add_responsive_control(
            'linkpva_service_facts_style_grid_gap',
            array(
                'label'      => esc_html__('Gap', 'linkpva-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'range'      => array('px' => array('min' => 0, 'max' => 80)),
                'selectors'  => array('{{WRAPPER}} .linkpva-facts-grid' => 'gap: {{SIZE}}{{UNIT}};'),
            )
        );

        $this->end_controls_section();
    }

    private function register_item_style_controls()
    {
        $this->start_controls_section(
            'linkpva_service_facts_style_item',
            array(
                'label' => esc_html__('Fact Items', 'linkpva-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control('linkpva_service_facts_style_item_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-facts-grid > div' => 'background-color: {{VALUE}};')));
        $this->add_control('linkpva_service_facts_style_item_divider_color', array('label' => esc_html__('Divider Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-facts-grid > div' => 'border-color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_service_facts_style_item_border', 'selector' => '{{WRAPPER}} .linkpva-facts-grid > div'));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_service_facts_style_item_shadow', 'selector' => '{{WRAPPER}} .linkpva-facts-grid > div'));
        $this->add_responsive_control('linkpva_service_facts_style_item_min_height', array('label' => esc_html__('Minimum Height', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 400)), 'selectors' => array('{{WRAPPER}} .linkpva-facts-grid > div' => 'min-height: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_service_facts_style_item_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-facts-grid > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_service_facts_style_item_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-facts-grid > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control(
            'linkpva_service_facts_style_item_alignment',
            array(
                'label'   => esc_html__('Alignment', 'linkpva-core'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => array(
                    'start'  => array('title' => esc_html__('Left', 'linkpva-core'), 'icon' => 'eicon-text-align-left'),
                    'center' => array('title' => esc_html__('Center', 'linkpva-core'), 'icon' => 'eicon-text-align-center'),
                    'end'    => array('title' => esc_html__('Right', 'linkpva-core'), 'icon' => 'eicon-text-align-right'),
                ),
                'default'   => 'center',
                'selectors' => array('{{WRAPPER}} .linkpva-facts-grid > div' => 'text-align: {{VALUE}}; justify-items: {{VALUE}};'),
            )
        );

        $this->end_controls_section();
    }

    private function register_icon_style_controls()
    {
        $this->start_controls_section(
            'linkpva_service_facts_style_icon',
            array(
                'label'     => esc_html__('Icons', 'linkpva-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => array('linkpva_service_facts_show_icons' => 'yes'),
            )
        );

        $this->add_control('linkpva_service_facts_style_icon_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-facts-grid > div > i' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-facts-grid > div > svg path' => 'fill: {{VALUE}};')));
        $this->add_responsive_control('linkpva_service_facts_style_icon_size', array('label' => esc_html__('Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 6, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-facts-grid > div > i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-facts-grid > div > svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_service_facts_style_icon_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 60)), 'selectors' => array('{{WRAPPER}} .linkpva-facts-grid > div > i, {{WRAPPER}} .linkpva-facts-grid > div > svg' => 'margin-bottom: {{SIZE}}{{UNIT}};')));

        $this->end_controls_section();
    }

    private function register_title_style_controls()
    {
        $this->start_controls_section('linkpva_service_facts_style_title', array('label' => esc_html__('Titles', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_control('linkpva_service_facts_style_title_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-facts-grid strong' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_service_facts_style_title_typography', 'selector' => '{{WRAPPER}} .linkpva-facts-grid strong'));
        $this->add_responsive_control('linkpva_service_facts_style_title_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 50)), 'selectors' => array('{{WRAPPER}} .linkpva-facts-grid strong' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_subtitle_style_controls()
    {
        $this->start_controls_section(
            'linkpva_service_facts_style_subtitle',
            array(
                'label'     => esc_html__('Subtitles', 'linkpva-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => array('linkpva_service_facts_show_subtitles' => 'yes'),
            )
        );

        $this->add_control('linkpva_service_facts_style_subtitle_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-facts-grid > div > span' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_service_facts_style_subtitle_typography', 'selector' => '{{WRAPPER}} .linkpva-facts-grid > div > span'));
        $this->end_controls_section();
    }

    private function get_default_facts()
    {
        return array(
            array('icon' => array('value' => 'bi bi-card-text', 'library' => 'bootstrap'), 'title' => esc_html__('Detailed Listings', 'linkpva-core'), 'subtitle' => esc_html__('Relevant product information', 'linkpva-core')),
            array('icon' => array('value' => 'bi bi-ui-checks-grid', 'library' => 'bootstrap'), 'title' => esc_html__('Clear Process', 'linkpva-core'), 'subtitle' => esc_html__('Understand each order step', 'linkpva-core')),
            array('icon' => array('value' => 'bi bi-collection', 'library' => 'bootstrap'), 'title' => esc_html__('Four Categories', 'linkpva-core'), 'subtitle' => esc_html__('Options for different needs', 'linkpva-core')),
            array('icon' => array('value' => 'bi bi-life-preserver', 'library' => 'bootstrap'), 'title' => esc_html__('Order Assistance', 'linkpva-core'), 'subtitle' => esc_html__('Support for your purchase', 'linkpva-core')),
        );
    }

    private function render_icon($icon)
    {
        if (is_array($icon) && !empty($icon['value'])) {
            Icons_Manager::render_icon($icon, array('aria-hidden' => 'true'));
        }
    }

    protected function render()
    {
        $settings       = $this->get_settings_for_display();
        $widget_id      = sanitize_html_class($this->get_id());
        $facts          = isset($settings['linkpva_service_facts_items']) && is_array($settings['linkpva_service_facts_items']) ? $settings['linkpva_service_facts_items'] : array();
        $show_icons     = 'yes' === ($settings['linkpva_service_facts_show_icons'] ?? '');
        $show_subtitles = 'yes' === ($settings['linkpva_service_facts_show_subtitles'] ?? '');
        $aria_label     = isset($settings['linkpva_service_facts_aria_label']) ? sanitize_text_field($settings['linkpva_service_facts_aria_label']) : '';
        $facts          = array_values(
            array_filter(
                $facts,
                function ($fact) use ($show_icons, $show_subtitles) {
                    return !empty($fact['title']) || ($show_subtitles && !empty($fact['subtitle'])) || ($show_icons && !empty($fact['icon']['value']));
                }
            )
        );

        if (empty($facts)) {
            return;
        }
?>
        <section class="linkpva-service-facts" data-linkpva-service-facts-widget="<?php echo esc_attr($widget_id); ?>" <?php if ('' !== $aria_label) : ?> aria-label="<?php echo esc_attr($aria_label); ?>" <?php endif; ?>>
            <div class="container">
                <div class="linkpva-facts-grid">
                    <?php foreach ($facts as $fact) : ?>
                        <div>
                            <?php if ($show_icons && !empty($fact['icon']['value'])) : ?><?php $this->render_icon($fact['icon']); ?><?php endif; ?>
                            <?php if (!empty($fact['title'])) : ?><strong><?php echo esc_html($fact['title']); ?></strong><?php endif; ?>
                            <?php if ($show_subtitles && !empty($fact['subtitle'])) : ?><span><?php echo esc_html($fact['subtitle']); ?></span><?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new linkpva_Service_Facts_Widget());
