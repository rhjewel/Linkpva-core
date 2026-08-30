<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit;
}

class linkpva_Contact_Info_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'linkpva_contact_info';
    }

    public function get_title()
    {
        return esc_html__('LinkPVA Contact Info', 'linkpva-core');
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
        $this->register_content_controls();
        $this->register_section_style_controls();
        $this->register_grid_style_controls();
        $this->register_card_style_controls();
        $this->register_icon_style_controls();
        $this->register_title_style_controls();
        $this->register_description_style_controls();
        $this->register_link_style_controls();
    }

    private function register_content_controls()
    {
        $this->start_controls_section(
            'linkpva_contact_info_content',
            array(
                'label' => esc_html__('Information Cards', 'linkpva-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'icon',
            array(
                'label'   => esc_html__('Icon', 'linkpva-core'),
                'type'    => Controls_Manager::ICONS,
                'default' => array(
                    'value'   => 'bi bi-question-circle',
                    'library' => 'bootstrap',
                ),
            )
        );
        $repeater->add_control(
            'title',
            array(
                'label'       => esc_html__('Title', 'linkpva-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('General Questions', 'linkpva-core'),
                'label_block' => true,
            )
        );
        $repeater->add_control(
            'description',
            array(
                'label'       => esc_html__('Description', 'linkpva-core'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Review answers about product types and ordering in the FAQ.', 'linkpva-core'),
                'label_block' => true,
            )
        );
        $repeater->add_control(
            'show_link',
            array(
                'label'        => esc_html__('Show Link', 'linkpva-core'),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
                'separator'    => 'before',
            )
        );
        $repeater->add_control(
            'link_text',
            array(
                'label'       => esc_html__('Link Text', 'linkpva-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('View FAQ', 'linkpva-core'),
                'label_block' => true,
                'condition'   => array('show_link' => 'yes'),
            )
        );
        $repeater->add_control(
            'link_url',
            array(
                'label'         => esc_html__('Link URL', 'linkpva-core'),
                'type'          => Controls_Manager::URL,
                'default'       => array('url' => home_url('/faq/')),
                'placeholder'   => home_url('/faq/'),
                'show_external' => true,
                'condition'     => array('show_link' => 'yes'),
            )
        );
        $repeater->add_control(
            'show_link_icon',
            array(
                'label'        => esc_html__('Show Link Icon', 'linkpva-core'),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => array('show_link' => 'yes'),
            )
        );
        $repeater->add_control(
            'link_icon',
            array(
                'label'     => esc_html__('Link Icon', 'linkpva-core'),
                'type'      => Controls_Manager::ICONS,
                'default'   => array(
                    'value'   => 'bi bi-arrow-right',
                    'library' => 'bootstrap',
                ),
                'condition' => array('show_link' => 'yes', 'show_link_icon' => 'yes'),
            )
        );

        $this->add_control(
            'linkpva_contact_info_items',
            array(
                'label'       => esc_html__('Cards', 'linkpva-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
                'default'     => $this->get_default_items(),
            )
        );

        $this->end_controls_section();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section('linkpva_contact_info_style_section', array('label' => esc_html__('Section', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_contact_info_style_section_background', 'selector' => '{{WRAPPER}} .linkpva-contact-info-widget'));
        $this->add_responsive_control('linkpva_contact_info_style_section_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-contact-info-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_grid_style_controls()
    {
        $this->start_controls_section('linkpva_contact_info_style_grid', array('label' => esc_html__('Grid', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_responsive_control(
            'linkpva_contact_info_style_columns',
            array(
                'label'     => esc_html__('Columns', 'linkpva-core'),
                'type'      => Controls_Manager::SELECT,
                'options'   => array(
                    '1' => esc_html__('One', 'linkpva-core'),
                    '2' => esc_html__('Two', 'linkpva-core'),
                    '3' => esc_html__('Three', 'linkpva-core'),
                    '4' => esc_html__('Four', 'linkpva-core'),
                ),
                'default'   => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'selectors' => array('{{WRAPPER}} .linkpva-info-grid' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));'),
            )
        );
        $this->add_responsive_control('linkpva_contact_info_style_grid_gap', array('label' => esc_html__('Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-info-grid' => 'gap: {{SIZE}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_card_style_controls()
    {
        $this->start_controls_section('linkpva_contact_info_style_card', array('label' => esc_html__('Card', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_contact_info_style_card_background', 'selector' => '{{WRAPPER}} .linkpva-info-card'));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_contact_info_style_card_border', 'selector' => '{{WRAPPER}} .linkpva-info-card'));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_contact_info_style_card_shadow', 'selector' => '{{WRAPPER}} .linkpva-info-card'));
        $this->add_responsive_control('linkpva_contact_info_style_card_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-info-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_info_style_card_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-info-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_info_style_card_min_height', array('label' => esc_html__('Minimum Height', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 100, 'max' => 800)), 'selectors' => array('{{WRAPPER}} .linkpva-info-card' => 'min-height: {{SIZE}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_icon_style_controls()
    {
        $this->start_controls_section('linkpva_contact_info_style_icon', array('label' => esc_html__('Card Icon', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_control('linkpva_contact_info_style_icon_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-info-icon' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-info-icon svg path' => 'fill: {{VALUE}};')));
        $this->add_control('linkpva_contact_info_style_icon_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-info-icon' => 'background-color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_contact_info_style_icon_border', 'selector' => '{{WRAPPER}} .linkpva-info-icon'));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_contact_info_style_icon_shadow', 'selector' => '{{WRAPPER}} .linkpva-info-icon'));
        $this->add_responsive_control('linkpva_contact_info_style_icon_box_size', array('label' => esc_html__('Box Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 20, 'max' => 150)), 'selectors' => array('{{WRAPPER}} .linkpva-info-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_info_style_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 6, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-info-icon i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-info-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_info_style_icon_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-info-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_info_style_icon_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-info-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_title_style_controls()
    {
        $this->start_controls_section('linkpva_contact_info_style_title', array('label' => esc_html__('Title', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_control('linkpva_contact_info_style_title_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-info-card .linkpva-info-title' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_contact_info_style_title_typography', 'selector' => '{{WRAPPER}} .linkpva-info-card .linkpva-info-title'));
        $this->add_responsive_control('linkpva_contact_info_style_title_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-info-card .linkpva-info-title' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_description_style_controls()
    {
        $this->start_controls_section('linkpva_contact_info_style_description', array('label' => esc_html__('Description', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_control('linkpva_contact_info_style_description_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-info-card .linkpva-info-description' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_contact_info_style_description_typography', 'selector' => '{{WRAPPER}} .linkpva-info-card .linkpva-info-description'));
        $this->add_responsive_control('linkpva_contact_info_style_description_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-info-card .linkpva-info-description' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_link_style_controls()
    {
        $this->start_controls_section('linkpva_contact_info_style_link', array('label' => esc_html__('Card Link', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_contact_info_style_link_typography', 'selector' => '{{WRAPPER}} .linkpva-info-card .linkpva-read-more'));
        $this->add_responsive_control('linkpva_contact_info_style_link_gap', array('label' => esc_html__('Icon Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-info-card .linkpva-read-more' => 'gap: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_info_style_link_top_spacing', array('label' => esc_html__('Top Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-info-card .linkpva-read-more' => 'margin-top: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_info_style_link_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-info-card .linkpva-read-more i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-info-card .linkpva-read-more svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
        $this->start_controls_tabs('linkpva_contact_info_style_link_tabs');
        $this->start_controls_tab('linkpva_contact_info_style_link_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
        $this->add_control('linkpva_contact_info_style_link_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-info-card .linkpva-read-more' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-info-card .linkpva-read-more svg path' => 'fill: {{VALUE}};')));
        $this->end_controls_tab();
        $this->start_controls_tab('linkpva_contact_info_style_link_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
        $this->add_control('linkpva_contact_info_style_link_hover_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-info-card .linkpva-read-more:hover, {{WRAPPER}} .linkpva-info-card .linkpva-read-more:focus-visible' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-info-card .linkpva-read-more:hover svg path, {{WRAPPER}} .linkpva-info-card .linkpva-read-more:focus-visible svg path' => 'fill: {{VALUE}};')));
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    private function get_default_items()
    {
        return array(
            array(
                'icon'           => array('value' => 'bi bi-question-circle', 'library' => 'bootstrap'),
                'title'          => esc_html__('General Questions', 'linkpva-core'),
                'description'    => esc_html__('Review answers about product types and ordering in the FAQ.', 'linkpva-core'),
                'show_link'      => 'yes',
                'link_text'      => esc_html__('View FAQ', 'linkpva-core'),
                'link_url'       => array('url' => home_url('/faq/')),
                'show_link_icon' => 'yes',
                'link_icon'      => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'),
            ),
            array(
                'icon'           => array('value' => 'bi bi-box-seam', 'library' => 'bootstrap'),
                'title'          => esc_html__('Delivery Information', 'linkpva-core'),
                'description'    => esc_html__('Understand delivery timing, confirmation, and customer responsibilities.', 'linkpva-core'),
                'show_link'      => 'yes',
                'link_text'      => esc_html__('Delivery Policy', 'linkpva-core'),
                'link_url'       => array('url' => home_url('/delivery-policy/')),
                'show_link_icon' => 'yes',
                'link_icon'      => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'),
            ),
            array(
                'icon'           => array('value' => 'bi bi-layers', 'library' => 'bootstrap'),
                'title'          => esc_html__('Bulk Requirements', 'linkpva-core'),
                'description'    => esc_html__('Submit quantity and product specifications for a tailored quotation.', 'linkpva-core'),
                'show_link'      => 'yes',
                'link_text'      => esc_html__('Bulk Order Form', 'linkpva-core'),
                'link_url'       => array('url' => home_url('/bulk-order/')),
                'show_link_icon' => 'yes',
                'link_icon'      => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'),
            ),
        );
    }

    private function normalize_contact_info_items($items)
    {
        if (!is_array($items)) {
            return array();
        }

        return array_values(array_filter($items, function ($item) {
            return is_array($item) && (!empty($item['title']) || !empty($item['description']) || !empty($item['icon']['value']));
        }));
    }

    private function render_icon($icon)
    {
        if (is_array($icon) && !empty($icon['value'])) {
            Icons_Manager::render_icon($icon, array('aria-hidden' => 'true'));
        }
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $items = $this->normalize_contact_info_items($settings['linkpva_contact_info_items'] ?? array());
        $widget_id = sanitize_html_class($this->get_id());

        if (empty($items)) {
            return;
        }
?>
        <section class="linkpva-section linkpva-surface-section linkpva-contact-info-widget" data-linkpva-contact-info-widget="<?php echo esc_attr($widget_id); ?>">
            <div class="container">
                <div class="linkpva-info-grid">
                    <?php foreach ($items as $index => $item) :
                        $show_link = 'yes' === ($item['show_link'] ?? '') && !empty($item['link_text']) && !empty($item['link_url']['url']);
                        $show_link_icon = $show_link && 'yes' === ($item['show_link_icon'] ?? '') && !empty($item['link_icon']['value']);
                        $link_key = 'linkpva_contact_info_link_' . $index;

                        if ($show_link) {
                            $this->add_link_attributes($link_key, $item['link_url']);
                            $this->add_render_attribute($link_key, 'class', 'linkpva-read-more');
                        }
                    ?>
                        <article class="linkpva-info-card">
                            <?php if (!empty($item['icon']['value'])) : ?><span class="linkpva-info-icon"><?php $this->render_icon($item['icon']); ?></span><?php endif; ?>
                            <?php if (!empty($item['title'])) : ?><h2 class="linkpva-info-title"><?php echo esc_html($item['title']); ?></h2><?php endif; ?>
                            <?php if (!empty($item['description'])) : ?><p class="linkpva-info-description"><?php echo esc_html($item['description']); ?></p><?php endif; ?>
                            <?php if ($show_link) : ?><a <?php $this->print_render_attribute_string($link_key); ?>><?php echo esc_html($item['link_text']); ?><?php if ($show_link_icon) : ?> <?php $this->render_icon($item['link_icon']); ?><?php endif; ?></a><?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new linkpva_Contact_Info_Widget());
