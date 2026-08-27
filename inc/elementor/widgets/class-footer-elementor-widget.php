<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}

class linkpva_Footer_Widget extends Widget_Base
{
	public function get_name()
	{
		return 'linkpva_footer';
	}

	public function get_title()
	{
		return esc_html__('LinkPVA Footer', 'linkpva-core');
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
		$this->register_brand_controls();
		$this->register_social_controls();
		$this->register_link_group_controls('marketplace', esc_html__('Marketplace Links', 'linkpva-core'), esc_html__('Marketplace', 'linkpva-core'), $this->get_marketplace_links());
		$this->register_link_group_controls('company', esc_html__('Company Links', 'linkpva-core'), esc_html__('Company', 'linkpva-core'), $this->get_company_links());
		$this->register_link_group_controls('policies', esc_html__('Policy Links', 'linkpva-core'), esc_html__('Policies', 'linkpva-core'), $this->get_policy_links());
		$this->register_support_controls();
		$this->register_bottom_controls();
		$this->register_footer_style_controls();
		$this->register_brand_style_controls();
		$this->register_heading_style_controls();
		$this->register_link_style_controls();
		$this->register_social_style_controls();
		$this->register_contact_style_controls();
		$this->register_bottom_style_controls();
	}

	private function register_brand_controls()
	{
		$this->start_controls_section(
			'linkpva_footer_brand_content',
			array(
				'label' => esc_html__('Brand', 'linkpva-core'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'linkpva_footer_logo',
			array(
				'label'       => esc_html__('Logo', 'linkpva-core'),
				'type'        => Controls_Manager::MEDIA,
				'media_types' => array('image', 'svg'),
				'default'     => $this->get_default_logo(),
			)
		);

		$this->add_control(
			'linkpva_footer_logo_link',
			array(
				'label'         => esc_html__('Logo Link', 'linkpva-core'),
				'type'          => Controls_Manager::URL,
				'default'       => array('url' => home_url('/')),
				'show_external' => true,
			)
		);

		$this->add_control(
			'linkpva_footer_logo_label',
			array(
				'label'       => esc_html__('Logo Accessible Label', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => sprintf(esc_html__('%s home', 'linkpva-core'), get_bloginfo('name')),
				'label_block' => true,
			)
		);

		$this->add_control(
			'linkpva_footer_show_about',
			array(
				'label'        => esc_html__('Show Description', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'linkpva_footer_about',
			array(
				'label'       => esc_html__('Description', 'linkpva-core'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__('A marketplace interface for comparing LinkedIn account listings with clear specifications and a straightforward ordering experience.', 'linkpva-core'),
				'label_block' => true,
				'condition'   => array('linkpva_footer_show_about' => 'yes'),
			)
		);

		$this->end_controls_section();
	}

	private function register_social_controls()
	{
		$this->start_controls_section(
			'linkpva_footer_social_content',
			array(
				'label' => esc_html__('Social Links', 'linkpva-core'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'linkpva_footer_show_social',
			array(
				'label'        => esc_html__('Show Social Links', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'label',
			array(
				'label'       => esc_html__('Accessible Label', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'icon',
			array(
				'label' => esc_html__('Icon', 'linkpva-core'),
				'type'  => Controls_Manager::ICONS,
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
			'linkpva_footer_social_links',
			array(
				'label'       => esc_html__('Social Items', 'linkpva-core'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ label }}}',
				'default'     => $this->get_social_links(),
				'condition'   => array('linkpva_footer_show_social' => 'yes'),
			)
		);

		$this->end_controls_section();
	}

	private function register_link_group_controls($key, $section_label, $default_heading, $default_links)
	{
		$this->start_controls_section(
			'linkpva_footer_' . $key . '_content',
			array(
				'label' => $section_label,
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'linkpva_footer_show_' . $key,
			array(
				'label'        => esc_html__('Show Link Group', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'linkpva_footer_' . $key . '_heading',
			array(
				'label'       => esc_html__('Heading', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => $default_heading,
				'label_block' => true,
				'condition'   => array('linkpva_footer_show_' . $key => 'yes'),
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
			'linkpva_footer_' . $key . '_links',
			array(
				'label'       => esc_html__('Links', 'linkpva-core'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ text }}}',
				'default'     => $default_links,
				'condition'   => array('linkpva_footer_show_' . $key => 'yes'),
			)
		);

		$this->end_controls_section();
	}

	private function register_support_controls()
	{
		$this->start_controls_section(
			'linkpva_footer_support_content',
			array(
				'label' => esc_html__('Support', 'linkpva-core'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'linkpva_footer_show_support',
			array(
				'label'        => esc_html__('Show Support', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'linkpva_footer_support_heading',
			array(
				'label'       => esc_html__('Heading', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Support', 'linkpva-core'),
				'label_block' => true,
				'condition'   => array('linkpva_footer_show_support' => 'yes'),
			)
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'icon',
			array(
				'label' => esc_html__('Icon', 'linkpva-core'),
				'type'  => Controls_Manager::ICONS,
			)
		);
		$repeater->add_control(
			'label',
			array(
				'label'       => esc_html__('Small Label', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'value',
			array(
				'label'       => esc_html__('Value', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			)
		);
		$repeater->add_control(
			'type',
			array(
				'label'   => esc_html__('Value Type', 'linkpva-core'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'link',
				'options' => array(
					'link'    => esc_html__('Link', 'linkpva-core'),
					'address' => esc_html__('Address', 'linkpva-core'),
				),
			)
		);
		$repeater->add_control(
			'link',
			array(
				'label'         => esc_html__('Link', 'linkpva-core'),
				'type'          => Controls_Manager::URL,
				'show_external' => true,
				'condition'     => array('type' => 'link'),
			)
		);

		$this->add_control(
			'linkpva_footer_support_items',
			array(
				'label'       => esc_html__('Support Items', 'linkpva-core'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ label }}}',
				'default'     => $this->get_support_items(),
				'condition'   => array('linkpva_footer_show_support' => 'yes'),
			)
		);

		$this->end_controls_section();
	}

	private function register_bottom_controls()
	{
		$this->start_controls_section(
			'linkpva_footer_bottom_content',
			array(
				'label' => esc_html__('Footer Bottom', 'linkpva-core'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'linkpva_footer_show_bottom',
			array(
				'label'        => esc_html__('Show Footer Bottom', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'linkpva_footer_copyright_text',
			array(
				'label'       => esc_html__('Copyright Text', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => sprintf(esc_html__('%s. All rights reserved.', 'linkpva-core'), get_bloginfo('name')),
				'label_block' => true,
				'condition'   => array('linkpva_footer_show_bottom' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_footer_disclaimer',
			array(
				'label'       => esc_html__('Disclaimer', 'linkpva-core'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__('LinkPVA is an independent marketplace and is not affiliated with or endorsed by LinkedIn.', 'linkpva-core'),
				'label_block' => true,
				'condition'   => array('linkpva_footer_show_bottom' => 'yes'),
			)
		);

		$this->end_controls_section();
	}

	private function register_footer_style_controls()
	{
		$this->start_controls_section(
			'linkpva_footer_style_section',
			array('label' => esc_html__('Footer', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array('name' => 'linkpva_footer_style_background', 'selector' => '{{WRAPPER}} .linkpva-footer')
		);
		$this->add_control(
			'linkpva_footer_style_text_color',
			array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-footer' => 'color: {{VALUE}};'))
		);
		$this->add_responsive_control(
			'linkpva_footer_style_padding',
			array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'))
		);
		$this->add_responsive_control(
			'linkpva_footer_style_column_gap',
			array('label' => esc_html__('Column Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-footer .row' => '--bs-gutter-x: {{SIZE}}{{UNIT}};'))
		);
		$this->add_responsive_control(
			'linkpva_footer_style_row_gap',
			array('label' => esc_html__('Row Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-footer .row' => '--bs-gutter-y: {{SIZE}}{{UNIT}};'))
		);

		$this->end_controls_section();
	}

	private function register_brand_style_controls()
	{
		$this->start_controls_section(
			'linkpva_footer_style_brand',
			array('label' => esc_html__('Brand', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE)
		);

		$this->add_responsive_control(
			'linkpva_footer_style_logo_width',
			array('label' => esc_html__('Logo Width', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', '%'), 'range' => array('px' => array('min' => 40, 'max' => 320)), 'default' => array('unit' => 'px', 'size' => 190), 'selectors' => array('{{WRAPPER}} .linkpva-footer-logo img' => 'width: {{SIZE}}{{UNIT}}; height: auto;'))
		);
		$this->add_responsive_control(
			'linkpva_footer_style_logo_spacing',
			array('label' => esc_html__('Logo Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-footer-logo' => 'margin-bottom: {{SIZE}}{{UNIT}};'))
		);
		$this->add_control(
			'linkpva_footer_style_about_color',
			array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-footer-about' => 'color: {{VALUE}};'), 'condition' => array('linkpva_footer_show_about' => 'yes'))
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array('name' => 'linkpva_footer_style_about_typography', 'selector' => '{{WRAPPER}} .linkpva-footer-about', 'condition' => array('linkpva_footer_show_about' => 'yes'))
		);
		$this->add_responsive_control(
			'linkpva_footer_style_about_width',
			array('label' => esc_html__('Description Max Width', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', '%'), 'range' => array('px' => array('min' => 100, 'max' => 600)), 'selectors' => array('{{WRAPPER}} .linkpva-footer-about' => 'max-width: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_footer_show_about' => 'yes'))
		);

		$this->end_controls_section();
	}

	private function register_heading_style_controls()
	{
		$this->start_controls_section(
			'linkpva_footer_style_headings',
			array('label' => esc_html__('Column Headings', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE)
		);

		$this->add_control(
			'linkpva_footer_style_heading_color',
			array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-footer h2' => 'color: {{VALUE}};'))
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array('name' => 'linkpva_footer_style_heading_typography', 'selector' => '{{WRAPPER}} .linkpva-footer h2')
		);
		$this->add_responsive_control(
			'linkpva_footer_style_heading_spacing',
			array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-footer h2' => 'margin-bottom: {{SIZE}}{{UNIT}};'))
		);

		$this->end_controls_section();
	}

	private function register_link_style_controls()
	{
		$this->start_controls_section(
			'linkpva_footer_style_links',
			array('label' => esc_html__('Navigation Links', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array('name' => 'linkpva_footer_style_link_typography', 'selector' => '{{WRAPPER}} .linkpva-footer-links a')
		);
		$this->add_responsive_control(
			'linkpva_footer_style_link_spacing',
			array('label' => esc_html__('Item Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 50)), 'selectors' => array('{{WRAPPER}} .linkpva-footer-links li' => 'margin-bottom: {{SIZE}}{{UNIT}};'))
		);
		$this->start_controls_tabs('linkpva_footer_style_link_tabs');
		$this->start_controls_tab('linkpva_footer_style_link_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control('linkpva_footer_style_link_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-footer-links a' => 'color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_footer_style_link_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control('linkpva_footer_style_link_hover_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-footer-links a:hover, {{WRAPPER}} .linkpva-footer-links a:focus-visible' => 'color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function register_social_style_controls()
	{
		$this->start_controls_section(
			'linkpva_footer_style_social',
			array('label' => esc_html__('Social Links', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_footer_show_social' => 'yes'))
		);

		$this->add_responsive_control(
			'linkpva_footer_style_social_spacing',
			array('label' => esc_html__('Top Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-social-links' => 'margin-top: {{SIZE}}{{UNIT}};'))
		);
		$this->add_responsive_control(
			'linkpva_footer_style_social_gap',
			array('label' => esc_html__('Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 50)), 'selectors' => array('{{WRAPPER}} .linkpva-social-links' => 'gap: {{SIZE}}{{UNIT}};'))
		);
		$this->add_responsive_control(
			'linkpva_footer_style_social_size',
			array('label' => esc_html__('Button Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px'), 'range' => array('px' => array('min' => 20, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-social-links a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'))
		);
		$this->add_responsive_control(
			'linkpva_footer_style_social_icon_size',
			array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 8, 'max' => 40)), 'selectors' => array('{{WRAPPER}} .linkpva-social-links a' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-social-links svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'))
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array('name' => 'linkpva_footer_style_social_border', 'selector' => '{{WRAPPER}} .linkpva-social-links a')
		);
		$this->add_responsive_control(
			'linkpva_footer_style_social_radius',
			array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-social-links a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'))
		);
		$this->start_controls_tabs('linkpva_footer_style_social_tabs');
		$this->start_controls_tab('linkpva_footer_style_social_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control('linkpva_footer_style_social_color', array('label' => esc_html__('Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-social-links a' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-social-links a svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_footer_style_social_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-social-links a' => 'background-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_footer_style_social_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control('linkpva_footer_style_social_hover_color', array('label' => esc_html__('Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-social-links a:hover, {{WRAPPER}} .linkpva-social-links a:focus-visible' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-social-links a:hover svg path, {{WRAPPER}} .linkpva-social-links a:focus-visible svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_footer_style_social_hover_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-social-links a:hover, {{WRAPPER}} .linkpva-social-links a:focus-visible' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_footer_style_social_hover_border', array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-social-links a:hover, {{WRAPPER}} .linkpva-social-links a:focus-visible' => 'border-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function register_contact_style_controls()
	{
		$this->start_controls_section(
			'linkpva_footer_style_contact',
			array('label' => esc_html__('Support Items', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_footer_show_support' => 'yes'))
		);

		$this->add_responsive_control(
			'linkpva_footer_style_contact_gap',
			array('label' => esc_html__('Content Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 50)), 'selectors' => array('{{WRAPPER}} .linkpva-contact-list li' => 'gap: {{SIZE}}{{UNIT}};'))
		);
		$this->add_responsive_control(
			'linkpva_footer_style_contact_spacing',
			array('label' => esc_html__('Item Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 50)), 'selectors' => array('{{WRAPPER}} .linkpva-contact-list li' => 'margin-bottom: {{SIZE}}{{UNIT}};'))
		);
		$this->add_control('linkpva_footer_style_contact_icon_heading', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::HEADING, 'separator' => 'before'));
		$this->add_responsive_control(
			'linkpva_footer_style_contact_icon_box_size',
			array('label' => esc_html__('Box Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px'), 'range' => array('px' => array('min' => 20, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-footer-contact-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'))
		);
		$this->add_responsive_control(
			'linkpva_footer_style_contact_icon_size',
			array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 8, 'max' => 40)), 'selectors' => array('{{WRAPPER}} .linkpva-footer-contact-icon' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-footer-contact-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'))
		);
		$this->add_control('linkpva_footer_style_contact_icon_color', array('label' => esc_html__('Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-footer-contact-icon' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-footer-contact-icon svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_footer_style_contact_icon_background', array('label' => esc_html__('Icon Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-footer-contact-icon' => 'background-color: {{VALUE}};')));
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array('name' => 'linkpva_footer_style_contact_icon_border', 'selector' => '{{WRAPPER}} .linkpva-footer-contact-icon')
		);
		$this->add_responsive_control(
			'linkpva_footer_style_contact_icon_radius',
			array('label' => esc_html__('Icon Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-footer-contact-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'))
		);
		$this->add_control('linkpva_footer_style_contact_text_heading', array('label' => esc_html__('Text', 'linkpva-core'), 'type' => Controls_Manager::HEADING, 'separator' => 'before'));
		$this->add_control('linkpva_footer_style_contact_label_color', array('label' => esc_html__('Label Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-list small' => 'color: {{VALUE}};')));
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array('name' => 'linkpva_footer_style_contact_label_typography', 'selector' => '{{WRAPPER}} .linkpva-contact-list small')
		);
		$this->add_control('linkpva_footer_style_contact_value_color', array('label' => esc_html__('Value Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-list a, {{WRAPPER}} .linkpva-contact-list address > span' => 'color: {{VALUE}};')));
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array('name' => 'linkpva_footer_style_contact_value_typography', 'selector' => '{{WRAPPER}} .linkpva-contact-list a, {{WRAPPER}} .linkpva-contact-list address > span')
		);
		$this->add_control('linkpva_footer_style_contact_value_hover', array('label' => esc_html__('Link Hover Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-contact-list a:hover, {{WRAPPER}} .linkpva-contact-list a:focus-visible' => 'color: {{VALUE}};')));

		$this->end_controls_section();
	}

	private function register_bottom_style_controls()
	{
		$this->start_controls_section(
			'linkpva_footer_style_bottom',
			array('label' => esc_html__('Footer Bottom', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_footer_show_bottom' => 'yes'))
		);

		$this->add_control(
			'linkpva_footer_style_bottom_border_color',
			array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-footer-bottom' => 'border-color: {{VALUE}};'))
		);
		$this->add_responsive_control(
			'linkpva_footer_style_bottom_margin',
			array('label' => esc_html__('Top Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 140)), 'selectors' => array('{{WRAPPER}} .linkpva-footer-bottom' => 'margin-top: {{SIZE}}{{UNIT}};'))
		);
		$this->add_responsive_control(
			'linkpva_footer_style_bottom_padding',
			array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-footer-bottom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'))
		);
		$this->add_responsive_control(
			'linkpva_footer_style_bottom_gap',
			array('label' => esc_html__('Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-footer-bottom' => 'gap: {{SIZE}}{{UNIT}};'))
		);
		$this->add_control(
			'linkpva_footer_style_bottom_color',
			array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-footer-bottom p' => 'color: {{VALUE}};'))
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array('name' => 'linkpva_footer_style_bottom_typography', 'selector' => '{{WRAPPER}} .linkpva-footer-bottom p')
		);

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

	private function get_social_links()
	{
		return array(
			array('label' => esc_html__('Facebook', 'linkpva-core'), 'icon' => array('value' => 'bi bi-facebook', 'library' => 'bootstrap'), 'link' => array('url' => 'https://www.facebook.com/')),
			array('label' => esc_html__('LinkedIn', 'linkpva-core'), 'icon' => array('value' => 'bi bi-linkedin', 'library' => 'bootstrap'), 'link' => array('url' => 'https://www.linkedin.com/')),
			array('label' => esc_html__('Telegram', 'linkpva-core'), 'icon' => array('value' => 'bi bi-telegram', 'library' => 'bootstrap'), 'link' => array('url' => 'https://telegram.org/')),
		);
	}

	private function get_marketplace_links()
	{
		return array(
			array('text' => esc_html__('All Products', 'linkpva-core'), 'link' => array('url' => home_url('/shop/'))),
			array('text' => esc_html__('Verified Accounts', 'linkpva-core'), 'link' => array('url' => home_url('/product-category/verified-accounts/'))),
			array('text' => esc_html__('Aged Accounts', 'linkpva-core'), 'link' => array('url' => home_url('/product-category/aged-accounts/'))),
			array('text' => esc_html__('PVA Accounts', 'linkpva-core'), 'link' => array('url' => home_url('/product-category/pva-accounts/'))),
			array('text' => esc_html__('Followers Accounts', 'linkpva-core'), 'link' => array('url' => home_url('/product-category/followers-accounts/'))),
		);
	}

	private function get_company_links()
	{
		return array(
			array('text' => esc_html__('About Us', 'linkpva-core'), 'link' => array('url' => home_url('/about/'))),
			array('text' => esc_html__('Pricing', 'linkpva-core'), 'link' => array('url' => home_url('/pricing/'))),
			array('text' => esc_html__('Blog', 'linkpva-core'), 'link' => array('url' => get_post_type_archive_link('post') ?: home_url('/blog/'))),
			array('text' => esc_html__('Bulk Orders', 'linkpva-core'), 'link' => array('url' => home_url('/bulk-order/'))),
			array('text' => esc_html__('Contact', 'linkpva-core'), 'link' => array('url' => home_url('/contact/'))),
			array('text' => esc_html__('FAQ', 'linkpva-core'), 'link' => array('url' => home_url('/faq/'))),
		);
	}

	private function get_policy_links()
	{
		return array(
			array('text' => esc_html__('Delivery Policy', 'linkpva-core'), 'link' => array('url' => home_url('/delivery-policy/'))),
			array('text' => esc_html__('Refund Policy', 'linkpva-core'), 'link' => array('url' => home_url('/refund-policy/'))),
			array('text' => esc_html__('Privacy Policy', 'linkpva-core'), 'link' => array('url' => get_privacy_policy_url() ?: home_url('/privacy/'))),
			array('text' => esc_html__('Terms of Service', 'linkpva-core'), 'link' => array('url' => home_url('/terms/'))),
		);
	}

	private function get_support_items()
	{
		return array(
			array('icon' => array('value' => 'bi bi-envelope', 'library' => 'bootstrap'), 'label' => esc_html__('Email us', 'linkpva-core'), 'value' => get_option('admin_email'), 'type' => 'link', 'link' => array('url' => 'mailto:' . sanitize_email(get_option('admin_email')))),
			array('icon' => array('value' => 'bi bi-chat-dots', 'library' => 'bootstrap'), 'label' => esc_html__('Need help?', 'linkpva-core'), 'value' => esc_html__('Contact Support', 'linkpva-core'), 'type' => 'link', 'link' => array('url' => home_url('/contact/'))),
			array('icon' => array('value' => 'bi bi-geo-alt', 'library' => 'bootstrap'), 'label' => esc_html__('Our location', 'linkpva-core'), 'value' => esc_html__('Dhaka, Bangladesh', 'linkpva-core'), 'type' => 'address'),
		);
	}

	private function get_media_data($media)
	{
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
			alt="<?php echo esc_attr($image['alt']); ?>" loading="lazy" decoding="async">
		<?php
	}

	private function render_icon($icon)
	{
		if (!empty($icon['value'])) {
			Icons_Manager::render_icon($icon, array('aria-hidden' => 'true'));
		}
	}

	private function render_link_group($settings, $key, $column_class)
	{
		$heading = $settings['linkpva_footer_' . $key . '_heading'];
		$links   = $settings['linkpva_footer_' . $key . '_links'];

		if ('yes' !== $settings['linkpva_footer_show_' . $key] || (empty($heading) && empty($links))) {
			return;
		}
		?>
		<div class="<?php echo esc_attr($column_class); ?>">
			<?php if (!empty($heading)) : ?>
				<h2><?php echo esc_html($heading); ?></h2>
			<?php endif; ?>
			<?php if (!empty($links)) : ?>
				<ul class="linkpva-footer-links">
					<?php foreach ($links as $index => $item) : ?>
						<?php
						if (empty($item['text'])) {
							continue;
						}

						$link_key = 'linkpva_footer_' . $key . '_link_' . $index;
						$this->add_link_attributes($link_key, $item['link'] ?? array());
						?>
						<li><a <?php $this->print_render_attribute_string($link_key); ?>><?php echo esc_html($item['text']); ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<?php
	}

	protected function render()
	{
		$settings     = $this->get_settings_for_display();
		$widget_id    = sanitize_html_class($this->get_id());
		$logo         = $this->get_media_data($settings['linkpva_footer_logo']);
		$show_about   = 'yes' === $settings['linkpva_footer_show_about'];
		$show_social  = 'yes' === $settings['linkpva_footer_show_social'];
		$show_support = 'yes' === $settings['linkpva_footer_show_support'] && (!empty($settings['linkpva_footer_support_heading']) || !empty($settings['linkpva_footer_support_items']));
		$show_bottom  = 'yes' === $settings['linkpva_footer_show_bottom'] && (!empty($settings['linkpva_footer_copyright_text']) || !empty($settings['linkpva_footer_disclaimer']));

		$this->add_link_attributes('linkpva_footer_logo_link', $settings['linkpva_footer_logo_link']);
		$this->add_render_attribute('linkpva_footer_logo_link', 'class', array('linkpva-logo', 'linkpva-footer-logo'));
		$this->add_render_attribute('linkpva_footer_logo_link', 'aria-label', $settings['linkpva_footer_logo_label']);
		?>
		<footer class="linkpva-footer" data-linkpva-footer-widget="<?php echo esc_attr($widget_id); ?>">
			<div class="container">
				<div class="row g-5">
					<div class="col-lg-4">
						<a <?php $this->print_render_attribute_string('linkpva_footer_logo_link'); ?>><?php $this->render_logo_image($logo); ?></a>

						<?php if ($show_about && !empty($settings['linkpva_footer_about'])) : ?>
							<p class="linkpva-footer-about"><?php echo esc_html($settings['linkpva_footer_about']); ?></p>
						<?php endif; ?>

						<?php if ($show_social && !empty($settings['linkpva_footer_social_links'])) : ?>
							<div class="linkpva-social-links">
								<?php foreach ($settings['linkpva_footer_social_links'] as $index => $item) : ?>
									<?php
									if (empty($item['label']) || empty($item['icon']['value'])) {
										continue;
									}

									$link_key = 'linkpva_footer_social_link_' . $index;
									$this->add_link_attributes($link_key, $item['link'] ?? array());
									$this->add_render_attribute($link_key, 'aria-label', $item['label']);
									?>
									<a <?php $this->print_render_attribute_string($link_key); ?>><?php $this->render_icon($item['icon']); ?></a>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>

					<?php $this->render_link_group($settings, 'marketplace', 'col-6 col-lg-2'); ?>
					<?php $this->render_link_group($settings, 'company', 'col-6 col-lg-2'); ?>
					<?php $this->render_link_group($settings, 'policies', 'col-sm-6 col-lg-2'); ?>

					<?php if ($show_support) : ?>
						<div class="col-sm-6 col-lg-2">
							<?php if (!empty($settings['linkpva_footer_support_heading'])) : ?>
								<h2><?php echo esc_html($settings['linkpva_footer_support_heading']); ?></h2>
							<?php endif; ?>
							<?php if (!empty($settings['linkpva_footer_support_items'])) : ?>
								<ul class="linkpva-contact-list">
									<?php foreach ($settings['linkpva_footer_support_items'] as $index => $item) : ?>
										<?php if (empty($item['label']) && empty($item['value'])) : ?>
											<?php continue; ?>
										<?php endif; ?>
										<li>
											<?php if (!empty($item['icon']['value'])) : ?>
												<span class="linkpva-footer-contact-icon"><?php $this->render_icon($item['icon']); ?></span>
											<?php endif; ?>
											<?php if ('address' === ($item['type'] ?? 'link')) : ?>
												<address>
													<?php if (!empty($item['label'])) : ?><small><?php echo esc_html($item['label']); ?></small><?php endif; ?>
													<?php if (!empty($item['value'])) : ?><span><?php echo esc_html($item['value']); ?></span><?php endif; ?>
												</address>
											<?php else : ?>
												<span>
													<?php if (!empty($item['label'])) : ?><small><?php echo esc_html($item['label']); ?></small><?php endif; ?>
													<?php if (!empty($item['value'])) : ?>
														<?php
														$link_key = 'linkpva_footer_support_link_' . $index;
														$this->add_link_attributes($link_key, $item['link'] ?? array());
														?>
														<a <?php $this->print_render_attribute_string($link_key); ?>><?php echo esc_html($item['value']); ?></a>
													<?php endif; ?>
												</span>
											<?php endif; ?>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>

				<?php if ($show_bottom) : ?>
					<div class="linkpva-footer-bottom">
						<?php if (!empty($settings['linkpva_footer_copyright_text'])) : ?>
							<p>&copy; <span data-current-year><?php echo esc_html(wp_date('Y')); ?></span> <?php echo esc_html($settings['linkpva_footer_copyright_text']); ?></p>
						<?php endif; ?>
						<?php if (!empty($settings['linkpva_footer_disclaimer'])) : ?>
							<p><?php echo esc_html($settings['linkpva_footer_disclaimer']); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</footer>
		<?php
	}
}

Plugin::instance()->widgets_manager->register(new linkpva_Footer_Widget());
