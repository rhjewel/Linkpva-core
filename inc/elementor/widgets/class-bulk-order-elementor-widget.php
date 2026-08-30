<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}

class linkpva_Bulk_Order_Widget extends Widget_Base
{
	public function get_name()
	{
		return 'linkpva_bulk_order';
	}

	public function get_title()
	{
		return esc_html__('LinkPVA Bulk Order', 'linkpva-core');
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
		$this->start_controls_section('linkpva_bulk_order_information_content', array('label' => esc_html__('Order Information', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_bulk_order_show_information', array('label' => esc_html__('Show Information', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_bulk_order_show_icon', array('label' => esc_html__('Show Icon', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_bulk_order_show_information' => 'yes')));
		$this->add_control('linkpva_bulk_order_icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-layers', 'library' => 'bootstrap'), 'condition' => array('linkpva_bulk_order_show_information' => 'yes', 'linkpva_bulk_order_show_icon' => 'yes')));
		$this->add_control('linkpva_bulk_order_title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Plan a Larger Order', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_bulk_order_show_information' => 'yes')));
		$this->add_control('linkpva_bulk_order_show_description', array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_bulk_order_show_information' => 'yes')));
		$this->add_control('linkpva_bulk_order_description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Provide enough detail for the team to review availability and prepare a relevant response.', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_bulk_order_show_information' => 'yes', 'linkpva_bulk_order_show_description' => 'yes')));

		$repeater = new Repeater();
		$repeater->add_control('icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-check2', 'library' => 'bootstrap')));
		$repeater->add_control('text', array('label' => esc_html__('Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Account category and region', 'linkpva-core'), 'label_block' => true));
		$this->add_control('linkpva_bulk_order_information_items', array('label' => esc_html__('Information Items', 'linkpva-core'), 'type' => Controls_Manager::REPEATER, 'fields' => $repeater->get_controls(), 'title_field' => '{{{ text }}}', 'default' => $this->get_default_information_items(), 'condition' => array('linkpva_bulk_order_show_information' => 'yes')));
		$this->end_controls_section();
	}

	private function register_form_controls()
	{
		$this->start_controls_section('linkpva_bulk_order_form_content', array('label' => esc_html__('Bulk Order Form', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_bulk_order_show_form', array('label' => esc_html__('Show Form', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_bulk_order_show_form_title', array('label' => esc_html__('Show Form Title', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_bulk_order_show_form' => 'yes')));
		$this->add_control('linkpva_bulk_order_form_title', array('label' => esc_html__('Form Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Bulk Requirements', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_bulk_order_show_form' => 'yes', 'linkpva_bulk_order_show_form_title' => 'yes')));
		$this->add_control('linkpva_bulk_order_form_shortcode', array('label' => esc_html__('Form Shortcode', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => '[contact-form-7 title="Bulk Order"]', 'placeholder' => '[contact-form-7 id="123" title="Bulk Order"]', 'label_block' => true, 'condition' => array('linkpva_bulk_order_show_form' => 'yes')));
		$this->end_controls_section();
	}

	private function register_section_style_controls()
	{
		$this->start_controls_section('linkpva_bulk_order_style_section', array('label' => esc_html__('Section', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_bulk_order_style_section_background', 'selector' => '{{WRAPPER}} .linkpva-bulk-order-widget'));
		$this->add_responsive_control('linkpva_bulk_order_style_section_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_order_style_columns_gap', array('label' => esc_html__('Columns Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 120)), 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-widget > .container > .row' => '--bs-gutter-x: {{SIZE}}{{UNIT}}; --bs-gutter-y: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_information_box_style_controls()
	{
		$this->start_controls_section('linkpva_bulk_order_style_information_box', array('label' => esc_html__('Information Box', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_bulk_order_show_information' => 'yes')));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_bulk_order_style_information_background', 'selector' => '{{WRAPPER}} .linkpva-bulk-order-aside'));
		$this->add_control('linkpva_bulk_order_style_information_base_color', array('label' => esc_html__('Base Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-aside' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_bulk_order_style_information_border', 'selector' => '{{WRAPPER}} .linkpva-bulk-order-aside'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_bulk_order_style_information_shadow', 'selector' => '{{WRAPPER}} .linkpva-bulk-order-aside'));
		$this->add_responsive_control('linkpva_bulk_order_style_information_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-aside' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_order_style_information_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-aside' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_information_content_style_controls()
	{
		$this->start_controls_section('linkpva_bulk_order_style_information_content', array('label' => esc_html__('Information Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_bulk_order_show_information' => 'yes')));
		$this->add_control('linkpva_bulk_order_style_icon_color', array('label' => esc_html__('Main Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-icon' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-bulk-order-icon svg path' => 'fill: {{VALUE}};'), 'condition' => array('linkpva_bulk_order_show_icon' => 'yes')));
		$this->add_responsive_control('linkpva_bulk_order_style_icon_size', array('label' => esc_html__('Main Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 8, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-icon i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-bulk-order-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_bulk_order_show_icon' => 'yes')));
		$this->add_responsive_control('linkpva_bulk_order_style_icon_spacing', array('label' => esc_html__('Main Icon Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_bulk_order_show_icon' => 'yes')));
		$this->add_control('linkpva_bulk_order_style_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-title' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_bulk_order_style_title_typography', 'selector' => '{{WRAPPER}} .linkpva-bulk-order-title'));
		$this->add_responsive_control('linkpva_bulk_order_style_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-title' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_bulk_order_style_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-description' => 'color: {{VALUE}};'), 'condition' => array('linkpva_bulk_order_show_description' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_bulk_order_style_description_typography', 'selector' => '{{WRAPPER}} .linkpva-bulk-order-description', 'condition' => array('linkpva_bulk_order_show_description' => 'yes')));
		$this->end_controls_section();
	}

	private function register_information_list_style_controls()
	{
		$this->start_controls_section('linkpva_bulk_order_style_information_list', array('label' => esc_html__('Information List', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_bulk_order_show_information' => 'yes')));
		$this->add_responsive_control('linkpva_bulk_order_style_list_top_spacing', array('label' => esc_html__('Top Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-list' => 'margin-top: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_order_style_list_item_spacing', array('label' => esc_html__('Item Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-list li + li' => 'margin-top: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_order_style_list_item_gap', array('label' => esc_html__('Icon Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-list li' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_bulk_order_style_list_text_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-list li' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_bulk_order_style_list_text_typography', 'selector' => '{{WRAPPER}} .linkpva-bulk-order-list li'));
		$this->add_control('linkpva_bulk_order_style_list_icon_color', array('label' => esc_html__('Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-list-icon' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-bulk-order-list-icon svg path' => 'fill: {{VALUE}};')));
		$this->add_responsive_control('linkpva_bulk_order_style_list_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 6, 'max' => 60)), 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-list-icon i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-bulk-order-list-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_form_card_style_controls()
	{
		$this->start_controls_section('linkpva_bulk_order_style_form_card', array('label' => esc_html__('Form Card', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_bulk_order_show_form' => 'yes')));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_bulk_order_style_form_card_background', 'selector' => '{{WRAPPER}} .linkpva-bulk-order-form-card'));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_bulk_order_style_form_card_border', 'selector' => '{{WRAPPER}} .linkpva-bulk-order-form-card'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_bulk_order_style_form_card_shadow', 'selector' => '{{WRAPPER}} .linkpva-bulk-order-form-card'));
		$this->add_responsive_control('linkpva_bulk_order_style_form_card_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_order_style_form_card_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_form_heading_style_controls()
	{
		$this->start_controls_section('linkpva_bulk_order_style_form_heading', array('label' => esc_html__('Form Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_bulk_order_show_form' => 'yes', 'linkpva_bulk_order_show_form_title' => 'yes')));
		$this->add_control('linkpva_bulk_order_style_form_title_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form-title' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_bulk_order_style_form_title_typography', 'selector' => '{{WRAPPER}} .linkpva-bulk-order-form-title'));
		$this->add_responsive_control('linkpva_bulk_order_style_form_title_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form-title' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_form_fields_style_controls()
	{
		$field_selector = '{{WRAPPER}} .linkpva-bulk-order-form input:not([type="submit"]):not([type="checkbox"]):not([type="radio"]), {{WRAPPER}} .linkpva-bulk-order-form select, {{WRAPPER}} .linkpva-bulk-order-form textarea';
		$this->start_controls_section('linkpva_bulk_order_style_form_fields', array('label' => esc_html__('Form Fields', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_bulk_order_show_form' => 'yes')));
		$this->add_control('linkpva_bulk_order_style_label_color', array('label' => esc_html__('Label Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form label' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_bulk_order_style_label_typography', 'selector' => '{{WRAPPER}} .linkpva-bulk-order-form label'));
		$this->add_control('linkpva_bulk_order_style_field_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array($field_selector => 'color: {{VALUE}};')));
		$this->add_control('linkpva_bulk_order_style_field_placeholder_color', array('label' => esc_html__('Placeholder Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form input::placeholder, {{WRAPPER}} .linkpva-bulk-order-form textarea::placeholder' => 'color: {{VALUE}}; opacity: 1;')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_bulk_order_style_field_typography', 'selector' => $field_selector));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_bulk_order_style_field_background', 'selector' => $field_selector));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_bulk_order_style_field_border', 'selector' => $field_selector));
		$this->add_responsive_control('linkpva_bulk_order_style_field_height', array('label' => esc_html__('Field Height', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 30, 'max' => 120)), 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form input:not([type="submit"]):not([type="checkbox"]):not([type="radio"]), {{WRAPPER}} .linkpva-bulk-order-form select' => 'min-height: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_order_style_textarea_height', array('label' => esc_html__('Textarea Height', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 80, 'max' => 500)), 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form textarea' => 'min-height: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_order_style_field_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array($field_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_order_style_field_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array($field_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_order_style_field_spacing', array('label' => esc_html__('Field Group Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form form > p, {{WRAPPER}} .linkpva-bulk-order-form .linkpva-form-field' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_bulk_order_style_field_focus_border', array('label' => esc_html__('Focus Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form input:focus, {{WRAPPER}} .linkpva-bulk-order-form select:focus, {{WRAPPER}} .linkpva-bulk-order-form textarea:focus' => 'border-color: {{VALUE}};')));
		$this->add_control('linkpva_bulk_order_style_field_focus_shadow', array('label' => esc_html__('Focus Ring Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form input:focus, {{WRAPPER}} .linkpva-bulk-order-form select:focus, {{WRAPPER}} .linkpva-bulk-order-form textarea:focus' => 'box-shadow: 0 0 0 3px {{VALUE}};')));
		$this->end_controls_section();
	}

	private function register_form_button_style_controls()
	{
		$button_selector = '{{WRAPPER}} .linkpva-bulk-order-form button, {{WRAPPER}} .linkpva-bulk-order-form input[type="submit"]';
		$this->start_controls_section('linkpva_bulk_order_style_form_button', array('label' => esc_html__('Submit Button', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_bulk_order_show_form' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_bulk_order_style_button_typography', 'selector' => $button_selector));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_bulk_order_style_button_border', 'selector' => $button_selector));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_bulk_order_style_button_shadow', 'selector' => $button_selector));
		$this->add_responsive_control('linkpva_bulk_order_style_button_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array($button_selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_order_style_button_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array($button_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->start_controls_tabs('linkpva_bulk_order_style_button_states');
		$this->start_controls_tab('linkpva_bulk_order_style_button_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control('linkpva_bulk_order_style_button_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array($button_selector => 'color: {{VALUE}};')));
		$this->add_control('linkpva_bulk_order_style_button_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array($button_selector => 'background-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_bulk_order_style_button_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control('linkpva_bulk_order_style_button_hover_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form button:hover, {{WRAPPER}} .linkpva-bulk-order-form button:focus-visible, {{WRAPPER}} .linkpva-bulk-order-form input[type="submit"]:hover, {{WRAPPER}} .linkpva-bulk-order-form input[type="submit"]:focus-visible' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_bulk_order_style_button_hover_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form button:hover, {{WRAPPER}} .linkpva-bulk-order-form button:focus-visible, {{WRAPPER}} .linkpva-bulk-order-form input[type="submit"]:hover, {{WRAPPER}} .linkpva-bulk-order-form input[type="submit"]:focus-visible' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_bulk_order_style_button_hover_border', array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form button:hover, {{WRAPPER}} .linkpva-bulk-order-form button:focus-visible, {{WRAPPER}} .linkpva-bulk-order-form input[type="submit"]:hover, {{WRAPPER}} .linkpva-bulk-order-form input[type="submit"]:focus-visible' => 'border-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	private function register_form_message_style_controls()
	{
		$this->start_controls_section('linkpva_bulk_order_style_form_message', array('label' => esc_html__('Form Messages', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_bulk_order_show_form' => 'yes')));
		$this->add_control('linkpva_bulk_order_style_validation_color', array('label' => esc_html__('Validation Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form .wpcf7-not-valid-tip, {{WRAPPER}} .linkpva-bulk-order-form .error' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_bulk_order_style_validation_typography', 'selector' => '{{WRAPPER}} .linkpva-bulk-order-form .wpcf7-not-valid-tip, {{WRAPPER}} .linkpva-bulk-order-form .error'));
		$this->add_control('linkpva_bulk_order_style_response_color', array('label' => esc_html__('Response Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form .wpcf7-response-output' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_bulk_order_style_response_background', array('label' => esc_html__('Response Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form .wpcf7-response-output' => 'background-color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_bulk_order_style_response_border', 'selector' => '{{WRAPPER}} .linkpva-bulk-order-form .wpcf7-response-output'));
		$this->add_responsive_control('linkpva_bulk_order_style_response_padding', array('label' => esc_html__('Response Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form .wpcf7-response-output' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_order_style_response_radius', array('label' => esc_html__('Response Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order-form .wpcf7-response-output' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function get_default_information_items()
	{
		return array(
			array('icon' => array('value' => 'bi bi-check2', 'library' => 'bootstrap'), 'text' => esc_html__('Account category and region', 'linkpva-core')),
			array('icon' => array('value' => 'bi bi-check2', 'library' => 'bootstrap'), 'text' => esc_html__('Required quantity and age range', 'linkpva-core')),
			array('icon' => array('value' => 'bi bi-check2', 'library' => 'bootstrap'), 'text' => esc_html__('Preferred delivery timeframe', 'linkpva-core')),
			array('icon' => array('value' => 'bi bi-shield-check', 'library' => 'bootstrap'), 'text' => esc_html__('Never submit account credentials', 'linkpva-core')),
		);
	}

	private function normalize_information_items($items)
	{
		if (!is_array($items)) {
			return array();
		}

		return array_values(array_filter($items, static function ($item) {
			return !empty($item['text']);
		}));
	}

	private function render_icon($icon, $class = '')
	{
		if (!is_array($icon) || empty($icon['value'])) {
			return;
		}

		$attributes = array('aria-hidden' => 'true');
		if ('' !== $class) {
			$attributes['class'] = sanitize_html_class($class);
		}
		Icons_Manager::render_icon($icon, $attributes);
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$show_information = 'yes' === ($settings['linkpva_bulk_order_show_information'] ?? '');
		$show_form = 'yes' === ($settings['linkpva_bulk_order_show_form'] ?? '');
		$show_icon = $show_information && 'yes' === ($settings['linkpva_bulk_order_show_icon'] ?? '') && !empty($settings['linkpva_bulk_order_icon']['value']);
		$show_description = $show_information && 'yes' === ($settings['linkpva_bulk_order_show_description'] ?? '') && !empty($settings['linkpva_bulk_order_description']);
		$show_form_title = $show_form && 'yes' === ($settings['linkpva_bulk_order_show_form_title'] ?? '') && !empty($settings['linkpva_bulk_order_form_title']);
		$information_items = $show_information ? $this->normalize_information_items($settings['linkpva_bulk_order_information_items'] ?? array()) : array();
		$shortcode = $show_form ? trim(sanitize_textarea_field($settings['linkpva_bulk_order_form_shortcode'] ?? '')) : '';
		$widget_id = sanitize_html_class($this->get_id());
		$information_heading_id = 'linkpva-bulk-order-information-heading-' . $widget_id;
		$form_heading_id = 'linkpva-bulk-order-form-heading-' . $widget_id;

		if (!$show_information && !$show_form) {
			return;
		}
		?>
		<section class="linkpva-inner-section linkpva-bulk-order-widget" data-linkpva-bulk-order-widget="<?php echo esc_attr($widget_id); ?>">
			<div class="container">
				<div class="row g-4">
					<?php if ($show_information) : ?>
						<div class="<?php echo esc_attr($show_form ? 'col-lg-4' : 'col-12'); ?>">
							<aside class="linkpva-contact-aside linkpva-bulk-order-aside"<?php if (!empty($settings['linkpva_bulk_order_title'])) : ?> aria-labelledby="<?php echo esc_attr($information_heading_id); ?>"<?php endif; ?>>
								<?php if ($show_icon) : ?><span class="linkpva-bulk-order-icon"><?php $this->render_icon($settings['linkpva_bulk_order_icon']); ?></span><?php endif; ?>
								<?php if (!empty($settings['linkpva_bulk_order_title'])) : ?><h2 id="<?php echo esc_attr($information_heading_id); ?>" class="linkpva-bulk-order-title"><?php echo esc_html($settings['linkpva_bulk_order_title']); ?></h2><?php endif; ?>
								<?php if ($show_description) : ?><p class="linkpva-bulk-order-description"><?php echo esc_html($settings['linkpva_bulk_order_description']); ?></p><?php endif; ?>
								<?php if (!empty($information_items)) : ?>
									<ul class="linkpva-bulk-order-list">
										<?php foreach ($information_items as $item) : ?>
											<li><?php if (!empty($item['icon']['value'])) : ?><span class="linkpva-bulk-order-list-icon"><?php $this->render_icon($item['icon']); ?></span><?php endif; ?><span><?php echo esc_html($item['text']); ?></span></li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</aside>
						</div>
					<?php endif; ?>

					<?php if ($show_form) : ?>
						<div class="<?php echo esc_attr($show_information ? 'col-lg-8' : 'col-12'); ?>">
							<div class="linkpva-content-card linkpva-bulk-order-form-card"<?php if ($show_form_title) : ?> aria-labelledby="<?php echo esc_attr($form_heading_id); ?>"<?php endif; ?>>
								<?php if ($show_form_title) : ?><h2 id="<?php echo esc_attr($form_heading_id); ?>" class="linkpva-bulk-order-form-title"><?php echo esc_html($settings['linkpva_bulk_order_form_title']); ?></h2><?php endif; ?>
								<?php if ('' !== $shortcode) : ?>
									<div class="linkpva-bulk-order-form">
										<?php echo do_shortcode($shortcode); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Registered shortcode output is trusted. ?>
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

Plugin::instance()->widgets_manager->register(new linkpva_Bulk_Order_Widget());
