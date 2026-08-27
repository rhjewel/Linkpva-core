<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}

class linkpva_Why_Choose_Widget extends Widget_Base
{
	public function get_name() { return 'linkpva_why_choose'; }
	public function get_title() { return esc_html__('LinkPVA Why Choose', 'linkpva-core'); }
	public function get_icon() { return 'egns-widget-icon'; }
	public function get_categories() { return array('linkpva_widgets'); }

	protected function register_controls()
	{
		$this->content_controls();
		$this->section_style_controls();
		$this->heading_style_controls();
		$this->button_style_controls();
		$this->card_style_controls();
		$this->icon_style_controls();
		$this->card_text_style_controls();
	}

	private function content_controls()
	{
		$this->start_controls_section('linkpva_why_heading_content', array('label' => esc_html__('Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('show_tag', array('label' => esc_html__('Show Tag', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('tag', array('label' => esc_html__('Tag', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Why LinkPVA', 'linkpva-core'), 'label_block' => true, 'condition' => array('show_tag' => 'yes')));
		$this->add_control('title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('A Clearer Way to Choose LinkedIn Accounts', 'linkpva-core'), 'label_block' => true));
		$this->add_control('show_description', array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('LinkPVA is designed to make product comparison, ordering, and purchase support easier to understand.', 'linkpva-core'), 'condition' => array('show_description' => 'yes')));
		$this->end_controls_section();

		$this->start_controls_section('linkpva_why_button_content', array('label' => esc_html__('Button', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('show_button', array('label' => esc_html__('Show Button', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('button_text', array('label' => esc_html__('Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Learn About LinkPVA', 'linkpva-core'), 'label_block' => true, 'condition' => array('show_button' => 'yes')));
		$this->add_control('button_link', array('label' => esc_html__('Link', 'linkpva-core'), 'type' => Controls_Manager::URL, 'default' => array('url' => home_url('/about/')), 'show_external' => true, 'condition' => array('show_button' => 'yes')));
		$this->add_control('button_icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'), 'condition' => array('show_button' => 'yes')));
		$this->end_controls_section();

		$this->start_controls_section('linkpva_why_cards_content', array('label' => esc_html__('Benefit Cards', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('show_icons', array('label' => esc_html__('Show Icons', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('show_card_descriptions', array('label' => esc_html__('Show Descriptions', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$repeater = new Repeater();
		$repeater->add_control('icon', array('label' => esc_html__('Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS));
		$repeater->add_control('title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'label_block' => true));
		$repeater->add_control('description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA));
		$this->add_control('benefits', array('label' => esc_html__('Benefits', 'linkpva-core'), 'type' => Controls_Manager::REPEATER, 'fields' => $repeater->get_controls(), 'title_field' => '{{{ title }}}', 'default' => $this->default_benefits()));
		$this->end_controls_section();
	}

	private function section_style_controls()
	{
		$this->start_controls_section('linkpva_why_section_style', array('label' => esc_html__('Section', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'section_background', 'selector' => '{{WRAPPER}} .linkpva-why'));
		$this->add_responsive_control('section_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-why' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('column_gap', array('label' => esc_html__('Column Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 150)), 'selectors' => array('{{WRAPPER}} .linkpva-why > .container > .row' => '--bs-gutter-x: calc({{SIZE}}{{UNIT}} * 2);')));
		$this->add_responsive_control('card_gap', array('label' => esc_html__('Card Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-benefits-grid' => '--bs-gutter-x: calc({{SIZE}}{{UNIT}} * 2); --bs-gutter-y: calc({{SIZE}}{{UNIT}} * 2);')));
		$this->end_controls_section();
	}

	private function heading_style_controls()
	{
		$this->start_controls_section('linkpva_why_heading_style', array('label' => esc_html__('Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_responsive_control('heading_spacing', array('label' => esc_html__('Heading Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-why .linkpva-section-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('tag_color', array('label' => esc_html__('Tag Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-why .linkpva-section-tag' => 'color: {{VALUE}};'), 'condition' => array('show_tag' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'tag_typography', 'selector' => '{{WRAPPER}} .linkpva-why .linkpva-section-tag', 'condition' => array('show_tag' => 'yes')));
		$this->add_control('title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-why h2' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'title_typography', 'selector' => '{{WRAPPER}} .linkpva-why h2'));
		$this->add_responsive_control('title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 60)), 'selectors' => array('{{WRAPPER}} .linkpva-why h2' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-section-heading p' => 'color: {{VALUE}};'), 'condition' => array('show_description' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'description_typography', 'selector' => '{{WRAPPER}} .linkpva-section-heading p', 'condition' => array('show_description' => 'yes')));
		$this->end_controls_section();
	}

	private function button_style_controls()
	{
		$this->start_controls_section('linkpva_why_button_style', array('label' => esc_html__('Button', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('show_button' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'button_typography', 'selector' => '{{WRAPPER}} .linkpva-why .linkpva-button'));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'button_border', 'selector' => '{{WRAPPER}} .linkpva-why .linkpva-button'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'button_shadow', 'selector' => '{{WRAPPER}} .linkpva-why .linkpva-button'));
		$this->add_responsive_control('button_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-why .linkpva-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('button_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-why .linkpva-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('button_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-button i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-button svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->start_controls_tabs('button_color_tabs');
		$this->start_controls_tab('button_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control('button_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-button svg path' => 'fill: {{VALUE}};')));
		$this->add_control('button_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button' => 'background-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('button_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control('button_hover_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button:hover, {{WRAPPER}} .linkpva-button:focus-visible' => 'color: {{VALUE}};')));
		$this->add_control('button_hover_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button:hover, {{WRAPPER}} .linkpva-button:focus-visible' => 'background-color: {{VALUE}};')));
		$this->add_control('button_hover_border', array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-button:hover, {{WRAPPER}} .linkpva-button:focus-visible' => 'border-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	private function card_style_controls()
	{
		$this->start_controls_section('linkpva_why_card_style', array('label' => esc_html__('Benefit Cards', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'card_border', 'selector' => '{{WRAPPER}} .linkpva-benefit-card'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'card_shadow', 'selector' => '{{WRAPPER}} .linkpva-benefit-card'));
		$this->add_responsive_control('card_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-benefit-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('card_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-benefit-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->start_controls_tabs('card_tabs');
		$this->start_controls_tab('card_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control('card_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-benefit-card' => 'background-color: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('card_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control('card_hover_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-benefit-card:hover' => 'background-color: {{VALUE}};')));
		$this->add_control('card_hover_border', array('label' => esc_html__('Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-benefit-card:hover' => 'border-color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'card_hover_shadow', 'selector' => '{{WRAPPER}} .linkpva-benefit-card:hover'));
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	private function icon_style_controls()
	{
		$this->start_controls_section('linkpva_why_icon_style', array('label' => esc_html__('Card Icons', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('show_icons' => 'yes')));
		$this->add_control('icon_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-benefit-card > span' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-benefit-card > span svg path' => 'fill: {{VALUE}};')));
		$this->add_control('icon_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-benefit-card > span' => 'background-color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'icon_border', 'selector' => '{{WRAPPER}} .linkpva-benefit-card > span'));
		$this->add_responsive_control('icon_box_size', array('label' => esc_html__('Box Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 20, 'max' => 120)), 'selectors' => array('{{WRAPPER}} .linkpva-benefit-card > span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-benefit-card > span i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-benefit-card > span svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('icon_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-benefit-card > span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('icon_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-benefit-card > span' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function card_text_style_controls()
	{
		$this->start_controls_section('linkpva_why_card_text_style', array('label' => esc_html__('Card Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_control('card_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-benefit-card h3' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'card_title_typography', 'selector' => '{{WRAPPER}} .linkpva-benefit-card h3'));
		$this->add_responsive_control('card_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-benefit-card h3' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('card_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-benefit-card p' => 'color: {{VALUE}};'), 'condition' => array('show_card_descriptions' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'card_description_typography', 'selector' => '{{WRAPPER}} .linkpva-benefit-card p', 'condition' => array('show_card_descriptions' => 'yes')));
		$this->end_controls_section();
	}

	private function default_benefits()
	{
		return array(
			array('icon' => array('value' => 'bi bi-card-list', 'library' => 'bootstrap'), 'title' => esc_html__('Clear Product Specifications', 'linkpva-core'), 'description' => esc_html__('Review relevant account details and available options before making a decision.', 'linkpva-core')),
			array('icon' => array('value' => 'bi bi-bag-check', 'library' => 'bootstrap'), 'title' => esc_html__('Simple Ordering Experience', 'linkpva-core'), 'description' => esc_html__('Choose a listing, confirm your selection, and follow a straightforward checkout flow.', 'linkpva-core')),
			array('icon' => array('value' => 'bi bi-truck', 'library' => 'bootstrap'), 'title' => esc_html__('Transparent Delivery Info', 'linkpva-core'), 'description' => esc_html__('See the expected delivery process and applicable conditions before purchase.', 'linkpva-core')),
			array('icon' => array('value' => 'bi bi-chat-square-text', 'library' => 'bootstrap'), 'title' => esc_html__('Purchase Support', 'linkpva-core'), 'description' => esc_html__('Contact support when you need help with product selection or an existing order.', 'linkpva-core')),
		);
	}

	private function render_icon($icon)
	{
		if (is_array($icon) && !empty($icon['value'])) { Icons_Manager::render_icon($icon, array('aria-hidden' => 'true')); }
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$widget_id = sanitize_html_class($this->get_id());
		$heading_id = 'linkpva-why-heading-' . $widget_id;
		$benefits = isset($settings['benefits']) && is_array($settings['benefits']) ? $settings['benefits'] : array();
		$show_tag = 'yes' === ($settings['show_tag'] ?? '') && !empty($settings['tag']);
		$show_description = 'yes' === ($settings['show_description'] ?? '') && !empty($settings['description']);
		$show_button = 'yes' === ($settings['show_button'] ?? '') && !empty($settings['button_text']) && !empty($settings['button_link']['url']);
		$show_icons = 'yes' === ($settings['show_icons'] ?? '');
		$show_card_descriptions = 'yes' === ($settings['show_card_descriptions'] ?? '');
		$has_title = !empty($settings['title']);
		$has_intro = $has_title || $show_tag || $show_description || $show_button;
		$benefits = array_values(array_filter($benefits, function ($item) use ($show_card_descriptions) { return !empty($item['title']) || ($show_card_descriptions && !empty($item['description'])); }));
		if (!$has_intro && empty($benefits)) { return; }
		if ($show_button) {
			$this->add_link_attributes('button_link', $settings['button_link']);
			$this->add_render_attribute('button_link', 'class', array('linkpva-button', 'linkpva-button-primary'));
		}
		?>
		<section class="linkpva-section linkpva-why" data-linkpva-why-choose-widget="<?php echo esc_attr($widget_id); ?>"<?php if ($has_title) : ?> aria-labelledby="<?php echo esc_attr($heading_id); ?>"<?php endif; ?>>
			<div class="container"><div class="row align-items-center g-5">
				<?php if ($has_intro) : ?><div class="<?php echo empty($benefits) ? 'col-12' : 'col-lg-5'; ?>">
					<?php if ($has_title || $show_tag || $show_description) : ?><div class="linkpva-section-heading">
						<?php if ($show_tag) : ?><span class="linkpva-section-tag"><?php echo esc_html($settings['tag']); ?></span><?php endif; ?>
						<?php if ($has_title) : ?><h2 id="<?php echo esc_attr($heading_id); ?>"><?php echo esc_html($settings['title']); ?></h2><?php endif; ?>
						<?php if ($show_description) : ?><p><?php echo esc_html($settings['description']); ?></p><?php endif; ?>
					</div><?php endif; ?>
					<?php if ($show_button) : ?><a <?php $this->print_render_attribute_string('button_link'); ?>><?php echo esc_html($settings['button_text']); ?> <?php $this->render_icon($settings['button_icon'] ?? array()); ?></a><?php endif; ?>
				</div><?php endif; ?>
				<?php if (!empty($benefits)) : ?><div class="<?php echo $has_intro ? 'col-lg-7' : 'col-12'; ?>"><div class="row g-3 linkpva-benefits-grid">
					<?php foreach ($benefits as $benefit) : ?><div class="col-sm-6"><article class="linkpva-benefit-card">
						<?php if ($show_icons && !empty($benefit['icon']['value'])) : ?><span><?php $this->render_icon($benefit['icon']); ?></span><?php endif; ?>
						<?php if (!empty($benefit['title'])) : ?><h3><?php echo esc_html($benefit['title']); ?></h3><?php endif; ?>
						<?php if ($show_card_descriptions && !empty($benefit['description'])) : ?><p><?php echo esc_html($benefit['description']); ?></p><?php endif; ?>
					</article></div><?php endforeach; ?>
				</div></div><?php endif; ?>
			</div></div>
		</section>
		<?php
	}
}

Plugin::instance()->widgets_manager->register(new linkpva_Why_Choose_Widget());
