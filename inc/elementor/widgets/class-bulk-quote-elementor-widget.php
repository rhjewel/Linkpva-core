<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}

class linkpva_Bulk_Quote_Widget extends Widget_Base
{
	public function get_name()
	{
		return 'linkpva_bulk_quote';
	}

	public function get_title()
	{
		return esc_html__('LinkPVA Bulk Quote', 'linkpva-core');
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
		$this->register_section_style_controls();
		$this->register_container_style_controls();
		$this->register_icon_style_controls();
		$this->register_content_style_controls();
		$this->register_button_style_controls();
	}

	private function register_content_controls()
	{
		$this->start_controls_section('linkpva_bulk_quote_content', array('label' => esc_html__('Bulk Quote', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_bulk_quote_show_icon', array('label' => esc_html__('Show Icon', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_bulk_quote_icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-layers', 'library' => 'bootstrap'), 'condition' => array('linkpva_bulk_quote_show_icon' => 'yes')));
		$this->add_control('linkpva_bulk_quote_show_label', array('label' => esc_html__('Show Label', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_bulk_quote_label', array('label' => esc_html__('Label', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Custom Requirements', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_bulk_quote_show_label' => 'yes')));
		$this->add_control('linkpva_bulk_quote_title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Need LinkedIn Accounts in Bulk?', 'linkpva-core'), 'label_block' => true));
		$this->add_control('linkpva_bulk_quote_show_description', array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_bulk_quote_description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Share your required account types, specifications, and quantity to request a tailored quotation.', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_bulk_quote_show_description' => 'yes')));
		$this->add_control('linkpva_bulk_quote_show_button', array('label' => esc_html__('Show Button', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'separator' => 'before'));
		$this->add_control('linkpva_bulk_quote_button_text', array('label' => esc_html__('Button Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Request a Bulk Quote', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_bulk_quote_show_button' => 'yes')));
		$this->add_control('linkpva_bulk_quote_button_link', array('label' => esc_html__('Button Link', 'linkpva-core'), 'type' => Controls_Manager::URL, 'default' => array('url' => home_url('/bulk-order/')), 'show_external' => true, 'condition' => array('linkpva_bulk_quote_show_button' => 'yes')));
		$this->add_control('linkpva_bulk_quote_button_icon', array('label' => esc_html__('Button Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'), 'condition' => array('linkpva_bulk_quote_show_button' => 'yes')));
		$this->end_controls_section();
	}

	private function register_section_style_controls()
	{
		$this->start_controls_section('linkpva_bulk_quote_style_section', array('label' => esc_html__('Section', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_bulk_quote_style_section_background', 'selector' => '{{WRAPPER}} .linkpva-bulk-order'));
		$this->add_responsive_control('linkpva_bulk_quote_style_section_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-bulk-order' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_container_style_controls()
	{
		$this->start_controls_section('linkpva_bulk_quote_style_container', array('label' => esc_html__('Quote Container', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_bulk_quote_style_container_background', 'selector' => '{{WRAPPER}} .linkpva-bulk-inner'));
		$this->add_control('linkpva_bulk_quote_style_container_color', array('label' => esc_html__('Base Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-inner' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_bulk_quote_style_container_border', 'selector' => '{{WRAPPER}} .linkpva-bulk-inner'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_bulk_quote_style_container_shadow', 'selector' => '{{WRAPPER}} .linkpva-bulk-inner'));
		$this->add_responsive_control('linkpva_bulk_quote_style_container_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-bulk-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_quote_style_container_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-bulk-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_quote_style_container_gap', array('label' => esc_html__('Content Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-bulk-inner' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_icon_style_controls()
	{
		$this->start_controls_section('linkpva_bulk_quote_style_icon', array('label' => esc_html__('Main Icon', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_bulk_quote_show_icon' => 'yes')));
		$this->add_control('linkpva_bulk_quote_style_icon_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-icon' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-bulk-icon svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_bulk_quote_style_icon_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-icon' => 'background-color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_bulk_quote_style_icon_border', 'selector' => '{{WRAPPER}} .linkpva-bulk-icon'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_bulk_quote_style_icon_shadow', 'selector' => '{{WRAPPER}} .linkpva-bulk-icon'));
		$this->add_responsive_control('linkpva_bulk_quote_style_icon_box_size', array('label' => esc_html__('Box Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 24, 'max' => 150)), 'selectors' => array('{{WRAPPER}} .linkpva-bulk-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_quote_style_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 6, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-bulk-icon i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-bulk-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_quote_style_icon_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-bulk-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_content_style_controls()
	{
		$this->start_controls_section('linkpva_bulk_quote_style_content', array('label' => esc_html__('Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_control('linkpva_bulk_quote_style_label_color', array('label' => esc_html__('Label Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-content > span' => 'color: {{VALUE}};'), 'condition' => array('linkpva_bulk_quote_show_label' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_bulk_quote_style_label_typography', 'selector' => '{{WRAPPER}} .linkpva-bulk-content > span', 'condition' => array('linkpva_bulk_quote_show_label' => 'yes')));
		$this->add_responsive_control('linkpva_bulk_quote_style_label_spacing', array('label' => esc_html__('Label Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-content > span' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_bulk_quote_show_label' => 'yes')));
		$this->add_control('linkpva_bulk_quote_style_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-inner h2' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_bulk_quote_style_title_typography', 'selector' => '{{WRAPPER}} .linkpva-bulk-inner h2'));
		$this->add_responsive_control('linkpva_bulk_quote_style_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-inner h2' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_bulk_quote_style_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-inner p' => 'color: {{VALUE}};'), 'condition' => array('linkpva_bulk_quote_show_description' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_bulk_quote_style_description_typography', 'selector' => '{{WRAPPER}} .linkpva-bulk-inner p', 'condition' => array('linkpva_bulk_quote_show_description' => 'yes')));
		$this->end_controls_section();
	}

	private function register_button_style_controls()
	{
		$this->start_controls_section('linkpva_bulk_quote_style_button', array('label' => esc_html__('Button', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_bulk_quote_show_button' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_bulk_quote_style_button_typography', 'selector' => '{{WRAPPER}} .linkpva-bulk-inner .linkpva-button'));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_bulk_quote_style_button_border', 'selector' => '{{WRAPPER}} .linkpva-bulk-inner .linkpva-button'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_bulk_quote_style_button_shadow', 'selector' => '{{WRAPPER}} .linkpva-bulk-inner .linkpva-button'));
		$this->add_responsive_control('linkpva_bulk_quote_style_button_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-inner .linkpva-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_quote_style_button_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-inner .linkpva-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_quote_style_button_gap', array('label' => esc_html__('Icon Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-bulk-inner .linkpva-button' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_bulk_quote_style_button_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-button i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-button svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->start_controls_tabs('linkpva_bulk_quote_style_button_tabs');
		$this->start_controls_tab('linkpva_bulk_quote_style_button_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control('linkpva_bulk_quote_style_button_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-button svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_bulk_quote_style_button_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button' => 'background-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_bulk_quote_style_button_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control('linkpva_bulk_quote_style_button_hover_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button:hover, {{WRAPPER}} .linkpva-button:focus-visible' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-button:hover svg path, {{WRAPPER}} .linkpva-button:focus-visible svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_bulk_quote_style_button_hover_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button:hover, {{WRAPPER}} .linkpva-button:focus-visible' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_bulk_quote_style_button_hover_border', array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button:hover, {{WRAPPER}} .linkpva-button:focus-visible' => 'border-color: {{VALUE}};')));
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
		$heading_id = 'linkpva-bulk-heading-' . $widget_id;
		$show_icon = 'yes' === ($settings['linkpva_bulk_quote_show_icon'] ?? '') && !empty($settings['linkpva_bulk_quote_icon']['value']);
		$show_label = 'yes' === ($settings['linkpva_bulk_quote_show_label'] ?? '') && !empty($settings['linkpva_bulk_quote_label']);
		$show_description = 'yes' === ($settings['linkpva_bulk_quote_show_description'] ?? '') && !empty($settings['linkpva_bulk_quote_description']);
		$show_button = 'yes' === ($settings['linkpva_bulk_quote_show_button'] ?? '') && !empty($settings['linkpva_bulk_quote_button_text']) && !empty($settings['linkpva_bulk_quote_button_link']['url']);
		$has_title = !empty($settings['linkpva_bulk_quote_title']);
		$has_content = $has_title || $show_label || $show_description;

		if (!$has_content) {
			return;
		}

		if ($show_button) {
			$this->add_link_attributes('linkpva_bulk_quote_button_link', $settings['linkpva_bulk_quote_button_link']);
			$this->add_render_attribute('linkpva_bulk_quote_button_link', 'class', array('linkpva-button', 'linkpva-button-light'));
		}
		?>
		<section class="linkpva-bulk-order" data-linkpva-bulk-quote-widget="<?php echo esc_attr($widget_id); ?>"<?php if ($has_title) : ?> aria-labelledby="<?php echo esc_attr($heading_id); ?>"<?php endif; ?>>
			<div class="container">
				<div class="linkpva-bulk-inner<?php echo $show_icon ? '' : ' has-no-icon'; ?>">
					<?php if ($show_icon) : ?><div class="linkpva-bulk-icon"><?php $this->render_icon($settings['linkpva_bulk_quote_icon']); ?></div><?php endif; ?>
					<?php if ($has_content) : ?><div class="linkpva-bulk-content">
						<?php if ($show_label) : ?><span><?php echo esc_html($settings['linkpva_bulk_quote_label']); ?></span><?php endif; ?>
						<?php if ($has_title) : ?><h2 id="<?php echo esc_attr($heading_id); ?>"><?php echo esc_html($settings['linkpva_bulk_quote_title']); ?></h2><?php endif; ?>
						<?php if ($show_description) : ?><p><?php echo esc_html($settings['linkpva_bulk_quote_description']); ?></p><?php endif; ?>
					</div><?php endif; ?>
					<?php if ($show_button) : ?><a <?php $this->print_render_attribute_string('linkpva_bulk_quote_button_link'); ?>><?php echo esc_html($settings['linkpva_bulk_quote_button_text']); ?> <?php $this->render_icon($settings['linkpva_bulk_quote_button_icon'] ?? array()); ?></a><?php endif; ?>
				</div>
			</div>
		</section>
		<?php
	}
}

Plugin::instance()->widgets_manager->register(new linkpva_Bulk_Quote_Widget());
