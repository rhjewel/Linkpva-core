<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit;
}

class linkpva_FAQs_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'linkpva_faqs';
    }
    public function get_title()
    {
        return esc_html__('LinkPVA FAQs', 'linkpva-core');
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
        $this->register_help_controls();
        $this->register_faq_controls();
        $this->register_footer_link_controls();
        $this->register_section_style_controls();
        $this->register_heading_style_controls();
        $this->register_help_style_controls();
        $this->register_accordion_style_controls();
        $this->register_question_style_controls();
        $this->register_toggle_style_controls();
        $this->register_answer_style_controls();
        $this->register_footer_link_style_controls();
    }

    private function register_heading_controls()
    {
        $this->start_controls_section('linkpva_faqs_heading_content', array('label' => esc_html__('Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
        $this->add_control('linkpva_faqs_show_tag', array('label' => esc_html__('Show Tag', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_faqs_tag', array('label' => esc_html__('Tag', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Common Questions', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_faqs_show_tag' => 'yes')));
        $this->add_control('linkpva_faqs_title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Frequently Asked Questions', 'linkpva-core'), 'label_block' => true));
        $this->add_control('linkpva_faqs_show_description', array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_faqs_description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Find quick information about account types, ordering, delivery, and support.', 'linkpva-core'), 'condition' => array('linkpva_faqs_show_description' => 'yes')));
        $this->end_controls_section();
    }

    private function register_help_controls()
    {
        $this->start_controls_section('linkpva_faqs_help_content', array('label' => esc_html__('Help Card', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
        $this->add_control('linkpva_faqs_show_help', array('label' => esc_html__('Show Help Card', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_faqs_show_help_icon', array('label' => esc_html__('Show Icon', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_faqs_show_help' => 'yes')));
        $this->add_control('linkpva_faqs_help_icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-chat-heart', 'library' => 'bootstrap'), 'condition' => array('linkpva_faqs_show_help' => 'yes', 'linkpva_faqs_show_help_icon' => 'yes')));
        $this->add_control('linkpva_faqs_help_title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Still have a question?', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_faqs_show_help' => 'yes')));
        $this->add_control('linkpva_faqs_show_help_description', array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_faqs_show_help' => 'yes')));
        $this->add_control('linkpva_faqs_help_description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Contact our team for help before placing an order.', 'linkpva-core'), 'condition' => array('linkpva_faqs_show_help' => 'yes', 'linkpva_faqs_show_help_description' => 'yes')));
        $this->add_control('linkpva_faqs_show_help_link', array('label' => esc_html__('Show Link', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_faqs_show_help' => 'yes')));
        $this->add_control('linkpva_faqs_help_link_text', array('label' => esc_html__('Link Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Contact support', 'linkpva-core'), 'condition' => array('linkpva_faqs_show_help' => 'yes', 'linkpva_faqs_show_help_link' => 'yes')));
        $this->add_control('linkpva_faqs_help_link', array('label' => esc_html__('Link', 'linkpva-core'), 'type' => Controls_Manager::URL, 'default' => array('url' => home_url('/contact/')), 'show_external' => true, 'condition' => array('linkpva_faqs_show_help' => 'yes', 'linkpva_faqs_show_help_link' => 'yes')));
        $this->add_control('linkpva_faqs_help_link_icon', array('label' => esc_html__('Link Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'), 'condition' => array('linkpva_faqs_show_help' => 'yes', 'linkpva_faqs_show_help_link' => 'yes')));
        $this->end_controls_section();
    }

    private function register_faq_controls()
    {
        $this->start_controls_section('linkpva_faqs_items_content', array('label' => esc_html__('FAQ Items', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
        $this->add_control('linkpva_faqs_show_toggle_icon', array('label' => esc_html__('Show Toggle Icon', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_faqs_toggle_icon', array('label' => esc_html__('Toggle Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-plus-lg', 'library' => 'bootstrap'), 'condition' => array('linkpva_faqs_show_toggle_icon' => 'yes')));
        $repeater = new Repeater();
        $repeater->add_control('question', array('label' => esc_html__('Question', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'label_block' => true));
        $repeater->add_control('answer', array('label' => esc_html__('Answer', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'label_block' => true));
        $repeater->add_control('open_by_default', array('label' => esc_html__('Open by Default', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => ''));
        $this->add_control('linkpva_faqs_items', array('label' => esc_html__('Questions', 'linkpva-core'), 'type' => Controls_Manager::REPEATER, 'fields' => $repeater->get_controls(), 'title_field' => '{{{ question }}}', 'default' => $this->get_default_faqs()));
        $this->end_controls_section();
    }

    private function register_footer_link_controls()
    {
        $this->start_controls_section('linkpva_faqs_footer_link_content', array('label' => esc_html__('Footer Link', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
        $this->add_control('linkpva_faqs_show_footer_link', array('label' => esc_html__('Show Footer Link', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_faqs_footer_link_text', array('label' => esc_html__('Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('View all frequently asked questions', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_faqs_show_footer_link' => 'yes')));
        $this->add_control('linkpva_faqs_footer_link', array('label' => esc_html__('Link', 'linkpva-core'), 'type' => Controls_Manager::URL, 'default' => array('url' => home_url('/faq/')), 'show_external' => true, 'condition' => array('linkpva_faqs_show_footer_link' => 'yes')));
        $this->add_control('linkpva_faqs_footer_link_icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'), 'condition' => array('linkpva_faqs_show_footer_link' => 'yes')));
        $this->end_controls_section();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section('linkpva_faqs_style_section', array('label' => esc_html__('Section & Layout', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_faqs_style_section_background', 'selector' => '{{WRAPPER}} .linkpva-faq'));
        $this->add_responsive_control('linkpva_faqs_style_section_padding', array('label' => esc_html__('Section Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-faq' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_faqs_style_column_gap', array('label' => esc_html__('Column Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 150)), 'selectors' => array('{{WRAPPER}} .linkpva-faq > .container > .row' => '--bs-gutter-x: calc({{SIZE}}{{UNIT}} * 2);')));
        $this->add_responsive_control('linkpva_faqs_style_row_gap', array('label' => esc_html__('Row Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 150)), 'selectors' => array('{{WRAPPER}} .linkpva-faq > .container > .row' => '--bs-gutter-y: calc({{SIZE}}{{UNIT}} * 2);')));
        $this->end_controls_section();
    }

    private function register_heading_style_controls()
    {
        $this->start_controls_section('linkpva_faqs_style_heading', array('label' => esc_html__('Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_control('linkpva_faqs_style_tag_color', array('label' => esc_html__('Tag Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-faq .linkpva-section-tag' => 'color: {{VALUE}};'), 'condition' => array('linkpva_faqs_show_tag' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_faqs_style_tag_typography', 'selector' => '{{WRAPPER}} .linkpva-faq .linkpva-section-tag', 'condition' => array('linkpva_faqs_show_tag' => 'yes')));
        $this->add_responsive_control('linkpva_faqs_style_tag_spacing', array('label' => esc_html__('Tag Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-faq .linkpva-section-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_faqs_show_tag' => 'yes')));
        $this->add_control('linkpva_faqs_style_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-faq .linkpva-section-heading h2' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_faqs_style_title_typography', 'selector' => '{{WRAPPER}} .linkpva-faq .linkpva-section-heading h2'));
        $this->add_responsive_control('linkpva_faqs_style_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-faq .linkpva-section-heading h2' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_faqs_style_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-faq .linkpva-section-heading p' => 'color: {{VALUE}};'), 'condition' => array('linkpva_faqs_show_description' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_faqs_style_description_typography', 'selector' => '{{WRAPPER}} .linkpva-faq .linkpva-section-heading p', 'condition' => array('linkpva_faqs_show_description' => 'yes')));
        $this->end_controls_section();
    }

    private function register_help_style_controls()
    {
        $this->start_controls_section('linkpva_faqs_style_help', array('label' => esc_html__('Help Card', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_faqs_show_help' => 'yes')));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_faqs_style_help_background', 'selector' => '{{WRAPPER}} .linkpva-help-card'));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_faqs_style_help_border', 'selector' => '{{WRAPPER}} .linkpva-help-card'));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_faqs_style_help_shadow', 'selector' => '{{WRAPPER}} .linkpva-help-card'));
        $this->add_responsive_control('linkpva_faqs_style_help_width', array('label' => esc_html__('Maximum Width', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 150, 'max' => 700)), 'selectors' => array('{{WRAPPER}} .linkpva-help-card' => 'max-width: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_faqs_style_help_spacing', array('label' => esc_html__('Top Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-help-card' => 'margin-top: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_faqs_style_help_gap', array('label' => esc_html__('Content Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-help-card' => 'gap: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_faqs_style_help_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-help-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_faqs_style_help_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-help-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_control('linkpva_faqs_style_help_icon_color', array('label' => esc_html__('Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-help-card > i' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-help-card > svg path' => 'fill: {{VALUE}};')));
        $this->add_control('linkpva_faqs_style_help_icon_background', array('label' => esc_html__('Icon Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-help-card > i, {{WRAPPER}} .linkpva-help-card > svg' => 'background-color: {{VALUE}};')));
        $this->add_responsive_control('linkpva_faqs_style_help_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-help-card > i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-help-card > svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_faqs_style_help_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-help-card h3' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_faqs_style_help_title_typography', 'selector' => '{{WRAPPER}} .linkpva-help-card h3'));
        $this->add_control('linkpva_faqs_style_help_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-help-card p' => 'color: {{VALUE}};'), 'condition' => array('linkpva_faqs_show_help_description' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_faqs_style_help_description_typography', 'selector' => '{{WRAPPER}} .linkpva-help-card p', 'condition' => array('linkpva_faqs_show_help_description' => 'yes')));
        $this->add_control('linkpva_faqs_style_help_link_color', array('label' => esc_html__('Link Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-help-card a' => 'color: {{VALUE}};'), 'condition' => array('linkpva_faqs_show_help_link' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_faqs_style_help_link_typography', 'selector' => '{{WRAPPER}} .linkpva-help-card a', 'condition' => array('linkpva_faqs_show_help_link' => 'yes')));
        $this->end_controls_section();
    }

    private function register_accordion_style_controls()
    {
        $this->start_controls_section('linkpva_faqs_style_accordion', array('label' => esc_html__('Accordion', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_faqs_style_accordion_background', 'selector' => '{{WRAPPER}} .linkpva-accordion'));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_faqs_style_accordion_border', 'selector' => '{{WRAPPER}} .linkpva-accordion'));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_faqs_style_accordion_shadow', 'selector' => '{{WRAPPER}} .linkpva-accordion'));
        $this->add_responsive_control('linkpva_faqs_style_accordion_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-accordion' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_control('linkpva_faqs_style_item_divider_color', array('label' => esc_html__('Divider Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item' => 'border-color: {{VALUE}};')));
        $this->end_controls_section();
    }

    private function register_question_style_controls()
    {
        $this->start_controls_section('linkpva_faqs_style_question', array('label' => esc_html__('Questions', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_faqs_style_question_typography', 'selector' => '{{WRAPPER}} .linkpva-accordion-item button'));
        $this->add_responsive_control('linkpva_faqs_style_question_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_faqs_style_question_gap', array('label' => esc_html__('Icon Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item button' => 'gap: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_faqs_style_question_color', array('label' => esc_html__('Closed Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item button' => 'color: {{VALUE}};')));
        $this->add_control('linkpva_faqs_style_question_open_color', array('label' => esc_html__('Open Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item.is-open button' => 'color: {{VALUE}};')));
        $this->end_controls_section();
    }

    private function register_toggle_style_controls()
    {
        $this->start_controls_section('linkpva_faqs_style_toggle', array('label' => esc_html__('Toggle Icon', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_faqs_show_toggle_icon' => 'yes')));
        $this->add_control('linkpva_faqs_style_toggle_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item button i' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-accordion-item button svg path' => 'fill: {{VALUE}};')));
        $this->add_control('linkpva_faqs_style_toggle_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item button i, {{WRAPPER}} .linkpva-accordion-item button svg' => 'background-color: {{VALUE}};')));
        $this->add_responsive_control('linkpva_faqs_style_toggle_box_size', array('label' => esc_html__('Box Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 16, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item button i, {{WRAPPER}} .linkpva-accordion-item button svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_faqs_style_toggle_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 6, 'max' => 50)), 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item button i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-accordion-item button svg' => 'padding: calc((100% - {{SIZE}}{{UNIT}}) / 2);')));
        $this->add_responsive_control('linkpva_faqs_style_toggle_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item button i, {{WRAPPER}} .linkpva-accordion-item button svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_answer_style_controls()
    {
        $this->start_controls_section('linkpva_faqs_style_answer', array('label' => esc_html__('Answers', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_control('linkpva_faqs_style_answer_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item > div p' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_faqs_style_answer_typography', 'selector' => '{{WRAPPER}} .linkpva-accordion-item > div p'));
        $this->add_responsive_control('linkpva_faqs_style_answer_padding', array('label' => esc_html__('Panel Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_footer_link_style_controls()
    {
        $this->start_controls_section('linkpva_faqs_style_footer_link', array('label' => esc_html__('Footer Link', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_faqs_show_footer_link' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_faqs_style_footer_link_typography', 'selector' => '{{WRAPPER}} .linkpva-faq-link'));
        $this->add_responsive_control('linkpva_faqs_style_footer_link_spacing', array('label' => esc_html__('Top Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-faq-link' => 'margin-top: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_faqs_style_footer_link_gap', array('label' => esc_html__('Icon Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-faq-link' => 'gap: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_faqs_style_footer_link_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-faq-link i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-faq-link svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
        $this->start_controls_tabs('linkpva_faqs_style_footer_link_tabs');
        $this->start_controls_tab('linkpva_faqs_style_footer_link_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
        $this->add_control('linkpva_faqs_style_footer_link_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-faq-link' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-faq-link svg path' => 'fill: {{VALUE}};')));
        $this->end_controls_tab();
        $this->start_controls_tab('linkpva_faqs_style_footer_link_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
        $this->add_control('linkpva_faqs_style_footer_link_hover_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-faq-link:hover, {{WRAPPER}} .linkpva-faq-link:focus-visible' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-faq-link:hover svg path, {{WRAPPER}} .linkpva-faq-link:focus-visible svg path' => 'fill: {{VALUE}};')));
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    private function get_default_faqs()
    {
        return array(
            array('question' => esc_html__('What types of LinkedIn accounts are available?', 'linkpva-core'), 'answer' => esc_html__('Listings are organized into verified, old or aged, PVA, and follower-based account categories. Available specifications and variations are shown on each product page.', 'linkpva-core'), 'open_by_default' => 'yes'),
            array('question' => esc_html__('How does account delivery work?', 'linkpva-core'), 'answer' => esc_html__('After an order is confirmed, the relevant order information is sent through the delivery method stated on the product page. Timing and conditions may vary by listing.', 'linkpva-core')),
            array('question' => esc_html__('How can I choose the right LinkedIn account?', 'linkpva-core'), 'answer' => esc_html__('Compare the stated age, region, verification information, profile completeness, follower range, and delivery conditions. Contact support if a specification is unclear.', 'linkpva-core')),
            array('question' => esc_html__('Do you provide customer support?', 'linkpva-core'), 'answer' => esc_html__('Purchase support is available for product questions and existing orders. Confirmed contact methods and service hours will be listed on the contact page.', 'linkpva-core')),
            array('question' => esc_html__('What payment methods are available?', 'linkpva-core'), 'answer' => esc_html__('Approved payment methods will be displayed at checkout when the commerce system is connected. Do not send payment information through an unlisted channel.', 'linkpva-core')),
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
        $settings = $this->get_settings_for_display();
        $widget_id = sanitize_html_class($this->get_id());
        $heading_id = 'linkpva-faq-heading-' . $widget_id;
        $items = isset($settings['linkpva_faqs_items']) && is_array($settings['linkpva_faqs_items']) ? $settings['linkpva_faqs_items'] : array();
        $items = array_values(array_filter($items, function ($item) {
            return !empty($item['question']) && !empty($item['answer']);
        }));
        $show_tag = 'yes' === ($settings['linkpva_faqs_show_tag'] ?? '') && !empty($settings['linkpva_faqs_tag']);
        $show_description = 'yes' === ($settings['linkpva_faqs_show_description'] ?? '') && !empty($settings['linkpva_faqs_description']);
        $has_title = !empty($settings['linkpva_faqs_title']);
        $show_help_description = 'yes' === ($settings['linkpva_faqs_show_help_description'] ?? '') && !empty($settings['linkpva_faqs_help_description']);
        $show_help_link = 'yes' === ($settings['linkpva_faqs_show_help_link'] ?? '') && !empty($settings['linkpva_faqs_help_link_text']) && !empty($settings['linkpva_faqs_help_link']['url']);
        $show_help = 'yes' === ($settings['linkpva_faqs_show_help'] ?? '') && (!empty($settings['linkpva_faqs_help_title']) || $show_help_description || $show_help_link);
        $show_help_icon = $show_help && 'yes' === ($settings['linkpva_faqs_show_help_icon'] ?? '') && !empty($settings['linkpva_faqs_help_icon']['value']);
        $show_toggle_icon = 'yes' === ($settings['linkpva_faqs_show_toggle_icon'] ?? '') && !empty($settings['linkpva_faqs_toggle_icon']['value']);
        $show_footer_link = 'yes' === ($settings['linkpva_faqs_show_footer_link'] ?? '') && !empty($settings['linkpva_faqs_footer_link_text']) && !empty($settings['linkpva_faqs_footer_link']['url']);
        $has_left = $has_title || $show_tag || $show_description || $show_help;
        if (!$has_left && empty($items) && !$show_footer_link) {
            return;
        }
        if ($show_help_link) {
            $this->add_link_attributes('linkpva_faqs_help_link', $settings['linkpva_faqs_help_link']);
        }
        if ($show_footer_link) {
            $this->add_link_attributes('linkpva_faqs_footer_link', $settings['linkpva_faqs_footer_link']);
            $this->add_render_attribute('linkpva_faqs_footer_link', 'class', 'linkpva-faq-link');
        }
        $open_assigned = false;
?>
        <section class="linkpva-section linkpva-faq" id="linkpva-faq-<?php echo esc_attr($widget_id); ?>" data-linkpva-faqs-widget="<?php echo esc_attr($widget_id); ?>" <?php if ($has_title) : ?> aria-labelledby="<?php echo esc_attr($heading_id); ?>" <?php endif; ?>>
            <div class="container">
                <div class="row g-5">
                    <?php if ($has_left) : ?><div class="<?php echo (empty($items) && !$show_footer_link) ? 'col-12' : 'col-lg-5'; ?>">
                            <?php if ($has_title || $show_tag || $show_description) : ?><div class="linkpva-section-heading">
                                    <?php if ($show_tag) : ?><span class="linkpva-section-tag"><?php echo esc_html($settings['linkpva_faqs_tag']); ?></span><?php endif; ?>
                                    <?php if ($has_title) : ?><h2 id="<?php echo esc_attr($heading_id); ?>"><?php echo esc_html($settings['linkpva_faqs_title']); ?></h2><?php endif; ?>
                                    <?php if ($show_description) : ?><p><?php echo esc_html($settings['linkpva_faqs_description']); ?></p><?php endif; ?>
                                </div><?php endif; ?>
                            <?php if ($show_help) : ?><div class="linkpva-help-card">
                                    <?php if ($show_help_icon) : ?><?php $this->render_icon($settings['linkpva_faqs_help_icon']); ?><?php endif; ?>
                                    <div><?php if (!empty($settings['linkpva_faqs_help_title'])) : ?><h3><?php echo esc_html($settings['linkpva_faqs_help_title']); ?></h3><?php endif; ?><?php if ($show_help_description) : ?><p><?php echo esc_html($settings['linkpva_faqs_help_description']); ?></p><?php endif; ?><?php if ($show_help_link) : ?><a <?php $this->print_render_attribute_string('linkpva_faqs_help_link'); ?>><?php echo esc_html($settings['linkpva_faqs_help_link_text']); ?> <?php $this->render_icon($settings['linkpva_faqs_help_link_icon'] ?? array()); ?></a><?php endif; ?></div>
                                </div><?php endif; ?>
                        </div><?php endif; ?>
                    <?php if (!empty($items) || $show_footer_link) : ?><div class="<?php echo $has_left ? 'col-lg-7' : 'col-12'; ?>">
                            <?php if (!empty($items)) : ?><div class="linkpva-accordion" data-accordion>
                                    <?php foreach ($items as $index => $item) : ?><?php
                                                                                    $is_open = !$open_assigned && 'yes' === ($item['open_by_default'] ?? '');
                                                                                    if ($is_open) {
                                                                                        $open_assigned = true;
                                                                                    }
                                                                                    $question_id = 'linkpva-faq-question-' . $widget_id . '-' . ($index + 1);
                                                                                    $answer_id = 'linkpva-faq-answer-' . $widget_id . '-' . ($index + 1);
                                                                                    ?>
                                    <article class="linkpva-accordion-item<?php echo $is_open ? ' is-open' : ''; ?>">
                                        <h3><button type="button" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr($answer_id); ?>" id="<?php echo esc_attr($question_id); ?>"><?php echo esc_html($item['question']); ?><?php if ($show_toggle_icon) : ?><?php $this->render_icon($settings['linkpva_faqs_toggle_icon']); ?><?php endif; ?></button></h3>
                                        <div id="<?php echo esc_attr($answer_id); ?>" role="region" aria-labelledby="<?php echo esc_attr($question_id); ?>" <?php if (!$is_open) : ?> hidden<?php endif; ?>>
                                            <p><?php echo esc_html($item['answer']); ?></p>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                                </div><?php endif; ?>
                            <?php if ($show_footer_link) : ?><a <?php $this->print_render_attribute_string('linkpva_faqs_footer_link'); ?>><?php echo esc_html($settings['linkpva_faqs_footer_link_text']); ?> <?php $this->render_icon($settings['linkpva_faqs_footer_link_icon'] ?? array()); ?></a><?php endif; ?>
                        </div><?php endif; ?>
                </div>
            </div>
        </section>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new linkpva_FAQs_Widget());
