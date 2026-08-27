<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}

class linkpva_How_It_Works_Widget extends Widget_Base
{
	public function get_name()
	{
		return 'linkpva_how_it_works';
	}

	public function get_title()
	{
		return esc_html__('LinkPVA How It Works', 'linkpva-core');
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
		$this->register_steps_controls();
		$this->register_policy_controls();
		$this->register_section_style_controls();
		$this->register_heading_style_controls();
		$this->register_grid_style_controls();
		$this->register_step_style_controls();
		$this->register_icon_style_controls();
		$this->register_number_style_controls();
		$this->register_policy_style_controls();
	}

	private function register_heading_controls()
	{
		$this->start_controls_section('linkpva_how_it_works_heading_content', array('label' => esc_html__('Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_how_it_works_show_tag', array('label' => esc_html__('Show Tag', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_how_it_works_tag', array('label' => esc_html__('Tag', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Three Simple Steps', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_how_it_works_show_tag' => 'yes')));
		$this->add_control('linkpva_how_it_works_title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('How Ordering Works', 'linkpva-core'), 'label_block' => true));
		$this->add_control('linkpva_how_it_works_show_description', array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_how_it_works_description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('From product selection to order delivery, the process is designed to stay clear and simple.', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_how_it_works_show_description' => 'yes')));
		$this->end_controls_section();
	}

	private function register_steps_controls()
	{
		$this->start_controls_section('linkpva_how_it_works_steps_content', array('label' => esc_html__('Process Steps', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_how_it_works_show_numbers', array('label' => esc_html__('Show Step Numbers', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_how_it_works_show_icons', array('label' => esc_html__('Show Icons', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_how_it_works_show_step_descriptions', array('label' => esc_html__('Show Descriptions', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));

		$repeater = new Repeater();
		$repeater->add_control('number', array('label' => esc_html__('Step Number', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => '01'));
		$repeater->add_control('icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-search', 'library' => 'bootstrap')));
		$repeater->add_control('title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'label_block' => true));
		$repeater->add_control('description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'label_block' => true));
		$this->add_control('linkpva_how_it_works_steps', array('label' => esc_html__('Steps', 'linkpva-core'), 'type' => Controls_Manager::REPEATER, 'fields' => $repeater->get_controls(), 'title_field' => '{{{ number }}} — {{{ title }}}', 'default' => $this->get_default_steps()));
		$this->end_controls_section();
	}

	private function register_policy_controls()
	{
		$this->start_controls_section('linkpva_how_it_works_policy_content', array('label' => esc_html__('Policy', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_how_it_works_show_policy', array('label' => esc_html__('Show Policy', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_how_it_works_policy_text', array('label' => esc_html__('Policy Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Delivery timing and conditions vary by listing.', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_how_it_works_show_policy' => 'yes')));
		$this->add_control('linkpva_how_it_works_policy_link_text', array('label' => esc_html__('Link Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Read the delivery policy', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_how_it_works_show_policy' => 'yes')));
		$this->add_control('linkpva_how_it_works_policy_link', array('label' => esc_html__('Link', 'linkpva-core'), 'type' => Controls_Manager::URL, 'default' => array('url' => home_url('/delivery-policy/')), 'show_external' => true, 'condition' => array('linkpva_how_it_works_show_policy' => 'yes')));
		$this->end_controls_section();
	}

	private function register_section_style_controls()
	{
		$this->start_controls_section('linkpva_how_it_works_style_section', array('label' => esc_html__('Section', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_how_it_works_style_section_background', 'selector' => '{{WRAPPER}} .linkpva-process'));
		$this->add_control('linkpva_how_it_works_style_section_color', array('label' => esc_html__('Base Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-process' => 'color: {{VALUE}};')));
		$this->add_responsive_control('linkpva_how_it_works_style_section_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-process' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_heading_style_controls()
	{
		$this->start_controls_section('linkpva_how_it_works_style_heading', array('label' => esc_html__('Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_responsive_control('linkpva_how_it_works_style_heading_width', array('label' => esc_html__('Maximum Width', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', '%'), 'range' => array('px' => array('min' => 200, 'max' => 1200)), 'selectors' => array('{{WRAPPER}} .linkpva-process .linkpva-section-heading' => 'max-width: {{SIZE}}{{UNIT}}; margin-right: auto; margin-left: auto;')));
		$this->add_responsive_control('linkpva_how_it_works_style_heading_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 120)), 'selectors' => array('{{WRAPPER}} .linkpva-process .linkpva-section-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_how_it_works_style_tag_color', array('label' => esc_html__('Tag Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-process .linkpva-section-tag' => 'color: {{VALUE}};'), 'condition' => array('linkpva_how_it_works_show_tag' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_how_it_works_style_tag_typography', 'selector' => '{{WRAPPER}} .linkpva-process .linkpva-section-tag', 'condition' => array('linkpva_how_it_works_show_tag' => 'yes')));
		$this->add_responsive_control('linkpva_how_it_works_style_tag_spacing', array('label' => esc_html__('Tag Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-process .linkpva-section-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_how_it_works_show_tag' => 'yes')));
		$this->add_control('linkpva_how_it_works_style_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-process .linkpva-section-heading h2' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_how_it_works_style_title_typography', 'selector' => '{{WRAPPER}} .linkpva-process .linkpva-section-heading h2'));
		$this->add_responsive_control('linkpva_how_it_works_style_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-process .linkpva-section-heading h2' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_how_it_works_style_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-process .linkpva-section-heading p' => 'color: {{VALUE}};'), 'condition' => array('linkpva_how_it_works_show_description' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_how_it_works_style_description_typography', 'selector' => '{{WRAPPER}} .linkpva-process .linkpva-section-heading p', 'condition' => array('linkpva_how_it_works_show_description' => 'yes')));
		$this->end_controls_section();
	}

	private function register_grid_style_controls()
	{
		$this->start_controls_section('linkpva_how_it_works_style_grid', array('label' => esc_html__('Steps Grid', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_responsive_control('linkpva_how_it_works_style_grid_columns', array('label' => esc_html__('Columns', 'linkpva-core'), 'type' => Controls_Manager::SELECT, 'default' => '3', 'tablet_default' => '3', 'mobile_default' => '1', 'options' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4'), 'selectors' => array('{{WRAPPER}} .linkpva-process-grid' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));')));
		$this->add_responsive_control('linkpva_how_it_works_style_grid_gap', array('label' => esc_html__('Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 120)), 'selectors' => array('{{WRAPPER}} .linkpva-process-grid' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_step_style_controls()
	{
		$this->start_controls_section('linkpva_how_it_works_style_step', array('label' => esc_html__('Step Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_responsive_control('linkpva_how_it_works_style_step_padding', array('label' => esc_html__('Step Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-process-grid li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_control('linkpva_how_it_works_style_step_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-process-grid h3' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_how_it_works_style_step_title_typography', 'selector' => '{{WRAPPER}} .linkpva-process-grid h3'));
		$this->add_responsive_control('linkpva_how_it_works_style_step_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-process-grid h3' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_how_it_works_style_step_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-process-grid p' => 'color: {{VALUE}};'), 'condition' => array('linkpva_how_it_works_show_step_descriptions' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_how_it_works_style_step_description_typography', 'selector' => '{{WRAPPER}} .linkpva-process-grid p', 'condition' => array('linkpva_how_it_works_show_step_descriptions' => 'yes')));
		$this->end_controls_section();
	}

	private function register_icon_style_controls()
	{
		$this->start_controls_section('linkpva_how_it_works_style_icon', array('label' => esc_html__('Step Icons', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_how_it_works_show_icons' => 'yes')));
		$this->add_control('linkpva_how_it_works_style_icon_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-process-icon' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-process-icon svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_how_it_works_style_icon_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-process-icon' => 'background-color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_how_it_works_style_icon_border', 'selector' => '{{WRAPPER}} .linkpva-process-icon'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_how_it_works_style_icon_shadow', 'selector' => '{{WRAPPER}} .linkpva-process-icon'));
		$this->add_responsive_control('linkpva_how_it_works_style_icon_box_size', array('label' => esc_html__('Box Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 30, 'max' => 180)), 'selectors' => array('{{WRAPPER}} .linkpva-process-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_how_it_works_style_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 8, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-process-icon i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-process-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_how_it_works_style_icon_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-process-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_how_it_works_style_icon_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-process-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_number_style_controls()
	{
		$this->start_controls_section('linkpva_how_it_works_style_number', array('label' => esc_html__('Step Numbers', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_how_it_works_show_numbers' => 'yes')));
		$this->add_control('linkpva_how_it_works_style_number_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-step-number' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_how_it_works_style_number_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-step-number' => 'background-color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_how_it_works_style_number_border', 'selector' => '{{WRAPPER}} .linkpva-step-number'));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_how_it_works_style_number_typography', 'selector' => '{{WRAPPER}} .linkpva-step-number'));
		$this->add_responsive_control('linkpva_how_it_works_style_number_size', array('label' => esc_html__('Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 16, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-step-number' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_policy_style_controls()
	{
		$this->start_controls_section('linkpva_how_it_works_style_policy', array('label' => esc_html__('Policy', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_how_it_works_show_policy' => 'yes')));
		$this->add_control('linkpva_how_it_works_style_policy_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-process-policy' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_how_it_works_style_policy_typography', 'selector' => '{{WRAPPER}} .linkpva-process-policy'));
		$this->add_responsive_control('linkpva_how_it_works_style_policy_spacing', array('label' => esc_html__('Top Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-process-policy' => 'margin-top: {{SIZE}}{{UNIT}};')));
		$this->start_controls_tabs('linkpva_how_it_works_style_policy_link_tabs');
		$this->start_controls_tab('linkpva_how_it_works_style_policy_link_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control('linkpva_how_it_works_style_policy_link_color', array('label' => esc_html__('Link Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-process-policy a' => 'color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_how_it_works_style_policy_link_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control('linkpva_how_it_works_style_policy_link_hover_color', array('label' => esc_html__('Link Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-process-policy a:hover, {{WRAPPER}} .linkpva-process-policy a:focus-visible' => 'color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	private function get_default_steps()
	{
		return array(
			array('number' => '01', 'icon' => array('value' => 'bi bi-search', 'library' => 'bootstrap'), 'title' => esc_html__('Choose Your Account', 'linkpva-core'), 'description' => esc_html__('Compare account types, specifications, prices, and available options.', 'linkpva-core')),
			array('number' => '02', 'icon' => array('value' => 'bi bi-credit-card', 'library' => 'bootstrap'), 'title' => esc_html__('Complete Your Order', 'linkpva-core'), 'description' => esc_html__('Confirm your selection and complete the required checkout information.', 'linkpva-core')),
			array('number' => '03', 'icon' => array('value' => 'bi bi-envelope-check', 'library' => 'bootstrap'), 'title' => esc_html__('Receive Order Details', 'linkpva-core'), 'description' => esc_html__('Receive the relevant information through the stated delivery method after confirmation.', 'linkpva-core')),
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
		$settings               = $this->get_settings_for_display();
		$widget_id              = sanitize_html_class($this->get_id());
		$heading_id             = 'linkpva-process-heading-' . $widget_id;
		$steps                  = isset($settings['linkpva_how_it_works_steps']) && is_array($settings['linkpva_how_it_works_steps']) ? $settings['linkpva_how_it_works_steps'] : array();
		$show_tag               = 'yes' === ($settings['linkpva_how_it_works_show_tag'] ?? '') && !empty($settings['linkpva_how_it_works_tag']);
		$show_description       = 'yes' === ($settings['linkpva_how_it_works_show_description'] ?? '') && !empty($settings['linkpva_how_it_works_description']);
		$show_numbers           = 'yes' === ($settings['linkpva_how_it_works_show_numbers'] ?? '');
		$show_icons             = 'yes' === ($settings['linkpva_how_it_works_show_icons'] ?? '');
		$show_step_descriptions = 'yes' === ($settings['linkpva_how_it_works_show_step_descriptions'] ?? '');
		$has_title              = !empty($settings['linkpva_how_it_works_title']);
		$show_policy            = 'yes' === ($settings['linkpva_how_it_works_show_policy'] ?? '') && (!empty($settings['linkpva_how_it_works_policy_text']) || (!empty($settings['linkpva_how_it_works_policy_link_text']) && !empty($settings['linkpva_how_it_works_policy_link']['url'])));
		$steps                  = array_values(array_filter($steps, function ($step) use ($show_step_descriptions) {
			return !empty($step['title']) || ($show_step_descriptions && !empty($step['description']));
		}));

		if (!$has_title && !$show_tag && !$show_description && empty($steps) && !$show_policy) {
			return;
		}

		$show_policy_link = $show_policy && !empty($settings['linkpva_how_it_works_policy_link_text']) && !empty($settings['linkpva_how_it_works_policy_link']['url']);
		if ($show_policy_link) {
			$this->add_link_attributes('linkpva_how_it_works_policy_link', $settings['linkpva_how_it_works_policy_link']);
		}
		?>
		<section class="linkpva-section linkpva-process" data-linkpva-how-it-works-widget="<?php echo esc_attr($widget_id); ?>"<?php if ($has_title) : ?> aria-labelledby="<?php echo esc_attr($heading_id); ?>"<?php endif; ?>>
			<div class="container">
				<?php if ($has_title || $show_tag || $show_description) : ?>
					<div class="linkpva-section-heading text-center">
						<?php if ($show_tag) : ?><span class="linkpva-section-tag"><?php echo esc_html($settings['linkpva_how_it_works_tag']); ?></span><?php endif; ?>
						<?php if ($has_title) : ?><h2 id="<?php echo esc_attr($heading_id); ?>"><?php echo esc_html($settings['linkpva_how_it_works_title']); ?></h2><?php endif; ?>
						<?php if ($show_description) : ?><p><?php echo esc_html($settings['linkpva_how_it_works_description']); ?></p><?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if (!empty($steps)) : ?>
					<ol class="linkpva-process-grid">
						<?php foreach ($steps as $step) : ?>
							<li>
								<?php if ($show_numbers && !empty($step['number'])) : ?><span class="linkpva-step-number"><?php echo esc_html($step['number']); ?></span><?php endif; ?>
								<?php if ($show_icons && !empty($step['icon']['value'])) : ?><div class="linkpva-process-icon"><?php $this->render_icon($step['icon']); ?></div><?php endif; ?>
								<?php if (!empty($step['title'])) : ?><h3><?php echo esc_html($step['title']); ?></h3><?php endif; ?>
								<?php if ($show_step_descriptions && !empty($step['description'])) : ?><p><?php echo esc_html($step['description']); ?></p><?php endif; ?>
							</li>
						<?php endforeach; ?>
					</ol>
				<?php endif; ?>
				<?php if ($show_policy) : ?>
					<p class="linkpva-process-policy"><?php if (!empty($settings['linkpva_how_it_works_policy_text'])) : ?><?php echo esc_html($settings['linkpva_how_it_works_policy_text']); ?> <?php endif; ?><?php if ($show_policy_link) : ?><a <?php $this->print_render_attribute_string('linkpva_how_it_works_policy_link'); ?>><?php echo esc_html($settings['linkpva_how_it_works_policy_link_text']); ?></a><?php endif; ?></p>
				<?php endif; ?>
			</div>
		</section>
		<?php
	}
}

Plugin::instance()->widgets_manager->register(new linkpva_How_It_Works_Widget());
