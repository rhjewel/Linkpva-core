<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit;
}

class linkpva_Product_Category_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'linkpva_product_category';
    }

    public function get_title()
    {
        return esc_html__('LinkPVA Product Category', 'linkpva-core');
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
        $this->register_query_controls();
        $this->register_card_content_controls();
        $this->register_section_style_controls();
        $this->register_heading_style_controls();
        $this->register_grid_style_controls();
        $this->register_card_style_controls();
        $this->register_decoration_style_controls();
        $this->register_thumbnail_style_controls();
        $this->register_number_style_controls();
        $this->register_content_style_controls();
        $this->register_link_style_controls();
    }

    private function register_heading_controls()
    {
        $this->start_controls_section('linkpva_product_category_content_heading', array(
            'label' => esc_html__('Heading', 'linkpva-core'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ));
        $this->add_control('linkpva_product_category_show_heading', array('label' => esc_html__('Show Heading', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_product_category_show_tag', array('label' => esc_html__('Show Tag', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_product_category_show_heading' => 'yes')));
        $this->add_control('linkpva_product_category_tag', array('label' => esc_html__('Tag', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Account Categories', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_product_category_show_heading' => 'yes', 'linkpva_product_category_show_tag' => 'yes')));
        $this->add_control('linkpva_product_category_title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Shop LinkedIn Accounts by Type', 'linkpva-core'), 'label_block' => true, 'rows' => 3, 'condition' => array('linkpva_product_category_show_heading' => 'yes')));
        $this->add_control('linkpva_product_category_show_description', array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_product_category_show_heading' => 'yes')));
        $this->add_control('linkpva_product_category_description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Explore account categories and compare the details that matter to your requirements.', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_product_category_show_heading' => 'yes', 'linkpva_product_category_show_description' => 'yes')));
        $this->end_controls_section();
    }

    private function register_query_controls()
    {
        $this->start_controls_section('linkpva_product_category_content_query', array(
            'label' => esc_html__('Query', 'linkpva-core'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ));
        $this->add_control('linkpva_product_category_query_categories', array(
            'label' => esc_html__('Select Categories', 'linkpva-core'),
            'type' => Controls_Manager::SELECT2,
            'options' => $this->get_product_category_options(),
            'multiple' => true,
            'label_block' => true,
            'description' => esc_html__('Selected categories use the selected order and override the parent filter.', 'linkpva-core'),
        ));
        $this->add_control('linkpva_product_category_query_scope', array(
            'label' => esc_html__('Category Scope', 'linkpva-core'),
            'type' => Controls_Manager::SELECT,
            'default' => 'top_level',
            'options' => array(
                'all' => esc_html__('All Categories', 'linkpva-core'),
                'top_level' => esc_html__('Top Level Only', 'linkpva-core'),
                'children' => esc_html__('Children of Category', 'linkpva-core'),
            ),
        ));
        $this->add_control('linkpva_product_category_query_parent', array(
            'label' => esc_html__('Parent Category', 'linkpva-core'),
            'type' => Controls_Manager::SELECT2,
            'options' => $this->get_product_category_options(),
            'label_block' => true,
            'condition' => array('linkpva_product_category_query_scope' => 'children'),
        ));
        $this->add_control('linkpva_product_category_query_limit', array(
            'label' => esc_html__('Number of Categories', 'linkpva-core'),
            'type' => Controls_Manager::NUMBER,
            'default' => 4,
            'min' => 1,
            'max' => 24,
            'step' => 1,
        ));
        $this->add_control('linkpva_product_category_query_hide_empty', array('label' => esc_html__('Hide Empty Categories', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_product_category_query_orderby', array(
            'label' => esc_html__('Order By', 'linkpva-core'),
            'type' => Controls_Manager::SELECT,
            'default' => 'name',
            'options' => array(
                'name' => esc_html__('Name', 'linkpva-core'),
                'slug' => esc_html__('Slug', 'linkpva-core'),
                'count' => esc_html__('Product Count', 'linkpva-core'),
                'term_id' => esc_html__('Term ID', 'linkpva-core'),
            ),
        ));
        $this->add_control('linkpva_product_category_query_order', array(
            'label' => esc_html__('Order', 'linkpva-core'),
            'type' => Controls_Manager::SELECT,
            'default' => 'ASC',
            'options' => array('ASC' => esc_html__('Ascending', 'linkpva-core'), 'DESC' => esc_html__('Descending', 'linkpva-core')),
        ));
        $this->end_controls_section();
    }

    private function register_card_content_controls()
    {
        $this->start_controls_section('linkpva_product_category_content_cards', array(
            'label' => esc_html__('Card Content', 'linkpva-core'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ));
        $this->add_control('linkpva_product_category_show_number', array('label' => esc_html__('Show Card Number', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_product_category_show_thumbnail', array('label' => esc_html__('Show Category Thumbnail', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_product_category_show_term_description', array('label' => esc_html__('Show Category Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_product_category_description_words', array('label' => esc_html__('Description Words', 'linkpva-core'), 'type' => Controls_Manager::NUMBER, 'default' => 16, 'min' => 1, 'max' => 80, 'condition' => array('linkpva_product_category_show_term_description' => 'yes')));
        $this->add_control('linkpva_product_category_show_link', array('label' => esc_html__('Show Category Link', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_product_category_link_text', array('label' => esc_html__('Link Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Explore category', 'linkpva-core'), 'condition' => array('linkpva_product_category_show_link' => 'yes')));
        $this->add_control('linkpva_product_category_link_icon', array('label' => esc_html__('Link Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-arrow-up-right', 'library' => 'bootstrap'), 'condition' => array('linkpva_product_category_show_link' => 'yes')));
        $this->end_controls_section();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section('linkpva_product_category_style_section', array('label' => esc_html__('Section', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_product_category_style_section_background', 'selector' => '{{WRAPPER}} .linkpva-categories'));
        $this->add_responsive_control('linkpva_product_category_style_section_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-categories' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_heading_style_controls()
    {
        $this->start_controls_section('linkpva_product_category_style_heading', array('label' => esc_html__('Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_product_category_show_heading' => 'yes')));
        $this->add_responsive_control('linkpva_product_category_style_heading_width', array('label' => esc_html__('Maximum Width', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 280, 'max' => 1200)), 'selectors' => array('{{WRAPPER}} .linkpva-section-heading' => 'max-width: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_product_category_style_heading_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 160)), 'selectors' => array('{{WRAPPER}} .linkpva-section-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_product_category_style_tag_color', array('label' => esc_html__('Tag Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-section-tag' => 'color: {{VALUE}};'), 'condition' => array('linkpva_product_category_show_tag' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_product_category_style_tag_typography', 'selector' => '{{WRAPPER}} .linkpva-section-tag', 'condition' => array('linkpva_product_category_show_tag' => 'yes')));
        $this->add_responsive_control('linkpva_product_category_style_tag_spacing', array('label' => esc_html__('Tag Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-section-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_product_category_show_tag' => 'yes')));
        $this->add_control('linkpva_product_category_style_heading_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-section-heading h2' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_product_category_style_heading_title_typography', 'selector' => '{{WRAPPER}} .linkpva-section-heading h2'));
        $this->add_responsive_control('linkpva_product_category_style_heading_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-section-heading h2' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_product_category_style_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-section-heading p' => 'color: {{VALUE}};'), 'condition' => array('linkpva_product_category_show_description' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_product_category_style_description_typography', 'selector' => '{{WRAPPER}} .linkpva-section-heading p', 'condition' => array('linkpva_product_category_show_description' => 'yes')));
        $this->end_controls_section();
    }

    private function register_grid_style_controls()
    {
        $this->start_controls_section('linkpva_product_category_style_grid', array('label' => esc_html__('Grid', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_responsive_control('linkpva_product_category_style_column_gap', array('label' => esc_html__('Column Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-product-category-grid' => '--bs-gutter-x: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_product_category_style_row_gap', array('label' => esc_html__('Row Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-product-category-grid' => '--bs-gutter-y: {{SIZE}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_card_style_controls()
    {
        $this->start_controls_section('linkpva_product_category_style_card', array('label' => esc_html__('Cards', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_responsive_control('linkpva_product_category_style_card_height', array('label' => esc_html__('Minimum Height', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 180, 'max' => 700)), 'selectors' => array('{{WRAPPER}} .linkpva-category-card' => 'min-height: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_product_category_style_card_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-category-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_product_category_style_card_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-category-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->start_controls_tabs('linkpva_product_category_style_card_tabs');
        $this->start_controls_tab('linkpva_product_category_style_card_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_product_category_style_card_background', 'selector' => '{{WRAPPER}} .linkpva-category-card'));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_product_category_style_card_border', 'selector' => '{{WRAPPER}} .linkpva-category-card'));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_product_category_style_card_shadow', 'selector' => '{{WRAPPER}} .linkpva-category-card'));
        $this->end_controls_tab();
        $this->start_controls_tab('linkpva_product_category_style_card_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_product_category_style_card_hover_background', 'selector' => '{{WRAPPER}} .linkpva-category-card:hover'));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_product_category_style_card_hover_border', 'selector' => '{{WRAPPER}} .linkpva-category-card:hover'));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_product_category_style_card_hover_shadow', 'selector' => '{{WRAPPER}} .linkpva-category-card:hover'));
        $this->add_control('linkpva_product_category_style_card_hover_lift', array('label' => esc_html__('Lift', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 30)), 'selectors' => array('{{WRAPPER}} .linkpva-category-card:hover' => 'transform: translateY(-{{SIZE}}{{UNIT}});')));
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    private function register_decoration_style_controls()
    {
        $this->start_controls_section('linkpva_product_category_style_decoration', array('label' => esc_html__('Card Decoration', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_control('linkpva_product_category_style_decoration_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-category-card::after' => 'background-color: {{VALUE}};')));
        $this->add_responsive_control('linkpva_product_category_style_decoration_size', array('label' => esc_html__('Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 20, 'max' => 300)), 'selectors' => array('{{WRAPPER}} .linkpva-category-card::after' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_product_category_style_decoration_opacity', array('label' => esc_html__('Opacity', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 1, 'step' => 0.05)), 'selectors' => array('{{WRAPPER}} .linkpva-category-card::after' => 'opacity: {{SIZE}};')));
        $this->add_responsive_control('linkpva_product_category_style_decoration_right', array('label' => esc_html__('Right Position', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => -150, 'max' => 150)), 'selectors' => array('{{WRAPPER}} .linkpva-category-card::after' => 'right: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_product_category_style_decoration_bottom', array('label' => esc_html__('Bottom Position', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => -150, 'max' => 150)), 'selectors' => array('{{WRAPPER}} .linkpva-category-card::after' => 'bottom: {{SIZE}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_thumbnail_style_controls()
    {
        $this->start_controls_section('linkpva_product_category_style_thumbnail', array('label' => esc_html__('Category Thumbnail', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_product_category_show_thumbnail' => 'yes')));
        $this->add_responsive_control('linkpva_product_category_style_thumbnail_box_size', array('label' => esc_html__('Box Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 24, 'max' => 140)), 'selectors' => array('{{WRAPPER}} .linkpva-category-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_product_category_style_thumbnail_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-category-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_control('linkpva_product_category_style_thumbnail_fit', array('label' => esc_html__('Image Fit', 'linkpva-core'), 'type' => Controls_Manager::SELECT, 'default' => 'cover', 'options' => array('cover' => esc_html__('Cover', 'linkpva-core'), 'contain' => esc_html__('Contain', 'linkpva-core')), 'selectors' => array('{{WRAPPER}} .linkpva-category-icon img' => 'object-fit: {{VALUE}};')));
        $variants = array(
            'primary' => array(esc_html__('Primary', 'linkpva-core'), '.linkpva-category-card:not(.is-purple):not(.is-cyan):not(.is-green)'),
            'purple' => array(esc_html__('Purple', 'linkpva-core'), '.linkpva-category-card.is-purple'),
            'cyan' => array(esc_html__('Cyan', 'linkpva-core'), '.linkpva-category-card.is-cyan'),
            'green' => array(esc_html__('Green', 'linkpva-core'), '.linkpva-category-card.is-green'),
        );
        foreach ($variants as $key => $variant) {
            $this->add_control('linkpva_product_category_style_thumbnail_' . $key . '_heading', array('label' => $variant[0], 'type' => Controls_Manager::HEADING, 'separator' => 'before'));
            $this->add_control('linkpva_product_category_style_thumbnail_' . $key . '_background', array('label' => esc_html__('Background Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} ' . $variant[1] . ' .linkpva-category-icon' => 'background-color: {{VALUE}};')));
        }
        $this->end_controls_section();
    }

    private function register_number_style_controls()
    {
        $this->start_controls_section('linkpva_product_category_style_number', array('label' => esc_html__('Card Number', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_product_category_show_number' => 'yes')));
        $this->add_control('linkpva_product_category_style_number_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-card-number' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_product_category_style_number_typography', 'selector' => '{{WRAPPER}} .linkpva-card-number'));
        $this->add_responsive_control('linkpva_product_category_style_number_top', array('label' => esc_html__('Top Position', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-card-number' => 'top: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_product_category_style_number_right', array('label' => esc_html__('Right Position', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-card-number' => 'right: {{SIZE}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_content_style_controls()
    {
        $this->start_controls_section('linkpva_product_category_style_content', array('label' => esc_html__('Card Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_control('linkpva_product_category_style_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-category-card h3' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_product_category_style_card_title_typography', 'selector' => '{{WRAPPER}} .linkpva-category-card h3'));
        $this->add_responsive_control('linkpva_product_category_style_card_title_spacing', array('label' => esc_html__('Title Top Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-category-card h3' => 'margin-top: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_product_category_style_card_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-category-card p' => 'color: {{VALUE}};'), 'condition' => array('linkpva_product_category_show_term_description' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_product_category_style_card_description_typography', 'selector' => '{{WRAPPER}} .linkpva-category-card p', 'condition' => array('linkpva_product_category_show_term_description' => 'yes')));
        $this->add_responsive_control('linkpva_product_category_style_card_description_spacing', array('label' => esc_html__('Description Top Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-category-card p' => 'margin-top: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_product_category_show_term_description' => 'yes')));
        $this->end_controls_section();
    }

    private function register_link_style_controls()
    {
        $this->start_controls_section('linkpva_product_category_style_link', array('label' => esc_html__('Category Link', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_product_category_show_link' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_product_category_style_link_typography', 'selector' => '{{WRAPPER}} .linkpva-category-card a'));
        $this->add_responsive_control('linkpva_product_category_style_link_gap', array('label' => esc_html__('Icon Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 40)), 'selectors' => array('{{WRAPPER}} .linkpva-category-card a' => 'gap: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_product_category_style_link_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 8, 'max' => 50)), 'selectors' => array('{{WRAPPER}} .linkpva-category-card a i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-category-card a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_product_category_style_link_bottom', array('label' => esc_html__('Bottom Position', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 120)), 'selectors' => array('{{WRAPPER}} .linkpva-category-card a' => 'bottom: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_product_category_style_link_left', array('label' => esc_html__('Left Position', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 120)), 'selectors' => array('{{WRAPPER}} .linkpva-category-card a' => 'left: {{SIZE}}{{UNIT}};')));
        $this->start_controls_tabs('linkpva_product_category_style_link_tabs');
        $this->start_controls_tab('linkpva_product_category_style_link_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
        $this->add_control('linkpva_product_category_style_link_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-category-card a' => 'color: {{VALUE}};')));
        $this->end_controls_tab();
        $this->start_controls_tab('linkpva_product_category_style_link_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
        $this->add_control('linkpva_product_category_style_link_hover_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-category-card a:hover, {{WRAPPER}} .linkpva-category-card a:focus-visible' => 'color: {{VALUE}};')));
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    private function get_product_category_options()
    {
        $options = array();
        if (!taxonomy_exists('product_cat')) {
            return $options;
        }
        $terms = get_terms(array('taxonomy' => 'product_cat', 'hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC'));
        if (is_wp_error($terms)) {
            return $options;
        }
        foreach ($terms as $term) {
            $options[$term->term_id] = $term->name;
        }
        return $options;
    }

    private function get_queried_categories($settings)
    {
        if (!taxonomy_exists('product_cat')) {
            return array();
        }
        $allowed_orderby = array('name', 'slug', 'count', 'term_id');
        $orderby = in_array($settings['linkpva_product_category_query_orderby'] ?? '', $allowed_orderby, true) ? $settings['linkpva_product_category_query_orderby'] : 'name';
        $order = 'DESC' === ($settings['linkpva_product_category_query_order'] ?? '') ? 'DESC' : 'ASC';
        $limit = max(1, min(24, absint($settings['linkpva_product_category_query_limit'] ?? 4)));
        $selected = array_values(array_filter(array_map('absint', (array) ($settings['linkpva_product_category_query_categories'] ?? array()))));
        $args = array(
            'taxonomy' => 'product_cat',
            'hide_empty' => 'yes' === ($settings['linkpva_product_category_query_hide_empty'] ?? ''),
            'number' => $limit,
            'orderby' => $orderby,
            'order' => $order,
        );
        if ($selected) {
            $args['include'] = $selected;
            $args['orderby'] = 'include';
            $args['order'] = 'ASC';
        } else {
            $scope = in_array($settings['linkpva_product_category_query_scope'] ?? '', array('all', 'top_level', 'children'), true) ? $settings['linkpva_product_category_query_scope'] : 'top_level';
            if ('top_level' === $scope) {
                $args['parent'] = 0;
            } elseif ('children' === $scope) {
                $args['parent'] = absint($settings['linkpva_product_category_query_parent'] ?? 0);
            }
        }
        $terms = get_terms($args);
        return is_wp_error($terms) ? array() : $terms;
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
        $terms = $this->get_queried_categories($settings);
        if (!$terms) {
            return;
        }
        $widget_id = sanitize_html_class($this->get_id());
        $section_id = 'linkpva-account-types-' . $widget_id;
        $heading_id = 'linkpva-categories-heading-' . $widget_id;
        $show_heading = 'yes' === ($settings['linkpva_product_category_show_heading'] ?? '');
        $show_tag = $show_heading && 'yes' === ($settings['linkpva_product_category_show_tag'] ?? '') && !empty($settings['linkpva_product_category_tag']);
        $show_description = $show_heading && 'yes' === ($settings['linkpva_product_category_show_description'] ?? '') && !empty($settings['linkpva_product_category_description']);
        $has_title = $show_heading && !empty($settings['linkpva_product_category_title']);
        $show_number = 'yes' === ($settings['linkpva_product_category_show_number'] ?? '');
        $show_thumbnail = 'yes' === ($settings['linkpva_product_category_show_thumbnail'] ?? '');
        $show_term_description = 'yes' === ($settings['linkpva_product_category_show_term_description'] ?? '');
        $show_link = 'yes' === ($settings['linkpva_product_category_show_link'] ?? '') && !empty($settings['linkpva_product_category_link_text']);
        $description_words = max(1, min(80, absint($settings['linkpva_product_category_description_words'] ?? 16)));
        $styles = array('', 'is-purple', 'is-cyan', 'is-green');
?>
        <section id="<?php echo esc_attr($section_id); ?>" class="linkpva-section linkpva-categories linkpva-product-category-widget" data-linkpva-product-category-widget="<?php echo esc_attr($widget_id); ?>" <?php if ($has_title) : ?> aria-labelledby="<?php echo esc_attr($heading_id); ?>" <?php endif; ?>>
            <div class="container">
                <?php if ($has_title || $show_tag || $show_description) : ?>
                    <div class="linkpva-section-heading text-center">
                        <?php if ($show_tag) : ?><span class="linkpva-section-tag"><?php echo esc_html($settings['linkpva_product_category_tag']); ?></span><?php endif; ?>
                        <?php if ($has_title) : ?><h2 id="<?php echo esc_attr($heading_id); ?>"><?php echo esc_html($settings['linkpva_product_category_title']); ?></h2><?php endif; ?>
                        <?php if ($show_description) : ?><p><?php echo esc_html($settings['linkpva_product_category_description']); ?></p><?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="row g-4 linkpva-product-category-grid">
                    <?php foreach ($terms as $index => $term) :
                        $term_link = get_term_link($term);
                        if (is_wp_error($term_link)) {
                            continue;
                        }
                        $style = $styles[$index % count($styles)];
                        $thumbnail_id = $show_thumbnail ? absint(get_term_meta($term->term_id, 'thumbnail_id', true)) : 0;
                        $thumbnail_html = $thumbnail_id ? wp_get_attachment_image($thumbnail_id, 'woocommerce_thumbnail', false, array('alt' => $term->name, 'loading' => 'lazy', 'decoding' => 'async')) : '';
                        $term_description = $show_term_description && !empty($term->description) ? wp_trim_words(wp_strip_all_tags($term->description), $description_words, '…') : '';
                    ?>
                        <div class="col-md-6 col-xl-3">
                            <article class="linkpva-category-card<?php echo $style ? ' ' . esc_attr($style) : ''; ?>">
                                <?php if ($show_number) : ?><span class="linkpva-card-number"><?php echo esc_html(sprintf('%02d', $index + 1)); ?></span><?php endif; ?>
                                <?php if ($thumbnail_html) : ?><div class="linkpva-category-icon"><?php echo $thumbnail_html; ?></div><?php endif; ?>
                                <h3><?php echo esc_html($term->name); ?></h3>
                                <?php if ($term_description) : ?><p><?php echo esc_html($term_description); ?></p><?php endif; ?>
                                <?php if ($show_link) : ?><a href="<?php echo esc_url($term_link); ?>"><?php echo esc_html($settings['linkpva_product_category_link_text']); ?> <?php $this->render_icon($settings['linkpva_product_category_link_icon'] ?? array()); ?></a><?php endif; ?>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new linkpva_Product_Category_Widget());
