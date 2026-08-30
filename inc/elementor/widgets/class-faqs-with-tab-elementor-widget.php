<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}

class linkpva_FAQs_With_Tab_Widget extends Widget_Base
{
	public function get_name()
	{
		return 'linkpva_faqs_with_tab';
	}

	public function get_title()
	{
		return esc_html__('LinkPVA FAQs With Tab', 'linkpva-core');
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
		$this->register_sidebar_controls();
		$this->register_help_controls();
		$this->register_faq_controls();
		$this->register_section_style_controls();
		$this->register_sidebar_style_controls();
		$this->register_tabs_style_controls();
		$this->register_help_style_controls();
		$this->register_panel_heading_style_controls();
		$this->register_accordion_style_controls();
		$this->register_question_style_controls();
		$this->register_toggle_style_controls();
		$this->register_answer_style_controls();
	}

	private function register_sidebar_controls()
	{
		$this->start_controls_section('linkpva_faqs_with_tab_sidebar_content', array('label' => esc_html__('Category Sidebar', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_faqs_with_tab_sidebar_title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Question Categories', 'linkpva-core'), 'label_block' => true));
		$this->add_control('linkpva_faqs_with_tab_navigation_label', array('label' => esc_html__('Navigation Label', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('FAQ categories', 'linkpva-core'), 'label_block' => true));
		$this->end_controls_section();
	}

	private function register_help_controls()
	{
		$this->start_controls_section('linkpva_faqs_with_tab_help_content', array('label' => esc_html__('Help Card', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_faqs_with_tab_show_help', array('label' => esc_html__('Show Help Card', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_faqs_with_tab_show_help_icon', array('label' => esc_html__('Show Icon', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_faqs_with_tab_show_help' => 'yes')));
		$this->add_control('linkpva_faqs_with_tab_help_icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-chat-heart', 'library' => 'bootstrap'), 'condition' => array('linkpva_faqs_with_tab_show_help' => 'yes', 'linkpva_faqs_with_tab_show_help_icon' => 'yes')));
		$this->add_control('linkpva_faqs_with_tab_help_title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Need more help?', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_faqs_with_tab_show_help' => 'yes')));
		$this->add_control('linkpva_faqs_with_tab_show_help_description', array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_faqs_with_tab_show_help' => 'yes')));
		$this->add_control('linkpva_faqs_with_tab_help_description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Ask a question before placing an order.', 'linkpva-core'), 'condition' => array('linkpva_faqs_with_tab_show_help' => 'yes', 'linkpva_faqs_with_tab_show_help_description' => 'yes')));
		$this->add_control('linkpva_faqs_with_tab_show_help_link', array('label' => esc_html__('Show Link', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_faqs_with_tab_show_help' => 'yes')));
		$this->add_control('linkpva_faqs_with_tab_help_link_text', array('label' => esc_html__('Link Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Contact support', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_faqs_with_tab_show_help' => 'yes', 'linkpva_faqs_with_tab_show_help_link' => 'yes')));
		$this->add_control('linkpva_faqs_with_tab_help_link', array('label' => esc_html__('Link', 'linkpva-core'), 'type' => Controls_Manager::URL, 'default' => array('url' => home_url('/contact/')), 'show_external' => true, 'condition' => array('linkpva_faqs_with_tab_show_help' => 'yes', 'linkpva_faqs_with_tab_show_help_link' => 'yes')));
		$this->end_controls_section();
	}

	private function register_faq_controls()
	{
		$this->start_controls_section('linkpva_faqs_with_tab_items_content', array('label' => esc_html__('FAQ Tabs', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_faqs_with_tab_open_first', array('label' => esc_html__('Open First Question', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_faqs_with_tab_show_toggle_icon', array('label' => esc_html__('Show Toggle Icon', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_faqs_with_tab_toggle_icon', array('label' => esc_html__('Toggle Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-plus-lg', 'library' => 'bootstrap'), 'condition' => array('linkpva_faqs_with_tab_show_toggle_icon' => 'yes')));

		$repeater = new Repeater();
		$repeater->add_control('tab_label', array('label' => esc_html__('Tab Label', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Products', 'linkpva-core'), 'label_block' => true));
		$repeater->add_control('section_title', array('label' => esc_html__('Section Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Products and selection', 'linkpva-core'), 'label_block' => true));
		$repeater->add_control(
			'faq_lines',
			array(
				'label'       => esc_html__('Questions and Answers', 'linkpva-core'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "What products are available? || Review the available product categories and specifications before ordering.\nHow do I choose a product? || Compare the details shown on each product page and contact support if anything is unclear.",
				'description' => esc_html__('Add one FAQ per line using: Question || Answer', 'linkpva-core'),
				'rows'        => 8,
			)
		);
		$this->add_control('linkpva_faqs_with_tab_categories', array('label' => esc_html__('Categories', 'linkpva-core'), 'type' => Controls_Manager::REPEATER, 'fields' => $repeater->get_controls(), 'title_field' => '{{{ tab_label }}}', 'default' => $this->get_default_categories()));
		$this->end_controls_section();
	}

	private function register_section_style_controls()
	{
		$this->start_controls_section('linkpva_faqs_with_tab_style_section', array('label' => esc_html__('Section & Layout', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_faqs_with_tab_style_section_background', 'selector' => '{{WRAPPER}} .linkpva-faqs-with-tab-widget'));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_section_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-faqs-with-tab-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_columns_gap', array('label' => esc_html__('Columns Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 120)), 'selectors' => array('{{WRAPPER}} .linkpva-faqs-with-tab-widget > .container > .row' => '--bs-gutter-x: {{SIZE}}{{UNIT}}; --bs-gutter-y: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_sidebar_style_controls()
	{
		$this->start_controls_section('linkpva_faqs_with_tab_style_sidebar', array('label' => esc_html__('Sidebar Card', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_faqs_with_tab_style_sidebar_background', 'selector' => '{{WRAPPER}} .linkpva-faq-tabs-sidebar'));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_faqs_with_tab_style_sidebar_border', 'selector' => '{{WRAPPER}} .linkpva-faq-tabs-sidebar'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_faqs_with_tab_style_sidebar_shadow', 'selector' => '{{WRAPPER}} .linkpva-faq-tabs-sidebar'));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_sidebar_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-faq-tabs-sidebar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_sidebar_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-faq-tabs-sidebar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_control('linkpva_faqs_with_tab_style_sidebar_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-faq-tabs-sidebar-title' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_faqs_with_tab_style_sidebar_title_typography', 'selector' => '{{WRAPPER}} .linkpva-faq-tabs-sidebar-title'));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_sidebar_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-faq-tabs-sidebar-title' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_tabs_style_controls()
	{
		$this->start_controls_section('linkpva_faqs_with_tab_style_tabs', array('label' => esc_html__('Category Tabs', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_tabs_gap', array('label' => esc_html__('Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-category-pills' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_faqs_with_tab_style_tab_typography', 'selector' => '{{WRAPPER}} .linkpva-category-pills a'));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_faqs_with_tab_style_tab_border', 'selector' => '{{WRAPPER}} .linkpva-category-pills a'));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_tab_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-category-pills a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_tab_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-category-pills a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->start_controls_tabs('linkpva_faqs_with_tab_style_tab_states');
		$this->start_controls_tab('linkpva_faqs_with_tab_style_tab_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control('linkpva_faqs_with_tab_style_tab_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-category-pills a' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_faqs_with_tab_style_tab_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-category-pills a' => 'background-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_faqs_with_tab_style_tab_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control('linkpva_faqs_with_tab_style_tab_hover_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-category-pills a:hover, {{WRAPPER}} .linkpva-category-pills a:focus-visible' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_faqs_with_tab_style_tab_hover_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-category-pills a:hover, {{WRAPPER}} .linkpva-category-pills a:focus-visible' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_faqs_with_tab_style_tab_hover_border', array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-category-pills a:hover, {{WRAPPER}} .linkpva-category-pills a:focus-visible' => 'border-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_faqs_with_tab_style_tab_active', array('label' => esc_html__('Active', 'linkpva-core')));
		$this->add_control('linkpva_faqs_with_tab_style_tab_active_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-category-pills a.is-active' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_faqs_with_tab_style_tab_active_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-category-pills a.is-active' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_faqs_with_tab_style_tab_active_border', array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-category-pills a.is-active' => 'border-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	private function register_help_style_controls()
	{
		$this->start_controls_section('linkpva_faqs_with_tab_style_help', array('label' => esc_html__('Help Card', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_faqs_with_tab_show_help' => 'yes')));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_faqs_with_tab_style_help_background', 'selector' => '{{WRAPPER}} .linkpva-help-card'));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_faqs_with_tab_style_help_border', 'selector' => '{{WRAPPER}} .linkpva-help-card'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_faqs_with_tab_style_help_shadow', 'selector' => '{{WRAPPER}} .linkpva-help-card'));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_help_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-help-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_help_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-help-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_help_spacing', array('label' => esc_html__('Top Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-help-card' => 'margin-top: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_faqs_with_tab_style_help_icon_color', array('label' => esc_html__('Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-help-icon' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-help-icon path' => 'fill: {{VALUE}};'), 'condition' => array('linkpva_faqs_with_tab_show_help_icon' => 'yes')));
		$this->add_control('linkpva_faqs_with_tab_style_help_icon_background', array('label' => esc_html__('Icon Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-help-icon' => 'background-color: {{VALUE}};'), 'condition' => array('linkpva_faqs_with_tab_show_help_icon' => 'yes')));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_help_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} i.linkpva-help-icon' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} svg.linkpva-help-icon' => 'padding: calc((44px - {{SIZE}}{{UNIT}}) / 2);'), 'condition' => array('linkpva_faqs_with_tab_show_help_icon' => 'yes')));
		$this->add_control('linkpva_faqs_with_tab_style_help_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-help-card h3' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_faqs_with_tab_style_help_title_typography', 'selector' => '{{WRAPPER}} .linkpva-help-card h3'));
		$this->add_control('linkpva_faqs_with_tab_style_help_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-help-card p' => 'color: {{VALUE}};'), 'condition' => array('linkpva_faqs_with_tab_show_help_description' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_faqs_with_tab_style_help_description_typography', 'selector' => '{{WRAPPER}} .linkpva-help-card p', 'condition' => array('linkpva_faqs_with_tab_show_help_description' => 'yes')));
		$this->add_control('linkpva_faqs_with_tab_style_help_link_color', array('label' => esc_html__('Link Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-help-card a' => 'color: {{VALUE}};'), 'condition' => array('linkpva_faqs_with_tab_show_help_link' => 'yes')));
		$this->add_control('linkpva_faqs_with_tab_style_help_link_hover_color', array('label' => esc_html__('Link Hover Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-help-card a:hover, {{WRAPPER}} .linkpva-help-card a:focus-visible' => 'color: {{VALUE}};'), 'condition' => array('linkpva_faqs_with_tab_show_help_link' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_faqs_with_tab_style_help_link_typography', 'selector' => '{{WRAPPER}} .linkpva-help-card a', 'condition' => array('linkpva_faqs_with_tab_show_help_link' => 'yes')));
		$this->end_controls_section();
	}

	private function register_panel_heading_style_controls()
	{
		$this->start_controls_section('linkpva_faqs_with_tab_style_panel_heading', array('label' => esc_html__('Panel Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_control('linkpva_faqs_with_tab_style_panel_heading_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-faq-tab-heading' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_faqs_with_tab_style_panel_heading_typography', 'selector' => '{{WRAPPER}} .linkpva-faq-tab-heading'));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_panel_heading_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-faq-tab-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_accordion_style_controls()
	{
		$this->start_controls_section('linkpva_faqs_with_tab_style_accordion', array('label' => esc_html__('Accordion', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_faqs_with_tab_style_accordion_background', 'selector' => '{{WRAPPER}} .linkpva-accordion'));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_faqs_with_tab_style_accordion_border', 'selector' => '{{WRAPPER}} .linkpva-accordion'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_faqs_with_tab_style_accordion_shadow', 'selector' => '{{WRAPPER}} .linkpva-accordion'));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_accordion_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-accordion' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_control('linkpva_faqs_with_tab_style_divider_color', array('label' => esc_html__('Divider Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item' => 'border-color: {{VALUE}};')));
		$this->end_controls_section();
	}

	private function register_question_style_controls()
	{
		$this->start_controls_section('linkpva_faqs_with_tab_style_question', array('label' => esc_html__('Questions', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_faqs_with_tab_style_question_typography', 'selector' => '{{WRAPPER}} .linkpva-accordion-item button'));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_question_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_control('linkpva_faqs_with_tab_style_question_color', array('label' => esc_html__('Closed Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item button' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_faqs_with_tab_style_question_open_color', array('label' => esc_html__('Open Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item.is-open button' => 'color: {{VALUE}};')));
		$this->end_controls_section();
	}

	private function register_toggle_style_controls()
	{
		$this->start_controls_section('linkpva_faqs_with_tab_style_toggle', array('label' => esc_html__('Toggle Icon', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_faqs_with_tab_show_toggle_icon' => 'yes')));
		$this->add_control('linkpva_faqs_with_tab_style_toggle_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-faq-toggle-icon' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-faq-toggle-icon path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_faqs_with_tab_style_toggle_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-faq-toggle-icon' => 'background-color: {{VALUE}};')));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_toggle_size', array('label' => esc_html__('Box Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 16, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-faq-toggle-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_toggle_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-faq-toggle-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_answer_style_controls()
	{
		$this->start_controls_section('linkpva_faqs_with_tab_style_answer', array('label' => esc_html__('Answers', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_control('linkpva_faqs_with_tab_style_answer_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item > div p' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_faqs_with_tab_style_answer_typography', 'selector' => '{{WRAPPER}} .linkpva-accordion-item > div p'));
		$this->add_responsive_control('linkpva_faqs_with_tab_style_answer_padding', array('label' => esc_html__('Panel Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-accordion-item > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function get_default_categories()
	{
		return array(
			array('tab_label' => esc_html__('Products', 'linkpva-core'), 'section_title' => esc_html__('Products and selection', 'linkpva-core'), 'faq_lines' => "What types of products are available? || Listings are organized by product type and current availability.\nHow do I choose the right listing? || Compare the specifications, delivery details, and applicable conditions on each product page.\nWhat do product labels mean? || The exact meaning of each label is defined by the details shown on its product page."),
			array('tab_label' => esc_html__('Orders', 'linkpva-core'), 'section_title' => esc_html__('Ordering and delivery', 'linkpva-core'), 'faq_lines' => "How does delivery work? || Order information is provided through the method and timeline stated on the product page after confirmation.\nCan I place a bulk order? || Use the bulk-order form to submit your required category, specifications, quantity, and preferred timeframe.\nWhat payment methods are available? || Approved payment methods are displayed during checkout."),
			array('tab_label' => esc_html__('Policies', 'linkpva-core'), 'section_title' => esc_html__('Policies and support', 'linkpva-core'), 'faq_lines' => "What is the replacement or refund policy? || Eligibility depends on the published conditions and request window. Read the policy before purchase.\nHow is order information protected? || Only necessary information should be collected and sensitive data should use a protected workflow.\nDo you provide purchase support? || Available support methods and service hours are published on the contact page."),
		);
	}

	private function parse_faq_lines($value)
	{
		$items = array();
		$lines = preg_split('/\r\n|\r|\n/', (string) $value);

		foreach ($lines as $line) {
			$parts = array_map('trim', explode('||', $line, 2));
			if (2 === count($parts) && '' !== $parts[0] && '' !== $parts[1]) {
				$items[] = array('question' => $parts[0], 'answer' => $parts[1]);
			}
		}

		return $items;
	}

	private function normalize_faq_categories($categories)
	{
		if (!is_array($categories)) {
			return array();
		}

		$normalized = array();
		foreach ($categories as $category) {
			$faqs = $this->parse_faq_lines($category['faq_lines'] ?? '');
			if (!empty($category['tab_label']) && !empty($faqs)) {
				$category['faqs'] = $faqs;
				$normalized[] = $category;
			}
		}

		return $normalized;
	}

	private function render_icon($icon, $class = '')
	{
		if (is_array($icon) && !empty($icon['value'])) {
			$attributes = array('aria-hidden' => 'true');
			if ('' !== $class) {
				$attributes['class'] = sanitize_html_class($class);
			}
			Icons_Manager::render_icon($icon, $attributes);
		}
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$categories = $this->normalize_faq_categories($settings['linkpva_faqs_with_tab_categories'] ?? array());
		$widget_id = sanitize_html_class($this->get_id());
		$show_help_description = 'yes' === ($settings['linkpva_faqs_with_tab_show_help_description'] ?? '') && !empty($settings['linkpva_faqs_with_tab_help_description']);
		$show_help_link = 'yes' === ($settings['linkpva_faqs_with_tab_show_help_link'] ?? '') && !empty($settings['linkpva_faqs_with_tab_help_link_text']) && !empty($settings['linkpva_faqs_with_tab_help_link']['url']);
		$show_help = 'yes' === ($settings['linkpva_faqs_with_tab_show_help'] ?? '') && (!empty($settings['linkpva_faqs_with_tab_help_title']) || $show_help_description || $show_help_link);
		$show_help_icon = $show_help && 'yes' === ($settings['linkpva_faqs_with_tab_show_help_icon'] ?? '') && !empty($settings['linkpva_faqs_with_tab_help_icon']['value']);
		$show_toggle_icon = 'yes' === ($settings['linkpva_faqs_with_tab_show_toggle_icon'] ?? '') && !empty($settings['linkpva_faqs_with_tab_toggle_icon']['value']);
		$open_first = 'yes' === ($settings['linkpva_faqs_with_tab_open_first'] ?? '');

		if (empty($categories)) {
			return;
		}
		if ($show_help_link) {
			$this->add_link_attributes('linkpva_faqs_with_tab_help_link', $settings['linkpva_faqs_with_tab_help_link']);
		}
?>
		<section class="linkpva-inner-section linkpva-faqs-with-tab-widget">
			<div class="container">
				<div class="row g-5">
					<aside class="col-lg-4">
						<div class="linkpva-content-card linkpva-faq-tabs-sidebar">
							<?php if (!empty($settings['linkpva_faqs_with_tab_sidebar_title'])) : ?><h2 class="linkpva-faq-tabs-sidebar-title"><?php echo esc_html($settings['linkpva_faqs_with_tab_sidebar_title']); ?></h2><?php endif; ?>
							<nav class="linkpva-category-pills" aria-label="<?php echo esc_attr($settings['linkpva_faqs_with_tab_navigation_label'] ?: esc_html__('FAQ categories', 'linkpva-core')); ?>">
								<?php foreach ($categories as $category_index => $category) :
									$panel_id = 'linkpva-faq-panel-' . $widget_id . '-' . ($category_index + 1);
									$is_active = 0 === $category_index;
								?>
									<a class="<?php echo $is_active ? 'is-active' : ''; ?>" href="#<?php echo esc_attr($panel_id); ?>"><?php echo esc_html($category['tab_label']); ?></a>
								<?php endforeach; ?>
							</nav>
							<?php if ($show_help) : ?><div class="linkpva-help-card">
									<?php if ($show_help_icon) : ?><?php $this->render_icon($settings['linkpva_faqs_with_tab_help_icon'], 'linkpva-help-icon'); ?><?php endif; ?>
									<div>
										<?php if (!empty($settings['linkpva_faqs_with_tab_help_title'])) : ?><h3><?php echo esc_html($settings['linkpva_faqs_with_tab_help_title']); ?></h3><?php endif; ?>
										<?php if ($show_help_description) : ?><p><?php echo esc_html($settings['linkpva_faqs_with_tab_help_description']); ?></p><?php endif; ?>
										<?php if ($show_help_link) : ?><a <?php $this->print_render_attribute_string('linkpva_faqs_with_tab_help_link'); ?>><?php echo esc_html($settings['linkpva_faqs_with_tab_help_link_text']); ?></a><?php endif; ?>
									</div>
								</div><?php endif; ?>
						</div>
					</aside>
					<div class="col-lg-8">
						<?php foreach ($categories as $category_index => $category) :
							$panel_id = 'linkpva-faq-panel-' . $widget_id . '-' . ($category_index + 1);
						?>
							<section id="<?php echo esc_attr($panel_id); ?>" class="linkpva-faq-tab-panel">
								<?php if (!empty($category['section_title'])) : ?><h2 class="linkpva-faq-tab-heading"><?php echo esc_html($category['section_title']); ?></h2><?php endif; ?>
								<div class="linkpva-accordion" data-accordion>
									<?php foreach ($category['faqs'] as $faq_index => $faq) :
										$is_open = $open_first && 0 === $faq_index;
										$question_id = 'linkpva-faq-tab-question-' . $widget_id . '-' . ($category_index + 1) . '-' . ($faq_index + 1);
										$answer_id = 'linkpva-faq-tab-answer-' . $widget_id . '-' . ($category_index + 1) . '-' . ($faq_index + 1);
									?>
										<article class="linkpva-accordion-item<?php echo $is_open ? ' is-open' : ''; ?>">
											<h3><button type="button" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr($answer_id); ?>" id="<?php echo esc_attr($question_id); ?>"><?php echo esc_html($faq['question']); ?><?php if ($show_toggle_icon) : ?><?php $this->render_icon($settings['linkpva_faqs_with_tab_toggle_icon'], 'linkpva-faq-toggle-icon'); ?><?php endif; ?></button></h3>
											<div id="<?php echo esc_attr($answer_id); ?>" role="region" aria-labelledby="<?php echo esc_attr($question_id); ?>" <?php if (!$is_open) : ?> hidden<?php endif; ?>>
												<p><?php echo esc_html($faq['answer']); ?></p>
											</div>
										</article>
									<?php endforeach; ?>
								</div>
							</section>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>
<?php
	}
}

Plugin::instance()->widgets_manager->register(new linkpva_FAQs_With_Tab_Widget());
