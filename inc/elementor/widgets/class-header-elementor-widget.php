<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}

class linkpva_Header_Widget extends Widget_Base
{
	public function get_name()
	{
		return 'linkpva_header';
	}

	public function get_title()
	{
		return esc_html__('LinkPVA Header', 'linkpva-core');
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
		$this->register_topbar_controls();
		$this->register_logo_controls();
		$this->register_navigation_controls();
		$this->register_action_controls();
		$this->register_search_controls();
		$this->register_topbar_style_controls();
		$this->register_header_style_controls();
		$this->register_logo_style_controls();
		$this->register_navigation_style_controls();
		$this->register_submenu_style_controls();
		$this->register_action_style_controls();
		$this->register_search_style_controls();
		$this->register_mobile_style_controls();
	}

	private function register_topbar_controls()
	{
		$this->start_controls_section(
			'linkpva_header_topbar_content',
			array(
				'label' => esc_html__('Topbar', 'linkpva-core'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'linkpva_header_show_topbar',
			array(
				'label'        => esc_html__('Show Topbar', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'linkpva_header_topbar_icon',
			array(
				'label'     => esc_html__('Help Icon', 'linkpva-core'),
				'type'      => Controls_Manager::ICONS,
				'default'   => array('value' => 'bi bi-headset', 'library' => 'bootstrap'),
				'condition' => array('linkpva_header_show_topbar' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_header_topbar_text',
			array(
				'label'       => esc_html__('Help Text', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Need help with an order?', 'linkpva-core'),
				'label_block' => true,
				'condition'   => array('linkpva_header_show_topbar' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_header_topbar_support_text',
			array(
				'label'       => esc_html__('Support Link Text', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Contact support', 'linkpva-core'),
				'label_block' => true,
				'condition'   => array('linkpva_header_show_topbar' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_header_topbar_support_link',
			array(
				'label'         => esc_html__('Support Link', 'linkpva-core'),
				'type'          => Controls_Manager::URL,
				'default'       => array('url' => home_url('/contact/')),
				'show_external' => true,
				'condition'     => array('linkpva_header_show_topbar' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_header_show_topbar_links',
			array(
				'label'        => esc_html__('Show Utility Links', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
				'condition'    => array('linkpva_header_show_topbar' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_header_topbar_navigation_label',
			array(
				'label'       => esc_html__('Utility Navigation Label', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Utility navigation', 'linkpva-core'),
				'label_block' => true,
				'condition'   => array(
					'linkpva_header_show_topbar'       => 'yes',
					'linkpva_header_show_topbar_links' => 'yes',
				),
			)
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'text',
			array(
				'label'       => esc_html__('Text', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'link',
			array(
				'label'         => esc_html__('Link', 'linkpva-core'),
				'type'          => Controls_Manager::URL,
				'show_external' => true,
			)
		);

		$this->add_control(
			'linkpva_header_topbar_links',
			array(
				'label'       => esc_html__('Utility Links', 'linkpva-core'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ text }}}',
				'default'     => array(
					array('text' => esc_html__('Delivery policy', 'linkpva-core'), 'link' => array('url' => home_url('/delivery-policy/'))),
					array('text' => esc_html__('Help center', 'linkpva-core'), 'link' => array('url' => home_url('/faq/'))),
				),
				'condition'   => array(
					'linkpva_header_show_topbar'       => 'yes',
					'linkpva_header_show_topbar_links' => 'yes',
				),
			)
		);

		$this->end_controls_section();
	}

	private function register_logo_controls()
	{
		$this->start_controls_section(
			'linkpva_header_logo_content',
			array(
				'label' => esc_html__('Logo', 'linkpva-core'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'linkpva_header_logo_image',
			array(
				'label'       => esc_html__('Desktop Logo', 'linkpva-core'),
				'type'        => Controls_Manager::MEDIA,
				'media_types' => array('image', 'svg'),
				'default'     => $this->get_default_logo(),
			)
		);

		$this->add_control(
			'linkpva_header_mobile_logo_image',
			array(
				'label'       => esc_html__('Mobile Logo', 'linkpva-core'),
				'type'        => Controls_Manager::MEDIA,
				'media_types' => array('image', 'svg'),
				'default'     => $this->get_default_logo(),
				'description' => esc_html__('Falls back to the desktop logo when empty.', 'linkpva-core'),
			)
		);

		$this->add_control(
			'linkpva_header_logo_link',
			array(
				'label'         => esc_html__('Logo Link', 'linkpva-core'),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_url(home_url('/')),
				'default'       => array('url' => home_url('/')),
				'show_external' => true,
			)
		);

		$this->add_control(
			'linkpva_header_logo_label',
			array(
				'label'       => esc_html__('Logo Accessible Label', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => sprintf(esc_html__('%s home', 'linkpva-core'), get_bloginfo('name')),
				'label_block' => true,
			)
		);

		$this->end_controls_section();
	}

	private function register_navigation_controls()
	{
		$this->start_controls_section(
			'linkpva_header_navigation_content',
			array(
				'label' => esc_html__('Navigation', 'linkpva-core'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'linkpva_header_navigation_label',
			array(
				'label'       => esc_html__('Navigation Label', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Primary navigation', 'linkpva-core'),
				'label_block' => true,
			)
		);

		$this->add_control(
			'linkpva_header_menu_toggle_label',
			array(
				'label'       => esc_html__('Open Menu Label', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Open navigation', 'linkpva-core'),
				'label_block' => true,
			)
		);

		$this->add_control(
			'linkpva_header_menu_toggle_icon',
			array(
				'label'   => esc_html__('Menu Toggle Icon', 'linkpva-core'),
				'type'    => Controls_Manager::ICONS,
				'default' => array('value' => 'bi bi-list', 'library' => 'bootstrap'),
			)
		);

		$this->add_control(
			'linkpva_header_menu_close_label',
			array(
				'label'       => esc_html__('Close Menu Label', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Close navigation', 'linkpva-core'),
				'label_block' => true,
			)
		);

		$this->add_control(
			'linkpva_header_menu_close_icon',
			array(
				'label'   => esc_html__('Menu Close Icon', 'linkpva-core'),
				'type'    => Controls_Manager::ICONS,
				'default' => array('value' => 'bi bi-x-lg', 'library' => 'bootstrap'),
			)
		);

		$this->end_controls_section();
	}

	private function register_action_controls()
	{
		$this->start_controls_section(
			'linkpva_header_actions_content',
			array(
				'label' => esc_html__('Header Actions', 'linkpva-core'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'linkpva_header_show_search',
			array(
				'label'        => esc_html__('Show Search', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'linkpva_header_search_label',
			array(
				'label'       => esc_html__('Search Button Label', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Search products', 'linkpva-core'),
				'label_block' => true,
				'condition'   => array('linkpva_header_show_search' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_header_search_icon',
			array(
				'label'     => esc_html__('Search Icon', 'linkpva-core'),
				'type'      => Controls_Manager::ICONS,
				'default'   => array('value' => 'bi bi-search', 'library' => 'bootstrap'),
				'condition' => array('linkpva_header_show_search' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_header_show_account',
			array(
				'label'        => esc_html__('Show Account', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'linkpva_header_account_label',
			array(
				'label'       => esc_html__('Account Label', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('My account', 'linkpva-core'),
				'label_block' => true,
				'condition'   => array('linkpva_header_show_account' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_header_account_link',
			array(
				'label'         => esc_html__('Account Link', 'linkpva-core'),
				'type'          => Controls_Manager::URL,
				'default'       => array('url' => $this->get_account_url()),
				'show_external' => true,
				'condition'     => array('linkpva_header_show_account' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_header_account_icon',
			array(
				'label'     => esc_html__('Account Icon', 'linkpva-core'),
				'type'      => Controls_Manager::ICONS,
				'default'   => array('value' => 'bi bi-person', 'library' => 'bootstrap'),
				'condition' => array('linkpva_header_show_account' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_header_show_cart',
			array(
				'label'        => esc_html__('Show Cart', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'linkpva_header_cart_label',
			array(
				'label'       => esc_html__('Cart Label', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Shopping cart', 'linkpva-core'),
				'label_block' => true,
				'condition'   => array('linkpva_header_show_cart' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_header_cart_link',
			array(
				'label'         => esc_html__('Cart Link', 'linkpva-core'),
				'type'          => Controls_Manager::URL,
				'default'       => array('url' => $this->get_cart_url()),
				'show_external' => true,
				'condition'     => array('linkpva_header_show_cart' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_header_cart_icon',
			array(
				'label'     => esc_html__('Cart Icon', 'linkpva-core'),
				'type'      => Controls_Manager::ICONS,
				'default'   => array('value' => 'bi bi-bag', 'library' => 'bootstrap'),
				'condition' => array('linkpva_header_show_cart' => 'yes'),
			)
		);

		$this->end_controls_section();
	}

	private function register_search_controls()
	{
		$this->start_controls_section(
			'linkpva_header_search_content',
			array(
				'label'     => esc_html__('Search Form', 'linkpva-core'),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array('linkpva_header_show_search' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_header_search_input_label',
			array(
				'label'       => esc_html__('Input Label', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Search account listings', 'linkpva-core'),
				'label_block' => true,
			)
		);

		$this->add_control(
			'linkpva_header_search_placeholder',
			array(
				'label'       => esc_html__('Placeholder', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Search account listings...', 'linkpva-core'),
				'label_block' => true,
			)
		);

		$this->add_control(
			'linkpva_header_search_button_text',
			array(
				'label'   => esc_html__('Submit Text', 'linkpva-core'),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__('Search', 'linkpva-core'),
			)
		);

		$this->add_control(
			'linkpva_header_search_products_only',
			array(
				'label'        => esc_html__('Search Products Only', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->end_controls_section();
	}

	private function register_topbar_style_controls()
	{
		$this->start_controls_section(
			'linkpva_header_style_topbar',
			array(
				'label'     => esc_html__('Topbar', 'linkpva-core'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array('linkpva_header_show_topbar' => 'yes'),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array('name' => 'linkpva_header_style_topbar_background', 'selector' => '{{WRAPPER}} .linkpva-utility-bar')
		);
		$this->add_control(
			'linkpva_header_style_topbar_text_color',
			array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-utility-bar' => 'color: {{VALUE}};'))
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array('name' => 'linkpva_header_style_topbar_typography', 'selector' => '{{WRAPPER}} .linkpva-utility-bar')
		);
		$this->add_responsive_control(
			'linkpva_header_style_topbar_height',
			array('label' => esc_html__('Minimum Height', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 20, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-utility-inner' => 'min-height: {{SIZE}}{{UNIT}};'))
		);
		$this->add_responsive_control(
			'linkpva_header_style_topbar_gap',
			array('label' => esc_html__('Content Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-utility-inner' => 'gap: {{SIZE}}{{UNIT}};'))
		);
		$this->add_responsive_control(
			'linkpva_header_style_topbar_padding',
			array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-utility-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'))
		);

		$this->add_control('linkpva_header_style_topbar_icon_heading', array('label' => esc_html__('Help Icon', 'linkpva-core'), 'type' => Controls_Manager::HEADING, 'separator' => 'before'));
		$this->add_control(
			'linkpva_header_style_topbar_icon_color',
			array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-utility-help-icon' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-utility-help-icon svg path' => 'fill: {{VALUE}};'))
		);
		$this->add_responsive_control(
			'linkpva_header_style_topbar_icon_size',
			array('label' => esc_html__('Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 8, 'max' => 48)), 'selectors' => array('{{WRAPPER}} .linkpva-utility-help-icon' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-utility-help-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'))
		);

		$this->add_control('linkpva_header_style_topbar_links_heading', array('label' => esc_html__('Links', 'linkpva-core'), 'type' => Controls_Manager::HEADING, 'separator' => 'before'));
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array('name' => 'linkpva_header_style_topbar_link_typography', 'selector' => '{{WRAPPER}} .linkpva-utility-bar a')
		);
		$this->add_responsive_control(
			'linkpva_header_style_topbar_links_gap',
			array('label' => esc_html__('Utility Links Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-utility-inner nav' => 'gap: {{SIZE}}{{UNIT}};'))
		);
		$this->start_controls_tabs('linkpva_header_style_topbar_link_tabs');
		$this->start_controls_tab('linkpva_header_style_topbar_link_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control('linkpva_header_style_topbar_link_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-utility-bar a' => 'color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_header_style_topbar_link_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control('linkpva_header_style_topbar_link_hover_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-utility-bar a:hover, {{WRAPPER}} .linkpva-utility-bar a:focus-visible' => 'color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function register_header_style_controls()
	{
		$this->start_controls_section(
			'linkpva_header_style_section',
			array('label' => esc_html__('Header', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array('name' => 'linkpva_header_style_background', 'selector' => '{{WRAPPER}} .linkpva-header')
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array('name' => 'linkpva_header_style_border', 'selector' => '{{WRAPPER}} .linkpva-header')
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array('name' => 'linkpva_header_style_sticky_shadow', 'label' => esc_html__('Sticky Shadow', 'linkpva-core'), 'selector' => '{{WRAPPER}} .linkpva-header.is-sticky')
		);

		$this->add_responsive_control(
			'linkpva_header_style_inner_height',
			array(
				'label'      => esc_html__('Minimum Height', 'linkpva-core'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px', 'rem'),
				'range'      => array('px' => array('min' => 50, 'max' => 160)),
				'selectors'  => array('{{WRAPPER}} .linkpva-header-inner' => 'min-height: {{SIZE}}{{UNIT}};'),
			)
		);

		$this->add_responsive_control(
			'linkpva_header_style_inner_gap',
			array(
				'label'      => esc_html__('Inner Gap', 'linkpva-core'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px', 'rem'),
				'range'      => array('px' => array('min' => 0, 'max' => 80)),
				'selectors'  => array('{{WRAPPER}} .linkpva-header-inner' => 'gap: {{SIZE}}{{UNIT}};'),
			)
		);

		$this->add_responsive_control(
			'linkpva_header_style_inner_padding',
			array(
				'label'      => esc_html__('Inner Padding', 'linkpva-core'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%', 'rem'),
				'selectors'  => array('{{WRAPPER}} .linkpva-header-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'),
			)
		);

		$this->end_controls_section();
	}

	private function register_logo_style_controls()
	{
		$this->start_controls_section(
			'linkpva_header_style_logo',
			array('label' => esc_html__('Logo', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE)
		);

		$this->add_responsive_control(
			'linkpva_header_style_logo_width',
			array(
				'label'      => esc_html__('Width', 'linkpva-core'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px', '%'),
				'range'      => array('px' => array('min' => 40, 'max' => 320)),
				'default'    => array('unit' => 'px', 'size' => 150),
				'selectors'  => array('{{WRAPPER}} .linkpva-logo img' => 'width: {{SIZE}}{{UNIT}}; height: auto;'),
			)
		);

		$this->add_responsive_control(
			'linkpva_header_style_logo_height',
			array(
				'label'      => esc_html__('Height', 'linkpva-core'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px'),
				'range'      => array('px' => array('min' => 20, 'max' => 100)),
				'selectors'  => array('{{WRAPPER}} .linkpva-logo img' => 'height: {{SIZE}}{{UNIT}}; width: auto;'),
			)
		);

		$this->end_controls_section();
	}

	private function register_navigation_style_controls()
	{
		$this->start_controls_section(
			'linkpva_header_style_navigation',
			array('label' => esc_html__('Navigation', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE)
		);

		$this->add_responsive_control(
			'linkpva_header_style_navigation_gap',
			array(
				'label'      => esc_html__('Item Gap', 'linkpva-core'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px', 'rem'),
				'range'      => array('px' => array('min' => 0, 'max' => 70)),
				'selectors'  => array('{{WRAPPER}} .linkpva-primary-nav > ul' => 'gap: {{SIZE}}{{UNIT}};'),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array('name' => 'linkpva_header_style_navigation_typography', 'selector' => '{{WRAPPER}} .linkpva-primary-nav > ul > li > a')
		);

		$this->add_control(
			'linkpva_header_style_dropdown_icon_color',
			array(
				'label'     => esc_html__('Dropdown Icon Color', 'linkpva-core'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array('{{WRAPPER}} .linkpva-primary-nav .menu-item-has-children > a::before' => 'color: {{VALUE}};'),
			)
		);

		$this->add_responsive_control(
			'linkpva_header_style_dropdown_icon_size',
			array(
				'label'      => esc_html__('Dropdown Icon Size', 'linkpva-core'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px', 'rem'),
				'range'      => array('px' => array('min' => 6, 'max' => 30)),
				'selectors'  => array('{{WRAPPER}} .linkpva-primary-nav .menu-item-has-children > a::before' => 'font-size: {{SIZE}}{{UNIT}};'),
			)
		);

		$this->add_responsive_control(
			'linkpva_header_style_navigation_link_padding',
			array(
				'label'      => esc_html__('Link Padding', 'linkpva-core'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'rem'),
				'selectors'  => array('{{WRAPPER}} .linkpva-primary-nav > ul > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'),
			)
		);

		$this->start_controls_tabs('linkpva_header_style_navigation_tabs');
		$this->start_controls_tab('linkpva_header_style_navigation_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control(
			'linkpva_header_style_navigation_color',
			array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-primary-nav > ul > li > a' => 'color: {{VALUE}};'))
		);
		$this->end_controls_tab();

		$this->start_controls_tab('linkpva_header_style_navigation_hover', array('label' => esc_html__('Hover / Active', 'linkpva-core')));
		$this->add_control(
			'linkpva_header_style_navigation_hover_color',
			array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-primary-nav > ul > li > a:hover, {{WRAPPER}} .linkpva-primary-nav > ul > li > a:focus-visible, {{WRAPPER}} .linkpva-primary-nav > ul > li.current-menu-item > a, {{WRAPPER}} .linkpva-primary-nav > ul > li > a.is-active' => 'color: {{VALUE}};'))
		);
		$this->add_control(
			'linkpva_header_style_navigation_underline_color',
			array('label' => esc_html__('Underline Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-primary-nav > ul > li > a::after' => 'background-color: {{VALUE}};'))
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function register_submenu_style_controls()
	{
		$this->start_controls_section(
			'linkpva_header_style_submenu',
			array('label' => esc_html__('Submenu', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE)
		);

		$this->add_control(
			'linkpva_header_style_submenu_background',
			array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-primary-nav .sub-menu' => 'background-color: {{VALUE}};'))
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array('name' => 'linkpva_header_style_submenu_border', 'selector' => '{{WRAPPER}} .linkpva-primary-nav .sub-menu')
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array('name' => 'linkpva_header_style_submenu_shadow', 'selector' => '{{WRAPPER}} .linkpva-primary-nav .sub-menu')
		);

		$this->add_responsive_control(
			'linkpva_header_style_submenu_width',
			array(
				'label'      => esc_html__('Width', 'linkpva-core'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px'),
				'range'      => array('px' => array('min' => 160, 'max' => 420)),
				'selectors'  => array('{{WRAPPER}} .linkpva-primary-nav .sub-menu' => 'width: {{SIZE}}{{UNIT}};'),
			)
		);

		$this->add_responsive_control(
			'linkpva_header_style_submenu_radius',
			array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-primary-nav .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'))
		);

		$this->add_responsive_control(
			'linkpva_header_style_submenu_padding',
			array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-primary-nav .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'))
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array('name' => 'linkpva_header_style_submenu_typography', 'selector' => '{{WRAPPER}} .linkpva-primary-nav .sub-menu a')
		);

		$this->add_responsive_control(
			'linkpva_header_style_submenu_link_padding',
			array('label' => esc_html__('Link Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-primary-nav .sub-menu a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'))
		);

		$this->add_responsive_control(
			'linkpva_header_style_submenu_link_radius',
			array('label' => esc_html__('Link Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-primary-nav .sub-menu a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'))
		);

		$this->start_controls_tabs('linkpva_header_style_submenu_tabs');
		$this->start_controls_tab('linkpva_header_style_submenu_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control(
			'linkpva_header_style_submenu_color',
			array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-primary-nav .sub-menu a' => 'color: {{VALUE}};'))
		);
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_header_style_submenu_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control(
			'linkpva_header_style_submenu_hover_color',
			array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-primary-nav .sub-menu a:hover, {{WRAPPER}} .linkpva-primary-nav .sub-menu a:focus-visible' => 'color: {{VALUE}};'))
		);
		$this->add_control(
			'linkpva_header_style_submenu_hover_background',
			array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-primary-nav .sub-menu a:hover, {{WRAPPER}} .linkpva-primary-nav .sub-menu a:focus-visible' => 'background-color: {{VALUE}};'))
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function register_action_style_controls()
	{
		$this->start_controls_section(
			'linkpva_header_style_actions',
			array(
				'label'      => esc_html__('Action Buttons', 'linkpva-core'),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array('name' => 'linkpva_header_show_search', 'operator' => '===', 'value' => 'yes'),
						array('name' => 'linkpva_header_show_account', 'operator' => '===', 'value' => 'yes'),
						array('name' => 'linkpva_header_show_cart', 'operator' => '===', 'value' => 'yes'),
					),
				),
			)
		);

		$this->add_responsive_control(
			'linkpva_header_style_actions_gap',
			array('label' => esc_html__('Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 40)), 'selectors' => array('{{WRAPPER}} .linkpva-header-actions' => 'gap: {{SIZE}}{{UNIT}};'))
		);

		$this->add_responsive_control(
			'linkpva_header_style_action_size',
			array('label' => esc_html__('Button Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px'), 'range' => array('px' => array('min' => 28, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-icon-button, {{WRAPPER}} .linkpva-cart-button, {{WRAPPER}} .linkpva-menu-toggle' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'))
		);

		$this->add_responsive_control(
			'linkpva_header_style_action_icon_size',
			array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 10, 'max' => 40)), 'selectors' => array('{{WRAPPER}} .linkpva-icon-button, {{WRAPPER}} .linkpva-cart-button, {{WRAPPER}} .linkpva-menu-toggle' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-icon-button svg, {{WRAPPER}} .linkpva-cart-button svg, {{WRAPPER}} .linkpva-menu-toggle svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'))
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array('name' => 'linkpva_header_style_action_border', 'selector' => '{{WRAPPER}} .linkpva-icon-button, {{WRAPPER}} .linkpva-cart-button, {{WRAPPER}} .linkpva-menu-toggle')
		);

		$this->add_responsive_control(
			'linkpva_header_style_action_radius',
			array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-icon-button, {{WRAPPER}} .linkpva-cart-button, {{WRAPPER}} .linkpva-menu-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'))
		);

		$this->start_controls_tabs('linkpva_header_style_action_tabs');
		$this->start_controls_tab('linkpva_header_style_action_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control(
			'linkpva_header_style_action_color',
			array('label' => esc_html__('Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-icon-button, {{WRAPPER}} .linkpva-cart-button, {{WRAPPER}} .linkpva-menu-toggle' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-icon-button svg, {{WRAPPER}} .linkpva-cart-button svg, {{WRAPPER}} .linkpva-menu-toggle svg' => 'fill: {{VALUE}};'))
		);
		$this->add_control(
			'linkpva_header_style_action_background',
			array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-icon-button, {{WRAPPER}} .linkpva-cart-button, {{WRAPPER}} .linkpva-menu-toggle' => 'background-color: {{VALUE}};'))
		);
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_header_style_action_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control(
			'linkpva_header_style_action_hover_color',
			array('label' => esc_html__('Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-icon-button:hover, {{WRAPPER}} .linkpva-cart-button:hover, {{WRAPPER}} .linkpva-menu-toggle:hover' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-icon-button:hover svg, {{WRAPPER}} .linkpva-cart-button:hover svg, {{WRAPPER}} .linkpva-menu-toggle:hover svg' => 'fill: {{VALUE}};'))
		);
		$this->add_control(
			'linkpva_header_style_action_hover_background',
			array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-icon-button:hover, {{WRAPPER}} .linkpva-cart-button:hover, {{WRAPPER}} .linkpva-menu-toggle:hover' => 'background-color: {{VALUE}};'))
		);
		$this->add_control(
			'linkpva_header_style_action_hover_border',
			array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-icon-button:hover, {{WRAPPER}} .linkpva-cart-button:hover, {{WRAPPER}} .linkpva-menu-toggle:hover' => 'border-color: {{VALUE}};'))
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control('linkpva_header_style_cart_badge_heading', array('label' => esc_html__('Cart Badge', 'linkpva-core'), 'type' => Controls_Manager::HEADING, 'separator' => 'before', 'condition' => array('linkpva_header_show_cart' => 'yes')));
		$this->add_control(
			'linkpva_header_style_cart_badge_color',
			array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-cart-count' => 'color: {{VALUE}};'), 'condition' => array('linkpva_header_show_cart' => 'yes'))
		);
		$this->add_control(
			'linkpva_header_style_cart_badge_background',
			array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-cart-count' => 'background-color: {{VALUE}};'), 'condition' => array('linkpva_header_show_cart' => 'yes'))
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array('name' => 'linkpva_header_style_cart_badge_border', 'selector' => '{{WRAPPER}} .linkpva-cart-count', 'condition' => array('linkpva_header_show_cart' => 'yes'))
		);
		$this->add_responsive_control(
			'linkpva_header_style_cart_badge_size',
			array('label' => esc_html__('Minimum Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px'), 'range' => array('px' => array('min' => 12, 'max' => 40)), 'selectors' => array('{{WRAPPER}} .linkpva-cart-count' => 'min-width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_header_show_cart' => 'yes'))
		);
		$this->add_responsive_control(
			'linkpva_header_style_cart_badge_radius',
			array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-cart-count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'), 'condition' => array('linkpva_header_show_cart' => 'yes'))
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array('name' => 'linkpva_header_style_cart_badge_typography', 'selector' => '{{WRAPPER}} .linkpva-cart-count', 'condition' => array('linkpva_header_show_cart' => 'yes'))
		);

		$this->end_controls_section();
	}

	private function register_search_style_controls()
	{
		$this->start_controls_section(
			'linkpva_header_style_search',
			array('label' => esc_html__('Search Form', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_header_show_search' => 'yes'))
		);

		$this->add_responsive_control(
			'linkpva_header_style_search_gap',
			array('label' => esc_html__('Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 40)), 'selectors' => array('{{WRAPPER}} .linkpva-search-form' => 'gap: {{SIZE}}{{UNIT}};'))
		);

		$this->add_responsive_control(
			'linkpva_header_style_search_padding',
			array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-search-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'))
		);

		$this->add_control(
			'linkpva_header_style_search_icon_color',
			array('label' => esc_html__('Input Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-search-form > i' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-search-form > svg' => 'fill: {{VALUE}};'))
		);

		$this->add_control('linkpva_header_style_search_input_heading', array('label' => esc_html__('Input', 'linkpva-core'), 'type' => Controls_Manager::HEADING, 'separator' => 'before'));
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array('name' => 'linkpva_header_style_search_input_typography', 'selector' => '{{WRAPPER}} .linkpva-search-form input')
		);
		$this->add_control(
			'linkpva_header_style_search_input_color',
			array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-search-form input' => 'color: {{VALUE}};'))
		);
		$this->add_control(
			'linkpva_header_style_search_placeholder_color',
			array('label' => esc_html__('Placeholder Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-search-form input::placeholder' => 'color: {{VALUE}}; opacity: 1;'))
		);
		$this->add_control(
			'linkpva_header_style_search_input_background',
			array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-search-form input' => 'background-color: {{VALUE}};'))
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array('name' => 'linkpva_header_style_search_input_border', 'selector' => '{{WRAPPER}} .linkpva-search-form input')
		);
		$this->add_responsive_control(
			'linkpva_header_style_search_input_radius',
			array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-search-form input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'))
		);
		$this->add_responsive_control(
			'linkpva_header_style_search_input_height',
			array('label' => esc_html__('Height', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px'), 'range' => array('px' => array('min' => 32, 'max' => 90)), 'selectors' => array('{{WRAPPER}} .linkpva-search-form input' => 'height: {{SIZE}}{{UNIT}};'))
		);
		$this->add_responsive_control(
			'linkpva_header_style_search_input_padding',
			array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-search-form input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'))
		);
		$this->add_control(
			'linkpva_header_style_search_input_focus_border',
			array('label' => esc_html__('Focus Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-search-form input:focus' => 'border-color: {{VALUE}};'))
		);

		$this->add_control('linkpva_header_style_search_button_heading', array('label' => esc_html__('Submit Button', 'linkpva-core'), 'type' => Controls_Manager::HEADING, 'separator' => 'before'));
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array('name' => 'linkpva_header_style_search_button_typography', 'selector' => '{{WRAPPER}} .linkpva-search-form button')
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array('name' => 'linkpva_header_style_search_button_border', 'selector' => '{{WRAPPER}} .linkpva-search-form button')
		);
		$this->add_responsive_control(
			'linkpva_header_style_search_button_padding',
			array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-search-form button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'))
		);
		$this->add_responsive_control(
			'linkpva_header_style_search_button_radius',
			array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-search-form button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'))
		);

		$this->start_controls_tabs('linkpva_header_style_search_button_tabs');
		$this->start_controls_tab('linkpva_header_style_search_button_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control('linkpva_header_style_search_button_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-search-form button' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_header_style_search_button_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-search-form button' => 'background-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_header_style_search_button_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control('linkpva_header_style_search_button_hover_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-search-form button:hover, {{WRAPPER}} .linkpva-search-form button:focus-visible' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_header_style_search_button_hover_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-search-form button:hover, {{WRAPPER}} .linkpva-search-form button:focus-visible' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_header_style_search_button_hover_border', array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-search-form button:hover, {{WRAPPER}} .linkpva-search-form button:focus-visible' => 'border-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function register_mobile_style_controls()
	{
		$this->start_controls_section(
			'linkpva_header_style_mobile',
			array('label' => esc_html__('Mobile Navigation', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE)
		);

		$this->add_control(
			'linkpva_header_style_mobile_backdrop',
			array('label' => esc_html__('Backdrop Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-mobile-menu-backdrop' => 'background-color: {{VALUE}};'))
		);
		$this->add_control(
			'linkpva_header_style_mobile_panel_background',
			array('label' => esc_html__('Panel Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-primary-nav.is-open' => 'background-color: {{VALUE}};', '{{WRAPPER}} .linkpva-primary-nav .linkpva-mobile-nav-header' => 'background-color: {{VALUE}};'))
		);
		$this->add_responsive_control(
			'linkpva_header_style_mobile_panel_width',
			array('label' => esc_html__('Panel Width', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'vw'), 'range' => array('px' => array('min' => 220, 'max' => 500), 'vw' => array('min' => 50, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-primary-nav.is-open' => 'width: {{SIZE}}{{UNIT}};'))
		);
		$this->add_control(
			'linkpva_header_style_mobile_divider_color',
			array('label' => esc_html__('Divider Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-primary-nav .linkpva-mobile-nav-header, {{WRAPPER}} .linkpva-primary-nav > ul > li > a, {{WRAPPER}} .linkpva-primary-nav .sub-menu a' => 'border-color: {{VALUE}};'))
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array('name' => 'linkpva_header_style_mobile_link_typography', 'selector' => '{{WRAPPER}} .linkpva-primary-nav > ul > li > a')
		);

		$this->add_control('linkpva_header_style_mobile_close_heading', array('label' => esc_html__('Close Button', 'linkpva-core'), 'type' => Controls_Manager::HEADING, 'separator' => 'before'));
		$this->add_responsive_control(
			'linkpva_header_style_mobile_close_size',
			array('label' => esc_html__('Button Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px'), 'range' => array('px' => array('min' => 28, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-mobile-menu-close' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'))
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array('name' => 'linkpva_header_style_mobile_close_border', 'selector' => '{{WRAPPER}} .linkpva-mobile-menu-close')
		);
		$this->add_responsive_control(
			'linkpva_header_style_mobile_close_radius',
			array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-mobile-menu-close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'))
		);
		$this->start_controls_tabs('linkpva_header_style_mobile_close_tabs');
		$this->start_controls_tab('linkpva_header_style_mobile_close_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control('linkpva_header_style_mobile_close_color', array('label' => esc_html__('Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-mobile-menu-close' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-mobile-menu-close svg' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_header_style_mobile_close_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-mobile-menu-close' => 'background-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_header_style_mobile_close_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control('linkpva_header_style_mobile_close_hover_color', array('label' => esc_html__('Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-mobile-menu-close:hover, {{WRAPPER}} .linkpva-mobile-menu-close:focus-visible' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-mobile-menu-close:hover svg, {{WRAPPER}} .linkpva-mobile-menu-close:focus-visible svg' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_header_style_mobile_close_hover_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-mobile-menu-close:hover, {{WRAPPER}} .linkpva-mobile-menu-close:focus-visible' => 'background-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function get_default_logo()
	{
		$logo_id  = absint(get_theme_mod('custom_logo'));
		$logo_url = $logo_id ? wp_get_attachment_image_url($logo_id, 'full') : '';

		return array(
			'id'  => $logo_id,
			'url' => $logo_url ?: Utils::get_placeholder_image_src(),
		);
	}

	private function get_account_url()
	{
		if (function_exists('wc_get_page_permalink')) {
			return wc_get_page_permalink('myaccount');
		}

		return wp_login_url();
	}

	private function get_cart_url()
	{
		if (function_exists('wc_get_cart_url')) {
			return wc_get_cart_url();
		}

		return home_url('/cart/');
	}

	private function get_cart_count()
	{
		if (function_exists('WC') && WC() && WC()->cart) {
			return absint(WC()->cart->get_cart_contents_count());
		}

		return 0;
	}

	private function get_media_data($media, $fallback = array())
	{
		if (empty($media['url']) && !empty($fallback['url'])) {
			$media = $fallback;
		}

		$attachment_id = !empty($media['id']) ? absint($media['id']) : 0;
		$image_data    = $attachment_id ? wp_get_attachment_image_src($attachment_id, 'full') : false;
		$image_alt     = Control_Media::get_image_alt($media);

		return array(
			'url'    => !empty($media['url']) ? $media['url'] : Utils::get_placeholder_image_src(),
			'alt'    => $image_alt ?: get_bloginfo('name'),
			'width'  => $image_data ? absint($image_data[1]) : 0,
			'height' => $image_data ? absint($image_data[2]) : 0,
		);
	}

	private function render_logo_image($image)
	{
?>
		<img src="<?php echo esc_url($image['url']); ?>"
			<?php if ($image['width']) : ?>width="<?php echo esc_attr($image['width']); ?>" <?php endif; ?>
			<?php if ($image['height']) : ?>height="<?php echo esc_attr($image['height']); ?>" <?php endif; ?>
			alt="<?php echo esc_attr($image['alt']); ?>" loading="eager" decoding="async">
	<?php
	}

	private function render_icon($icon, $attributes = array())
	{
		if (empty($icon['value'])) {
			return;
		}

		Icons_Manager::render_icon($icon, $attributes);
	}

	protected function render()
	{
		$settings         = $this->get_settings_for_display();
		$widget_id        = sanitize_html_class($this->get_id());
		$navigation_id    = 'linkpva-primary-navigation-' . $widget_id;
		$search_form_id   = 'linkpva-search-form-' . $widget_id;
		$search_input_id  = 'linkpva-site-search-' . $widget_id;
		$desktop_logo     = $this->get_media_data($settings['linkpva_header_logo_image']);
		$mobile_logo      = $this->get_media_data($settings['linkpva_header_mobile_logo_image'], $settings['linkpva_header_logo_image']);
		$show_topbar       = 'yes' === $settings['linkpva_header_show_topbar'];
		$show_topbar_links = $show_topbar && 'yes' === $settings['linkpva_header_show_topbar_links'];
		$show_search       = 'yes' === $settings['linkpva_header_show_search'];
		$show_account      = 'yes' === $settings['linkpva_header_show_account'];
		$show_cart         = 'yes' === $settings['linkpva_header_show_cart'];
		$cart_count        = $this->get_cart_count();
		$cart_aria_label   = sprintf('%s (%d)', $settings['linkpva_header_cart_label'], $cart_count);

		$this->add_link_attributes('linkpva_header_logo_link', $settings['linkpva_header_logo_link']);
		$this->add_render_attribute('linkpva_header_logo_link', 'class', 'linkpva-logo');
		$this->add_render_attribute('linkpva_header_logo_link', 'aria-label', $settings['linkpva_header_logo_label']);

		if ($show_topbar && !empty($settings['linkpva_header_topbar_support_text'])) {
			$this->add_link_attributes('linkpva_header_topbar_support_link', $settings['linkpva_header_topbar_support_link']);
		}

		if ($show_account) {
			$this->add_link_attributes('linkpva_header_account_link', $settings['linkpva_header_account_link']);
			$this->add_render_attribute('linkpva_header_account_link', 'class', 'linkpva-icon-button');
			$this->add_render_attribute('linkpva_header_account_link', 'aria-label', $settings['linkpva_header_account_label']);
		}

		if ($show_cart) {
			$this->add_link_attributes('linkpva_header_cart_link', $settings['linkpva_header_cart_link']);
			$this->add_render_attribute('linkpva_header_cart_link', 'class', 'linkpva-cart-button');
			$this->add_render_attribute('linkpva_header_cart_link', 'aria-label', $cart_aria_label);
		}
	?>

		<?php if ($show_topbar) : ?>
			<div class="linkpva-utility-bar">
				<div class="container">
					<div class="linkpva-utility-inner">
						<p>
							<?php $this->render_icon($settings['linkpva_header_topbar_icon'], array('class' => 'linkpva-utility-help-icon', 'aria-hidden' => 'true')); ?>
							<?php if (!empty($settings['linkpva_header_topbar_text'])) : ?>
								<span><?php echo esc_html($settings['linkpva_header_topbar_text']); ?></span>
							<?php endif; ?>
							<?php if (!empty($settings['linkpva_header_topbar_support_text'])) : ?>
								<a <?php $this->print_render_attribute_string('linkpva_header_topbar_support_link'); ?>><?php echo esc_html($settings['linkpva_header_topbar_support_text']); ?></a>
							<?php endif; ?>
						</p>
						<?php if ($show_topbar_links && !empty($settings['linkpva_header_topbar_links'])) : ?>
							<nav aria-label="<?php echo esc_attr($settings['linkpva_header_topbar_navigation_label']); ?>">
								<?php foreach ($settings['linkpva_header_topbar_links'] as $index => $item) : ?>
									<?php
									if (empty($item['text'])) {
										continue;
									}

									$link_key = 'linkpva_header_topbar_link_' . $index;
									$this->add_link_attributes($link_key, $item['link'] ?? array());
									?>
									<a <?php $this->print_render_attribute_string($link_key); ?>><?php echo esc_html($item['text']); ?></a>
								<?php endforeach; ?>
							</nav>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<header class="linkpva-header" data-header data-linkpva-header-widget="<?php echo esc_attr($widget_id); ?>">
			<div class="container">
				<div class="linkpva-header-inner">
					<a <?php $this->print_render_attribute_string('linkpva_header_logo_link'); ?>>
						<?php $this->render_logo_image($desktop_logo); ?>
					</a>

					<button class="linkpva-menu-toggle" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr($navigation_id); ?>" data-open-label="<?php echo esc_attr($settings['linkpva_header_menu_toggle_label']); ?>" data-close-label="<?php echo esc_attr($settings['linkpva_header_menu_close_label']); ?>" data-menu-toggle>
						<span class="visually-hidden"><?php echo esc_html($settings['linkpva_header_menu_toggle_label']); ?></span>
						<?php $this->render_icon($settings['linkpva_header_menu_toggle_icon'], array('aria-hidden' => 'true')); ?>
					</button>

					<div class="linkpva-mobile-menu-backdrop" aria-hidden="true" data-menu-backdrop></div>

					<nav class="linkpva-primary-nav" id="<?php echo esc_attr($navigation_id); ?>" aria-label="<?php echo esc_attr($settings['linkpva_header_navigation_label']); ?>" data-mobile-menu>
						<div class="linkpva-mobile-nav-header">
							<a <?php $this->print_render_attribute_string('linkpva_header_logo_link'); ?>>
								<?php $this->render_logo_image($mobile_logo); ?>
							</a>
							<button class="linkpva-mobile-menu-close" type="button" aria-label="<?php echo esc_attr($settings['linkpva_header_menu_close_label']); ?>" data-menu-close>
								<?php $this->render_icon($settings['linkpva_header_menu_close_icon'], array('aria-hidden' => 'true')); ?>
							</button>
						</div>
						<?php
						\Egns_Core\Egns_Helper::egns_get_theme_menu(
							'primary-menu',
							'',
							'',
							'',
							'',
							'menu-list',
							3
						);
						?>
					</nav>

					<?php if ($show_search || $show_account || $show_cart) : ?>
						<div class="linkpva-header-actions">
							<?php if ($show_search) : ?>
								<button class="linkpva-icon-button linkpva-search-toggle-button" type="button" aria-label="<?php echo esc_attr($settings['linkpva_header_search_label']); ?>" aria-expanded="false" aria-controls="<?php echo esc_attr($search_form_id); ?>" data-search-toggle>
									<?php $this->render_icon($settings['linkpva_header_search_icon'], array('aria-hidden' => 'true')); ?>
								</button>
							<?php endif; ?>

							<?php if ($show_account) : ?>
								<a <?php $this->print_render_attribute_string('linkpva_header_account_link'); ?>>
									<?php $this->render_icon($settings['linkpva_header_account_icon'], array('aria-hidden' => 'true')); ?>
								</a>
							<?php endif; ?>

							<?php if ($show_cart) : ?>
								<a <?php $this->print_render_attribute_string('linkpva_header_cart_link'); ?>>
									<?php $this->render_icon($settings['linkpva_header_cart_icon'], array('aria-hidden' => 'true')); ?>
									<span class="linkpva-cart-count"><?php echo esc_html($cart_count); ?></span>
								</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>

				<?php if ($show_search) : ?>
					<form class="linkpva-search-form" id="<?php echo esc_attr($search_form_id); ?>" action="<?php echo esc_url(home_url('/')); ?>" method="get" role="search" hidden data-search-form>
						<label class="visually-hidden" for="<?php echo esc_attr($search_input_id); ?>"><?php echo esc_html($settings['linkpva_header_search_input_label']); ?></label>
						<?php //$this->render_icon($settings['linkpva_header_search_icon'], array('aria-hidden' => 'true')); ?>
						<input id="<?php echo esc_attr($search_input_id); ?>" name="s" type="search" placeholder="<?php echo esc_attr($settings['linkpva_header_search_placeholder']); ?>">
						<?php if ('yes' === $settings['linkpva_header_search_products_only']) : ?>
							<input type="hidden" name="post_type" value="product">
						<?php endif; ?>
						<button type="submit"><?php echo esc_html($settings['linkpva_header_search_button_text']); ?></button>
					</form>
				<?php endif; ?>
			</div>
		</header>
<?php
	}
}

Plugin::instance()->widgets_manager->register(new linkpva_Header_Widget());
