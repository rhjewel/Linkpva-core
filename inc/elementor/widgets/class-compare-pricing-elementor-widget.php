<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}

class linkpva_Compare_Pricing_Widget extends Widget_Base
{
	public function get_name()
	{
		return 'linkpva_compare_pricing';
	}

	public function get_title()
	{
		return esc_html__('LinkPVA Compare Pricing', 'linkpva-core');
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
		$this->register_table_controls();
		$this->register_note_controls();
		$this->register_section_style_controls();
		$this->register_heading_style_controls();
		$this->register_header_link_style_controls();
		$this->register_table_style_controls();
		$this->register_table_header_style_controls();
		$this->register_account_style_controls();
		$this->register_price_style_controls();
		$this->register_icon_style_controls();
		$this->register_action_style_controls();
		$this->register_note_style_controls();
	}

	private function register_heading_controls()
	{
		$this->start_controls_section(
			'linkpva_compare_pricing_heading_content',
			array(
				'label' => esc_html__('Heading', 'linkpva-core'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'linkpva_compare_pricing_show_tag',
			array('label' => esc_html__('Show Tag', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes')
		);
		$this->add_control(
			'linkpva_compare_pricing_tag',
			array('label' => esc_html__('Tag', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Simple Pricing', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_compare_pricing_show_tag' => 'yes'))
		);
		$this->add_control(
			'linkpva_compare_pricing_title',
			array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Compare Account Pricing', 'linkpva-core'), 'label_block' => true, 'separator' => 'before')
		);
		$this->add_control(
			'linkpva_compare_pricing_show_description',
			array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes')
		);
		$this->add_control(
			'linkpva_compare_pricing_description',
			array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('See starting prices for the most popular account categories before reviewing a full listing.', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_compare_pricing_show_description' => 'yes'))
		);
		$this->add_control(
			'linkpva_compare_pricing_show_header_link',
			array('label' => esc_html__('Show Header Link', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'separator' => 'before')
		);
		$this->add_control(
			'linkpva_compare_pricing_header_link_text',
			array('label' => esc_html__('Link Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('View full pricing', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_compare_pricing_show_header_link' => 'yes'))
		);
		$this->add_control(
			'linkpva_compare_pricing_header_link',
			array('label' => esc_html__('Link', 'linkpva-core'), 'type' => Controls_Manager::URL, 'default' => array('url' => home_url('/pricing/')), 'show_external' => true, 'condition' => array('linkpva_compare_pricing_show_header_link' => 'yes'))
		);
		$this->add_control(
			'linkpva_compare_pricing_header_link_icon',
			array('label' => esc_html__('Link Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'), 'condition' => array('linkpva_compare_pricing_show_header_link' => 'yes'))
		);

		$this->end_controls_section();
	}

	private function register_table_controls()
	{
		$this->start_controls_section(
			'linkpva_compare_pricing_table_content',
			array(
				'label' => esc_html__('Pricing Table', 'linkpva-core'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control('linkpva_compare_pricing_account_label', array('label' => esc_html__('Account Column Label', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Account type', 'linkpva-core'), 'label_block' => true));
		$this->add_control('linkpva_compare_pricing_price_label', array('label' => esc_html__('Price Column Label', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Starting price', 'linkpva-core'), 'label_block' => true));
		$this->add_control('linkpva_compare_pricing_best_for_label', array('label' => esc_html__('Purpose Column Label', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Best for', 'linkpva-core'), 'label_block' => true));
		$this->add_control('linkpva_compare_pricing_action_label', array('label' => esc_html__('Action Column Label', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Details', 'linkpva-core'), 'label_block' => true));

		$repeater = new Repeater();
		$repeater->add_control('icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS));
		$repeater->add_control(
			'accent',
			array(
				'label'   => esc_html__('Icon Accent', 'linkpva-core'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'cyan',
				'options' => array(
					'cyan'   => esc_html__('Cyan', 'linkpva-core'),
					'purple' => esc_html__('Purple', 'linkpva-core'),
					'blue'   => esc_html__('Blue', 'linkpva-core'),
					'green'  => esc_html__('Green', 'linkpva-core'),
				),
			)
		);
		$repeater->add_control('account_title', array('label' => esc_html__('Account Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'label_block' => true));
		$repeater->add_control('account_subtitle', array('label' => esc_html__('Account Subtitle', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'label_block' => true));
		$repeater->add_control('price', array('label' => esc_html__('Price', 'linkpva-core'), 'type' => Controls_Manager::TEXT));
		$repeater->add_control('price_suffix', array('label' => esc_html__('Price Suffix', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('per account', 'linkpva-core')));
		$repeater->add_control('best_for', array('label' => esc_html__('Best For', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'label_block' => true));
		$repeater->add_control('action_text', array('label' => esc_html__('Action Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('View listing', 'linkpva-core')));
		$repeater->add_control('action_link', array('label' => esc_html__('Action Link', 'linkpva-core'), 'type' => Controls_Manager::URL, 'show_external' => true));
		$repeater->add_control('action_icon', array('label' => esc_html__('Action Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap')));

		$this->add_control(
			'linkpva_compare_pricing_rows',
			array(
				'label'       => esc_html__('Pricing Rows', 'linkpva-core'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ account_title }}}',
				'default'     => $this->get_default_rows(),
			)
		);

		$this->end_controls_section();
	}

	private function register_note_controls()
	{
		$this->start_controls_section(
			'linkpva_compare_pricing_note_content',
			array(
				'label' => esc_html__('Pricing Note', 'linkpva-core'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control('linkpva_compare_pricing_show_note', array('label' => esc_html__('Show Note', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_compare_pricing_note_icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-info-circle', 'library' => 'bootstrap'), 'condition' => array('linkpva_compare_pricing_show_note' => 'yes')));
		$this->add_control('linkpva_compare_pricing_note_text', array('label' => esc_html__('Text', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Final pricing may vary by region, age, profile details, quantity, and availability.', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_compare_pricing_show_note' => 'yes')));

		$this->end_controls_section();
	}

	private function register_section_style_controls()
	{
		$this->start_controls_section('linkpva_compare_pricing_style_section', array('label' => esc_html__('Section', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_compare_pricing_style_background', 'selector' => '{{WRAPPER}} .linkpva-pricing-preview'));
		$this->add_responsive_control('linkpva_compare_pricing_style_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-preview' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_compare_pricing_style_heading_row_spacing', array('label' => esc_html__('Heading Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 120)), 'selectors' => array('{{WRAPPER}} .linkpva-heading-row' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_heading_style_controls()
	{
		$this->start_controls_section('linkpva_compare_pricing_style_heading', array('label' => esc_html__('Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_control('linkpva_compare_pricing_style_tag_color', array('label' => esc_html__('Tag Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-section-tag' => 'color: {{VALUE}};'), 'condition' => array('linkpva_compare_pricing_show_tag' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_compare_pricing_style_tag_typography', 'selector' => '{{WRAPPER}} .linkpva-section-tag', 'condition' => array('linkpva_compare_pricing_show_tag' => 'yes')));
		$this->add_responsive_control('linkpva_compare_pricing_style_tag_spacing', array('label' => esc_html__('Tag Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 60)), 'selectors' => array('{{WRAPPER}} .linkpva-section-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_compare_pricing_show_tag' => 'yes')));
		$this->add_control('linkpva_compare_pricing_style_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-section-heading h2' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_compare_pricing_style_title_typography', 'selector' => '{{WRAPPER}} .linkpva-section-heading h2'));
		$this->add_responsive_control('linkpva_compare_pricing_style_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 60)), 'selectors' => array('{{WRAPPER}} .linkpva-section-heading h2' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_compare_pricing_style_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-section-heading p' => 'color: {{VALUE}};'), 'condition' => array('linkpva_compare_pricing_show_description' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_compare_pricing_style_description_typography', 'selector' => '{{WRAPPER}} .linkpva-section-heading p', 'condition' => array('linkpva_compare_pricing_show_description' => 'yes')));
		$this->end_controls_section();
	}

	private function register_header_link_style_controls()
	{
		$this->start_controls_section('linkpva_compare_pricing_style_header_link', array('label' => esc_html__('Header Link', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_compare_pricing_show_header_link' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_compare_pricing_style_header_link_typography', 'selector' => '{{WRAPPER}} .linkpva-heading-row .linkpva-text-link'));
		$this->add_responsive_control('linkpva_compare_pricing_style_header_link_gap', array('label' => esc_html__('Icon Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 30)), 'selectors' => array('{{WRAPPER}} .linkpva-heading-row .linkpva-text-link' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_compare_pricing_style_header_link_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 6, 'max' => 40)), 'selectors' => array('{{WRAPPER}} .linkpva-heading-row .linkpva-text-link i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-heading-row .linkpva-text-link svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->start_controls_tabs('linkpva_compare_pricing_style_header_link_tabs');
		$this->start_controls_tab('linkpva_compare_pricing_style_header_link_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control('linkpva_compare_pricing_style_header_link_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-heading-row .linkpva-text-link' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-heading-row .linkpva-text-link svg path' => 'fill: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_compare_pricing_style_header_link_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control('linkpva_compare_pricing_style_header_link_hover_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-heading-row .linkpva-text-link:hover, {{WRAPPER}} .linkpva-heading-row .linkpva-text-link:focus-visible' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-heading-row .linkpva-text-link:hover svg path, {{WRAPPER}} .linkpva-heading-row .linkpva-text-link:focus-visible svg path' => 'fill: {{VALUE}};')));
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	private function register_table_style_controls()
	{
		$this->start_controls_section('linkpva_compare_pricing_style_table', array('label' => esc_html__('Table Container', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_compare_pricing_style_table_background', 'selector' => '{{WRAPPER}} .linkpva-pricing-table-wrap'));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_compare_pricing_style_table_border', 'selector' => '{{WRAPPER}} .linkpva-pricing-table-wrap'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_compare_pricing_style_table_shadow', 'selector' => '{{WRAPPER}} .linkpva-pricing-table-wrap'));
		$this->add_responsive_control('linkpva_compare_pricing_style_table_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_control('linkpva_compare_pricing_style_row_background', array('label' => esc_html__('Row Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table tbody tr' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_compare_pricing_style_row_divider', array('label' => esc_html__('Row Divider Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table th, {{WRAPPER}} .linkpva-pricing-table td' => 'border-color: {{VALUE}};')));
		$this->add_responsive_control('linkpva_compare_pricing_style_cell_padding', array('label' => esc_html__('Cell Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table th, {{WRAPPER}} .linkpva-pricing-table td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_table_header_style_controls()
	{
		$this->start_controls_section('linkpva_compare_pricing_style_table_header', array('label' => esc_html__('Table Header', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_control('linkpva_compare_pricing_style_table_header_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table thead th' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_compare_pricing_style_table_header_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table thead th' => 'background-color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_compare_pricing_style_table_header_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-table thead th'));
		$this->end_controls_section();
	}

	private function register_account_style_controls()
	{
		$this->start_controls_section('linkpva_compare_pricing_style_account', array('label' => esc_html__('Account Details', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_control('linkpva_compare_pricing_style_account_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table tbody th' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_compare_pricing_style_account_title_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-table tbody th'));
		$this->add_control('linkpva_compare_pricing_style_account_subtitle_color', array('label' => esc_html__('Subtitle Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table tbody th small' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_compare_pricing_style_account_subtitle_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-table tbody th small'));
		$this->add_control('linkpva_compare_pricing_style_best_for_color', array('label' => esc_html__('Purpose Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table tbody td:nth-of-type(2)' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_compare_pricing_style_best_for_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-table tbody td:nth-of-type(2)'));
		$this->end_controls_section();
	}

	private function register_price_style_controls()
	{
		$this->start_controls_section('linkpva_compare_pricing_style_price', array('label' => esc_html__('Price', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_control('linkpva_compare_pricing_style_price_color', array('label' => esc_html__('Price Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table td > strong' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_compare_pricing_style_price_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-table td > strong'));
		$this->add_control('linkpva_compare_pricing_style_price_suffix_color', array('label' => esc_html__('Suffix Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table td:nth-of-type(1) small' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_compare_pricing_style_price_suffix_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-table td:nth-of-type(1) small'));
		$this->end_controls_section();
	}

	private function register_icon_style_controls()
	{
		$this->start_controls_section('linkpva_compare_pricing_style_icons', array('label' => esc_html__('Account Icons', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_responsive_control('linkpva_compare_pricing_style_icon_box_size', array('label' => esc_html__('Box Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px'), 'range' => array('px' => array('min' => 20, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-price-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; flex-basis: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_compare_pricing_style_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 6, 'max' => 50)), 'selectors' => array('{{WRAPPER}} .linkpva-price-icon i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-price-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_compare_pricing_style_icon_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-price-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_control('linkpva_compare_pricing_style_icon_cyan_color', array('label' => esc_html__('Cyan Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-price-icon:not(.is-purple):not(.is-blue):not(.is-green)' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-price-icon:not(.is-purple):not(.is-blue):not(.is-green) svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_compare_pricing_style_icon_cyan_background', array('label' => esc_html__('Cyan Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-price-icon:not(.is-purple):not(.is-blue):not(.is-green)' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_compare_pricing_style_icon_purple_color', array('label' => esc_html__('Purple Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-price-icon.is-purple' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-price-icon.is-purple svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_compare_pricing_style_icon_purple_background', array('label' => esc_html__('Purple Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-price-icon.is-purple' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_compare_pricing_style_icon_blue_color', array('label' => esc_html__('Blue Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-price-icon.is-blue' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-price-icon.is-blue svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_compare_pricing_style_icon_blue_background', array('label' => esc_html__('Blue Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-price-icon.is-blue' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_compare_pricing_style_icon_green_color', array('label' => esc_html__('Green Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-price-icon.is-green' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-price-icon.is-green svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_compare_pricing_style_icon_green_background', array('label' => esc_html__('Green Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-price-icon.is-green' => 'background-color: {{VALUE}};')));
		$this->end_controls_section();
	}

	private function register_action_style_controls()
	{
		$this->start_controls_section('linkpva_compare_pricing_style_action', array('label' => esc_html__('Row Actions', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_compare_pricing_style_action_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-table td:last-child a'));
		$this->add_responsive_control('linkpva_compare_pricing_style_action_gap', array('label' => esc_html__('Icon Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 30)), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table td:last-child a' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->start_controls_tabs('linkpva_compare_pricing_style_action_tabs');
		$this->start_controls_tab('linkpva_compare_pricing_style_action_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control('linkpva_compare_pricing_style_action_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table td:last-child a' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-pricing-table td:last-child a svg path' => 'fill: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_compare_pricing_style_action_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control('linkpva_compare_pricing_style_action_hover_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table td:last-child a:hover, {{WRAPPER}} .linkpva-pricing-table td:last-child a:focus-visible' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-pricing-table td:last-child a:hover svg path, {{WRAPPER}} .linkpva-pricing-table td:last-child a:focus-visible svg path' => 'fill: {{VALUE}};')));
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	private function register_note_style_controls()
	{
		$this->start_controls_section('linkpva_compare_pricing_style_note', array('label' => esc_html__('Pricing Note', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_compare_pricing_show_note' => 'yes')));
		$this->add_control('linkpva_compare_pricing_style_note_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-note' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_compare_pricing_style_note_icon_color', array('label' => esc_html__('Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-note i' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-pricing-note svg path' => 'fill: {{VALUE}};')));
		$this->add_responsive_control('linkpva_compare_pricing_style_note_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 6, 'max' => 40)), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-note i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-pricing-note svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_compare_pricing_style_note_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-note'));
		$this->add_responsive_control('linkpva_compare_pricing_style_note_spacing', array('label' => esc_html__('Top Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-note' => 'margin-top: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_compare_pricing_style_note_gap', array('label' => esc_html__('Icon Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 30)), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-note' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function get_default_rows()
	{
		$link = array('url' => home_url('/shop/'));

		return array(
			array('icon' => array('value' => 'bi bi-phone', 'library' => 'bootstrap'), 'accent' => 'cyan', 'account_title' => esc_html__('PVA Account', 'linkpva-core'), 'account_subtitle' => esc_html__('Phone-verified options', 'linkpva-core'), 'price' => esc_html__('$29', 'linkpva-core'), 'price_suffix' => esc_html__('per account', 'linkpva-core'), 'best_for' => esc_html__('Flexible account requirements', 'linkpva-core'), 'action_text' => esc_html__('View listing', 'linkpva-core'), 'action_link' => $link, 'action_icon' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap')),
			array('icon' => array('value' => 'bi bi-clock-history', 'library' => 'bootstrap'), 'accent' => 'purple', 'account_title' => esc_html__('Aged Account', 'linkpva-core'), 'account_subtitle' => esc_html__('3+ year options', 'linkpva-core'), 'price' => esc_html__('$34', 'linkpva-core'), 'price_suffix' => esc_html__('per account', 'linkpva-core'), 'best_for' => esc_html__('Established account history', 'linkpva-core'), 'action_text' => esc_html__('View listing', 'linkpva-core'), 'action_link' => $link, 'action_icon' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap')),
			array('icon' => array('value' => 'bi bi-patch-check', 'library' => 'bootstrap'), 'accent' => 'blue', 'account_title' => esc_html__('Verified Account', 'linkpva-core'), 'account_subtitle' => esc_html__('Verification details included', 'linkpva-core'), 'price' => esc_html__('$49', 'linkpva-core'), 'price_suffix' => esc_html__('per account', 'linkpva-core'), 'best_for' => esc_html__('Clear verification information', 'linkpva-core'), 'action_text' => esc_html__('View listing', 'linkpva-core'), 'action_link' => $link, 'action_icon' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap')),
			array('icon' => array('value' => 'bi bi-people', 'library' => 'bootstrap'), 'accent' => 'green', 'account_title' => esc_html__('Followers Account', 'linkpva-core'), 'account_subtitle' => esc_html__('1K+ follower range', 'linkpva-core'), 'price' => esc_html__('$79', 'linkpva-core'), 'price_suffix' => esc_html__('per account', 'linkpva-core'), 'best_for' => esc_html__('Audience-based requirements', 'linkpva-core'), 'action_text' => esc_html__('View listing', 'linkpva-core'), 'action_link' => $link, 'action_icon' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap')),
		);
	}

	private function render_icon($icon)
	{
		if (!empty($icon['value'])) {
			Icons_Manager::render_icon($icon, array('aria-hidden' => 'true'));
		}
	}

	protected function render()
	{
		$settings         = $this->get_settings_for_display();
		$widget_id        = sanitize_html_class($this->get_id());
		$heading_id       = 'linkpva-pricing-heading-' . $widget_id;
		$rows             = is_array($settings['linkpva_compare_pricing_rows']) ? $settings['linkpva_compare_pricing_rows'] : array();
		$show_tag         = 'yes' === $settings['linkpva_compare_pricing_show_tag'] && !empty($settings['linkpva_compare_pricing_tag']);
		$show_description = 'yes' === $settings['linkpva_compare_pricing_show_description'] && !empty($settings['linkpva_compare_pricing_description']);
		$show_header_link = 'yes' === $settings['linkpva_compare_pricing_show_header_link'] && !empty($settings['linkpva_compare_pricing_header_link_text']) && !empty($settings['linkpva_compare_pricing_header_link']['url']);
		$show_note        = 'yes' === $settings['linkpva_compare_pricing_show_note'] && !empty($settings['linkpva_compare_pricing_note_text']);
		$has_heading      = !empty($settings['linkpva_compare_pricing_title']);
		$rows             = array_values(
			array_filter(
				$rows,
				function ($row) {
					return !empty($row['account_title']) || !empty($row['price']) || !empty($row['best_for']);
				}
			)
		);

		if (empty($rows) && !$has_heading && !$show_tag && !$show_description && !$show_header_link && !$show_note) {
			return;
		}

		if ($show_header_link) {
			$this->add_link_attributes('linkpva_compare_pricing_header_link', $settings['linkpva_compare_pricing_header_link']);
			$this->add_render_attribute('linkpva_compare_pricing_header_link', 'class', 'linkpva-text-link');
		}
		?>
		<section class="linkpva-section linkpva-pricing-preview" data-linkpva-compare-pricing-widget="<?php echo esc_attr($widget_id); ?>"<?php if ($has_heading) : ?> aria-labelledby="<?php echo esc_attr($heading_id); ?>"<?php endif; ?>>
			<div class="container">
				<?php if ($has_heading || $show_tag || $show_description || $show_header_link) : ?>
					<div class="linkpva-heading-row">
						<?php if ($has_heading || $show_tag || $show_description) : ?>
							<div class="linkpva-section-heading">
								<?php if ($show_tag) : ?><span class="linkpva-section-tag"><?php echo esc_html($settings['linkpva_compare_pricing_tag']); ?></span><?php endif; ?>
								<?php if ($has_heading) : ?><h2 id="<?php echo esc_attr($heading_id); ?>"><?php echo esc_html($settings['linkpva_compare_pricing_title']); ?></h2><?php endif; ?>
								<?php if ($show_description) : ?><p><?php echo esc_html($settings['linkpva_compare_pricing_description']); ?></p><?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if ($show_header_link) : ?>
							<a <?php $this->print_render_attribute_string('linkpva_compare_pricing_header_link'); ?>><?php echo esc_html($settings['linkpva_compare_pricing_header_link_text']); ?> <?php $this->render_icon($settings['linkpva_compare_pricing_header_link_icon']); ?></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if (!empty($rows)) : ?>
					<div class="linkpva-pricing-table-wrap">
						<table class="linkpva-pricing-table">
							<thead>
								<tr>
									<th scope="col"><?php echo esc_html($settings['linkpva_compare_pricing_account_label']); ?></th>
									<th scope="col"><?php echo esc_html($settings['linkpva_compare_pricing_price_label']); ?></th>
									<th scope="col"><?php echo esc_html($settings['linkpva_compare_pricing_best_for_label']); ?></th>
									<th scope="col"><span class="visually-hidden"><?php echo esc_html($settings['linkpva_compare_pricing_action_label']); ?></span></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($rows as $index => $row) : ?>
									<?php
									$accent       = in_array($row['accent'] ?? 'cyan', array('cyan', 'purple', 'blue', 'green'), true) ? $row['accent'] : 'cyan';
									$accent_class = 'cyan' === $accent ? '' : ' is-' . $accent;
									$show_action  = !empty($row['action_text']) && !empty($row['action_link']['url']);

									if ($show_action) {
										$link_key = 'linkpva_compare_pricing_row_link_' . $index;
										$this->add_link_attributes($link_key, $row['action_link'] ?? array());
									}
									?>
									<tr>
										<th scope="row">
											<?php if (!empty($row['icon']['value'])) : ?><span class="linkpva-price-icon<?php echo esc_attr($accent_class); ?>"><?php $this->render_icon($row['icon']); ?></span><?php endif; ?>
											<span>
												<?php if (!empty($row['account_title'])) : ?><?php echo esc_html($row['account_title']); ?><?php endif; ?>
												<?php if (!empty($row['account_subtitle'])) : ?><small><?php echo esc_html($row['account_subtitle']); ?></small><?php endif; ?>
											</span>
										</th>
										<td data-label="<?php echo esc_attr($settings['linkpva_compare_pricing_price_label']); ?>">
											<?php if (!empty($row['price'])) : ?><strong><?php echo esc_html($row['price']); ?></strong><?php endif; ?>
											<?php if (!empty($row['price_suffix'])) : ?><small><?php echo esc_html($row['price_suffix']); ?></small><?php endif; ?>
										</td>
										<td data-label="<?php echo esc_attr($settings['linkpva_compare_pricing_best_for_label']); ?>"><?php echo esc_html($row['best_for'] ?? ''); ?></td>
										<td data-label="<?php echo esc_attr($settings['linkpva_compare_pricing_action_label']); ?>">
											<?php if ($show_action) : ?><a <?php $this->print_render_attribute_string($link_key); ?>><?php echo esc_html($row['action_text']); ?> <?php $this->render_icon($row['action_icon'] ?? array()); ?></a><?php endif; ?>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				<?php endif; ?>

				<?php if ($show_note) : ?>
					<p class="linkpva-pricing-note"><?php $this->render_icon($settings['linkpva_compare_pricing_note_icon']); ?> <?php echo esc_html($settings['linkpva_compare_pricing_note_text']); ?></p>
				<?php endif; ?>
			</div>
		</section>
		<?php
	}
}

Plugin::instance()->widgets_manager->register(new linkpva_Compare_Pricing_Widget());
