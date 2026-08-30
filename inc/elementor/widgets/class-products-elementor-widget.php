<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}

class linkpva_Products_Widget extends Widget_Base
{
	public function get_name()
	{
		return 'linkpva_products';
	}

	public function get_title()
	{
		return esc_html__('LinkPVA Products', 'linkpva-core');
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
		$this->register_style_controls();
	}

	private function register_content_controls()
	{
		$shop_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');

		$this->start_controls_section('linkpva_products_content_heading', array('label' => esc_html__('Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_products_show_heading', array('label' => esc_html__('Show Heading', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_products_show_tag', array('label' => esc_html__('Show Tag', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_products_show_heading' => 'yes')));
		$this->add_control('linkpva_products_tag', array('label' => esc_html__('Tag', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Featured Listings', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_products_show_heading' => 'yes', 'linkpva_products_show_tag' => 'yes')));
		$this->add_control('linkpva_products_title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Featured LinkedIn Accounts', 'linkpva-core'), 'rows' => 2, 'condition' => array('linkpva_products_show_heading' => 'yes')));
		$this->add_control('linkpva_products_show_description', array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_products_show_heading' => 'yes')));
		$this->add_control('linkpva_products_description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Explore selected listings and compare their key specifications before placing an order.', 'linkpva-core'), 'rows' => 3, 'condition' => array('linkpva_products_show_heading' => 'yes', 'linkpva_products_show_description' => 'yes')));
		$this->add_control('linkpva_products_show_archive_link', array('label' => esc_html__('Show Archive Link', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_products_archive_text', array('label' => esc_html__('Archive Link Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('View all products', 'linkpva-core'), 'condition' => array('linkpva_products_show_archive_link' => 'yes')));
		$this->add_control('linkpva_products_archive_url', array('label' => esc_html__('Archive Link', 'linkpva-core'), 'type' => Controls_Manager::URL, 'default' => array('url' => $shop_url), 'dynamic' => array('active' => true), 'condition' => array('linkpva_products_show_archive_link' => 'yes')));
		$this->add_control('linkpva_products_archive_icon', array('label' => esc_html__('Archive Link Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'), 'condition' => array('linkpva_products_show_archive_link' => 'yes')));
		$this->end_controls_section();

		$this->start_controls_section('linkpva_products_content_query', array('label' => esc_html__('Query', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_products_query_manual', array('label' => esc_html__('Select Products', 'linkpva-core'), 'type' => Controls_Manager::SELECT2, 'options' => $this->get_product_options(), 'multiple' => true, 'label_block' => true, 'description' => esc_html__('Selected products override category filtering and keep the selected order.', 'linkpva-core')));
		$this->add_control('linkpva_products_query_categories', array('label' => esc_html__('Product Categories', 'linkpva-core'), 'type' => Controls_Manager::SELECT2, 'options' => $this->get_category_options(), 'multiple' => true, 'label_block' => true));
		$this->add_control('linkpva_products_query_limit', array('label' => esc_html__('Products Per Page', 'linkpva-core'), 'type' => Controls_Manager::NUMBER, 'default' => 4, 'min' => 1, 'max' => 24));
		$this->add_control('linkpva_products_query_orderby', array('label' => esc_html__('Order By', 'linkpva-core'), 'type' => Controls_Manager::SELECT, 'default' => 'date', 'options' => array('date' => esc_html__('Date', 'linkpva-core'), 'modified' => esc_html__('Modified Date', 'linkpva-core'), 'title' => esc_html__('Title', 'linkpva-core'), 'menu_order' => esc_html__('Menu Order', 'linkpva-core'), 'rand' => esc_html__('Random', 'linkpva-core'), 'ID' => esc_html__('Product ID', 'linkpva-core'))));
		$this->add_control('linkpva_products_query_order', array('label' => esc_html__('Order', 'linkpva-core'), 'type' => Controls_Manager::SELECT, 'default' => 'DESC', 'options' => array('ASC' => esc_html__('Ascending', 'linkpva-core'), 'DESC' => esc_html__('Descending', 'linkpva-core'))));
		$this->end_controls_section();

		$this->start_controls_section('linkpva_products_content_cards', array('label' => esc_html__('Card Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_products_show_image', array('label' => esc_html__('Show Product Image', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_group_control(Group_Control_Image_Size::get_type(), array('name' => 'linkpva_products_image', 'default' => 'woocommerce_thumbnail', 'exclude' => array('custom'), 'condition' => array('linkpva_products_show_image' => 'yes')));
		$this->add_control('linkpva_products_show_badge', array('label' => esc_html__('Show Account Type Badge', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'description' => esc_html__('Uses the WooCommerce product attribute named Account Type.', 'linkpva-core')));
		$this->add_control('linkpva_products_show_category', array('label' => esc_html__('Show Product Category', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_products_show_features', array('label' => esc_html__('Show Product Features', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'description' => esc_html__('Uses newline-separated Product Features from the Codestar metabox.', 'linkpva-core')));
		$this->add_control('linkpva_products_feature_limit', array('label' => esc_html__('Feature Limit', 'linkpva-core'), 'type' => Controls_Manager::NUMBER, 'default' => 3, 'min' => 1, 'max' => 20, 'condition' => array('linkpva_products_show_features' => 'yes')));
		$this->add_control('linkpva_products_feature_icon', array('label' => esc_html__('Feature Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-check2', 'library' => 'bootstrap'), 'condition' => array('linkpva_products_show_features' => 'yes')));
		$this->add_control('linkpva_products_show_price', array('label' => esc_html__('Show Price', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_products_show_details_link', array('label' => esc_html__('Show Details Link', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_products_details_icon', array('label' => esc_html__('Details Link Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'), 'condition' => array('linkpva_products_show_details_link' => 'yes')));
		$this->end_controls_section();

		$this->start_controls_section('linkpva_products_content_note', array('label' => esc_html__('Note', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_products_show_note', array('label' => esc_html__('Show Note', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_products_note', array('label' => esc_html__('Note Text', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Product prices and specifications are sample content and must be replaced with approved listing data.', 'linkpva-core'), 'rows' => 3, 'condition' => array('linkpva_products_show_note' => 'yes')));
		$this->add_control('linkpva_products_note_icon', array('label' => esc_html__('Note Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-info-circle', 'library' => 'bootstrap'), 'condition' => array('linkpva_products_show_note' => 'yes')));
		$this->end_controls_section();
	}

	private function register_style_controls()
	{
		$this->start_controls_section('linkpva_products_style_section', array('label' => esc_html__('Section', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_products_section_background', 'selector' => '{{WRAPPER}} .linkpva-products'));
		$this->add_responsive_control('linkpva_products_section_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-products' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->end_controls_section();

		$this->start_controls_section('linkpva_products_style_heading', array('label' => esc_html__('Heading & Archive Link', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_responsive_control('linkpva_products_heading_gap', array('label' => esc_html__('Heading Row Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-heading-row' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_products_heading_spacing', array('label' => esc_html__('Row Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 160)), 'selectors' => array('{{WRAPPER}} .linkpva-heading-row' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_products_tag_color', array('label' => esc_html__('Tag Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-section-tag' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_products_tag_typography', 'selector' => '{{WRAPPER}} .linkpva-section-tag'));
		$this->add_control('linkpva_products_heading_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-section-heading h2' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_products_heading_typography', 'selector' => '{{WRAPPER}} .linkpva-section-heading h2'));
		$this->add_control('linkpva_products_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-section-heading p' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_products_description_typography', 'selector' => '{{WRAPPER}} .linkpva-section-heading p'));
		$this->add_control('linkpva_products_archive_color', array('label' => esc_html__('Archive Link Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-text-link' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-text-link svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_products_archive_hover_color', array('label' => esc_html__('Archive Link Hover Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-text-link:hover' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-text-link:hover svg path' => 'fill: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_products_archive_typography', 'selector' => '{{WRAPPER}} .linkpva-text-link'));
		$this->add_responsive_control('linkpva_products_archive_icon_size', array('label' => esc_html__('Archive Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-text-link i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-text-link svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();

		$this->start_controls_section('linkpva_products_style_grid', array('label' => esc_html__('Grid', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_responsive_control('linkpva_products_column_gap', array('label' => esc_html__('Column Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-products-grid' => '--bs-gutter-x: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_products_row_gap', array('label' => esc_html__('Row Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-products-grid' => '--bs-gutter-y: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();

		$this->start_controls_section('linkpva_products_style_card', array('label' => esc_html__('Cards', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_control('linkpva_products_card_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-product-card' => 'background-color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_products_card_border', 'selector' => '{{WRAPPER}} .linkpva-product-card'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_products_card_shadow', 'selector' => '{{WRAPPER}} .linkpva-product-card'));
		$this->add_responsive_control('linkpva_products_card_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-product-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_products_card_hover_shadow', 'label' => esc_html__('Hover Shadow', 'linkpva-core'), 'selector' => '{{WRAPPER}} .linkpva-product-card:hover'));
		$this->add_control('linkpva_products_card_hover_border_color', array('label' => esc_html__('Hover Border Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-product-card:hover' => 'border-color: {{VALUE}};')));
		$this->add_responsive_control('linkpva_products_card_hover_offset', array('label' => esc_html__('Hover Vertical Offset', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => -30, 'max' => 20)), 'selectors' => array('{{WRAPPER}} .linkpva-product-card:hover' => 'transform: translateY({{SIZE}}{{UNIT}});')));
		$this->end_controls_section();

		$this->start_controls_section('linkpva_products_style_visual', array('label' => esc_html__('Product Visual & Badge', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_responsive_control('linkpva_products_visual_height', array('label' => esc_html__('Visual Height', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 100, 'max' => 600)), 'selectors' => array('{{WRAPPER}} .linkpva-product-visual' => 'height: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_products_visual_background', array('label' => esc_html__('Default Visual Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-product-visual' => 'background: {{VALUE}};')));
		$this->add_control('linkpva_products_image_fit', array('label' => esc_html__('Image Fit', 'linkpva-core'), 'type' => Controls_Manager::SELECT, 'default' => 'cover', 'options' => array('cover' => esc_html__('Cover', 'linkpva-core'), 'contain' => esc_html__('Contain', 'linkpva-core'), 'fill' => esc_html__('Fill', 'linkpva-core')), 'selectors' => array('{{WRAPPER}} .linkpva-product-visual > img' => 'object-fit: {{VALUE}};')));
		$this->add_control('linkpva_products_badge_color', array('label' => esc_html__('Badge Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-product-badge' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_products_badge_background', array('label' => esc_html__('Badge Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-product-badge' => 'background-color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_products_badge_typography', 'selector' => '{{WRAPPER}} .linkpva-product-badge'));
		$this->add_responsive_control('linkpva_products_badge_padding', array('label' => esc_html__('Badge Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-product-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_products_badge_radius', array('label' => esc_html__('Badge Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-product-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->end_controls_section();

		$this->start_controls_section('linkpva_products_style_content', array('label' => esc_html__('Card Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_responsive_control('linkpva_products_body_padding', array('label' => esc_html__('Body Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-product-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_control('linkpva_products_category_color', array('label' => esc_html__('Category Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-product-category' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_products_category_typography', 'selector' => '{{WRAPPER}} .linkpva-product-category'));
		$this->add_control('linkpva_products_title_color', array('label' => esc_html__('Product Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-product-body h3 a' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_products_title_hover_color', array('label' => esc_html__('Product Title Hover Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-product-body h3 a:hover' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_products_title_typography', 'selector' => '{{WRAPPER}} .linkpva-product-body h3'));
		$this->add_control('linkpva_products_features_color', array('label' => esc_html__('Feature Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-product-body ul li' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_products_features_typography', 'selector' => '{{WRAPPER}} .linkpva-product-body ul li'));
		$this->add_control('linkpva_products_features_divider_color', array('label' => esc_html__('Feature Divider Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-product-body ul' => 'border-bottom-color: {{VALUE}};')));
		$this->add_responsive_control('linkpva_products_features_spacing', array('label' => esc_html__('Feature List Bottom Padding', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-product-body ul' => 'padding-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_products_features_icon_color', array('label' => esc_html__('Feature Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-product-body ul li i' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-product-body ul li svg path' => 'fill: {{VALUE}};')));
		$this->add_responsive_control('linkpva_products_features_icon_size', array('label' => esc_html__('Feature Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-product-body ul li i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-product-body ul li svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();

		$this->start_controls_section('linkpva_products_style_footer', array('label' => esc_html__('Price & Details Link', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_control('linkpva_products_price_color', array('label' => esc_html__('Price Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-product-footer strong' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_products_price_typography', 'selector' => '{{WRAPPER}} .linkpva-product-footer strong'));
		$this->add_responsive_control('linkpva_products_details_size', array('label' => esc_html__('Details Link Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-product-footer a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_products_details_radius', array('label' => esc_html__('Details Link Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-product-footer a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_products_details_icon_size', array('label' => esc_html__('Details Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-product-footer a i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-product-footer a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_products_details_color', array('label' => esc_html__('Link Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-product-footer a' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-product-footer a svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_products_details_background', array('label' => esc_html__('Link Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-product-footer a' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_products_details_hover_color', array('label' => esc_html__('Hover Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-product-card:hover .linkpva-product-footer a, {{WRAPPER}} .linkpva-product-footer a:hover' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-product-card:hover .linkpva-product-footer a svg path, {{WRAPPER}} .linkpva-product-footer a:hover svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_products_details_hover_background', array('label' => esc_html__('Hover Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-product-card:hover .linkpva-product-footer a, {{WRAPPER}} .linkpva-product-footer a:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};')));
		$this->end_controls_section();

		$this->start_controls_section('linkpva_products_style_note', array('label' => esc_html__('Note', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_products_show_note' => 'yes')));
		$this->add_control('linkpva_products_note_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-demo-note' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-demo-note svg path' => 'fill: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_products_note_typography', 'selector' => '{{WRAPPER}} .linkpva-demo-note'));
		$this->add_responsive_control('linkpva_products_note_spacing', array('label' => esc_html__('Top Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-demo-note' => 'margin-top: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_products_note_gap', array('label' => esc_html__('Icon Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-demo-note' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_products_note_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-demo-note i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-demo-note svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function get_product_options()
	{
		$options = array();
		$products = get_posts(array('post_type' => 'product', 'post_status' => 'publish', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC'));
		foreach ($products as $product) {
			$options[$product->ID] = $product->post_title;
		}
		return $options;
	}

	private function get_category_options()
	{
		$options = array();
		$terms = get_terms(array('taxonomy' => 'product_cat', 'hide_empty' => false));
		if (!is_wp_error($terms)) {
			foreach ($terms as $term) {
				$options[$term->term_id] = $term->name;
			}
		}
		return $options;
	}

	private function build_query_args($settings)
	{
		$allowed_orderby = array('date', 'modified', 'title', 'menu_order', 'rand', 'ID');
		$orderby = in_array($settings['linkpva_products_query_orderby'] ?? '', $allowed_orderby, true) ? $settings['linkpva_products_query_orderby'] : 'date';
		$manual = array_values(array_filter(array_map('absint', (array) ($settings['linkpva_products_query_manual'] ?? array()))));
		$categories = array_values(array_filter(array_map('absint', (array) ($settings['linkpva_products_query_categories'] ?? array()))));
		$tax_query = array();

		if (function_exists('wc_get_product_visibility_term_ids')) {
			$visibility = wc_get_product_visibility_term_ids();
			if (!empty($visibility['exclude-from-catalog'])) {
				$tax_query[] = array('taxonomy' => 'product_visibility', 'field' => 'term_taxonomy_id', 'terms' => array(absint($visibility['exclude-from-catalog'])), 'operator' => 'NOT IN');
			}
		}

		if (!$manual && $categories) {
			$tax_query[] = array('taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $categories);
		}

		$args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'posts_per_page'      => max(1, min(24, absint($settings['linkpva_products_query_limit'] ?? 4))),
			'orderby'             => $orderby,
			'order'               => 'ASC' === ($settings['linkpva_products_query_order'] ?? '') ? 'ASC' : 'DESC',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		);

		if ($manual) {
			$args['post__in'] = $manual;
			$args['orderby'] = 'post__in';
			$args['posts_per_page'] = count($manual);
		}
		if ($tax_query) {
			$args['tax_query'] = $tax_query;
		}
		return $args;
	}

	private function get_account_type($product)
	{
		foreach ($product->get_attributes() as $attribute) {
			$name = $attribute->get_name();
			$label = function_exists('wc_attribute_label') ? wc_attribute_label($name, $product) : $name;
			if ('account-type' !== sanitize_title(preg_replace('/^pa_/', '', $name)) && 'account-type' !== sanitize_title($label)) {
				continue;
			}
			$values = $attribute->is_taxonomy() ? wc_get_product_terms($product->get_id(), $name, array('fields' => 'names')) : $attribute->get_options();
			if (!is_wp_error($values)) {
				return implode(', ', array_values(array_filter(array_map('sanitize_text_field', (array) $values))));
			}
		}
		return '';
	}

	private function get_product_features($product_id, $limit)
	{
		$meta = get_post_meta($product_id, 'EGNS_PRODUCT_META_ID', true);
		$features = is_array($meta) ? ($meta['product_feature_lbl'] ?? '') : '';
		if ('' === trim((string) $features)) {
			$features = get_post_meta($product_id, 'product_feature_lbl', true);
		}
		$features = preg_split('/\r\n|\r|\n/', wp_strip_all_tags((string) $features));
		$features = array_values(array_filter(array_map('trim', (array) $features)));
		return array_slice($features, 0, max(1, absint($limit)));
	}

	private function get_primary_category($product_id)
	{
		$terms = get_the_terms($product_id, 'product_cat');
		return (!is_wp_error($terms) && !empty($terms)) ? $terms[0]->name : '';
	}

	private function render_product_image($product, $settings)
	{
		$size = sanitize_key($settings['linkpva_products_image_size'] ?? 'woocommerce_thumbnail');
		if ($product->get_image_id()) {
			echo wp_get_attachment_image($product->get_image_id(), $size, false, array('loading' => 'lazy', 'decoding' => 'async'));
		} elseif (function_exists('wc_placeholder_img_src')) {
			printf('<img src="%1$s" alt="%2$s" loading="lazy" decoding="async">', esc_url(wc_placeholder_img_src($size)), esc_attr($product->get_name()));
		}
	}

	private function render_icon($icon)
	{
		if (!empty($icon['value'])) {
			Icons_Manager::render_icon($icon, array('aria-hidden' => 'true'));
		}
	}

	protected function render()
	{
		if (!class_exists('WooCommerce') || !function_exists('wc_get_product')) {
			return;
		}

		$settings = $this->get_settings_for_display();
		$query = new \WP_Query($this->build_query_args($settings));
		if (!$query->have_posts()) {
			wp_reset_postdata();
			return;
		}

		$heading_id = 'linkpva-products-heading-' . $this->get_id();
		$show_heading = 'yes' === ($settings['linkpva_products_show_heading'] ?? '');
		$has_heading_title = $show_heading && !empty($settings['linkpva_products_title']);
		$visual_classes = array('', 'is-purple', 'is-cyan', 'is-green');
		$card_index = 0;
		?>
		<section class="linkpva-section linkpva-products linkpva-products-widget"<?php echo $has_heading_title ? ' aria-labelledby="' . esc_attr($heading_id) . '"' : ' aria-label="' . esc_attr__('Products', 'linkpva-core') . '"'; ?>>
			<div class="container">
				<?php if ($show_heading || 'yes' === ($settings['linkpva_products_show_archive_link'] ?? '')) : ?>
					<div class="linkpva-heading-row">
						<?php if ($show_heading) : ?>
							<div class="linkpva-section-heading">
								<?php if ('yes' === ($settings['linkpva_products_show_tag'] ?? '') && !empty($settings['linkpva_products_tag'])) : ?><span class="linkpva-section-tag"><?php echo esc_html($settings['linkpva_products_tag']); ?></span><?php endif; ?>
								<?php if (!empty($settings['linkpva_products_title'])) : ?><h2 id="<?php echo esc_attr($heading_id); ?>"><?php echo esc_html($settings['linkpva_products_title']); ?></h2><?php endif; ?>
								<?php if ('yes' === ($settings['linkpva_products_show_description'] ?? '') && !empty($settings['linkpva_products_description'])) : ?><p><?php echo wp_kses_post($settings['linkpva_products_description']); ?></p><?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if ('yes' === ($settings['linkpva_products_show_archive_link'] ?? '') && !empty($settings['linkpva_products_archive_text']) && !empty($settings['linkpva_products_archive_url']['url'])) : ?>
							<?php $this->add_link_attributes('linkpva_products_archive_url', $settings['linkpva_products_archive_url']); $this->add_render_attribute('linkpva_products_archive_url', 'class', 'linkpva-text-link'); ?>
							<a <?php $this->print_render_attribute_string('linkpva_products_archive_url'); ?>><?php echo esc_html($settings['linkpva_products_archive_text']); ?> <?php $this->render_icon($settings['linkpva_products_archive_icon'] ?? array()); ?></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<div class="row g-4 linkpva-products-grid">
					<?php while ($query->have_posts()) : $query->the_post(); ?>
						<?php
						$product = wc_get_product(get_the_ID());
						if (!$product || !$product->is_visible()) { continue; }
						$product_id = $product->get_id();
						$product_name = $product->get_name();
						$product_url = get_permalink($product_id);
						$account_type = $this->get_account_type($product);
						$features = $this->get_product_features($product_id, $settings['linkpva_products_feature_limit'] ?? 3);
						$category = $this->get_primary_category($product_id);
						$visual_class = $visual_classes[$card_index % count($visual_classes)];
						$card_index++;
						?>
						<div class="col-md-6 col-xl-3">
							<article class="linkpva-product-card">
								<?php if ('yes' === ($settings['linkpva_products_show_image'] ?? '')) : ?>
									<div class="linkpva-product-visual<?php echo $visual_class ? ' ' . esc_attr($visual_class) : ''; ?>">
										<?php if ('yes' === ($settings['linkpva_products_show_badge'] ?? '') && $account_type) : ?><span class="linkpva-product-badge"><?php echo esc_html($account_type); ?></span><?php endif; ?>
										<?php $this->render_product_image($product, $settings); ?>
									</div>
								<?php endif; ?>
								<div class="linkpva-product-body">
									<?php if ('yes' === ($settings['linkpva_products_show_category'] ?? '') && $category) : ?><span class="linkpva-product-category"><?php echo esc_html($category); ?></span><?php endif; ?>
									<h3><a href="<?php echo esc_url($product_url); ?>"><?php echo esc_html($product_name); ?></a></h3>
									<?php if ('yes' === ($settings['linkpva_products_show_features'] ?? '') && $features) : ?>
										<ul><?php foreach ($features as $feature) : ?><li><?php $this->render_icon($settings['linkpva_products_feature_icon'] ?? array()); ?> <?php echo esc_html($feature); ?></li><?php endforeach; ?></ul>
									<?php endif; ?>
									<?php if ('yes' === ($settings['linkpva_products_show_price'] ?? '') || 'yes' === ($settings['linkpva_products_show_details_link'] ?? '')) : ?>
										<div class="linkpva-product-footer">
											<?php if ('yes' === ($settings['linkpva_products_show_price'] ?? '')) : ?><strong><?php echo wp_kses_post($product->get_price_html()); ?></strong><?php endif; ?>
											<?php if ('yes' === ($settings['linkpva_products_show_details_link'] ?? '')) : ?><a href="<?php echo esc_url($product_url); ?>" aria-label="<?php echo esc_attr(sprintf(__('View %s details', 'linkpva-core'), $product_name)); ?>"><?php $this->render_icon($settings['linkpva_products_details_icon'] ?? array()); ?></a><?php endif; ?>
										</div>
									<?php endif; ?>
								</div>
							</article>
						</div>
					<?php endwhile; ?>
				</div>
				<?php if ('yes' === ($settings['linkpva_products_show_note'] ?? '') && !empty($settings['linkpva_products_note'])) : ?><p class="linkpva-demo-note"><?php $this->render_icon($settings['linkpva_products_note_icon'] ?? array()); ?> <?php echo esc_html($settings['linkpva_products_note']); ?></p><?php endif; ?>
			</div>
		</section>
		<?php
		wp_reset_postdata();
	}
}

Plugin::instance()->widgets_manager->register(new linkpva_Products_Widget());
