<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}

class linkpva_CTA_Widget extends Widget_Base
{
	public function get_name()
	{
		return 'linkpva_cta';
	}

	public function get_title()
	{
		return esc_html__('LinkPVA Call To Action', 'linkpva-core');
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
		$this->register_primary_button_controls();
		$this->register_secondary_button_controls();
		$this->register_section_style_controls();
		$this->register_content_style_controls();
		$this->register_button_group_style_controls();
		$this->register_primary_button_style_controls();
		$this->register_secondary_button_style_controls();
	}

	private function register_content_controls()
	{
		$this->start_controls_section('linkpva_call_to_action_content', array('label' => esc_html__('Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_call_to_action_show_tag', array('label' => esc_html__('Show Tag', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_call_to_action_tag', array('label' => esc_html__('Tag', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Explore the Marketplace', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_call_to_action_show_tag' => 'yes')));
		$this->add_control('linkpva_call_to_action_title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Ready to Compare Available LinkedIn Accounts?', 'linkpva-core'), 'label_block' => true));
		$this->add_control('linkpva_call_to_action_show_description', array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_call_to_action_description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Browse current listings, review the available details, and choose the option that fits your requirements.', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_call_to_action_show_description' => 'yes')));
		$this->end_controls_section();
	}

	private function register_primary_button_controls()
	{
		$this->start_controls_section('linkpva_call_to_action_primary_button_content', array('label' => esc_html__('Primary Button', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_call_to_action_show_primary_button', array('label' => esc_html__('Show Button', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_call_to_action_primary_button_text', array('label' => esc_html__('Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Browse All Products', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_call_to_action_show_primary_button' => 'yes')));
		$this->add_control('linkpva_call_to_action_primary_button_link', array('label' => esc_html__('Link', 'linkpva-core'), 'type' => Controls_Manager::URL, 'default' => array('url' => home_url('/shop/')), 'show_external' => true, 'condition' => array('linkpva_call_to_action_show_primary_button' => 'yes')));
		$this->add_control('linkpva_call_to_action_show_primary_button_icon', array('label' => esc_html__('Show Icon', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_call_to_action_show_primary_button' => 'yes')));
		$this->add_control('linkpva_call_to_action_primary_button_icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'), 'condition' => array('linkpva_call_to_action_show_primary_button' => 'yes', 'linkpva_call_to_action_show_primary_button_icon' => 'yes')));
		$this->end_controls_section();
	}

	private function register_secondary_button_controls()
	{
		$this->start_controls_section('linkpva_call_to_action_secondary_button_content', array('label' => esc_html__('Secondary Button', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_call_to_action_show_secondary_button', array('label' => esc_html__('Show Button', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_call_to_action_secondary_button_text', array('label' => esc_html__('Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Contact Support', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_call_to_action_show_secondary_button' => 'yes')));
		$this->add_control('linkpva_call_to_action_secondary_button_link', array('label' => esc_html__('Link', 'linkpva-core'), 'type' => Controls_Manager::URL, 'default' => array('url' => home_url('/contact/')), 'show_external' => true, 'condition' => array('linkpva_call_to_action_show_secondary_button' => 'yes')));
		$this->end_controls_section();
	}

	private function register_section_style_controls()
	{
		$this->start_controls_section('linkpva_call_to_action_style_section', array('label' => esc_html__('Section', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_call_to_action_style_section_background', 'selector' => '{{WRAPPER}} .linkpva-final-cta'));
		$this->add_responsive_control('linkpva_call_to_action_style_section_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-final-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_content_style_controls()
	{
		$this->start_controls_section('linkpva_call_to_action_style_content', array('label' => esc_html__('Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_responsive_control('linkpva_call_to_action_style_content_width', array('label' => esc_html__('Maximum Width', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', '%'), 'range' => array('px' => array('min' => 200, 'max' => 1400)), 'selectors' => array('{{WRAPPER}} .linkpva-final-cta-inner' => 'max-width: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control(
			'linkpva_call_to_action_style_alignment',
			array(
				'label'   => esc_html__('Alignment', 'linkpva-core'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'left'   => array('title' => esc_html__('Left', 'linkpva-core'), 'icon' => 'eicon-text-align-left'),
					'center' => array('title' => esc_html__('Center', 'linkpva-core'), 'icon' => 'eicon-text-align-center'),
					'right'  => array('title' => esc_html__('Right', 'linkpva-core'), 'icon' => 'eicon-text-align-right'),
				),
				'default'   => 'center',
				'selectors' => array('{{WRAPPER}} .linkpva-final-cta-inner' => 'text-align: {{VALUE}};'),
			)
		);
		$this->add_control('linkpva_call_to_action_style_tag_color', array('label' => esc_html__('Tag Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-final-cta-inner .linkpva-section-tag' => 'color: {{VALUE}};'), 'condition' => array('linkpva_call_to_action_show_tag' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_call_to_action_style_tag_typography', 'selector' => '{{WRAPPER}} .linkpva-final-cta-inner .linkpva-section-tag', 'condition' => array('linkpva_call_to_action_show_tag' => 'yes')));
		$this->add_responsive_control('linkpva_call_to_action_style_tag_spacing', array('label' => esc_html__('Tag Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-final-cta-inner .linkpva-section-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_call_to_action_show_tag' => 'yes')));
		$this->add_control('linkpva_call_to_action_style_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-final-cta-inner h2' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_call_to_action_style_title_typography', 'selector' => '{{WRAPPER}} .linkpva-final-cta-inner h2'));
		$this->add_responsive_control('linkpva_call_to_action_style_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-final-cta-inner h2' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_call_to_action_style_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-final-cta-inner > p' => 'color: {{VALUE}};'), 'condition' => array('linkpva_call_to_action_show_description' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_call_to_action_style_description_typography', 'selector' => '{{WRAPPER}} .linkpva-final-cta-inner > p', 'condition' => array('linkpva_call_to_action_show_description' => 'yes')));
		$this->add_responsive_control('linkpva_call_to_action_style_description_width', array('label' => esc_html__('Description Maximum Width', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 100, 'max' => 1000)), 'selectors' => array('{{WRAPPER}} .linkpva-final-cta-inner > p' => 'max-width: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_call_to_action_show_description' => 'yes')));
		$this->add_responsive_control('linkpva_call_to_action_style_description_spacing', array('label' => esc_html__('Description Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-final-cta-inner > p' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_call_to_action_show_description' => 'yes')));
		$this->end_controls_section();
	}

	private function register_button_group_style_controls()
	{
		$this->start_controls_section(
			'linkpva_call_to_action_style_button_group',
			array(
				'label'      => esc_html__('Button Group', 'linkpva-core'),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array('name' => 'linkpva_call_to_action_show_primary_button', 'operator' => '===', 'value' => 'yes'),
						array('name' => 'linkpva_call_to_action_show_secondary_button', 'operator' => '===', 'value' => 'yes'),
					),
				),
			)
		);
		$this->add_responsive_control(
			'linkpva_call_to_action_style_button_group_alignment',
			array(
				'label'   => esc_html__('Alignment', 'linkpva-core'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'flex-start' => array('title' => esc_html__('Left', 'linkpva-core'), 'icon' => 'eicon-h-align-left'),
					'center'     => array('title' => esc_html__('Center', 'linkpva-core'), 'icon' => 'eicon-h-align-center'),
					'flex-end'   => array('title' => esc_html__('Right', 'linkpva-core'), 'icon' => 'eicon-h-align-right'),
				),
				'default'   => 'center',
				'selectors' => array('{{WRAPPER}} .linkpva-final-cta-inner .linkpva-button-group' => 'justify-content: {{VALUE}};'),
			)
		);
		$this->add_responsive_control('linkpva_call_to_action_style_button_group_gap', array('label' => esc_html__('Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 60)), 'selectors' => array('{{WRAPPER}} .linkpva-final-cta-inner .linkpva-button-group' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_call_to_action_style_button_group_spacing', array('label' => esc_html__('Top Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-final-cta-inner .linkpva-button-group' => 'margin-top: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_primary_button_style_controls()
	{
		$this->start_controls_section('linkpva_call_to_action_style_primary_button', array('label' => esc_html__('Primary Button', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_call_to_action_show_primary_button' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_call_to_action_style_primary_button_typography', 'selector' => '{{WRAPPER}} .linkpva-final-cta .linkpva-button-primary'));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_call_to_action_style_primary_button_border', 'selector' => '{{WRAPPER}} .linkpva-final-cta .linkpva-button-primary'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_call_to_action_style_primary_button_shadow', 'selector' => '{{WRAPPER}} .linkpva-final-cta .linkpva-button-primary'));
		$this->add_responsive_control('linkpva_call_to_action_style_primary_button_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-final-cta .linkpva-button-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_call_to_action_style_primary_button_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-final-cta .linkpva-button-primary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_call_to_action_style_primary_button_gap', array('label' => esc_html__('Icon Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-final-cta .linkpva-button-primary' => 'gap: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_call_to_action_show_primary_button_icon' => 'yes')));
		$this->add_responsive_control('linkpva_call_to_action_style_primary_button_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-button-primary i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-button-primary svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_call_to_action_show_primary_button_icon' => 'yes')));
		$this->start_controls_tabs('linkpva_call_to_action_style_primary_button_tabs');
		$this->start_controls_tab('linkpva_call_to_action_style_primary_button_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control('linkpva_call_to_action_style_primary_button_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-primary' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-button-primary svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_call_to_action_style_primary_button_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-primary' => 'background-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_call_to_action_style_primary_button_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control('linkpva_call_to_action_style_primary_button_hover_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-primary:hover, {{WRAPPER}} .linkpva-button-primary:focus-visible' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-button-primary:hover svg path, {{WRAPPER}} .linkpva-button-primary:focus-visible svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_call_to_action_style_primary_button_hover_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-primary:hover, {{WRAPPER}} .linkpva-button-primary:focus-visible' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_call_to_action_style_primary_button_hover_border', array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-primary:hover, {{WRAPPER}} .linkpva-button-primary:focus-visible' => 'border-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	private function register_secondary_button_style_controls()
	{
		$this->start_controls_section('linkpva_call_to_action_style_secondary_button', array('label' => esc_html__('Secondary Button', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_call_to_action_show_secondary_button' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_call_to_action_style_secondary_button_typography', 'selector' => '{{WRAPPER}} .linkpva-final-cta .linkpva-button-secondary'));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_call_to_action_style_secondary_button_border', 'selector' => '{{WRAPPER}} .linkpva-final-cta .linkpva-button-secondary'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_call_to_action_style_secondary_button_shadow', 'selector' => '{{WRAPPER}} .linkpva-final-cta .linkpva-button-secondary'));
		$this->add_responsive_control('linkpva_call_to_action_style_secondary_button_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-final-cta .linkpva-button-secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_call_to_action_style_secondary_button_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-final-cta .linkpva-button-secondary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->start_controls_tabs('linkpva_call_to_action_style_secondary_button_tabs');
		$this->start_controls_tab('linkpva_call_to_action_style_secondary_button_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control('linkpva_call_to_action_style_secondary_button_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-secondary' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_call_to_action_style_secondary_button_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-secondary' => 'background-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_call_to_action_style_secondary_button_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control('linkpva_call_to_action_style_secondary_button_hover_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-secondary:hover, {{WRAPPER}} .linkpva-button-secondary:focus-visible' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_call_to_action_style_secondary_button_hover_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-secondary:hover, {{WRAPPER}} .linkpva-button-secondary:focus-visible' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_call_to_action_style_secondary_button_hover_border', array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-secondary:hover, {{WRAPPER}} .linkpva-button-secondary:focus-visible' => 'border-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
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
		$heading_id = 'linkpva-final-cta-heading-' . $widget_id;
		$show_tag = 'yes' === ($settings['linkpva_call_to_action_show_tag'] ?? '') && !empty($settings['linkpva_call_to_action_tag']);
		$show_description = 'yes' === ($settings['linkpva_call_to_action_show_description'] ?? '') && !empty($settings['linkpva_call_to_action_description']);
		$show_primary = 'yes' === ($settings['linkpva_call_to_action_show_primary_button'] ?? '') && !empty($settings['linkpva_call_to_action_primary_button_text']) && !empty($settings['linkpva_call_to_action_primary_button_link']['url']);
		$show_primary_icon = $show_primary && 'yes' === ($settings['linkpva_call_to_action_show_primary_button_icon'] ?? '') && !empty($settings['linkpva_call_to_action_primary_button_icon']['value']);
		$show_secondary = 'yes' === ($settings['linkpva_call_to_action_show_secondary_button'] ?? '') && !empty($settings['linkpva_call_to_action_secondary_button_text']) && !empty($settings['linkpva_call_to_action_secondary_button_link']['url']);
		$has_title = !empty($settings['linkpva_call_to_action_title']);

		if (!$has_title && !$show_tag && !$show_description && !$show_primary && !$show_secondary) {
			return;
		}

		if ($show_primary) {
			$this->add_link_attributes('linkpva_call_to_action_primary_button_link', $settings['linkpva_call_to_action_primary_button_link']);
			$this->add_render_attribute('linkpva_call_to_action_primary_button_link', 'class', array('linkpva-button', 'linkpva-button-primary'));
		}
		if ($show_secondary) {
			$this->add_link_attributes('linkpva_call_to_action_secondary_button_link', $settings['linkpva_call_to_action_secondary_button_link']);
			$this->add_render_attribute('linkpva_call_to_action_secondary_button_link', 'class', array('linkpva-button', 'linkpva-button-secondary'));
		}
		?>
		<section class="linkpva-final-cta" data-linkpva-call-to-action-widget="<?php echo esc_attr($widget_id); ?>"<?php if ($has_title) : ?> aria-labelledby="<?php echo esc_attr($heading_id); ?>"<?php endif; ?>>
			<div class="container">
				<div class="linkpva-final-cta-inner">
					<?php if ($show_tag) : ?><span class="linkpva-section-tag"><?php echo esc_html($settings['linkpva_call_to_action_tag']); ?></span><?php endif; ?>
					<?php if ($has_title) : ?><h2 id="<?php echo esc_attr($heading_id); ?>"><?php echo esc_html($settings['linkpva_call_to_action_title']); ?></h2><?php endif; ?>
					<?php if ($show_description) : ?><p><?php echo esc_html($settings['linkpva_call_to_action_description']); ?></p><?php endif; ?>
					<?php if ($show_primary || $show_secondary) : ?><div class="linkpva-button-group">
						<?php if ($show_primary) : ?><a <?php $this->print_render_attribute_string('linkpva_call_to_action_primary_button_link'); ?>><?php echo esc_html($settings['linkpva_call_to_action_primary_button_text']); ?><?php if ($show_primary_icon) : ?> <?php $this->render_icon($settings['linkpva_call_to_action_primary_button_icon']); ?><?php endif; ?></a><?php endif; ?>
						<?php if ($show_secondary) : ?><a <?php $this->print_render_attribute_string('linkpva_call_to_action_secondary_button_link'); ?>><?php echo esc_html($settings['linkpva_call_to_action_secondary_button_text']); ?></a><?php endif; ?>
					</div><?php endif; ?>
				</div>
			</div>
		</section>
		<?php
	}
}

Plugin::instance()->widgets_manager->register(new linkpva_CTA_Widget());
