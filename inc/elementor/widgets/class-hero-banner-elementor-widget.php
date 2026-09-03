<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}

class linkpva_Hero_Banner_Widget extends Widget_Base
{
	public function get_name()
	{
		return 'linkpva_hero_banner';
	}

	public function get_title()
	{
		return esc_html__('LinkPVA Hero Banner', 'linkpva-core');
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
		$this->register_button_controls();
		$this->register_point_controls();
		$this->register_visual_controls();
		$this->register_floating_card_controls();
		$this->register_section_style_controls();
		$this->register_eyebrow_style_controls();
		$this->register_title_style_controls();
		$this->register_description_style_controls();
		$this->register_button_style_controls();
		$this->register_point_style_controls();
		$this->register_visual_style_controls();
		$this->register_window_style_controls();
		$this->register_listing_style_controls();
		$this->register_floating_card_style_controls();
	}

	private function register_content_controls()
	{
		$this->start_controls_section(
			'linkpva_hero_banner_content',
			array(
				'label' => esc_html__('Hero Content', 'linkpva-core'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'linkpva_hero_banner_show_shapes',
			array(
				'label'        => esc_html__('Show Decorative Shapes', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'linkpva_hero_banner_show_eyebrow',
			array(
				'label'        => esc_html__('Show Eyebrow', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'linkpva_hero_banner_eyebrow_icon',
			array(
				'label'     => esc_html__('Eyebrow Icon', 'linkpva-core'),
				'type'      => Controls_Manager::ICONS,
				'default'   => array('value' => 'bi bi-patch-check-fill', 'library' => 'bootstrap'),
				'condition' => array('linkpva_hero_banner_show_eyebrow' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_hero_banner_eyebrow_text',
			array(
				'label'       => esc_html__('Eyebrow Text', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('LinkedIn Account Marketplace', 'linkpva-core'),
				'label_block' => true,
				'condition'   => array('linkpva_hero_banner_show_eyebrow' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_hero_banner_title_before',
			array(
				'label'       => esc_html__('Title Before Highlight', 'linkpva-core'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__('Buy LinkedIn Accounts with', 'linkpva-core'),
				'label_block' => true,
				'separator'   => 'before',
			)
		);

		$this->add_control(
			'linkpva_hero_banner_title_highlight',
			array(
				'label'       => esc_html__('Highlighted Title', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Clear Details', 'linkpva-core'),
				'label_block' => true,
			)
		);

		$this->add_control(
			'linkpva_hero_banner_title_after',
			array(
				'label'       => esc_html__('Title After Highlight', 'linkpva-core'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__('and Flexible Options', 'linkpva-core'),
				'label_block' => true,
			)
		);

		$this->add_control(
			'linkpva_hero_banner_show_description',
			array(
				'label'        => esc_html__('Show Description', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'linkpva_hero_banner_description',
			array(
				'label'       => esc_html__('Description', 'linkpva-core'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__('Compare verified, aged, PVA, and follower-based account listings, review the available specifications, and follow a straightforward ordering process.', 'linkpva-core'),
				'label_block' => true,
				'condition'   => array('linkpva_hero_banner_show_description' => 'yes'),
			)
		);

		$this->end_controls_section();
	}

	private function register_button_controls()
	{
		$this->start_controls_section(
			'linkpva_hero_banner_button_content',
			array(
				'label' => esc_html__('Buttons', 'linkpva-core'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'linkpva_hero_banner_show_primary_button',
			array(
				'label'        => esc_html__('Show Primary Button', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'linkpva_hero_banner_primary_button_text',
			array(
				'label'       => esc_html__('Primary Button Text', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Browse All Accounts', 'linkpva-core'),
				'label_block' => true,
				'condition'   => array('linkpva_hero_banner_show_primary_button' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_hero_banner_primary_button_link',
			array(
				'label'         => esc_html__('Primary Button Link', 'linkpva-core'),
				'type'          => Controls_Manager::URL,
				'default'       => array('url' => home_url('/shop/')),
				'show_external' => true,
				'condition'     => array('linkpva_hero_banner_show_primary_button' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_hero_banner_primary_button_icon',
			array(
				'label'     => esc_html__('Primary Button Icon', 'linkpva-core'),
				'type'      => Controls_Manager::ICONS,
				'default'   => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'),
				'condition' => array('linkpva_hero_banner_show_primary_button' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_hero_banner_show_secondary_button',
			array(
				'label'        => esc_html__('Show Secondary Button', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'linkpva_hero_banner_secondary_button_text',
			array(
				'label'       => esc_html__('Secondary Button Text', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('How It Works', 'linkpva-core'),
				'label_block' => true,
				'condition'   => array('linkpva_hero_banner_show_secondary_button' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_hero_banner_secondary_button_link',
			array(
				'label'         => esc_html__('Secondary Button Link', 'linkpva-core'),
				'type'          => Controls_Manager::URL,
				'default'       => array('url' => home_url('/#how-it-works')),
				'show_external' => true,
				'condition'     => array('linkpva_hero_banner_show_secondary_button' => 'yes'),
			)
		);

		$this->end_controls_section();
	}

	private function register_point_controls()
	{
		$this->start_controls_section(
			'linkpva_hero_banner_point_content',
			array(
				'label' => esc_html__('Feature Points', 'linkpva-core'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'linkpva_hero_banner_show_points',
			array(
				'label'        => esc_html__('Show Feature Points', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'icon',
			array(
				'label'   => esc_html__('Icon', 'linkpva-core'),
				'type'    => Controls_Manager::ICONS,
				'default' => array('value' => 'bi bi-check-circle-fill', 'library' => 'bootstrap'),
			)
		);
		$repeater->add_control(
			'text',
			array(
				'label'       => esc_html__('Text', 'linkpva-core'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			)
		);

		$this->add_control(
			'linkpva_hero_banner_points',
			array(
				'label'       => esc_html__('Points', 'linkpva-core'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ text }}}',
				'default'     => $this->get_default_points(),
				'condition'   => array('linkpva_hero_banner_show_points' => 'yes'),
			)
		);

		$this->end_controls_section();
	}

	private function register_visual_controls()
	{
		$this->start_controls_section(
			'linkpva_hero_banner_visual_content',
			array(
				'label' => esc_html__('Right Visual', 'linkpva-core'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'linkpva_hero_banner_show_visual',
			array(
				'label'        => esc_html__('Show Right Visual', 'linkpva-core'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'linkpva_hero_banner_visual_type',
			array(
				'label'     => esc_html__('Visual Type', 'linkpva-core'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'content',
				'options'   => array(
					'content' => esc_html__('Content', 'linkpva-core'),
					'image'   => esc_html__('Image', 'linkpva-core'),
				),
				'condition' => array('linkpva_hero_banner_show_visual' => 'yes'),
			)
		);

		$this->add_control(
			'linkpva_hero_banner_visual_image',
			array(
				'label'       => esc_html__('Upload Image', 'linkpva-core'),
				'type'        => Controls_Manager::MEDIA,
				'media_types' => array('image', 'svg'),
				'description' => esc_html__('The content visual is used when no image is selected.', 'linkpva-core'),
				'condition'   => array(
					'linkpva_hero_banner_show_visual' => 'yes',
					'linkpva_hero_banner_visual_type' => 'image',
				),
			)
		);

		$visual_condition = array(
			'linkpva_hero_banner_show_visual' => 'yes',
			'linkpva_hero_banner_visual_type' => 'content',
		);

		$this->add_control('linkpva_hero_banner_browser_text', array('label' => esc_html__('Browser Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('linkpva.com/shop', 'linkpva-core'), 'label_block' => true, 'condition' => $visual_condition));
		$this->add_control('linkpva_hero_banner_window_label', array('label' => esc_html__('Window Label', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Available listings', 'linkpva-core'), 'label_block' => true, 'condition' => $visual_condition));
		$this->add_control('linkpva_hero_banner_window_heading', array('label' => esc_html__('Window Heading', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Choose by account type', 'linkpva-core'), 'label_block' => true, 'condition' => $visual_condition));

		$this->add_control(
			'linkpva_hero_banner_show_filter',
			array('label' => esc_html__('Show Filter Badge', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'separator' => 'before', 'condition' => $visual_condition)
		);
		$this->add_control('linkpva_hero_banner_filter_icon', array('label' => esc_html__('Filter Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-sliders', 'library' => 'bootstrap'), 'condition' => array('linkpva_hero_banner_show_visual' => 'yes', 'linkpva_hero_banner_visual_type' => 'content', 'linkpva_hero_banner_show_filter' => 'yes')));
		$this->add_control('linkpva_hero_banner_filter_text', array('label' => esc_html__('Filter Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Filters', 'linkpva-core'), 'condition' => array('linkpva_hero_banner_show_visual' => 'yes', 'linkpva_hero_banner_visual_type' => 'content', 'linkpva_hero_banner_show_filter' => 'yes')));

		$repeater = new Repeater();
		$repeater->add_control('icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS));
		$repeater->add_control('title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'label_block' => true));
		$repeater->add_control('description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'label_block' => true));
		$repeater->add_control('action_text', array('label' => esc_html__('Action Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('View', 'linkpva-core')));
		$repeater->add_control(
			'accent',
			array(
				'label'   => esc_html__('Icon Accent', 'linkpva-core'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default' => esc_html__('Primary', 'linkpva-core'),
					'purple'  => esc_html__('Purple', 'linkpva-core'),
					'green'   => esc_html__('Green', 'linkpva-core'),
				),
			)
		);

		$this->add_control(
			'linkpva_hero_banner_listings',
			array(
				'label'       => esc_html__('Listings', 'linkpva-core'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => $this->get_default_listings(),
				'condition'   => $visual_condition,
			)
		);

		$this->end_controls_section();
	}

	private function register_floating_card_controls()
	{
		$this->start_controls_section(
			'linkpva_hero_banner_floating_content',
			array(
				'label'     => esc_html__('Floating Cards', 'linkpva-core'),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'linkpva_hero_banner_show_visual' => 'yes',
					'linkpva_hero_banner_visual_type' => 'content',
				),
			)
		);

		$this->add_control(
			'linkpva_hero_banner_show_floating_cards',
			array('label' => esc_html__('Show Floating Cards', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes')
		);

		$repeater = new Repeater();
		$repeater->add_control('icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS));
		$repeater->add_control('title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'label_block' => true));
		$repeater->add_control('description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'label_block' => true));
		$repeater->add_control(
			'position',
			array(
				'label'   => esc_html__('Position', 'linkpva-core'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => array(
					'top'    => esc_html__('Top Right', 'linkpva-core'),
					'bottom' => esc_html__('Bottom Left', 'linkpva-core'),
				),
			)
		);

		$this->add_control(
			'linkpva_hero_banner_floating_cards',
			array(
				'label'       => esc_html__('Cards', 'linkpva-core'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => $this->get_default_floating_cards(),
				'condition'   => array('linkpva_hero_banner_show_floating_cards' => 'yes'),
			)
		);

		$this->end_controls_section();
	}

	private function register_section_style_controls()
	{
		$this->start_controls_section('linkpva_hero_banner_style_section', array('label' => esc_html__('Hero Section', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));

		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_hero_banner_style_background', 'selector' => '{{WRAPPER}} .linkpva-hero'));
		$this->add_responsive_control('linkpva_hero_banner_style_min_height', array('label' => esc_html__('Minimum Height', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'vh'), 'range' => array('px' => array('min' => 300, 'max' => 1200), 'vh' => array('min' => 30, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-hero' => 'min-height: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_hero_banner_style_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-hero' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_hero_banner_style_column_gap', array('label' => esc_html__('Column Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 120)), 'selectors' => array('{{WRAPPER}} .linkpva-hero .row' => '--bs-gutter-x: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_hero_banner_style_shape_border_color', array('label' => esc_html__('Shape Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-hero-shape' => 'border-color: {{VALUE}};'), 'condition' => array('linkpva_hero_banner_show_shapes' => 'yes')));

		$this->end_controls_section();
	}

	private function register_eyebrow_style_controls()
	{
		$this->start_controls_section('linkpva_hero_banner_style_eyebrow', array('label' => esc_html__('Eyebrow', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_hero_banner_show_eyebrow' => 'yes')));

		$this->add_control('linkpva_hero_banner_style_eyebrow_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-hero-content .linkpva-eyebrow' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_eyebrow_icon_color', array('label' => esc_html__('Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-hero-content .linkpva-eyebrow i' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-hero-content .linkpva-eyebrow svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_eyebrow_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-hero-content .linkpva-eyebrow' => 'background-color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_hero_banner_style_eyebrow_typography', 'selector' => '{{WRAPPER}} .linkpva-hero-content .linkpva-eyebrow'));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_hero_banner_style_eyebrow_border', 'selector' => '{{WRAPPER}} .linkpva-hero-content .linkpva-eyebrow'));
		$this->add_responsive_control('linkpva_hero_banner_style_eyebrow_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-hero-content .linkpva-eyebrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_hero_banner_style_eyebrow_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-hero-content .linkpva-eyebrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_hero_banner_style_eyebrow_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-hero-content .linkpva-eyebrow' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_hero_banner_style_eyebrow_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 6, 'max' => 40)), 'selectors' => array('{{WRAPPER}} .linkpva-hero-content .linkpva-eyebrow i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-hero-content .linkpva-eyebrow svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));

		$this->end_controls_section();
	}

	private function register_title_style_controls()
	{
		$this->start_controls_section('linkpva_hero_banner_style_title', array('label' => esc_html__('Title', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));

		$this->add_control('linkpva_hero_banner_style_title_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-hero-content h1' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_title_highlight_color', array('label' => esc_html__('Highlight Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-hero-content h1 span' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_hero_banner_style_title_typography', 'selector' => '{{WRAPPER}} .linkpva-hero-content h1'));
		$this->add_responsive_control('linkpva_hero_banner_style_title_width', array('label' => esc_html__('Max Width', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', '%'), 'range' => array('px' => array('min' => 250, 'max' => 1000)), 'selectors' => array('{{WRAPPER}} .linkpva-hero-content h1' => 'max-width: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_hero_banner_style_title_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-hero-content h1' => 'margin-bottom: {{SIZE}}{{UNIT}};')));

		$this->end_controls_section();
	}

	private function register_description_style_controls()
	{
		$this->start_controls_section('linkpva_hero_banner_style_description', array('label' => esc_html__('Description', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_hero_banner_show_description' => 'yes')));

		$this->add_control('linkpva_hero_banner_style_description_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-hero-content > p' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_hero_banner_style_description_typography', 'selector' => '{{WRAPPER}} .linkpva-hero-content > p'));
		$this->add_responsive_control('linkpva_hero_banner_style_description_width', array('label' => esc_html__('Max Width', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', '%'), 'range' => array('px' => array('min' => 200, 'max' => 900)), 'selectors' => array('{{WRAPPER}} .linkpva-hero-content > p' => 'max-width: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_hero_banner_style_description_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-hero-content > p' => 'margin-bottom: {{SIZE}}{{UNIT}};')));

		$this->end_controls_section();
	}

	private function register_button_style_controls()
	{
		$this->start_controls_section(
			'linkpva_hero_banner_style_buttons',
			array(
				'label'      => esc_html__('Buttons', 'linkpva-core'),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array('name' => 'linkpva_hero_banner_show_primary_button', 'operator' => '===', 'value' => 'yes'),
						array('name' => 'linkpva_hero_banner_show_secondary_button', 'operator' => '===', 'value' => 'yes'),
					),
				),
			)
		);

		$this->add_responsive_control('linkpva_hero_banner_style_button_gap', array('label' => esc_html__('Button Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 60)), 'selectors' => array('{{WRAPPER}} .linkpva-button-group' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_hero_banner_style_button_typography', 'selector' => '{{WRAPPER}} .linkpva-hero-content .linkpva-button'));
		$this->add_responsive_control('linkpva_hero_banner_style_button_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-hero-content .linkpva-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_hero_banner_style_button_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-hero-content .linkpva-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));

		$this->add_control('linkpva_hero_banner_style_primary_heading', array('label' => esc_html__('Primary Button', 'linkpva-core'), 'type' => Controls_Manager::HEADING, 'separator' => 'before', 'condition' => array('linkpva_hero_banner_show_primary_button' => 'yes')));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_hero_banner_style_primary_border', 'selector' => '{{WRAPPER}} .linkpva-button-primary', 'condition' => array('linkpva_hero_banner_show_primary_button' => 'yes')));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_hero_banner_style_primary_shadow', 'selector' => '{{WRAPPER}} .linkpva-button-primary', 'condition' => array('linkpva_hero_banner_show_primary_button' => 'yes')));
		$this->start_controls_tabs('linkpva_hero_banner_style_primary_tabs');
		$this->start_controls_tab('linkpva_hero_banner_style_primary_normal', array('label' => esc_html__('Normal', 'linkpva-core'), 'condition' => array('linkpva_hero_banner_show_primary_button' => 'yes')));
		$this->add_control('linkpva_hero_banner_style_primary_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-primary' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-button-primary svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_primary_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-primary' => 'background-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_hero_banner_style_primary_hover', array('label' => esc_html__('Hover', 'linkpva-core'), 'condition' => array('linkpva_hero_banner_show_primary_button' => 'yes')));
		$this->add_control('linkpva_hero_banner_style_primary_hover_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-primary:hover, {{WRAPPER}} .linkpva-button-primary:focus-visible' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-button-primary:hover svg path, {{WRAPPER}} .linkpva-button-primary:focus-visible svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_primary_hover_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-primary:hover, {{WRAPPER}} .linkpva-button-primary:focus-visible' => 'background-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control('linkpva_hero_banner_style_secondary_heading', array('label' => esc_html__('Secondary Button', 'linkpva-core'), 'type' => Controls_Manager::HEADING, 'separator' => 'before', 'condition' => array('linkpva_hero_banner_show_secondary_button' => 'yes')));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_hero_banner_style_secondary_border_control', 'selector' => '{{WRAPPER}} .linkpva-button-secondary', 'condition' => array('linkpva_hero_banner_show_secondary_button' => 'yes')));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_hero_banner_style_secondary_shadow', 'selector' => '{{WRAPPER}} .linkpva-button-secondary', 'condition' => array('linkpva_hero_banner_show_secondary_button' => 'yes')));
		$this->start_controls_tabs('linkpva_hero_banner_style_secondary_tabs');
		$this->start_controls_tab('linkpva_hero_banner_style_secondary_normal', array('label' => esc_html__('Normal', 'linkpva-core'), 'condition' => array('linkpva_hero_banner_show_secondary_button' => 'yes')));
		$this->add_control('linkpva_hero_banner_style_secondary_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-secondary' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_secondary_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-secondary' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_secondary_border', array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-secondary' => 'border-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_hero_banner_style_secondary_hover', array('label' => esc_html__('Hover', 'linkpva-core'), 'condition' => array('linkpva_hero_banner_show_secondary_button' => 'yes')));
		$this->add_control('linkpva_hero_banner_style_secondary_hover_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-secondary:hover, {{WRAPPER}} .linkpva-button-secondary:focus-visible' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_secondary_hover_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-secondary:hover, {{WRAPPER}} .linkpva-button-secondary:focus-visible' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_secondary_hover_border', array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button-secondary:hover, {{WRAPPER}} .linkpva-button-secondary:focus-visible' => 'border-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	private function register_point_style_controls()
	{
		$this->start_controls_section('linkpva_hero_banner_style_points', array('label' => esc_html__('Feature Points', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_hero_banner_show_points' => 'yes')));

		$this->add_control('linkpva_hero_banner_style_point_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-hero-points li' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_point_icon_color', array('label' => esc_html__('Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-hero-points i' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-hero-points svg path' => 'fill: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_hero_banner_style_point_typography', 'selector' => '{{WRAPPER}} .linkpva-hero-points li'));
		$this->add_responsive_control('linkpva_hero_banner_style_point_top_spacing', array('label' => esc_html__('Top Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-hero-points' => 'margin-top: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_hero_banner_style_point_column_gap', array('label' => esc_html__('Column Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 60)), 'selectors' => array('{{WRAPPER}} .linkpva-hero-points' => 'column-gap: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_hero_banner_style_point_row_gap', array('label' => esc_html__('Row Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 60)), 'selectors' => array('{{WRAPPER}} .linkpva-hero-points' => 'row-gap: {{SIZE}}{{UNIT}};')));

		$this->end_controls_section();
	}

	private function register_visual_style_controls()
	{
		$this->start_controls_section('linkpva_hero_banner_style_visual', array('label' => esc_html__('Visual Area', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_hero_banner_show_visual' => 'yes')));

		$this->add_responsive_control('linkpva_hero_banner_style_visual_width', array('label' => esc_html__('Max Width', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', '%'), 'range' => array('px' => array('min' => 280, 'max' => 900)), 'selectors' => array('{{WRAPPER}} .linkpva-hero-visual' => 'max-width: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_hero_banner_style_visual_height', array('label' => esc_html__('Minimum Height', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px'), 'range' => array('px' => array('min' => 250, 'max' => 800)), 'selectors' => array('{{WRAPPER}} .linkpva-hero-visual' => 'min-height: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_hero_banner_style_visual_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-hero-visual' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_hero_banner_style_visual_shape_background', 'selector' => '{{WRAPPER}} .linkpva-hero-visual::before'));
		$this->add_responsive_control('linkpva_hero_banner_style_visual_shape_radius', array('label' => esc_html__('Background Shape Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-hero-visual::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));

		$this->end_controls_section();
	}

	private function register_window_style_controls()
	{
		$this->start_controls_section('linkpva_hero_banner_style_window', array('label' => esc_html__('Market Window', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_hero_banner_show_visual' => 'yes', 'linkpva_hero_banner_visual_type' => 'content')));

		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_hero_banner_style_window_background', 'selector' => '{{WRAPPER}} .linkpva-market-window'));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_hero_banner_style_window_border', 'selector' => '{{WRAPPER}} .linkpva-market-window'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_hero_banner_style_window_shadow', 'selector' => '{{WRAPPER}} .linkpva-market-window'));
		$this->add_responsive_control('linkpva_hero_banner_style_window_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-market-window' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_control('linkpva_hero_banner_style_window_bar_heading', array('label' => esc_html__('Browser Bar', 'linkpva-core'), 'type' => Controls_Manager::HEADING, 'separator' => 'before'));
		$this->add_control('linkpva_hero_banner_style_window_bar_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-window-bar' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_window_bar_border', array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-window-bar' => 'border-color: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_browser_text_color', array('label' => esc_html__('Browser Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-window-bar div' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_hero_banner_style_browser_text_typography', 'selector' => '{{WRAPPER}} .linkpva-window-bar div'));
		$this->add_responsive_control('linkpva_hero_banner_style_window_body_padding', array('label' => esc_html__('Window Body Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-window-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_control('linkpva_hero_banner_style_window_label_color', array('label' => esc_html__('Label Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-window-heading small' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_hero_banner_style_window_label_typography', 'selector' => '{{WRAPPER}} .linkpva-window-heading small'));
		$this->add_control('linkpva_hero_banner_style_window_heading_color', array('label' => esc_html__('Heading Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-window-heading strong' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_hero_banner_style_window_heading_typography', 'selector' => '{{WRAPPER}} .linkpva-window-heading strong'));
		$this->add_control('linkpva_hero_banner_style_filter_color', array('label' => esc_html__('Filter Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-window-heading > span' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-window-heading > span svg path' => 'fill: {{VALUE}};'), 'condition' => array('linkpva_hero_banner_show_filter' => 'yes')));
		$this->add_control('linkpva_hero_banner_style_filter_background', array('label' => esc_html__('Filter Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-window-heading > span' => 'background-color: {{VALUE}};'), 'condition' => array('linkpva_hero_banner_show_filter' => 'yes')));

		$this->end_controls_section();
	}

	private function register_listing_style_controls()
	{
		$this->start_controls_section('linkpva_hero_banner_style_listing', array('label' => esc_html__('Listing Cards', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_hero_banner_show_visual' => 'yes', 'linkpva_hero_banner_visual_type' => 'content')));

		$this->add_control('linkpva_hero_banner_style_listing_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-mini-card' => 'background-color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_hero_banner_style_listing_border', 'selector' => '{{WRAPPER}} .linkpva-mini-card'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_hero_banner_style_listing_shadow', 'selector' => '{{WRAPPER}} .linkpva-mini-card'));
		$this->add_responsive_control('linkpva_hero_banner_style_listing_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-mini-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_hero_banner_style_listing_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-mini-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_hero_banner_style_listing_gap', array('label' => esc_html__('Content Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 50)), 'selectors' => array('{{WRAPPER}} .linkpva-mini-card' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_hero_banner_style_listing_spacing', array('label' => esc_html__('Card Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 50)), 'selectors' => array('{{WRAPPER}} .linkpva-mini-card' => 'margin-top: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_hero_banner_style_listing_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-mini-card div > span' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_hero_banner_style_listing_title_typography', 'selector' => '{{WRAPPER}} .linkpva-mini-card div > span'));
		$this->add_control('linkpva_hero_banner_style_listing_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-mini-card div > small' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_hero_banner_style_listing_description_typography', 'selector' => '{{WRAPPER}} .linkpva-mini-card div > small'));
		$this->add_control('linkpva_hero_banner_style_listing_action_color', array('label' => esc_html__('Action Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-mini-card > strong' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_hero_banner_style_listing_action_typography', 'selector' => '{{WRAPPER}} .linkpva-mini-card > strong'));
		$this->add_responsive_control('linkpva_hero_banner_style_listing_icon_size', array('label' => esc_html__('Icon Box Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px'), 'range' => array('px' => array('min' => 20, 'max' => 90)), 'selectors' => array('{{WRAPPER}} .linkpva-mini-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_hero_banner_style_listing_icon_primary_color', array('label' => esc_html__('Primary Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-mini-icon:not(.is-purple):not(.is-green)' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-mini-icon:not(.is-purple):not(.is-green) svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_listing_icon_primary_background', array('label' => esc_html__('Primary Icon Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-mini-icon:not(.is-purple):not(.is-green)' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_listing_icon_purple_color', array('label' => esc_html__('Purple Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-mini-icon.is-purple' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-mini-icon.is-purple svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_listing_icon_purple_background', array('label' => esc_html__('Purple Icon Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-mini-icon.is-purple' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_listing_icon_green_color', array('label' => esc_html__('Green Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-mini-icon.is-green' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-mini-icon.is-green svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_listing_icon_green_background', array('label' => esc_html__('Green Icon Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-mini-icon.is-green' => 'background-color: {{VALUE}};')));

		$this->end_controls_section();
	}

	private function register_floating_card_style_controls()
	{
		$this->start_controls_section('linkpva_hero_banner_style_floating', array('label' => esc_html__('Floating Cards', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_hero_banner_show_visual' => 'yes', 'linkpva_hero_banner_visual_type' => 'content', 'linkpva_hero_banner_show_floating_cards' => 'yes')));

		$this->add_control('linkpva_hero_banner_style_floating_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-floating-card' => 'background-color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_hero_banner_style_floating_border', 'selector' => '{{WRAPPER}} .linkpva-floating-card'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_hero_banner_style_floating_shadow', 'selector' => '{{WRAPPER}} .linkpva-floating-card'));
		$this->add_responsive_control('linkpva_hero_banner_style_floating_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-floating-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_hero_banner_style_floating_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-floating-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_control('linkpva_hero_banner_style_floating_icon_color', array('label' => esc_html__('Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-floating-card > i' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-floating-card > svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_hero_banner_style_floating_icon_background', array('label' => esc_html__('Icon Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-floating-card > i, {{WRAPPER}} .linkpva-floating-card > svg' => 'background-color: {{VALUE}};')));
		$this->add_responsive_control('linkpva_hero_banner_style_floating_icon_size', array('label' => esc_html__('Icon Box Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px'), 'range' => array('px' => array('min' => 20, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-floating-card > i, {{WRAPPER}} .linkpva-floating-card > svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_hero_banner_style_floating_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-floating-card strong' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_hero_banner_style_floating_title_typography', 'selector' => '{{WRAPPER}} .linkpva-floating-card strong'));
		$this->add_control('linkpva_hero_banner_style_floating_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-floating-card small' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_hero_banner_style_floating_description_typography', 'selector' => '{{WRAPPER}} .linkpva-floating-card small'));

		$this->end_controls_section();
	}

	private function get_default_points()
	{
		$icon = array('value' => 'bi bi-check-circle-fill', 'library' => 'bootstrap');

		return array(
			array('icon' => $icon, 'text' => esc_html__('Clear account details', 'linkpva-core')),
			array('icon' => $icon, 'text' => esc_html__('Multiple account types', 'linkpva-core')),
			array('icon' => $icon, 'text' => esc_html__('Purchase support', 'linkpva-core')),
		);
	}

	private function get_default_listings()
	{
		return array(
			array('icon' => array('value' => 'bi bi-patch-check-fill', 'library' => 'bootstrap'), 'title' => esc_html__('Verified Account', 'linkpva-core'), 'description' => esc_html__('Detailed verification info', 'linkpva-core'), 'action_text' => esc_html__('View', 'linkpva-core'), 'accent' => 'default'),
			array('icon' => array('value' => 'bi bi-clock-history', 'library' => 'bootstrap'), 'title' => esc_html__('Aged Account', 'linkpva-core'), 'description' => esc_html__('Multiple age ranges', 'linkpva-core'), 'action_text' => esc_html__('View', 'linkpva-core'), 'accent' => 'purple'),
			array('icon' => array('value' => 'bi bi-people-fill', 'library' => 'bootstrap'), 'title' => esc_html__('Followers Account', 'linkpva-core'), 'description' => esc_html__('Compare follower ranges', 'linkpva-core'), 'action_text' => esc_html__('View', 'linkpva-core'), 'accent' => 'green'),
		);
	}

	private function get_default_floating_cards()
	{
		return array(
			array('icon' => array('value' => 'bi bi-shield-check', 'library' => 'bootstrap'), 'title' => esc_html__('Clear specifications', 'linkpva-core'), 'description' => esc_html__('Know what you choose', 'linkpva-core'), 'position' => 'top'),
			array('icon' => array('value' => 'bi bi-headset', 'library' => 'bootstrap'), 'title' => esc_html__('Need assistance?', 'linkpva-core'), 'description' => esc_html__('Purchase support available', 'linkpva-core'), 'position' => 'bottom'),
		);
	}

	private function render_icon($icon, $attributes = array())
	{
		if (!empty($icon['value'])) {
			Icons_Manager::render_icon($icon, $attributes);
		}
	}

	private function render_visual_image($image)
	{
		if (!is_array($image) || empty($image['url'])) {
			return;
		}

		$attributes = array(
			'class'         => 'linkpva-hero-image',
			'loading'       => 'eager',
			'decoding'      => 'async',
			'fetchpriority' => 'high',
		);

		if (!empty($image['id'])) {
			echo wp_get_attachment_image(absint($image['id']), 'full', false, $attributes);
			return;
		}
?>
		<img class="linkpva-hero-image" src="<?php echo esc_url($image['url']); ?>" alt="" loading="eager" decoding="async" fetchpriority="high">
	<?php
	}

	protected function render()
	{
		$settings              = $this->get_settings_for_display();
		$widget_id             = sanitize_html_class($this->get_id());
		$heading_id            = 'linkpva-hero-heading-' . $widget_id;
		$points                = is_array($settings['linkpva_hero_banner_points']) ? $settings['linkpva_hero_banner_points'] : array();
		$listings              = is_array($settings['linkpva_hero_banner_listings']) ? $settings['linkpva_hero_banner_listings'] : array();
		$floating_cards        = is_array($settings['linkpva_hero_banner_floating_cards']) ? $settings['linkpva_hero_banner_floating_cards'] : array();
		$show_shapes           = 'yes' === $settings['linkpva_hero_banner_show_shapes'];
		$show_eyebrow          = 'yes' === $settings['linkpva_hero_banner_show_eyebrow'] && !empty($settings['linkpva_hero_banner_eyebrow_text']);
		$show_description      = 'yes' === $settings['linkpva_hero_banner_show_description'] && !empty($settings['linkpva_hero_banner_description']);
		$show_primary_button   = 'yes' === $settings['linkpva_hero_banner_show_primary_button'] && !empty($settings['linkpva_hero_banner_primary_button_text']);
		$show_secondary_button = 'yes' === $settings['linkpva_hero_banner_show_secondary_button'] && !empty($settings['linkpva_hero_banner_secondary_button_text']);
		$show_points           = 'yes' === $settings['linkpva_hero_banner_show_points'] && !empty($points);
		$show_visual           = 'yes' === $settings['linkpva_hero_banner_show_visual'];
		$visual_type           = isset($settings['linkpva_hero_banner_visual_type']) && 'image' === $settings['linkpva_hero_banner_visual_type'] ? 'image' : 'content';
		$visual_image          = isset($settings['linkpva_hero_banner_visual_image']) && is_array($settings['linkpva_hero_banner_visual_image']) ? $settings['linkpva_hero_banner_visual_image'] : array();
		$show_visual_image     = $show_visual && 'image' === $visual_type && !empty($visual_image['url']);
		$show_filter           = $show_visual && !$show_visual_image && 'yes' === $settings['linkpva_hero_banner_show_filter'] && !empty($settings['linkpva_hero_banner_filter_text']);
		$show_floating_cards   = $show_visual && !$show_visual_image && 'yes' === $settings['linkpva_hero_banner_show_floating_cards'] && !empty($floating_cards);
		$show_window_heading   = !empty($settings['linkpva_hero_banner_window_label']) || !empty($settings['linkpva_hero_banner_window_heading']) || $show_filter;
		$has_title             = !empty($settings['linkpva_hero_banner_title_before']) || !empty($settings['linkpva_hero_banner_title_highlight']) || !empty($settings['linkpva_hero_banner_title_after']);

		if ($show_primary_button) {
			$this->add_link_attributes('linkpva_hero_banner_primary_button_link', $settings['linkpva_hero_banner_primary_button_link']);
			$this->add_render_attribute('linkpva_hero_banner_primary_button_link', 'class', array('linkpva-button', 'linkpva-button-primary'));
		}

		if ($show_secondary_button) {
			$this->add_link_attributes('linkpva_hero_banner_secondary_button_link', $settings['linkpva_hero_banner_secondary_button_link']);
			$this->add_render_attribute('linkpva_hero_banner_secondary_button_link', 'class', array('linkpva-button', 'linkpva-button-secondary'));
		}
	?>
		<section class="linkpva-hero" data-linkpva-hero-banner-widget="<?php echo esc_attr($widget_id); ?>" <?php if ($has_title) : ?> aria-labelledby="<?php echo esc_attr($heading_id); ?>" <?php endif; ?>>
			<?php if ($show_shapes) : ?>
				<div class="linkpva-hero-shape linkpva-hero-shape-one" aria-hidden="true"></div>
				<div class="linkpva-hero-shape linkpva-hero-shape-two" aria-hidden="true"></div>
			<?php endif; ?>
			<div class="container">
				<div class="row align-items-center g-5">
					<div class="<?php echo esc_attr($show_visual ? 'col-lg-6' : 'col-12'); ?>">
						<div class="linkpva-hero-content">
							<?php if ($show_eyebrow) : ?>
								<span class="linkpva-eyebrow">
									<?php $this->render_icon($settings['linkpva_hero_banner_eyebrow_icon'], array('aria-hidden' => 'true')); ?>
									<?php echo esc_html($settings['linkpva_hero_banner_eyebrow_text']); ?>
								</span>
							<?php endif; ?>

							<?php if ($has_title) : ?>
								<h1 id="<?php echo esc_attr($heading_id); ?>">
									<?php if (!empty($settings['linkpva_hero_banner_title_before'])) : ?><?php echo esc_html($settings['linkpva_hero_banner_title_before']); ?> <?php endif; ?>
								<?php if (!empty($settings['linkpva_hero_banner_title_highlight'])) : ?><span><?php echo esc_html($settings['linkpva_hero_banner_title_highlight']); ?></span><?php endif; ?>
								<?php if (!empty($settings['linkpva_hero_banner_title_after'])) : ?> <?php echo esc_html($settings['linkpva_hero_banner_title_after']); ?><?php endif; ?>
								</h1>
							<?php endif; ?>

							<?php if ($show_description) : ?>
								<p><?php echo esc_html($settings['linkpva_hero_banner_description']); ?></p>
							<?php endif; ?>

							<?php if ($show_primary_button || $show_secondary_button) : ?>
								<div class="linkpva-button-group">
									<?php if ($show_primary_button) : ?>
										<a <?php $this->print_render_attribute_string('linkpva_hero_banner_primary_button_link'); ?>>
											<?php echo esc_html($settings['linkpva_hero_banner_primary_button_text']); ?>
											<?php $this->render_icon($settings['linkpva_hero_banner_primary_button_icon'], array('aria-hidden' => 'true')); ?>
										</a>
									<?php endif; ?>
									<?php if ($show_secondary_button) : ?>
										<a <?php $this->print_render_attribute_string('linkpva_hero_banner_secondary_button_link'); ?>><?php echo esc_html($settings['linkpva_hero_banner_secondary_button_text']); ?></a>
									<?php endif; ?>
								</div>
							<?php endif; ?>

							<?php if ($show_points) : ?>
								<ul class="linkpva-hero-points">
									<?php foreach ($points as $item) : ?>
										<?php if (empty($item['text'])) : ?><?php continue; ?><?php endif; ?>
										<li><?php $this->render_icon($item['icon'] ?? array(), array('aria-hidden' => 'true')); ?> <?php echo esc_html($item['text']); ?></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
					</div>

					<?php if ($show_visual) : ?>
						<div class="col-lg-6">
							<div class="linkpva-hero-visual">
								<?php if ($show_visual_image) : ?>
									<?php $this->render_visual_image($visual_image); ?>
								<?php else : ?>
									<div class="linkpva-market-window">
										<div class="linkpva-window-bar">
											<span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span>
											<?php if (!empty($settings['linkpva_hero_banner_browser_text'])) : ?><div><?php echo esc_html($settings['linkpva_hero_banner_browser_text']); ?></div><?php endif; ?>
										</div>
										<div class="linkpva-window-body">
											<?php if ($show_window_heading) : ?>
												<div class="linkpva-window-heading">
													<div>
														<?php if (!empty($settings['linkpva_hero_banner_window_label'])) : ?><small><?php echo esc_html($settings['linkpva_hero_banner_window_label']); ?></small><?php endif; ?>
														<?php if (!empty($settings['linkpva_hero_banner_window_heading'])) : ?><strong><?php echo esc_html($settings['linkpva_hero_banner_window_heading']); ?></strong><?php endif; ?>
													</div>
													<?php if ($show_filter) : ?>
														<span><?php $this->render_icon($settings['linkpva_hero_banner_filter_icon'], array('aria-hidden' => 'true')); ?> <?php echo esc_html($settings['linkpva_hero_banner_filter_text']); ?></span>
													<?php endif; ?>
												</div>
											<?php endif; ?>

											<?php foreach ($listings as $item) : ?>
												<?php
												if (empty($item['title']) && empty($item['description'])) {
													continue;
												}

												$accent       = in_array($item['accent'] ?? 'default', array('default', 'purple', 'green'), true) ? $item['accent'] : 'default';
												$accent_class = 'default' === $accent ? '' : ' is-' . $accent;
												?>
												<div class="linkpva-mini-card">
													<div class="linkpva-mini-icon<?php echo esc_attr($accent_class); ?>"><?php $this->render_icon($item['icon'] ?? array(), array('aria-hidden' => 'true')); ?></div>
													<div>
														<?php if (!empty($item['title'])) : ?><span><?php echo esc_html($item['title']); ?></span><?php endif; ?>
														<?php if (!empty($item['description'])) : ?><small><?php echo esc_html($item['description']); ?></small><?php endif; ?>
													</div>
													<?php if (!empty($item['action_text'])) : ?><strong><?php echo esc_html($item['action_text']); ?></strong><?php endif; ?>
												</div>
											<?php endforeach; ?>
										</div>
									</div>

									<?php if ($show_floating_cards) : ?>
										<?php foreach ($floating_cards as $item) : ?>
											<?php
											if (empty($item['title']) && empty($item['description'])) {
												continue;
											}

											$position = in_array($item['position'] ?? 'top', array('top', 'bottom'), true) ? $item['position'] : 'top';
											?>
											<div class="linkpva-floating-card linkpva-floating-card-<?php echo esc_attr($position); ?>">
												<?php $this->render_icon($item['icon'] ?? array(), array('aria-hidden' => 'true')); ?>
												<span>
													<?php if (!empty($item['title'])) : ?><strong><?php echo esc_html($item['title']); ?></strong><?php endif; ?>
													<?php if (!empty($item['description'])) : ?><small><?php echo esc_html($item['description']); ?></small><?php endif; ?>
												</span>
											</div>
										<?php endforeach; ?>
									<?php endif; ?>
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

Plugin::instance()->widgets_manager->register(new linkpva_Hero_Banner_Widget());
