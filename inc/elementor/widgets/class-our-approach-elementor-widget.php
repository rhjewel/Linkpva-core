<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}

class linkpva_Our_Approach_Widget extends Widget_Base
{
	public function get_name()
	{
		return 'linkpva_our_approach';
	}

	public function get_title()
	{
		return esc_html__('LinkPVA Our Approach', 'linkpva-core');
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
		$this->register_intro_controls();
		$this->register_button_controls();
		$this->register_cards_controls();
		$this->register_section_style_controls();
		$this->register_intro_style_controls();
		$this->register_button_style_controls();
		$this->register_cards_container_style_controls();
		$this->register_card_style_controls();
		$this->register_card_icon_style_controls();
		$this->register_card_content_style_controls();
	}

	private function register_intro_controls()
	{
		$this->start_controls_section('linkpva_our_approach_intro_content', array('label' => esc_html__('Introduction', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_our_approach_show_tag', array('label' => esc_html__('Show Tag', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_our_approach_tag', array('label' => esc_html__('Tag', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Our Approach', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_our_approach_show_tag' => 'yes')));
		$this->add_control('linkpva_our_approach_title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Built Around Clear Product Information', 'linkpva-core'), 'label_block' => true, 'rows' => 3));
		$this->add_control('linkpva_our_approach_show_description', array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control(
			'linkpva_our_approach_description',
			array(
				'label'       => esc_html__('Description', 'linkpva-core'),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => '<p>' . esc_html__('Customers should be able to understand what a listing includes before deciding to buy. LinkPVA organizes account categories, specifications, delivery information, and applicable policies in a consistent format.', 'linkpva-core') . '</p><p>' . esc_html__('The marketplace is independent and does not imply endorsement by LinkedIn. Product wording and business processes must remain factual, transparent, and compliant with applicable requirements.', 'linkpva-core') . '</p>',
				'label_block' => true,
				'condition'   => array('linkpva_our_approach_show_description' => 'yes'),
			)
		);
		$this->end_controls_section();
	}

	private function register_button_controls()
	{
		$this->start_controls_section('linkpva_our_approach_button_content', array('label' => esc_html__('Button', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_our_approach_show_button', array('label' => esc_html__('Show Button', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_our_approach_button_text', array('label' => esc_html__('Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Explore Products', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_our_approach_show_button' => 'yes')));
		$this->add_control('linkpva_our_approach_button_link', array('label' => esc_html__('Link', 'linkpva-core'), 'type' => Controls_Manager::URL, 'default' => array('url' => home_url('/shop/')), 'show_external' => true, 'condition' => array('linkpva_our_approach_show_button' => 'yes')));
		$this->add_control('linkpva_our_approach_button_icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'), 'condition' => array('linkpva_our_approach_show_button' => 'yes')));
		$this->end_controls_section();
	}

	private function register_cards_controls()
	{
		$this->start_controls_section('linkpva_our_approach_cards_content', array('label' => esc_html__('Approach Cards', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_our_approach_show_cards', array('label' => esc_html__('Show Cards', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_our_approach_show_card_icons', array('label' => esc_html__('Show Icons', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_our_approach_show_cards' => 'yes')));
		$this->add_control('linkpva_our_approach_show_card_descriptions', array('label' => esc_html__('Show Descriptions', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_our_approach_show_cards' => 'yes')));

		$repeater = new Repeater();
		$repeater->add_control('icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-card-checklist', 'library' => 'bootstrap')));
		$repeater->add_control('title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Clear Details', 'linkpva-core'), 'label_block' => true));
		$repeater->add_control('description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Relevant information displayed consistently.', 'linkpva-core'), 'label_block' => true));
		$this->add_control('linkpva_our_approach_cards', array('label' => esc_html__('Cards', 'linkpva-core'), 'type' => Controls_Manager::REPEATER, 'fields' => $repeater->get_controls(), 'title_field' => '{{{ title }}}', 'default' => $this->get_default_cards(), 'condition' => array('linkpva_our_approach_show_cards' => 'yes')));
		$this->end_controls_section();
	}

	private function register_section_style_controls()
	{
		$this->start_controls_section('linkpva_our_approach_style_section', array('label' => esc_html__('Section & Layout', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_our_approach_style_section_background', 'selector' => '{{WRAPPER}} .linkpva-our-approach-widget'));
		$this->add_responsive_control('linkpva_our_approach_style_section_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_our_approach_style_columns_gap', array('label' => esc_html__('Columns Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 150)), 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-widget > .container > .row' => '--bs-gutter-x: {{SIZE}}{{UNIT}}; --bs-gutter-y: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_intro_style_controls()
	{
		$this->start_controls_section('linkpva_our_approach_style_intro', array('label' => esc_html__('Introduction', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_control('linkpva_our_approach_style_tag_color', array('label' => esc_html__('Tag Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-tag' => 'color: {{VALUE}};'), 'condition' => array('linkpva_our_approach_show_tag' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_our_approach_style_tag_typography', 'selector' => '{{WRAPPER}} .linkpva-our-approach-tag', 'condition' => array('linkpva_our_approach_show_tag' => 'yes')));
		$this->add_responsive_control('linkpva_our_approach_style_tag_spacing', array('label' => esc_html__('Tag Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_our_approach_show_tag' => 'yes')));
		$this->add_control('linkpva_our_approach_style_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-title' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_our_approach_style_title_typography', 'selector' => '{{WRAPPER}} .linkpva-our-approach-title'));
		$this->add_responsive_control('linkpva_our_approach_style_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-title' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_our_approach_style_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-description, {{WRAPPER}} .linkpva-our-approach-description p' => 'color: {{VALUE}};'), 'condition' => array('linkpva_our_approach_show_description' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_our_approach_style_description_typography', 'selector' => '{{WRAPPER}} .linkpva-our-approach-description, {{WRAPPER}} .linkpva-our-approach-description p', 'condition' => array('linkpva_our_approach_show_description' => 'yes')));
		$this->add_responsive_control('linkpva_our_approach_style_description_paragraph_spacing', array('label' => esc_html__('Paragraph Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-description p' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_our_approach_show_description' => 'yes')));
		$this->end_controls_section();
	}

	private function register_button_style_controls()
	{
		$this->start_controls_section('linkpva_our_approach_style_button', array('label' => esc_html__('Button', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_our_approach_show_button' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_our_approach_style_button_typography', 'selector' => '{{WRAPPER}} .linkpva-our-approach-button'));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_our_approach_style_button_border', 'selector' => '{{WRAPPER}} .linkpva-our-approach-button'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_our_approach_style_button_shadow', 'selector' => '{{WRAPPER}} .linkpva-our-approach-button'));
		$this->add_responsive_control('linkpva_our_approach_style_button_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_our_approach_style_button_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_our_approach_style_button_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-button i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-our-approach-button svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->start_controls_tabs('linkpva_our_approach_style_button_states');
		$this->start_controls_tab('linkpva_our_approach_style_button_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control('linkpva_our_approach_style_button_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-button' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-our-approach-button svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_our_approach_style_button_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-button' => 'background-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_our_approach_style_button_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control('linkpva_our_approach_style_button_hover_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-button:hover, {{WRAPPER}} .linkpva-our-approach-button:focus-visible' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-our-approach-button:hover svg path, {{WRAPPER}} .linkpva-our-approach-button:focus-visible svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_our_approach_style_button_hover_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-button:hover, {{WRAPPER}} .linkpva-our-approach-button:focus-visible' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_our_approach_style_button_hover_border', array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-button:hover, {{WRAPPER}} .linkpva-our-approach-button:focus-visible' => 'border-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	private function register_cards_container_style_controls()
	{
		$this->start_controls_section('linkpva_our_approach_style_cards_container', array('label' => esc_html__('Cards Container', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_our_approach_show_cards' => 'yes')));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_our_approach_style_cards_container_background', 'selector' => '{{WRAPPER}} .linkpva-our-approach-cards-wrap'));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_our_approach_style_cards_container_border', 'selector' => '{{WRAPPER}} .linkpva-our-approach-cards-wrap'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_our_approach_style_cards_container_shadow', 'selector' => '{{WRAPPER}} .linkpva-our-approach-cards-wrap'));
		$this->add_responsive_control('linkpva_our_approach_style_cards_container_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-cards-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_our_approach_style_cards_container_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-cards-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_our_approach_style_cards_gap', array('label' => esc_html__('Cards Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-grid' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_card_style_controls()
	{
		$this->start_controls_section('linkpva_our_approach_style_card', array('label' => esc_html__('Cards', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_our_approach_show_cards' => 'yes')));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_our_approach_style_card_background', 'selector' => '{{WRAPPER}} .linkpva-our-approach-card'));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_our_approach_style_card_border', 'selector' => '{{WRAPPER}} .linkpva-our-approach-card'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_our_approach_style_card_shadow', 'selector' => '{{WRAPPER}} .linkpva-our-approach-card'));
		$this->add_responsive_control('linkpva_our_approach_style_card_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_our_approach_style_card_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_card_icon_style_controls()
	{
		$icon_selector = '{{WRAPPER}} .linkpva-our-approach-card > i, {{WRAPPER}} .linkpva-our-approach-card > svg';
		$this->start_controls_section('linkpva_our_approach_style_card_icon', array('label' => esc_html__('Card Icons', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_our_approach_show_cards' => 'yes', 'linkpva_our_approach_show_card_icons' => 'yes')));
		$this->add_control('linkpva_our_approach_style_card_icon_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array($icon_selector => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-our-approach-card > svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_our_approach_style_card_icon_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array($icon_selector => 'background-color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_our_approach_style_card_icon_border', 'selector' => $icon_selector));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_our_approach_style_card_icon_shadow', 'selector' => $icon_selector));
		$this->add_responsive_control('linkpva_our_approach_style_card_icon_box_size', array('label' => esc_html__('Box Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 20, 'max' => 120)), 'selectors' => array($icon_selector => '--linkpva-approach-icon-box-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_our_approach_style_card_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-card > i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-our-approach-card > svg' => '--linkpva-approach-icon-size: {{SIZE}}{{UNIT}}; padding: calc((var(--linkpva-approach-icon-box-size, 48px) - {{SIZE}}{{UNIT}}) / 2);')));
		$this->add_responsive_control('linkpva_our_approach_style_card_icon_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array($icon_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_our_approach_style_card_icon_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array($icon_selector => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_card_content_style_controls()
	{
		$this->start_controls_section('linkpva_our_approach_style_card_content', array('label' => esc_html__('Card Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_our_approach_show_cards' => 'yes')));
		$this->add_control('linkpva_our_approach_style_card_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-card h3' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_our_approach_style_card_title_typography', 'selector' => '{{WRAPPER}} .linkpva-our-approach-card h3'));
		$this->add_responsive_control('linkpva_our_approach_style_card_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-card h3' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_our_approach_style_card_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-our-approach-card p' => 'color: {{VALUE}};'), 'condition' => array('linkpva_our_approach_show_card_descriptions' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_our_approach_style_card_description_typography', 'selector' => '{{WRAPPER}} .linkpva-our-approach-card p', 'condition' => array('linkpva_our_approach_show_card_descriptions' => 'yes')));
		$this->end_controls_section();
	}

	private function get_default_cards()
	{
		return array(
			array('icon' => array('value' => 'bi bi-card-checklist', 'library' => 'bootstrap'), 'title' => esc_html__('Clear Details', 'linkpva-core'), 'description' => esc_html__('Relevant information displayed consistently.', 'linkpva-core')),
			array('icon' => array('value' => 'bi bi-ui-checks-grid', 'library' => 'bootstrap'), 'title' => esc_html__('Simple Flow', 'linkpva-core'), 'description' => esc_html__('A predictable path from listing to order.', 'linkpva-core')),
			array('icon' => array('value' => 'bi bi-chat-dots', 'library' => 'bootstrap'), 'title' => esc_html__('Order Help', 'linkpva-core'), 'description' => esc_html__('Support for product and purchase questions.', 'linkpva-core')),
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
		$heading_id = 'linkpva-our-approach-heading-' . $widget_id;
		$show_tag = 'yes' === ($settings['linkpva_our_approach_show_tag'] ?? '') && !empty($settings['linkpva_our_approach_tag']);
		$show_description = 'yes' === ($settings['linkpva_our_approach_show_description'] ?? '') && !empty($settings['linkpva_our_approach_description']);
		$show_button = 'yes' === ($settings['linkpva_our_approach_show_button'] ?? '') && !empty($settings['linkpva_our_approach_button_text']) && !empty($settings['linkpva_our_approach_button_link']['url']);
		$show_cards = 'yes' === ($settings['linkpva_our_approach_show_cards'] ?? '');
		$show_card_icons = $show_cards && 'yes' === ($settings['linkpva_our_approach_show_card_icons'] ?? '');
		$show_card_descriptions = $show_cards && 'yes' === ($settings['linkpva_our_approach_show_card_descriptions'] ?? '');
		$cards = $show_cards ? $this->normalize_cards($settings['linkpva_our_approach_cards'] ?? array(), $show_card_descriptions) : array();
		$has_title = !empty($settings['linkpva_our_approach_title']);
		$has_intro = $show_tag || $has_title || $show_description || $show_button;

		if (!$has_intro && empty($cards)) {
			return;
		}

		if ($show_button) {
			$this->add_link_attributes('linkpva_our_approach_button', $settings['linkpva_our_approach_button_link']);
			$this->add_render_attribute('linkpva_our_approach_button', 'class', array('linkpva-button', 'linkpva-button-primary', 'linkpva-our-approach-button'));
		}
		?>
		<section class="linkpva-inner-section linkpva-our-approach-widget" data-linkpva-our-approach-widget="<?php echo esc_attr($widget_id); ?>"<?php if ($has_title) : ?> aria-labelledby="<?php echo esc_attr($heading_id); ?>"<?php endif; ?>>
			<div class="container">
				<div class="row g-5 align-items-center">
					<?php if ($has_intro) : ?>
						<div class="<?php echo esc_attr(empty($cards) ? 'col-12' : 'col-lg-6'); ?> linkpva-our-approach-intro">
							<?php if ($show_tag) : ?><span class="linkpva-section-tag linkpva-our-approach-tag"><?php echo esc_html($settings['linkpva_our_approach_tag']); ?></span><?php endif; ?>
							<?php if ($has_title) : ?><h2 id="<?php echo esc_attr($heading_id); ?>" class="display-5 linkpva-our-approach-title"><?php echo esc_html($settings['linkpva_our_approach_title']); ?></h2><?php endif; ?>
							<?php if ($show_description) : ?><div class="linkpva-our-approach-description"><?php echo wp_kses_post($settings['linkpva_our_approach_description']); ?></div><?php endif; ?>
							<?php if ($show_button) : ?><a <?php $this->print_render_attribute_string('linkpva_our_approach_button'); ?>><?php echo esc_html($settings['linkpva_our_approach_button_text']); ?><?php $this->render_icon($settings['linkpva_our_approach_button_icon'] ?? array()); ?></a><?php endif; ?>
						</div>
					<?php endif; ?>
					<?php if (!empty($cards)) : ?>
						<div class="<?php echo esc_attr($has_intro ? 'col-lg-6' : 'col-12'); ?>">
							<div class="linkpva-content-card linkpva-our-approach-cards-wrap">
								<div class="linkpva-info-grid linkpva-our-approach-grid">
									<?php foreach ($cards as $card) : ?>
										<article class="linkpva-info-card linkpva-our-approach-card">
											<?php if ($show_card_icons && !empty($card['icon']['value'])) : ?><?php $this->render_icon($card['icon']); ?><?php endif; ?>
											<?php if (!empty($card['title'])) : ?><h3><?php echo esc_html($card['title']); ?></h3><?php endif; ?>
											<?php if ($show_card_descriptions && !empty($card['description'])) : ?><p><?php echo esc_html($card['description']); ?></p><?php endif; ?>
										</article>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<?php
	}
}

Plugin::instance()->widgets_manager->register(new linkpva_Our_Approach_Widget());
