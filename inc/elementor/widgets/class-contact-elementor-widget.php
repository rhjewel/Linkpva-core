<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit;
}

class linkpva_Contact_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'linkpva_contact';
    }

    public function get_title()
    {
        return esc_html__('LinkPVA Contact', 'linkpva-core');
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
        $this->register_information_controls();
        $this->register_form_controls();
        $this->register_section_style_controls();
        $this->register_information_box_style_controls();
        $this->register_information_content_style_controls();
        $this->register_information_list_style_controls();
        $this->register_form_card_style_controls();
        $this->register_form_heading_style_controls();
        $this->register_form_fields_style_controls();
        $this->register_form_button_style_controls();
        $this->register_form_message_style_controls();
    }

    private function register_information_controls()
    {
        $this->start_controls_section('linkpva_contact_information_content', array('label' => esc_html__('Contact Information', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
        $this->add_control('linkpva_contact_show_information', array('label' => esc_html__('Show Information', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_contact_show_tag', array('label' => esc_html__('Show Tag', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_contact_show_information' => 'yes')));
        $this->add_control('linkpva_contact_tag', array('label' => esc_html__('Tag', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Contact Information', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_contact_show_information' => 'yes', 'linkpva_contact_show_tag' => 'yes')));
        $this->add_control('linkpva_contact_title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Talk to Purchase Support', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_contact_show_information' => 'yes')));
        $this->add_control('linkpva_contact_show_description', array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_contact_show_information' => 'yes')));
        $this->add_control('linkpva_contact_description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Use the form for product questions, order assistance, or policy clarification.', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_contact_show_information' => 'yes', 'linkpva_contact_show_description' => 'yes')));

        $repeater = new Repeater();
        $repeater->add_control('icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-envelope', 'library' => 'bootstrap')));
        $repeater->add_control('title', array('label' => esc_html__('Label', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Email', 'linkpva-core'), 'label_block' => true));
        $repeater->add_control('value', array('label' => esc_html__('Value', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('support@example.com', 'linkpva-core'), 'label_block' => true));
        $repeater->add_control('link', array('label' => esc_html__('Link', 'linkpva-core'), 'type' => Controls_Manager::URL, 'placeholder' => 'mailto:support@example.com', 'show_external' => true));
        $this->add_control('linkpva_contact_information_items', array('label' => esc_html__('Information Items', 'linkpva-core'), 'type' => Controls_Manager::REPEATER, 'fields' => $repeater->get_controls(), 'title_field' => '{{{ title }}}', 'default' => $this->get_default_information_items(), 'condition' => array('linkpva_contact_show_information' => 'yes')));
        $this->end_controls_section();
    }

    private function register_form_controls()
    {
        $this->start_controls_section('linkpva_contact_form_content', array('label' => esc_html__('Contact Form', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
        $this->add_control('linkpva_contact_show_form', array('label' => esc_html__('Show Form', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_contact_show_form_title', array('label' => esc_html__('Show Form Title', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_contact_show_form' => 'yes')));
        $this->add_control('linkpva_contact_form_title', array('label' => esc_html__('Form Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Send a Message', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_contact_show_form' => 'yes', 'linkpva_contact_show_form_title' => 'yes')));
        $this->add_control('linkpva_contact_show_form_description', array('label' => esc_html__('Show Form Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_contact_show_form' => 'yes')));
        $this->add_control('linkpva_contact_form_description', array('label' => esc_html__('Form Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('All fields marked required must be completed.', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_contact_show_form' => 'yes', 'linkpva_contact_show_form_description' => 'yes')));
        $this->add_control('linkpva_contact_form_shortcode', array('label' => esc_html__('Form Shortcode', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => '[contact-form-7 title="Contact Page Form"]', 'placeholder' => '[contact-form-7 id="123" title="Contact form"]', 'label_block' => true, 'condition' => array('linkpva_contact_show_form' => 'yes')));
        $this->end_controls_section();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section('linkpva_contact_style_section', array('label' => esc_html__('Section', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_contact_style_section_background', 'selector' => '{{WRAPPER}} .linkpva-contact-widget'));
        $this->add_responsive_control('linkpva_contact_style_section_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-contact-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_style_columns_gap', array('label' => esc_html__('Columns Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-contact-widget > .container > .row' => '--bs-gutter-x: {{SIZE}}{{UNIT}}; --bs-gutter-y: {{SIZE}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_information_box_style_controls()
    {
        $this->start_controls_section('linkpva_contact_style_information_box', array('label' => esc_html__('Information Box', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_contact_show_information' => 'yes')));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_contact_style_information_background', 'selector' => '{{WRAPPER}} .linkpva-contact-aside'));
        $this->add_control('linkpva_contact_style_information_base_color', array('label' => esc_html__('Base Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-aside' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_contact_style_information_border', 'selector' => '{{WRAPPER}} .linkpva-contact-aside'));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_contact_style_information_shadow', 'selector' => '{{WRAPPER}} .linkpva-contact-aside'));
        $this->add_responsive_control('linkpva_contact_style_information_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-contact-aside' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_style_information_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-contact-aside' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_information_content_style_controls()
    {
        $this->start_controls_section('linkpva_contact_style_information_content', array('label' => esc_html__('Information Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_contact_show_information' => 'yes')));
        $this->add_control('linkpva_contact_style_tag_color', array('label' => esc_html__('Tag Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-aside .linkpva-section-tag' => 'color: {{VALUE}};'), 'condition' => array('linkpva_contact_show_tag' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_contact_style_tag_typography', 'selector' => '{{WRAPPER}} .linkpva-contact-aside .linkpva-section-tag', 'condition' => array('linkpva_contact_show_tag' => 'yes')));
        $this->add_responsive_control('linkpva_contact_style_tag_spacing', array('label' => esc_html__('Tag Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-contact-aside .linkpva-section-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_contact_show_tag' => 'yes')));
        $this->add_control('linkpva_contact_style_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-aside .linkpva-contact-title' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_contact_style_title_typography', 'selector' => '{{WRAPPER}} .linkpva-contact-aside .linkpva-contact-title'));
        $this->add_responsive_control('linkpva_contact_style_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-contact-aside .linkpva-contact-title' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_contact_style_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-aside > .linkpva-contact-description' => 'color: {{VALUE}};'), 'condition' => array('linkpva_contact_show_description' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_contact_style_description_typography', 'selector' => '{{WRAPPER}} .linkpva-contact-aside > .linkpva-contact-description', 'condition' => array('linkpva_contact_show_description' => 'yes')));
        $this->add_responsive_control('linkpva_contact_style_description_spacing', array('label' => esc_html__('Description Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-contact-aside > .linkpva-contact-description' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_contact_show_description' => 'yes')));
        $this->end_controls_section();
    }

    private function register_information_list_style_controls()
    {
        $this->start_controls_section('linkpva_contact_style_information_list', array('label' => esc_html__('Information List', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_contact_show_information' => 'yes')));
        $this->add_responsive_control('linkpva_contact_style_list_top_spacing', array('label' => esc_html__('List Top Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-contact-aside .linkpva-contact-information-list' => 'margin-top: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_style_item_spacing', array('label' => esc_html__('Item Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-contact-information-list li + li' => 'margin-top: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_style_item_gap', array('label' => esc_html__('Icon Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-contact-information-list li' => 'gap: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_contact_style_icon_color', array('label' => esc_html__('Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-information-list .linkpva-contact-info-icon' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-contact-information-list .linkpva-contact-info-icon svg path' => 'fill: {{VALUE}};')));
        $this->add_responsive_control('linkpva_contact_style_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 6, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-contact-info-icon i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-contact-info-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_contact_style_item_title_color', array('label' => esc_html__('Label Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-info-title' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_contact_style_item_title_typography', 'selector' => '{{WRAPPER}} .linkpva-contact-info-title'));
        $this->add_responsive_control('linkpva_contact_style_item_title_spacing', array('label' => esc_html__('Label Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-contact-info-title' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_contact_style_item_value_color', array('label' => esc_html__('Value Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-info-value, {{WRAPPER}} .linkpva-contact-info-value a' => 'color: {{VALUE}};')));
        $this->add_control('linkpva_contact_style_item_value_hover_color', array('label' => esc_html__('Value Hover Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-info-value a:hover, {{WRAPPER}} .linkpva-contact-info-value a:focus-visible' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_contact_style_item_value_typography', 'selector' => '{{WRAPPER}} .linkpva-contact-info-value'));
        $this->end_controls_section();
    }

    private function register_form_card_style_controls()
    {
        $this->start_controls_section('linkpva_contact_style_form_card', array('label' => esc_html__('Form Card', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_contact_show_form' => 'yes')));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_contact_style_form_card_background', 'selector' => '{{WRAPPER}} .linkpva-contact-form-card'));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_contact_style_form_card_border', 'selector' => '{{WRAPPER}} .linkpva-contact-form-card'));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_contact_style_form_card_shadow', 'selector' => '{{WRAPPER}} .linkpva-contact-form-card'));
        $this->add_responsive_control('linkpva_contact_style_form_card_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-contact-form-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_style_form_card_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-contact-form-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_form_heading_style_controls()
    {
        $this->start_controls_section('linkpva_contact_style_form_heading', array('label' => esc_html__('Form Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_contact_show_form' => 'yes')));
        $this->add_control('linkpva_contact_style_form_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form-title' => 'color: {{VALUE}};'), 'condition' => array('linkpva_contact_show_form_title' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_contact_style_form_title_typography', 'selector' => '{{WRAPPER}} .linkpva-contact-form-title', 'condition' => array('linkpva_contact_show_form_title' => 'yes')));
        $this->add_responsive_control('linkpva_contact_style_form_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form-title' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_contact_show_form_title' => 'yes')));
        $this->add_control('linkpva_contact_style_form_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form-description' => 'color: {{VALUE}};'), 'condition' => array('linkpva_contact_show_form_description' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_contact_style_form_description_typography', 'selector' => '{{WRAPPER}} .linkpva-contact-form-description', 'condition' => array('linkpva_contact_show_form_description' => 'yes')));
        $this->add_responsive_control('linkpva_contact_style_form_description_spacing', array('label' => esc_html__('Description Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form-description' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_contact_show_form_description' => 'yes')));
        $this->end_controls_section();
    }

    private function register_form_fields_style_controls()
    {
        $field_selector = '{{WRAPPER}} .linkpva-contact-form input:not([type="submit"]):not([type="checkbox"]):not([type="radio"]), {{WRAPPER}} .linkpva-contact-form select, {{WRAPPER}} .linkpva-contact-form textarea';
        $this->start_controls_section('linkpva_contact_style_form_fields', array('label' => esc_html__('Form Fields', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_contact_show_form' => 'yes')));
        $this->add_control('linkpva_contact_style_label_color', array('label' => esc_html__('Label Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form label' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_contact_style_label_typography', 'selector' => '{{WRAPPER}} .linkpva-contact-form label'));
        $this->add_responsive_control('linkpva_contact_style_label_spacing', array('label' => esc_html__('Label Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form label' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_contact_style_field_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array($field_selector => 'color: {{VALUE}};')));
        $this->add_control('linkpva_contact_style_field_placeholder_color', array('label' => esc_html__('Placeholder Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form input::placeholder, {{WRAPPER}} .linkpva-contact-form textarea::placeholder' => 'color: {{VALUE}}; opacity: 1;')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_contact_style_field_typography', 'selector' => $field_selector));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_contact_style_field_background', 'selector' => $field_selector));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_contact_style_field_border', 'selector' => $field_selector));
        $this->add_responsive_control('linkpva_contact_style_field_height', array('label' => esc_html__('Field Height', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 30, 'max' => 120)), 'selectors' => array('{{WRAPPER}} .linkpva-contact-form input:not([type="submit"]):not([type="checkbox"]):not([type="radio"]), {{WRAPPER}} .linkpva-contact-form select' => 'min-height: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_style_textarea_height', array('label' => esc_html__('Textarea Height', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 80, 'max' => 500)), 'selectors' => array('{{WRAPPER}} .linkpva-contact-form textarea' => 'min-height: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_style_field_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array($field_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_style_field_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array($field_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_style_field_spacing', array('label' => esc_html__('Field Group Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form form > p, {{WRAPPER}} .linkpva-contact-form .linkpva-form-field' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_contact_style_field_focus_border', array('label' => esc_html__('Focus Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form input:focus, {{WRAPPER}} .linkpva-contact-form select:focus, {{WRAPPER}} .linkpva-contact-form textarea:focus' => 'border-color: {{VALUE}};')));
        $this->add_control('linkpva_contact_style_field_focus_shadow', array('label' => esc_html__('Focus Ring Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form input:focus, {{WRAPPER}} .linkpva-contact-form select:focus, {{WRAPPER}} .linkpva-contact-form textarea:focus' => 'box-shadow: 0 0 0 3px {{VALUE}};')));
        $this->end_controls_section();
    }

    private function register_form_button_style_controls()
    {
        $button_selector = '{{WRAPPER}} .linkpva-contact-form button, {{WRAPPER}} .linkpva-contact-form input[type="submit"]';
        $this->start_controls_section('linkpva_contact_style_form_button', array('label' => esc_html__('Submit Button', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_contact_show_form' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_contact_style_button_typography', 'selector' => $button_selector));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_contact_style_button_border', 'selector' => $button_selector));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_contact_style_button_shadow', 'selector' => $button_selector));
        $this->add_responsive_control('linkpva_contact_style_button_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array($button_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_style_button_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array($button_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->start_controls_tabs('linkpva_contact_style_button_tabs');
        $this->start_controls_tab('linkpva_contact_style_button_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
        $this->add_control('linkpva_contact_style_button_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array($button_selector => 'color: {{VALUE}};')));
        $this->add_control('linkpva_contact_style_button_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array($button_selector => 'background-color: {{VALUE}};')));
        $this->end_controls_tab();
        $this->start_controls_tab('linkpva_contact_style_button_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
        $this->add_control('linkpva_contact_style_button_hover_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form button:hover, {{WRAPPER}} .linkpva-contact-form button:focus-visible, {{WRAPPER}} .linkpva-contact-form input[type="submit"]:hover, {{WRAPPER}} .linkpva-contact-form input[type="submit"]:focus-visible' => 'color: {{VALUE}};')));
        $this->add_control('linkpva_contact_style_button_hover_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form button:hover, {{WRAPPER}} .linkpva-contact-form button:focus-visible, {{WRAPPER}} .linkpva-contact-form input[type="submit"]:hover, {{WRAPPER}} .linkpva-contact-form input[type="submit"]:focus-visible' => 'background-color: {{VALUE}};')));
        $this->add_control('linkpva_contact_style_button_hover_border', array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form button:hover, {{WRAPPER}} .linkpva-contact-form button:focus-visible, {{WRAPPER}} .linkpva-contact-form input[type="submit"]:hover, {{WRAPPER}} .linkpva-contact-form input[type="submit"]:focus-visible' => 'border-color: {{VALUE}};')));
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    private function register_form_message_style_controls()
    {
        $this->start_controls_section('linkpva_contact_style_form_message', array('label' => esc_html__('Form Messages', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_contact_show_form' => 'yes')));
        $this->add_control('linkpva_contact_style_validation_color', array('label' => esc_html__('Validation Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form .wpcf7-not-valid-tip, {{WRAPPER}} .linkpva-contact-form .error' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_contact_style_validation_typography', 'selector' => '{{WRAPPER}} .linkpva-contact-form .wpcf7-not-valid-tip, {{WRAPPER}} .linkpva-contact-form .error'));
        $this->add_control('linkpva_contact_style_response_color', array('label' => esc_html__('Response Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form .wpcf7-response-output, {{WRAPPER}} .linkpva-contact-form .linkpva-form-status' => 'color: {{VALUE}};')));
        $this->add_control('linkpva_contact_style_response_background', array('label' => esc_html__('Response Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form .wpcf7-response-output, {{WRAPPER}} .linkpva-contact-form .linkpva-form-status' => 'background-color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_contact_style_response_border', 'selector' => '{{WRAPPER}} .linkpva-contact-form .wpcf7-response-output, {{WRAPPER}} .linkpva-contact-form .linkpva-form-status'));
        $this->add_responsive_control('linkpva_contact_style_response_padding', array('label' => esc_html__('Response Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form .wpcf7-response-output, {{WRAPPER}} .linkpva-contact-form .linkpva-form-status' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_contact_style_response_radius', array('label' => esc_html__('Response Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-contact-form .wpcf7-response-output, {{WRAPPER}} .linkpva-contact-form .linkpva-form-status' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function get_default_information_items()
    {
        return array(
            array('icon' => array('value' => 'bi bi-envelope', 'library' => 'bootstrap'), 'title' => esc_html__('Email', 'linkpva-core'), 'value' => esc_html__('support@example.com', 'linkpva-core'), 'link' => array('url' => 'mailto:support@example.com')),
            array('icon' => array('value' => 'bi bi-clock', 'library' => 'bootstrap'), 'title' => esc_html__('Support Hours', 'linkpva-core'), 'value' => esc_html__('Monday to Friday, 9:00 AM–6:00 PM', 'linkpva-core'), 'link' => array('url' => '')),
            array('icon' => array('value' => 'bi bi-shield-check', 'library' => 'bootstrap'), 'title' => esc_html__('Privacy Reminder', 'linkpva-core'), 'value' => esc_html__('Do not submit passwords or account credentials.', 'linkpva-core'), 'link' => array('url' => '')),
        );
    }

    private function render_icon($icon)
    {
        if (is_array($icon) && !empty($icon['value'])) {
            Icons_Manager::render_icon($icon, array('aria-hidden' => 'true'));
        }
    }

    private function get_information_items($items)
    {
        if (!is_array($items)) {
            return array();
        }

        return array_values(array_filter($items, function ($item) {
            return is_array($item) && (!empty($item['title']) || !empty($item['value']) || !empty($item['icon']['value']));
        }));
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = sanitize_html_class($this->get_id());
        $show_information = 'yes' === ($settings['linkpva_contact_show_information'] ?? '');
        $show_form = 'yes' === ($settings['linkpva_contact_show_form'] ?? '');
        $show_tag = $show_information && 'yes' === ($settings['linkpva_contact_show_tag'] ?? '') && !empty($settings['linkpva_contact_tag']);
        $show_description = $show_information && 'yes' === ($settings['linkpva_contact_show_description'] ?? '') && !empty($settings['linkpva_contact_description']);
        $show_form_title = $show_form && 'yes' === ($settings['linkpva_contact_show_form_title'] ?? '') && !empty($settings['linkpva_contact_form_title']);
        $show_form_description = $show_form && 'yes' === ($settings['linkpva_contact_show_form_description'] ?? '') && !empty($settings['linkpva_contact_form_description']);
        $information_items = $show_information ? $this->get_information_items($settings['linkpva_contact_information_items'] ?? array()) : array();
        $shortcode = $show_form ? trim(sanitize_textarea_field($settings['linkpva_contact_form_shortcode'] ?? '')) : '';
        $information_heading_id = 'linkpva-contact-information-heading-' . $widget_id;
        $form_heading_id = 'linkpva-contact-form-heading-' . $widget_id;

        if (!$show_information && !$show_form) {
            return;
        }
?>
        <section class="linkpva-inner-section linkpva-contact-widget" data-linkpva-contact-widget="<?php echo esc_attr($widget_id); ?>">
            <div class="container">
                <div class="row g-4">
                    <?php if ($show_information) : ?>
                        <div class="<?php echo esc_attr($show_form ? 'col-lg-5' : 'col-12'); ?>">
                            <aside class="linkpva-contact-aside" <?php if (!empty($settings['linkpva_contact_title'])) : ?> aria-labelledby="<?php echo esc_attr($information_heading_id); ?>" <?php endif; ?>>
                                <?php if ($show_tag) : ?><span class="linkpva-section-tag"><?php echo esc_html($settings['linkpva_contact_tag']); ?></span><?php endif; ?>
                                <?php if (!empty($settings['linkpva_contact_title'])) : ?><h2 id="<?php echo esc_attr($information_heading_id); ?>" class="linkpva-contact-title"><?php echo esc_html($settings['linkpva_contact_title']); ?></h2><?php endif; ?>
                                <?php if ($show_description) : ?><p class="linkpva-contact-description"><?php echo esc_html($settings['linkpva_contact_description']); ?></p><?php endif; ?>
                                <?php if (!empty($information_items)) : ?>
                                    <ul class="linkpva-contact-information-list">
                                        <?php foreach ($information_items as $index => $item) :
                                            $link_key = 'linkpva_contact_information_link_' . $index;
                                            $has_link = !empty($item['link']['url']) && !empty($item['value']);
                                            if ($has_link) {
                                                $this->add_link_attributes($link_key, $item['link']);
                                            }
                                        ?>
                                            <li>
                                                <?php if (!empty($item['icon']['value'])) : ?><span class="linkpva-contact-info-icon"><?php $this->render_icon($item['icon']); ?></span><?php endif; ?>
                                                <span class="linkpva-contact-info-content">
                                                    <?php if (!empty($item['title'])) : ?><strong class="linkpva-contact-info-title"><?php echo esc_html($item['title']); ?></strong><?php endif; ?>
                                                    <?php if (!empty($item['value'])) : ?><span class="linkpva-contact-info-value"><?php if ($has_link) : ?><a <?php $this->print_render_attribute_string($link_key); ?>><?php echo esc_html($item['value']); ?></a><?php else : ?><?php echo esc_html($item['value']); ?><?php endif; ?></span><?php endif; ?>
                                                </span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </aside>
                        </div>
                    <?php endif; ?>

                    <?php if ($show_form) : ?>
                        <div class="<?php echo esc_attr($show_information ? 'col-lg-7' : 'col-12'); ?>">
                            <div class="linkpva-content-card linkpva-contact-form-card" <?php if ($show_form_title) : ?> aria-labelledby="<?php echo esc_attr($form_heading_id); ?>" <?php endif; ?>>
                                <?php if ($show_form_title) : ?><h2 id="<?php echo esc_attr($form_heading_id); ?>" class="linkpva-contact-form-title"><?php echo esc_html($settings['linkpva_contact_form_title']); ?></h2><?php endif; ?>
                                <?php if ($show_form_description) : ?><p class="linkpva-contact-form-description"><?php echo esc_html($settings['linkpva_contact_form_description']); ?></p><?php endif; ?>
                                <?php if ('' !== $shortcode) : ?>
                                    <div class="linkpva-contact-form">
                                        <?php echo do_shortcode($shortcode); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Registered shortcode output is trusted. 
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new linkpva_Contact_Widget());
