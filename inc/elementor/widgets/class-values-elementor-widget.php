<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit;
}

class linkpva_Values_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'linkpva_values';
    }

    public function get_title()
    {
        return esc_html__('LinkPVA Values', 'linkpva-core');
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
        $this->register_heading_controls();
        $this->register_cards_controls();
        $this->register_section_style_controls();
        $this->register_heading_style_controls();
        $this->register_grid_style_controls();
        $this->register_card_style_controls();
        $this->register_icon_style_controls();
        $this->register_card_content_style_controls();
    }

    private function register_heading_controls()
    {
        $this->start_controls_section('linkpva_values_heading_content', array('label' => esc_html__('Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
        $this->add_control('linkpva_values_show_tag', array('label' => esc_html__('Show Tag', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_values_tag', array('label' => esc_html__('Tag', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Marketplace Values', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_values_show_tag' => 'yes')));
        $this->add_control('linkpva_values_title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('What Guides the Experience', 'linkpva-core'), 'label_block' => true, 'rows' => 3));
        $this->add_control('linkpva_values_show_description', array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_values_description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Practical principles for presenting listings and supporting customers.', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_values_show_description' => 'yes')));
        $this->end_controls_section();
    }

    private function register_cards_controls()
    {
        $this->start_controls_section('linkpva_values_cards_content', array('label' => esc_html__('Value Cards', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
        $this->add_control('linkpva_values_show_cards', array('label' => esc_html__('Show Cards', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_values_show_icons', array('label' => esc_html__('Show Icons', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_values_show_cards' => 'yes')));
        $this->add_control('linkpva_values_show_card_descriptions', array('label' => esc_html__('Show Descriptions', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_values_show_cards' => 'yes')));

        $repeater = new Repeater();
        $repeater->add_control('icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-eye', 'library' => 'bootstrap')));
        $repeater->add_control('title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Transparency', 'linkpva-core'), 'label_block' => true));
        $repeater->add_control('description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Product claims should be specific, understandable, and supportable.', 'linkpva-core'), 'label_block' => true));
        $this->add_control('linkpva_values_cards', array('label' => esc_html__('Cards', 'linkpva-core'), 'type' => Controls_Manager::REPEATER, 'fields' => $repeater->get_controls(), 'title_field' => '{{{ title }}}', 'default' => $this->get_default_cards(), 'condition' => array('linkpva_values_show_cards' => 'yes')));
        $this->end_controls_section();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section('linkpva_values_style_section', array('label' => esc_html__('Section', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_values_style_section_background', 'selector' => '{{WRAPPER}} .linkpva-values-widget'));
        $this->add_responsive_control('linkpva_values_style_section_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-values-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_heading_style_controls()
    {
        $this->start_controls_section('linkpva_values_style_heading', array('label' => esc_html__('Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_responsive_control('linkpva_values_style_heading_width', array('label' => esc_html__('Maximum Width', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 280, 'max' => 1200)), 'selectors' => array('{{WRAPPER}} .linkpva-values-heading' => 'max-width: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_values_style_heading_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 120)), 'selectors' => array('{{WRAPPER}} .linkpva-values-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_values_style_tag_color', array('label' => esc_html__('Tag Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-values-tag' => 'color: {{VALUE}};'), 'condition' => array('linkpva_values_show_tag' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_values_style_tag_typography', 'selector' => '{{WRAPPER}} .linkpva-values-tag', 'condition' => array('linkpva_values_show_tag' => 'yes')));
        $this->add_responsive_control('linkpva_values_style_tag_spacing', array('label' => esc_html__('Tag Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-values-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_values_show_tag' => 'yes')));
        $this->add_control('linkpva_values_style_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-values-title' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_values_style_title_typography', 'selector' => '{{WRAPPER}} .linkpva-values-title'));
        $this->add_responsive_control('linkpva_values_style_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-values-title' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_values_style_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-values-description' => 'color: {{VALUE}};'), 'condition' => array('linkpva_values_show_description' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_values_style_description_typography', 'selector' => '{{WRAPPER}} .linkpva-values-description', 'condition' => array('linkpva_values_show_description' => 'yes')));
        $this->end_controls_section();
    }

    private function register_grid_style_controls()
    {
        $this->start_controls_section('linkpva_values_style_grid', array('label' => esc_html__('Cards Grid', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_values_show_cards' => 'yes')));
        $this->add_responsive_control('linkpva_values_style_grid_columns_gap', array('label' => esc_html__('Columns Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-values-grid' => '--bs-gutter-x: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_values_style_grid_rows_gap', array('label' => esc_html__('Rows Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-values-grid' => '--bs-gutter-y: {{SIZE}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_card_style_controls()
    {
        $this->start_controls_section('linkpva_values_style_card', array('label' => esc_html__('Cards', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_values_show_cards' => 'yes')));
        $this->add_responsive_control('linkpva_values_style_card_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-values-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_values_style_card_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-values-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->start_controls_tabs('linkpva_values_style_card_states');
        $this->start_controls_tab('linkpva_values_style_card_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_values_style_card_background', 'selector' => '{{WRAPPER}} .linkpva-values-card'));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_values_style_card_border', 'selector' => '{{WRAPPER}} .linkpva-values-card'));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_values_style_card_shadow', 'selector' => '{{WRAPPER}} .linkpva-values-card'));
        $this->end_controls_tab();
        $this->start_controls_tab('linkpva_values_style_card_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
        $this->add_control('linkpva_values_style_card_hover_background', array('label' => esc_html__('Background Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-values-card:hover' => 'background-color: {{VALUE}};')));
        $this->add_control('linkpva_values_style_card_hover_border', array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-values-card:hover' => 'border-color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_values_style_card_hover_shadow', 'selector' => '{{WRAPPER}} .linkpva-values-card:hover'));
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    private function register_icon_style_controls()
    {
        $this->start_controls_section('linkpva_values_style_icon', array('label' => esc_html__('Card Icons', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_values_show_cards' => 'yes', 'linkpva_values_show_icons' => 'yes')));
        $this->add_control('linkpva_values_style_icon_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-values-icon' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-values-icon svg path' => 'fill: {{VALUE}};')));
        $this->add_control('linkpva_values_style_icon_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-values-icon' => 'background-color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_values_style_icon_border', 'selector' => '{{WRAPPER}} .linkpva-values-icon'));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_values_style_icon_shadow', 'selector' => '{{WRAPPER}} .linkpva-values-icon'));
        $this->add_responsive_control('linkpva_values_style_icon_box_size', array('label' => esc_html__('Box Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 20, 'max' => 120)), 'selectors' => array('{{WRAPPER}} .linkpva-values-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_values_style_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-values-icon i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-values-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_values_style_icon_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-values-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_values_style_icon_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-values-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_card_content_style_controls()
    {
        $this->start_controls_section('linkpva_values_style_card_content', array('label' => esc_html__('Card Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_values_show_cards' => 'yes')));
        $this->add_control('linkpva_values_style_card_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-values-card h3' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_values_style_card_title_typography', 'selector' => '{{WRAPPER}} .linkpva-values-card h3'));
        $this->add_responsive_control('linkpva_values_style_card_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-values-card h3' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_values_style_card_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-values-card p' => 'color: {{VALUE}};'), 'condition' => array('linkpva_values_show_card_descriptions' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_values_style_card_description_typography', 'selector' => '{{WRAPPER}} .linkpva-values-card p', 'condition' => array('linkpva_values_show_card_descriptions' => 'yes')));
        $this->end_controls_section();
    }

    private function get_default_cards()
    {
        return array(
            array('icon' => array('value' => 'bi bi-eye', 'library' => 'bootstrap'), 'title' => esc_html__('Transparency', 'linkpva-core'), 'description' => esc_html__('Product claims should be specific, understandable, and supportable.', 'linkpva-core')),
            array('icon' => array('value' => 'bi bi-shield-check', 'library' => 'bootstrap'), 'title' => esc_html__('Responsible Handling', 'linkpva-core'), 'description' => esc_html__('Only necessary customer and order information should be collected.', 'linkpva-core')),
            array('icon' => array('value' => 'bi bi-person-check', 'library' => 'bootstrap'), 'title' => esc_html__('Customer Clarity', 'linkpva-core'), 'description' => esc_html__('Delivery and policy conditions should be visible before purchase.', 'linkpva-core')),
            array('icon' => array('value' => 'bi bi-arrow-repeat', 'library' => 'bootstrap'), 'title' => esc_html__('Continuous Review', 'linkpva-core'), 'description' => esc_html__('Content and processes should be updated as business requirements change.', 'linkpva-core')),
        );
    }

    private function normalize_cards($cards, $show_descriptions)
    {
        if (!is_array($cards)) {
            return array();
        }

        return array_values(array_filter($cards, static function ($card) use ($show_descriptions) {
            return !empty($card['title']) || ($show_descriptions && !empty($card['description']));
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
        $widget_id = sanitize_html_class($this->get_id());
        $heading_id = 'linkpva-values-heading-' . $widget_id;
        $show_tag = 'yes' === ($settings['linkpva_values_show_tag'] ?? '') && !empty($settings['linkpva_values_tag']);
        $show_description = 'yes' === ($settings['linkpva_values_show_description'] ?? '') && !empty($settings['linkpva_values_description']);
        $show_cards = 'yes' === ($settings['linkpva_values_show_cards'] ?? '');
        $show_icons = $show_cards && 'yes' === ($settings['linkpva_values_show_icons'] ?? '');
        $show_card_descriptions = $show_cards && 'yes' === ($settings['linkpva_values_show_card_descriptions'] ?? '');
        $cards = $show_cards ? $this->normalize_cards($settings['linkpva_values_cards'] ?? array(), $show_card_descriptions) : array();
        $has_title = !empty($settings['linkpva_values_title']);
        $has_heading = $show_tag || $has_title || $show_description;

        if (!$has_heading && empty($cards)) {
            return;
        }
?>
        <section class="linkpva-section linkpva-surface-section linkpva-values-widget" data-linkpva-values-widget="<?php echo esc_attr($widget_id); ?>" <?php if ($has_title) : ?> aria-labelledby="<?php echo esc_attr($heading_id); ?>" <?php endif; ?>>
            <div class="container">
                <?php if ($has_heading) : ?>
                    <div class="linkpva-section-heading text-center linkpva-values-heading">
                        <?php if ($show_tag) : ?><span class="linkpva-section-tag linkpva-values-tag"><?php echo esc_html($settings['linkpva_values_tag']); ?></span><?php endif; ?>
                        <?php if ($has_title) : ?><h2 id="<?php echo esc_attr($heading_id); ?>" class="linkpva-values-title"><?php echo esc_html($settings['linkpva_values_title']); ?></h2><?php endif; ?>
                        <?php if ($show_description) : ?><p class="linkpva-values-description"><?php echo esc_html($settings['linkpva_values_description']); ?></p><?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($cards)) : ?>
                    <div class="row g-4 linkpva-values-grid">
                        <?php foreach ($cards as $card) : ?>
                            <div class="col-md-6 col-lg-3">
                                <article class="linkpva-benefit-card linkpva-values-card">
                                    <?php if ($show_icons && !empty($card['icon']['value'])) : ?><span class="linkpva-values-icon"><?php $this->render_icon($card['icon']); ?></span><?php endif; ?>
                                    <?php if (!empty($card['title'])) : ?><h3><?php echo esc_html($card['title']); ?></h3><?php endif; ?>
                                    <?php if ($show_card_descriptions && !empty($card['description'])) : ?><p><?php echo esc_html($card['description']); ?></p><?php endif; ?>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new linkpva_Values_Widget());
