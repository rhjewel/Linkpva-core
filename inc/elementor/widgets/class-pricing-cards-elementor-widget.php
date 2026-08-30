<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit;
}

class linkpva_Pricing_Cards_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'linkpva_pricing_cards';
    }

    public function get_title()
    {
        return esc_html__('LinkPVA Pricing Cards', 'linkpva-core');
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
        $this->register_note_controls();
        $this->register_section_style_controls();
        $this->register_heading_style_controls();
        $this->register_grid_style_controls();
        $this->register_card_style_controls();
        $this->register_featured_style_controls();
        $this->register_badge_style_controls();
        $this->register_icon_style_controls();
        $this->register_card_content_style_controls();
        $this->register_price_style_controls();
        $this->register_features_style_controls();
        $this->register_button_style_controls();
        $this->register_note_style_controls();
    }

    private function register_heading_controls()
    {
        $this->start_controls_section('linkpva_pricing_cards_heading_content', array('label' => esc_html__('Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
        $this->add_control('linkpva_pricing_cards_show_tag', array('label' => esc_html__('Show Tag', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_pricing_cards_tag', array('label' => esc_html__('Tag', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Account Options', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_pricing_cards_show_tag' => 'yes')));
        $this->add_control('linkpva_pricing_cards_title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Choose the Right Starting Point', 'linkpva-core'), 'label_block' => true, 'rows' => 3));
        $this->add_control('linkpva_pricing_cards_show_description', array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_pricing_cards_description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Each price represents a sample starting price. Final cost depends on the selected listing and available options.', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_pricing_cards_show_description' => 'yes')));
        $this->end_controls_section();
    }

    private function register_cards_controls()
    {
        $this->start_controls_section('linkpva_pricing_cards_cards_content', array('label' => esc_html__('Pricing Cards', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
        $this->add_control('linkpva_pricing_cards_show_cards', array('label' => esc_html__('Show Cards', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_pricing_cards_show_icons', array('label' => esc_html__('Show Plan Icons', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_pricing_cards_show_cards' => 'yes')));
        $this->add_control('linkpva_pricing_cards_show_descriptions', array('label' => esc_html__('Show Descriptions', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_pricing_cards_show_cards' => 'yes')));
        $this->add_control('linkpva_pricing_cards_show_features', array('label' => esc_html__('Show Features', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_pricing_cards_show_cards' => 'yes')));
        $this->add_control('linkpva_pricing_cards_feature_icon', array('label' => esc_html__('Feature Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-check-circle-fill', 'library' => 'bootstrap'), 'condition' => array('linkpva_pricing_cards_show_cards' => 'yes', 'linkpva_pricing_cards_show_features' => 'yes')));

        $repeater = new Repeater();
        $repeater->add_control('icon', array('label' => esc_html__('Plan Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-phone', 'library' => 'bootstrap')));
        $repeater->add_control('icon_style', array('label' => esc_html__('Icon Color Style', 'linkpva-core'), 'type' => Controls_Manager::SELECT, 'default' => 'default', 'options' => array('default' => esc_html__('Cyan', 'linkpva-core'), 'purple' => esc_html__('Purple', 'linkpva-core'), 'blue' => esc_html__('Blue', 'linkpva-core'), 'green' => esc_html__('Green', 'linkpva-core'))));
        $repeater->add_control('featured', array('label' => esc_html__('Featured Plan', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => ''));
        $repeater->add_control('badge', array('label' => esc_html__('Featured Badge', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Popular', 'linkpva-core'), 'label_block' => true, 'condition' => array('featured' => 'yes')));
        $repeater->add_control('title', array('label' => esc_html__('Plan Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('PVA Account', 'linkpva-core'), 'label_block' => true));
        $repeater->add_control('description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Phone-verified account options with clear listing specifications.', 'linkpva-core'), 'label_block' => true));
        $repeater->add_control('price_prefix', array('label' => esc_html__('Price Prefix', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('From', 'linkpva-core')));
        $repeater->add_control('currency', array('label' => esc_html__('Currency', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => '$'));
        $repeater->add_control('price', array('label' => esc_html__('Price', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => '29'));
        $repeater->add_control('price_suffix', array('label' => esc_html__('Price Suffix', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('/ account', 'linkpva-core')));
        $repeater->add_control('features', array('label' => esc_html__('Features', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => "PVA information\nMultiple options\nDelivery details", 'description' => esc_html__('Add one feature per line.', 'linkpva-core'), 'rows' => 6));
        $repeater->add_control('show_button', array('label' => esc_html__('Show Button', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $repeater->add_control('button_text', array('label' => esc_html__('Button Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('View Listing', 'linkpva-core'), 'label_block' => true, 'condition' => array('show_button' => 'yes')));
        $repeater->add_control('button_link', array('label' => esc_html__('Button Link', 'linkpva-core'), 'type' => Controls_Manager::URL, 'default' => array('url' => home_url('/shop/')), 'show_external' => true, 'condition' => array('show_button' => 'yes')));
        $repeater->add_control('button_style', array('label' => esc_html__('Button Style', 'linkpva-core'), 'type' => Controls_Manager::SELECT, 'default' => 'secondary', 'options' => array('primary' => esc_html__('Primary', 'linkpva-core'), 'secondary' => esc_html__('Secondary', 'linkpva-core')), 'condition' => array('show_button' => 'yes')));
        $this->add_control('linkpva_pricing_cards_items', array('label' => esc_html__('Plans', 'linkpva-core'), 'type' => Controls_Manager::REPEATER, 'fields' => $repeater->get_controls(), 'title_field' => '{{{ title }}}', 'default' => $this->get_default_plans(), 'condition' => array('linkpva_pricing_cards_show_cards' => 'yes')));
        $this->end_controls_section();
    }

    private function register_note_controls()
    {
        $this->start_controls_section('linkpva_pricing_cards_note_content', array('label' => esc_html__('Pricing Note', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT, 'condition' => array('linkpva_pricing_cards_show_cards' => 'yes')));
        $this->add_control('linkpva_pricing_cards_show_note', array('label' => esc_html__('Show Note', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_pricing_cards_note_icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-info-circle', 'library' => 'bootstrap'), 'condition' => array('linkpva_pricing_cards_show_note' => 'yes')));
        $this->add_control('linkpva_pricing_cards_note_text', array('label' => esc_html__('Text', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Prices and specifications are sample content and should be confirmed on the selected product listing.', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_pricing_cards_show_note' => 'yes')));
        $this->end_controls_section();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section('linkpva_pricing_cards_style_section', array('label' => esc_html__('Section', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_pricing_cards_style_section_background', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-widget'));
        $this->add_responsive_control('linkpva_pricing_cards_style_section_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_heading_style_controls()
    {
        $this->start_controls_section('linkpva_pricing_cards_style_heading', array('label' => esc_html__('Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_responsive_control('linkpva_pricing_cards_style_heading_width', array('label' => esc_html__('Maximum Width', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 280, 'max' => 1200)), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-heading' => 'max-width: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_pricing_cards_style_heading_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 120)), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_pricing_cards_style_tag_color', array('label' => esc_html__('Tag Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-tag' => 'color: {{VALUE}};'), 'condition' => array('linkpva_pricing_cards_show_tag' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_pricing_cards_style_tag_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-tag', 'condition' => array('linkpva_pricing_cards_show_tag' => 'yes')));
        $this->add_responsive_control('linkpva_pricing_cards_style_tag_spacing', array('label' => esc_html__('Tag Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_pricing_cards_show_tag' => 'yes')));
        $this->add_control('linkpva_pricing_cards_style_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-title' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_pricing_cards_style_title_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-title'));
        $this->add_responsive_control('linkpva_pricing_cards_style_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-title' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_pricing_cards_style_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-description' => 'color: {{VALUE}};'), 'condition' => array('linkpva_pricing_cards_show_description' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_pricing_cards_style_description_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-description', 'condition' => array('linkpva_pricing_cards_show_description' => 'yes')));
        $this->end_controls_section();
    }

    private function register_grid_style_controls()
    {
        $this->start_controls_section('linkpva_pricing_cards_style_grid', array('label' => esc_html__('Cards Grid', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_pricing_cards_show_cards' => 'yes')));
        $this->add_responsive_control('linkpva_pricing_cards_style_grid_columns_gap', array('label' => esc_html__('Columns Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-grid' => '--bs-gutter-x: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_pricing_cards_style_grid_rows_gap', array('label' => esc_html__('Rows Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-grid' => '--bs-gutter-y: {{SIZE}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_card_style_controls()
    {
        $this->start_controls_section('linkpva_pricing_cards_style_card', array('label' => esc_html__('Plan Cards', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_pricing_cards_show_cards' => 'yes')));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_pricing_cards_style_card_background', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-plan'));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_pricing_cards_style_card_border', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-plan'));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_pricing_cards_style_card_shadow', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-plan'));
        $this->add_responsive_control('linkpva_pricing_cards_style_card_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-plan' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_pricing_cards_style_card_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-plan' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_featured_style_controls()
    {
        $this->start_controls_section('linkpva_pricing_cards_style_featured', array('label' => esc_html__('Featured Card', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_pricing_cards_show_cards' => 'yes')));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_pricing_cards_style_featured_background', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-plan.is-featured'));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_pricing_cards_style_featured_border', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-plan.is-featured'));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_pricing_cards_style_featured_shadow', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-plan.is-featured'));
        $this->end_controls_section();
    }

    private function register_badge_style_controls()
    {
        $this->start_controls_section('linkpva_pricing_cards_style_badge', array('label' => esc_html__('Featured Badge', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_pricing_cards_show_cards' => 'yes')));
        $this->add_control('linkpva_pricing_cards_style_badge_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-plan-badge' => 'color: {{VALUE}};')));
        $this->add_control('linkpva_pricing_cards_style_badge_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-plan-badge' => 'background-color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_pricing_cards_style_badge_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-plan-badge'));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_pricing_cards_style_badge_border', 'selector' => '{{WRAPPER}} .linkpva-pricing-plan-badge'));
        $this->add_responsive_control('linkpva_pricing_cards_style_badge_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-plan-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_pricing_cards_style_badge_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-plan-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_icon_style_controls()
    {
        $this->start_controls_section('linkpva_pricing_cards_style_icon', array('label' => esc_html__('Plan Icons', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_pricing_cards_show_cards' => 'yes', 'linkpva_pricing_cards_show_icons' => 'yes')));
        $this->add_control('linkpva_pricing_cards_style_icon_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-icon' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-pricing-cards-icon svg path' => 'fill: {{VALUE}};')));
        $this->add_control('linkpva_pricing_cards_style_icon_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-icon' => 'background-color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_pricing_cards_style_icon_border', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-icon'));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_pricing_cards_style_icon_shadow', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-icon'));
        $this->add_responsive_control('linkpva_pricing_cards_style_icon_box_size', array('label' => esc_html__('Box Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 20, 'max' => 120)), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; flex-basis: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_pricing_cards_style_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-icon i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-pricing-cards-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_pricing_cards_style_icon_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_pricing_cards_style_icon_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_card_content_style_controls()
    {
        $this->start_controls_section('linkpva_pricing_cards_style_content', array('label' => esc_html__('Plan Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_pricing_cards_show_cards' => 'yes')));
        $this->add_control('linkpva_pricing_cards_style_plan_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-plan h2' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_pricing_cards_style_plan_title_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-plan h2'));
        $this->add_responsive_control('linkpva_pricing_cards_style_plan_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-plan h2' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_pricing_cards_style_plan_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-plan > p' => 'color: {{VALUE}};'), 'condition' => array('linkpva_pricing_cards_show_descriptions' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_pricing_cards_style_plan_description_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-plan > p', 'condition' => array('linkpva_pricing_cards_show_descriptions' => 'yes')));
        $this->add_responsive_control('linkpva_pricing_cards_style_plan_description_height', array('label' => esc_html__('Description Minimum Height', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 200)), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-plan > p' => 'min-height: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_pricing_cards_show_descriptions' => 'yes')));
        $this->end_controls_section();
    }

    private function register_price_style_controls()
    {
        $this->start_controls_section('linkpva_pricing_cards_style_price', array('label' => esc_html__('Price', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_pricing_cards_show_cards' => 'yes')));
        $this->add_control('linkpva_pricing_cards_style_price_color', array('label' => esc_html__('Price Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-plan-price' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_pricing_cards_style_price_typography', 'selector' => '{{WRAPPER}} .linkpva-plan-price'));
        $this->add_control('linkpva_pricing_cards_style_price_affix_color', array('label' => esc_html__('Prefix & Suffix Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-plan-price small' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_pricing_cards_style_price_affix_typography', 'selector' => '{{WRAPPER}} .linkpva-plan-price small'));
        $this->add_responsive_control('linkpva_pricing_cards_style_price_gap', array('label' => esc_html__('Items Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-plan-price' => 'gap: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_pricing_cards_style_price_spacing', array('label' => esc_html__('Vertical Spacing', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-plan-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_features_style_controls()
    {
        $this->start_controls_section('linkpva_pricing_cards_style_features', array('label' => esc_html__('Features', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_pricing_cards_show_cards' => 'yes', 'linkpva_pricing_cards_show_features' => 'yes')));
        $this->add_control('linkpva_pricing_cards_style_feature_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-features li' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_pricing_cards_style_feature_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-features li'));
        $this->add_responsive_control('linkpva_pricing_cards_style_feature_gap', array('label' => esc_html__('Items Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-features' => 'gap: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_pricing_cards_style_feature_icon_gap', array('label' => esc_html__('Icon Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-features li' => 'gap: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_pricing_cards_style_feature_icon_color', array('label' => esc_html__('Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-feature-icon' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-pricing-cards-feature-icon svg path' => 'fill: {{VALUE}};')));
        $this->add_responsive_control('linkpva_pricing_cards_style_feature_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-feature-icon i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-pricing-cards-feature-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_pricing_cards_style_features_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-features' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_button_style_controls()
    {
        $this->start_controls_section('linkpva_pricing_cards_style_button', array('label' => esc_html__('Buttons', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_pricing_cards_show_cards' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_pricing_cards_style_button_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-button'));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_pricing_cards_style_button_border', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-button'));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_pricing_cards_style_button_shadow', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-button'));
        $this->add_responsive_control('linkpva_pricing_cards_style_button_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_pricing_cards_style_button_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->start_controls_tabs('linkpva_pricing_cards_style_button_states');
        $this->start_controls_tab('linkpva_pricing_cards_style_button_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
        $this->add_control('linkpva_pricing_cards_style_button_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-button' => 'color: {{VALUE}};')));
        $this->add_control('linkpva_pricing_cards_style_button_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-button' => 'background-color: {{VALUE}};')));
        $this->end_controls_tab();
        $this->start_controls_tab('linkpva_pricing_cards_style_button_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
        $this->add_control('linkpva_pricing_cards_style_button_hover_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-button:hover, {{WRAPPER}} .linkpva-pricing-cards-button:focus-visible' => 'color: {{VALUE}};')));
        $this->add_control('linkpva_pricing_cards_style_button_hover_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-button:hover, {{WRAPPER}} .linkpva-pricing-cards-button:focus-visible' => 'background-color: {{VALUE}};')));
        $this->add_control('linkpva_pricing_cards_style_button_hover_border', array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-button:hover, {{WRAPPER}} .linkpva-pricing-cards-button:focus-visible' => 'border-color: {{VALUE}};')));
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    private function register_note_style_controls()
    {
        $this->start_controls_section('linkpva_pricing_cards_style_note', array('label' => esc_html__('Pricing Note', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_pricing_cards_show_cards' => 'yes', 'linkpva_pricing_cards_show_note' => 'yes')));
        $this->add_control('linkpva_pricing_cards_style_note_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-note' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_pricing_cards_style_note_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-cards-note'));
        $this->add_control('linkpva_pricing_cards_style_note_icon_color', array('label' => esc_html__('Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-note-icon' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-pricing-cards-note-icon svg path' => 'fill: {{VALUE}};')));
        $this->add_responsive_control('linkpva_pricing_cards_style_note_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-note-icon i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-pricing-cards-note-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_pricing_cards_style_note_spacing', array('label' => esc_html__('Top Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-note' => 'margin-top: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_pricing_cards_style_note_gap', array('label' => esc_html__('Icon Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-cards-note' => 'gap: {{SIZE}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function get_default_plans()
    {
        return array(
            array('icon' => array('value' => 'bi bi-phone', 'library' => 'bootstrap'), 'icon_style' => 'default', 'featured' => '', 'badge' => '', 'title' => esc_html__('PVA Account', 'linkpva-core'), 'description' => esc_html__('Phone-verified account options with clear listing specifications.', 'linkpva-core'), 'price_prefix' => esc_html__('From', 'linkpva-core'), 'currency' => '$', 'price' => '29', 'price_suffix' => esc_html__('/ account', 'linkpva-core'), 'features' => "PVA information\nMultiple options\nDelivery details", 'show_button' => 'yes', 'button_text' => esc_html__('View PVA Listing', 'linkpva-core'), 'button_link' => array('url' => home_url('/shop/')), 'button_style' => 'secondary'),
            array('icon' => array('value' => 'bi bi-clock-history', 'library' => 'bootstrap'), 'icon_style' => 'purple', 'featured' => '', 'badge' => '', 'title' => esc_html__('Aged Account', 'linkpva-core'), 'description' => esc_html__('Established accounts available across multiple age ranges.', 'linkpva-core'), 'price_prefix' => esc_html__('From', 'linkpva-core'), 'currency' => '$', 'price' => '34', 'price_suffix' => esc_html__('/ account', 'linkpva-core'), 'features' => "3+ year options\nProfile details\nRegion options", 'show_button' => 'yes', 'button_text' => esc_html__('View Aged Listing', 'linkpva-core'), 'button_link' => array('url' => home_url('/shop/')), 'button_style' => 'secondary'),
            array('icon' => array('value' => 'bi bi-patch-check', 'library' => 'bootstrap'), 'icon_style' => 'blue', 'featured' => 'yes', 'badge' => esc_html__('Popular', 'linkpva-core'), 'title' => esc_html__('Verified Account', 'linkpva-core'), 'description' => esc_html__('Verified account listings with profile and verification information.', 'linkpva-core'), 'price_prefix' => esc_html__('From', 'linkpva-core'), 'currency' => '$', 'price' => '49', 'price_suffix' => esc_html__('/ account', 'linkpva-core'), 'features' => "Verification details\nCompleted profile\nDelivery information", 'show_button' => 'yes', 'button_text' => esc_html__('View Verified Listing', 'linkpva-core'), 'button_link' => array('url' => home_url('/shop/')), 'button_style' => 'primary'),
            array('icon' => array('value' => 'bi bi-people', 'library' => 'bootstrap'), 'icon_style' => 'green', 'featured' => '', 'badge' => '', 'title' => esc_html__('Followers Account', 'linkpva-core'), 'description' => esc_html__('Audience-based account options with stated follower ranges.', 'linkpva-core'), 'price_prefix' => esc_html__('From', 'linkpva-core'), 'currency' => '$', 'price' => '79', 'price_suffix' => esc_html__('/ account', 'linkpva-core'), 'features' => "1K+ follower range\nAccount information\nDelivery details", 'show_button' => 'yes', 'button_text' => esc_html__('View Followers Listing', 'linkpva-core'), 'button_link' => array('url' => home_url('/shop/')), 'button_style' => 'secondary'),
        );
    }

    private function parse_features($value)
    {
        $lines = preg_split('/\r\n|\r|\n/', (string) $value);
        $lines = array_map('trim', $lines);
        return array_values(array_filter($lines, static function ($line) {
            return '' !== $line;
        }));
    }

    private function normalize_plans($plans, $show_descriptions, $show_features)
    {
        if (!is_array($plans)) {
            return array();
        }

        $normalized = array();
        foreach ($plans as $plan) {
            $plan['features_list'] = $show_features ? $this->parse_features($plan['features'] ?? '') : array();
            $has_button = 'yes' === ($plan['show_button'] ?? '') && !empty($plan['button_text']) && !empty($plan['button_link']['url']);
            $has_content = !empty($plan['title']) || ($show_descriptions && !empty($plan['description'])) || !empty($plan['price']) || !empty($plan['features_list']) || $has_button;

            if ($has_content) {
                $plan['has_button'] = $has_button;
                $normalized[] = $plan;
            }
        }

        return $normalized;
    }

    private function get_icon_style_class($style)
    {
        $classes = array('purple' => 'is-purple', 'blue' => 'is-blue', 'green' => 'is-green');
        return $classes[$style] ?? '';
    }

    private function get_button_style_class($style)
    {
        return 'primary' === $style ? 'linkpva-button-primary' : 'linkpva-button-secondary';
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
        $heading_id = 'linkpva-pricing-cards-heading-' . $widget_id;
        $show_tag = 'yes' === ($settings['linkpva_pricing_cards_show_tag'] ?? '') && !empty($settings['linkpva_pricing_cards_tag']);
        $show_description = 'yes' === ($settings['linkpva_pricing_cards_show_description'] ?? '') && !empty($settings['linkpva_pricing_cards_description']);
        $show_cards = 'yes' === ($settings['linkpva_pricing_cards_show_cards'] ?? '');
        $show_icons = $show_cards && 'yes' === ($settings['linkpva_pricing_cards_show_icons'] ?? '');
        $show_descriptions = $show_cards && 'yes' === ($settings['linkpva_pricing_cards_show_descriptions'] ?? '');
        $show_features = $show_cards && 'yes' === ($settings['linkpva_pricing_cards_show_features'] ?? '');
        $plans = $show_cards ? $this->normalize_plans($settings['linkpva_pricing_cards_items'] ?? array(), $show_descriptions, $show_features) : array();
        $show_note = !empty($plans) && 'yes' === ($settings['linkpva_pricing_cards_show_note'] ?? '') && !empty($settings['linkpva_pricing_cards_note_text']);
        $has_title = !empty($settings['linkpva_pricing_cards_title']);
        $has_heading = $show_tag || $has_title || $show_description;

        if (!$has_heading && empty($plans)) {
            return;
        }
?>
        <section class="linkpva-inner-section linkpva-pricing-cards-widget" data-linkpva-pricing-cards-widget="<?php echo esc_attr($widget_id); ?>" <?php if ($has_title) : ?> aria-labelledby="<?php echo esc_attr($heading_id); ?>" <?php endif; ?>>
            <div class="container">
                <?php if ($has_heading) : ?>
                    <div class="linkpva-section-heading text-center linkpva-pricing-cards-heading">
                        <?php if ($show_tag) : ?><span class="linkpva-section-tag linkpva-pricing-cards-tag"><?php echo esc_html($settings['linkpva_pricing_cards_tag']); ?></span><?php endif; ?>
                        <?php if ($has_title) : ?><h2 id="<?php echo esc_attr($heading_id); ?>" class="linkpva-pricing-cards-title"><?php echo esc_html($settings['linkpva_pricing_cards_title']); ?></h2><?php endif; ?>
                        <?php if ($show_description) : ?><p class="linkpva-pricing-cards-description"><?php echo esc_html($settings['linkpva_pricing_cards_description']); ?></p><?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($plans)) : ?>
                    <div class="row g-4 align-items-stretch linkpva-pricing-cards-grid">
                        <?php foreach ($plans as $index => $plan) :
                            $is_featured = 'yes' === ($plan['featured'] ?? '');
                            $icon_class = $this->get_icon_style_class($plan['icon_style'] ?? 'default');
                            $button_class = $this->get_button_style_class($plan['button_style'] ?? 'secondary');
                            $button_key = 'linkpva_pricing_cards_button_' . $index;
                            if (!empty($plan['has_button'])) {
                                $this->add_link_attributes($button_key, $plan['button_link']);
                                $this->add_render_attribute($button_key, 'class', array('linkpva-button', $button_class, 'linkpva-pricing-cards-button'));
                            }
                        ?>
                            <div class="col-md-6 col-xl-3">
                                <article class="linkpva-pricing-plan linkpva-pricing-cards-plan<?php echo $is_featured ? ' is-featured' : ''; ?>">
                                    <?php if ($is_featured && !empty($plan['badge'])) : ?><span class="linkpva-pricing-plan-badge"><?php echo esc_html($plan['badge']); ?></span><?php endif; ?>
                                    <?php if ($show_icons && !empty($plan['icon']['value'])) : ?><span class="linkpva-price-icon linkpva-pricing-cards-icon<?php echo $icon_class ? ' ' . esc_attr($icon_class) : ''; ?>"><?php $this->render_icon($plan['icon']); ?></span><?php endif; ?>
                                    <?php if (!empty($plan['title'])) : ?><h2><?php echo esc_html($plan['title']); ?></h2><?php endif; ?>
                                    <?php if ($show_descriptions && !empty($plan['description'])) : ?><p><?php echo esc_html($plan['description']); ?></p><?php endif; ?>
                                    <?php if (!empty($plan['price']) || !empty($plan['currency']) || !empty($plan['price_prefix']) || !empty($plan['price_suffix'])) : ?>
                                        <div class="linkpva-plan-price">
                                            <?php if (!empty($plan['price_prefix'])) : ?><small><?php echo esc_html($plan['price_prefix']); ?></small><?php endif; ?>
                                            <span class="linkpva-plan-price-value"><?php echo esc_html(($plan['currency'] ?? '') . ($plan['price'] ?? '')); ?></span>
                                            <?php if (!empty($plan['price_suffix'])) : ?><small><?php echo esc_html($plan['price_suffix']); ?></small><?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($plan['features_list'])) : ?>
                                        <ul class="linkpva-pricing-cards-features">
                                            <?php foreach ($plan['features_list'] as $feature) : ?><li><?php if (!empty($settings['linkpva_pricing_cards_feature_icon']['value'])) : ?><span class="linkpva-pricing-cards-feature-icon"><?php $this->render_icon($settings['linkpva_pricing_cards_feature_icon']); ?></span><?php endif; ?><?php echo esc_html($feature); ?></li><?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                    <?php if (!empty($plan['has_button'])) : ?><a <?php $this->print_render_attribute_string($button_key); ?>><?php echo esc_html($plan['button_text']); ?></a><?php endif; ?>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if ($show_note) : ?><p class="linkpva-pricing-note linkpva-pricing-cards-note"><?php if (!empty($settings['linkpva_pricing_cards_note_icon']['value'])) : ?><span class="linkpva-pricing-cards-note-icon"><?php $this->render_icon($settings['linkpva_pricing_cards_note_icon']); ?></span><?php endif; ?><?php echo esc_html($settings['linkpva_pricing_cards_note_text']); ?></p><?php endif; ?>
                <?php endif; ?>
            </div>
        </section>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new linkpva_Pricing_Cards_Widget());
