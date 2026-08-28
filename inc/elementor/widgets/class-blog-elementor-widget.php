<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}

class linkpva_Blog_Widget extends Widget_Base
{
	public function get_name() { return 'linkpva_blog'; }
	public function get_title() { return esc_html__('LinkPVA Blog', 'linkpva-core'); }
	public function get_icon() { return 'egns-widget-icon'; }
	public function get_categories() { return array('linkpva_widgets'); }

	protected function register_controls()
	{
		$this->register_heading_controls();
		$this->register_query_controls();
		$this->register_card_content_controls();
		$this->register_pagination_controls();
		$this->register_section_style_controls();
		$this->register_heading_style_controls();
		$this->register_grid_style_controls();
		$this->register_card_style_controls();
		$this->register_visual_style_controls();
		$this->register_body_style_controls();
		$this->register_meta_style_controls();
		$this->register_title_style_controls();
		$this->register_excerpt_style_controls();
		$this->register_read_more_style_controls();
		$this->register_pagination_style_controls();
	}

	private function register_heading_controls()
	{
		$posts_page_id = absint(get_option('page_for_posts'));
		$archive_url = $posts_page_id ? get_permalink($posts_page_id) : home_url('/blog/');

		$this->start_controls_section('linkpva_blog_heading_content', array('label' => esc_html__('Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_blog_show_heading', array('label' => esc_html__('Show Heading', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_blog_show_tag', array('label' => esc_html__('Show Tag', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_blog_show_heading' => 'yes')));
		$this->add_control('linkpva_blog_tag', array('label' => esc_html__('Tag', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('From the Blog', 'linkpva-core'), 'condition' => array('linkpva_blog_show_heading' => 'yes', 'linkpva_blog_show_tag' => 'yes')));
		$this->add_control('linkpva_blog_title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Latest Insights and Resources', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_blog_show_heading' => 'yes')));
		$this->add_control('linkpva_blog_show_description', array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'condition' => array('linkpva_blog_show_heading' => 'yes')));
		$this->add_control('linkpva_blog_description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Practical guides about account types, product details, ordering, and responsible use.', 'linkpva-core'), 'condition' => array('linkpva_blog_show_heading' => 'yes', 'linkpva_blog_show_description' => 'yes')));
		$this->add_control('linkpva_blog_show_archive_link', array('label' => esc_html__('Show Archive Link', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_blog_archive_link_text', array('label' => esc_html__('Link Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('View all articles', 'linkpva-core'), 'condition' => array('linkpva_blog_show_archive_link' => 'yes')));
		$this->add_control('linkpva_blog_archive_link', array('label' => esc_html__('Link', 'linkpva-core'), 'type' => Controls_Manager::URL, 'default' => array('url' => $archive_url), 'show_external' => true, 'condition' => array('linkpva_blog_show_archive_link' => 'yes')));
		$this->add_control('linkpva_blog_archive_link_icon', array('label' => esc_html__('Link Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'), 'condition' => array('linkpva_blog_show_archive_link' => 'yes')));
		$this->end_controls_section();
	}

	private function register_query_controls()
	{
		$this->start_controls_section('linkpva_blog_query_content', array('label' => esc_html__('Query', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_blog_query_posts_per_page', array('label' => esc_html__('Posts Per Page', 'linkpva-core'), 'type' => Controls_Manager::NUMBER, 'default' => 3, 'min' => 1, 'max' => 24, 'step' => 1));
		$this->add_control('linkpva_blog_query_categories', array('label' => esc_html__('Categories', 'linkpva-core'), 'type' => Controls_Manager::SELECT2, 'multiple' => true, 'options' => $this->get_term_options('category'), 'label_block' => true));
		$this->add_control('linkpva_blog_query_tags', array('label' => esc_html__('Tags', 'linkpva-core'), 'type' => Controls_Manager::SELECT2, 'multiple' => true, 'options' => $this->get_term_options('post_tag'), 'label_block' => true));
		$this->add_control('linkpva_blog_query_manual_posts', array('label' => esc_html__('Manual Posts', 'linkpva-core'), 'type' => Controls_Manager::SELECT2, 'multiple' => true, 'options' => $this->get_post_options(), 'label_block' => true, 'description' => esc_html__('Selected posts preserve this order and take priority over sorting controls.', 'linkpva-core')));
		$this->add_control('linkpva_blog_query_orderby', array('label' => esc_html__('Order By', 'linkpva-core'), 'type' => Controls_Manager::SELECT, 'default' => 'date', 'options' => array('date' => esc_html__('Date', 'linkpva-core'), 'modified' => esc_html__('Modified Date', 'linkpva-core'), 'title' => esc_html__('Title', 'linkpva-core'), 'comment_count' => esc_html__('Comment Count', 'linkpva-core'), 'rand' => esc_html__('Random', 'linkpva-core'), 'menu_order' => esc_html__('Menu Order', 'linkpva-core'))));
		$this->add_control('linkpva_blog_query_order', array('label' => esc_html__('Order', 'linkpva-core'), 'type' => Controls_Manager::SELECT, 'default' => 'DESC', 'options' => array('DESC' => esc_html__('Descending', 'linkpva-core'), 'ASC' => esc_html__('Ascending', 'linkpva-core'))));
		$this->add_control('linkpva_blog_query_ignore_sticky', array('label' => esc_html__('Ignore Sticky Posts', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->end_controls_section();
	}

	private function register_card_content_controls()
	{
		$this->start_controls_section('linkpva_blog_card_content', array('label' => esc_html__('Card Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_blog_show_image', array('label' => esc_html__('Show Featured Image', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_blog_show_visual_category', array('label' => esc_html__('Show Image Category', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_blog_show_format', array('label' => esc_html__('Show Post Format', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_blog_show_meta_category', array('label' => esc_html__('Show Meta Category', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_blog_show_date', array('label' => esc_html__('Show Date', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_blog_show_excerpt', array('label' => esc_html__('Show Excerpt', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_blog_excerpt_length', array('label' => esc_html__('Excerpt Words', 'linkpva-core'), 'type' => Controls_Manager::NUMBER, 'default' => 24, 'min' => 1, 'max' => 100, 'condition' => array('linkpva_blog_show_excerpt' => 'yes')));
		$this->add_control('linkpva_blog_show_read_more', array('label' => esc_html__('Show Read More', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_blog_read_more_text', array('label' => esc_html__('Read More Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Read article', 'linkpva-core'), 'condition' => array('linkpva_blog_show_read_more' => 'yes')));
		$this->add_control('linkpva_blog_read_more_icon', array('label' => esc_html__('Read More Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'), 'condition' => array('linkpva_blog_show_read_more' => 'yes')));
		$this->end_controls_section();
	}

	private function register_pagination_controls()
	{
		$this->start_controls_section('linkpva_blog_pagination_content', array('label' => esc_html__('Pagination', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_blog_show_pagination', array('label' => esc_html__('Show Pagination', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => ''));
		$this->add_control('linkpva_blog_pagination_prev_icon', array('label' => esc_html__('Previous Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-arrow-left', 'library' => 'bootstrap'), 'condition' => array('linkpva_blog_show_pagination' => 'yes')));
		$this->add_control('linkpva_blog_pagination_next_icon', array('label' => esc_html__('Next Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'), 'condition' => array('linkpva_blog_show_pagination' => 'yes')));
		$this->end_controls_section();
	}

	private function register_section_style_controls()
	{
		$this->start_controls_section('linkpva_blog_style_section', array('label' => esc_html__('Section', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_blog_style_section_background', 'selector' => '{{WRAPPER}} .linkpva-blog'));
		$this->add_responsive_control('linkpva_blog_style_section_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-blog' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_heading_style_controls()
	{
		$this->start_controls_section('linkpva_blog_style_heading', array('label' => esc_html__('Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_responsive_control('linkpva_blog_style_heading_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-blog .linkpva-heading-row' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_blog_style_tag_color', array('label' => esc_html__('Tag Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-blog .linkpva-section-tag' => 'color: {{VALUE}};'), 'condition' => array('linkpva_blog_show_tag' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_blog_style_tag_typography', 'selector' => '{{WRAPPER}} .linkpva-blog .linkpva-section-tag', 'condition' => array('linkpva_blog_show_tag' => 'yes')));
		$this->add_control('linkpva_blog_style_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-blog .linkpva-section-heading h2' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_blog_style_title_typography', 'selector' => '{{WRAPPER}} .linkpva-blog .linkpva-section-heading h2'));
		$this->add_control('linkpva_blog_style_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-blog .linkpva-section-heading p' => 'color: {{VALUE}};'), 'condition' => array('linkpva_blog_show_description' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_blog_style_description_typography', 'selector' => '{{WRAPPER}} .linkpva-blog .linkpva-section-heading p', 'condition' => array('linkpva_blog_show_description' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_blog_style_archive_link_typography', 'selector' => '{{WRAPPER}} .linkpva-blog .linkpva-text-link', 'condition' => array('linkpva_blog_show_archive_link' => 'yes')));
		$this->add_control('linkpva_blog_style_archive_link_color', array('label' => esc_html__('Archive Link Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-blog .linkpva-text-link' => 'color: {{VALUE}};'), 'condition' => array('linkpva_blog_show_archive_link' => 'yes')));
		$this->add_control('linkpva_blog_style_archive_link_hover_color', array('label' => esc_html__('Archive Link Hover', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-blog .linkpva-text-link:hover' => 'color: {{VALUE}};'), 'condition' => array('linkpva_blog_show_archive_link' => 'yes')));
		$this->end_controls_section();
	}

	private function register_grid_style_controls()
	{
		$this->start_controls_section('linkpva_blog_style_grid', array('label' => esc_html__('Grid', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_responsive_control('linkpva_blog_style_grid_gap', array('label' => esc_html__('Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 100)), 'selectors' => array('{{WRAPPER}} .linkpva-blog-grid' => '--bs-gutter-x: calc({{SIZE}}{{UNIT}} * 2); --bs-gutter-y: calc({{SIZE}}{{UNIT}} * 2);')));
		$this->end_controls_section();
	}

	private function register_card_style_controls()
	{
		$this->start_controls_section('linkpva_blog_style_card', array('label' => esc_html__('Cards', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_control('linkpva_blog_style_card_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-blog-card' => 'background-color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_blog_style_card_border', 'selector' => '{{WRAPPER}} .linkpva-blog-card'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_blog_style_card_shadow', 'selector' => '{{WRAPPER}} .linkpva-blog-card'));
		$this->add_responsive_control('linkpva_blog_style_card_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-blog-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_blog_style_card_hover_shadow', 'label' => esc_html__('Hover Shadow', 'linkpva-core'), 'selector' => '{{WRAPPER}} .linkpva-blog-card:hover'));
		$this->add_responsive_control('linkpva_blog_style_card_hover_offset', array('label' => esc_html__('Hover Vertical Offset', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => -30, 'max' => 20)), 'selectors' => array('{{WRAPPER}} .linkpva-blog-card:hover' => 'transform: translateY({{SIZE}}{{UNIT}});')));
		$this->end_controls_section();
	}

	private function register_visual_style_controls()
	{
		$this->start_controls_section('linkpva_blog_style_visual', array('label' => esc_html__('Card Visual', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_blog_style_visual_background', 'selector' => '{{WRAPPER}} .linkpva-blog-visual'));
		$this->add_responsive_control('linkpva_blog_style_visual_height', array('label' => esc_html__('Height', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 100, 'max' => 600)), 'selectors' => array('{{WRAPPER}} .linkpva-blog-visual' => 'height: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_blog_style_visual_icon_color', array('label' => esc_html__('Fallback Icon Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-blog-visual > i' => 'color: {{VALUE}};')));
		$this->add_responsive_control('linkpva_blog_style_visual_icon_size', array('label' => esc_html__('Fallback Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-blog-visual > i' => 'font-size: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_blog_style_badge_color', array('label' => esc_html__('Category Badge Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-blog-visual > span' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_blog_style_badge_background', array('label' => esc_html__('Category Badge Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-blog-visual > span' => 'background-color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_blog_style_badge_typography', 'selector' => '{{WRAPPER}} .linkpva-blog-visual > span'));
		$this->end_controls_section();
	}

	private function register_body_style_controls()
	{
		$this->start_controls_section('linkpva_blog_style_body', array('label' => esc_html__('Card Body', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_responsive_control('linkpva_blog_style_body_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-blog-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_meta_style_controls()
	{
		$this->start_controls_section('linkpva_blog_style_meta', array('label' => esc_html__('Metadata', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_control('linkpva_blog_style_meta_color', array('label' => esc_html__('Date Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-blog-meta' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_blog_style_meta_accent_color', array('label' => esc_html__('Category & Format Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-blog-meta span' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-blog-meta span svg path' => 'fill: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_blog_style_meta_typography', 'selector' => '{{WRAPPER}} .linkpva-blog-meta'));
		$this->add_responsive_control('linkpva_blog_style_meta_gap', array('label' => esc_html__('Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-blog-meta' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_blog_style_meta_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-blog-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_title_style_controls()
	{
		$this->start_controls_section('linkpva_blog_style_title', array('label' => esc_html__('Card Titles', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_control('linkpva_blog_style_card_title_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-blog-body h3 a' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_blog_style_card_title_hover_color', array('label' => esc_html__('Hover Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-blog-body h3 a:hover' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_blog_style_card_title_typography', 'selector' => '{{WRAPPER}} .linkpva-blog-body h3'));
		$this->add_responsive_control('linkpva_blog_style_card_title_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-blog-body h3' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_excerpt_style_controls()
	{
		$this->start_controls_section('linkpva_blog_style_excerpt', array('label' => esc_html__('Excerpt', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_blog_show_excerpt' => 'yes')));
		$this->add_control('linkpva_blog_style_excerpt_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-blog-body > p' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_blog_style_excerpt_typography', 'selector' => '{{WRAPPER}} .linkpva-blog-body > p'));
		$this->add_responsive_control('linkpva_blog_style_excerpt_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-blog-body > p' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_read_more_style_controls()
	{
		$this->start_controls_section('linkpva_blog_style_read_more', array('label' => esc_html__('Read More', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_blog_show_read_more' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_blog_style_read_more_typography', 'selector' => '{{WRAPPER}} .linkpva-read-more'));
		$this->add_control('linkpva_blog_style_read_more_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-read-more' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-read-more svg path' => 'fill: {{VALUE}};')));
		$this->add_control('linkpva_blog_style_read_more_hover_color', array('label' => esc_html__('Hover Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-read-more:hover' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-read-more:hover svg path' => 'fill: {{VALUE}};')));
		$this->add_responsive_control('linkpva_blog_style_read_more_gap', array('label' => esc_html__('Icon Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-read-more' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_blog_style_read_more_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-read-more i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-read-more svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_pagination_style_controls()
	{
		$this->start_controls_section('linkpva_blog_style_pagination', array('label' => esc_html__('Pagination', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_blog_show_pagination' => 'yes')));
		$this->add_responsive_control('linkpva_blog_style_pagination_spacing', array('label' => esc_html__('Top Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-pagination' => 'margin-top: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_blog_style_pagination_gap', array('label' => esc_html__('Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-pagination' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_blog_style_pagination_size', array('label' => esc_html__('Item Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-pagination a, {{WRAPPER}} .linkpva-pagination span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_blog_style_pagination_border', 'selector' => '{{WRAPPER}} .linkpva-pagination a, {{WRAPPER}} .linkpva-pagination span'));
		$this->add_responsive_control('linkpva_blog_style_pagination_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-pagination a, {{WRAPPER}} .linkpva-pagination span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_blog_style_pagination_typography', 'selector' => '{{WRAPPER}} .linkpva-pagination a, {{WRAPPER}} .linkpva-pagination span'));
		$this->add_control('linkpva_blog_style_pagination_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pagination a' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_blog_style_pagination_background', array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pagination a' => 'background-color: {{VALUE}};')));
		$this->add_control('linkpva_blog_style_pagination_active_color', array('label' => esc_html__('Active Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pagination span, {{WRAPPER}} .linkpva-pagination a:hover' => 'color: {{VALUE}};')));
		$this->add_control('linkpva_blog_style_pagination_active_background', array('label' => esc_html__('Active Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pagination span, {{WRAPPER}} .linkpva-pagination a:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};')));
		$this->end_controls_section();
	}

	private function get_term_options($taxonomy)
	{
		$options = array();
		$terms = get_terms(array('taxonomy' => $taxonomy, 'hide_empty' => false));
		if (!is_wp_error($terms)) {
			foreach ($terms as $term) { $options[$term->term_id] = $term->name; }
		}
		return $options;
	}

	private function get_post_options()
	{
		$options = array();
		$posts = get_posts(array('post_type' => 'post', 'post_status' => 'publish', 'numberposts' => -1, 'orderby' => 'date', 'order' => 'DESC'));
		foreach ($posts as $post) { $options[$post->ID] = $post->post_title; }
		return $options;
	}

	private function build_query_args($settings)
	{
		$allowed_orderby = array('date', 'modified', 'title', 'comment_count', 'rand', 'menu_order');
		$orderby = in_array($settings['linkpva_blog_query_orderby'] ?? '', $allowed_orderby, true) ? $settings['linkpva_blog_query_orderby'] : 'date';
		$order = 'ASC' === ($settings['linkpva_blog_query_order'] ?? '') ? 'ASC' : 'DESC';
		$manual_posts = array_values(array_filter(array_map('absint', (array) ($settings['linkpva_blog_query_manual_posts'] ?? array()))));
		$categories = array_values(array_filter(array_map('absint', (array) ($settings['linkpva_blog_query_categories'] ?? array()))));
		$tags = array_values(array_filter(array_map('absint', (array) ($settings['linkpva_blog_query_tags'] ?? array()))));
		$tax_query = array();
		if ($categories) { $tax_query[] = array('taxonomy' => 'category', 'field' => 'term_id', 'terms' => $categories); }
		if ($tags) { $tax_query[] = array('taxonomy' => 'post_tag', 'field' => 'term_id', 'terms' => $tags); }
		if (count($tax_query) > 1) { $tax_query['relation'] = 'AND'; }
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => max(1, min(24, absint($settings['linkpva_blog_query_posts_per_page'] ?? 3))),
			'paged' => 'yes' === ($settings['linkpva_blog_show_pagination'] ?? '') ? max(1, absint(get_query_var('paged')), absint(get_query_var('page'))) : 1,
			'orderby' => $orderby,
			'order' => $order,
			'ignore_sticky_posts' => 'yes' === ($settings['linkpva_blog_query_ignore_sticky'] ?? ''),
			'no_found_rows' => 'yes' !== ($settings['linkpva_blog_show_pagination'] ?? ''),
		);
		if ($tax_query) { $args['tax_query'] = $tax_query; }
		if ($manual_posts) { $args['post__in'] = $manual_posts; $args['orderby'] = 'post__in'; }
		return $args;
	}

	private function get_format_data($post_id)
	{
		$format = get_post_format($post_id) ?: 'standard';
		$icons = array('standard' => 'file-earmark-text', 'aside' => 'card-text', 'audio' => 'music-note-beamed', 'chat' => 'chat-left-text', 'gallery' => 'images', 'image' => 'image', 'link' => 'link-45deg', 'quote' => 'quote', 'status' => 'card-text', 'video' => 'play-circle');
		$label = 'standard' === $format ? esc_html__('Article', 'linkpva-core') : get_post_format_string($format);
		return array('icon' => $icons[$format] ?? $icons['standard'], 'label' => $label ?: esc_html__('Article', 'linkpva-core'));
	}

	private function render_icon($icon)
	{
		if (is_array($icon) && !empty($icon['value'])) { Icons_Manager::render_icon($icon, array('aria-hidden' => 'true')); }
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$query = new \WP_Query($this->build_query_args($settings));
		if (!$query->have_posts()) { return; }
		$widget_id = sanitize_html_class($this->get_id());
		$heading_id = 'linkpva-blog-heading-' . $widget_id;
		$show_heading = 'yes' === ($settings['linkpva_blog_show_heading'] ?? '');
		$show_tag = $show_heading && 'yes' === ($settings['linkpva_blog_show_tag'] ?? '') && !empty($settings['linkpva_blog_tag']);
		$show_description = $show_heading && 'yes' === ($settings['linkpva_blog_show_description'] ?? '') && !empty($settings['linkpva_blog_description']);
		$has_title = $show_heading && !empty($settings['linkpva_blog_title']);
		$show_archive_link = 'yes' === ($settings['linkpva_blog_show_archive_link'] ?? '') && !empty($settings['linkpva_blog_archive_link_text']) && !empty($settings['linkpva_blog_archive_link']['url']);
		$show_image = 'yes' === ($settings['linkpva_blog_show_image'] ?? '');
		$show_visual_category = 'yes' === ($settings['linkpva_blog_show_visual_category'] ?? '');
		$show_format = 'yes' === ($settings['linkpva_blog_show_format'] ?? '');
		$show_meta_category = 'yes' === ($settings['linkpva_blog_show_meta_category'] ?? '');
		$show_date = 'yes' === ($settings['linkpva_blog_show_date'] ?? '');
		$show_excerpt = 'yes' === ($settings['linkpva_blog_show_excerpt'] ?? '');
		$show_read_more = 'yes' === ($settings['linkpva_blog_show_read_more'] ?? '') && !empty($settings['linkpva_blog_read_more_text']);
		if ($show_archive_link) { $this->add_link_attributes('linkpva_blog_archive_link', $settings['linkpva_blog_archive_link']); $this->add_render_attribute('linkpva_blog_archive_link', 'class', 'linkpva-text-link'); }
		?>
		<section class="linkpva-section linkpva-blog" data-linkpva-blog-widget="<?php echo esc_attr($widget_id); ?>"<?php if ($has_title) : ?> aria-labelledby="<?php echo esc_attr($heading_id); ?>"<?php endif; ?>>
			<div class="container">
				<?php if ($has_title || $show_tag || $show_description || $show_archive_link) : ?><div class="linkpva-heading-row">
					<?php if ($has_title || $show_tag || $show_description) : ?><div class="linkpva-section-heading"><?php if ($show_tag) : ?><span class="linkpva-section-tag"><?php echo esc_html($settings['linkpva_blog_tag']); ?></span><?php endif; ?><?php if ($has_title) : ?><h2 id="<?php echo esc_attr($heading_id); ?>"><?php echo esc_html($settings['linkpva_blog_title']); ?></h2><?php endif; ?><?php if ($show_description) : ?><p><?php echo esc_html($settings['linkpva_blog_description']); ?></p><?php endif; ?></div><?php endif; ?>
					<?php if ($show_archive_link) : ?><a <?php $this->print_render_attribute_string('linkpva_blog_archive_link'); ?>><?php echo esc_html($settings['linkpva_blog_archive_link_text']); ?> <?php $this->render_icon($settings['linkpva_blog_archive_link_icon'] ?? array()); ?></a><?php endif; ?>
				</div><?php endif; ?>
				<div class="row g-4 linkpva-blog-grid" data-blog-grid>
					<?php while ($query->have_posts()) : $query->the_post(); ?><?php
						$post_id = get_the_ID(); $permalink = get_permalink($post_id); $title = get_the_title($post_id);
						$categories = get_the_category($post_id); $category = $categories ? $categories[0] : null; $category_name = $category ? $category->name : '';
						$styles = array('is-blue', 'is-purple', 'is-green'); $visual_style = $styles[$category ? absint($category->term_id) % count($styles) : 0]; $format = $this->get_format_data($post_id);
						$excerpt = $show_excerpt ? wp_trim_words(wp_strip_all_tags(get_the_excerpt($post_id)), max(1, absint($settings['linkpva_blog_excerpt_length'] ?? 24)), '…') : '';
					?>
						<div id="post-<?php echo esc_attr($post_id); ?>" <?php post_class('col-md-6 col-lg-4'); ?> data-blog-item>
							<article class="linkpva-blog-card">
								<a class="linkpva-blog-visual <?php echo esc_attr($visual_style); ?>" href="<?php echo esc_url($permalink); ?>" aria-label="<?php echo esc_attr(sprintf(__('Read %s', 'linkpva-core'), $title)); ?>">
									<?php if ($show_image && has_post_thumbnail($post_id)) : ?><?php $thumbnail_id = get_post_thumbnail_id($post_id); $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) ?: $title; echo wp_get_attachment_image($thumbnail_id, 'blog-grid', false, array('alt' => $alt, 'loading' => 'lazy', 'decoding' => 'async')); ?><?php else : ?><i class="bi bi-<?php echo esc_attr($format['icon']); ?>" aria-hidden="true"></i><?php endif; ?>
									<?php if ($show_visual_category && $category_name) : ?><span><?php echo esc_html($category_name); ?></span><?php endif; ?>
								</a>
								<div class="linkpva-blog-body">
									<?php if ($show_format || ($show_meta_category && $category_name) || $show_date) : ?><div class="linkpva-blog-meta"><?php if ($show_format) : ?><span class="linkpva-post-format"><i class="bi bi-<?php echo esc_attr($format['icon']); ?>" aria-hidden="true"></i> <?php echo esc_html($format['label']); ?></span><?php endif; ?><?php if ($show_meta_category && $category_name) : ?><span><?php echo esc_html($category_name); ?></span><?php endif; ?><?php if ($show_date) : ?><time datetime="<?php echo esc_attr(get_the_date(DATE_W3C, $post_id)); ?>"><?php echo esc_html(get_the_date('', $post_id)); ?></time><?php endif; ?></div><?php endif; ?>
									<h3><a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a></h3>
									<?php if ($excerpt) : ?><p><?php echo esc_html($excerpt); ?></p><?php endif; ?>
									<?php if ($show_read_more) : ?><a class="linkpva-read-more" href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($settings['linkpva_blog_read_more_text']); ?> <?php $this->render_icon($settings['linkpva_blog_read_more_icon'] ?? array()); ?></a><?php endif; ?>
								</div>
							</article>
						</div>
					<?php endwhile; ?>
				</div>
				<?php if ('yes' === ($settings['linkpva_blog_show_pagination'] ?? '') && $query->max_num_pages > 1) : ?><?php $this->render_pagination($query, $settings); ?><?php endif; ?>
			</div>
		</section>
		<?php
		wp_reset_postdata();
	}

	private function render_pagination($query, $settings)
	{
		$current = max(1, absint(get_query_var('paged')), absint(get_query_var('page')));
		$links = paginate_links(array('current' => $current, 'total' => (int) $query->max_num_pages, 'type' => 'array', 'mid_size' => 1, 'end_size' => 1, 'prev_text' => $this->get_icon_html($settings['linkpva_blog_pagination_prev_icon'] ?? array(), esc_attr__('Previous page', 'linkpva-core')), 'next_text' => $this->get_icon_html($settings['linkpva_blog_pagination_next_icon'] ?? array(), esc_attr__('Next page', 'linkpva-core'))));
		if (!$links) { return; }
		?><nav class="linkpva-pagination" aria-label="<?php echo esc_attr__('Blog pagination', 'linkpva-core'); ?>"><?php foreach ($links as $link) { echo wp_kses($link, $this->get_pagination_allowed_html()); } ?></nav><?php
	}

	private function get_pagination_allowed_html()
	{
		$allowed = wp_kses_allowed_html('post');
		$allowed['svg'] = array('class' => true, 'viewbox' => true, 'viewBox' => true, 'xmlns' => true, 'width' => true, 'height' => true, 'fill' => true, 'aria-hidden' => true, 'aria-label' => true, 'role' => true, 'focusable' => true);
		$allowed['path'] = array('d' => true, 'fill' => true, 'fill-rule' => true, 'clip-rule' => true);
		return $allowed;
	}

	private function get_icon_html($icon, $label)
	{
		if (!is_array($icon) || empty($icon['value'])) { return esc_html($label); }
		ob_start(); Icons_Manager::render_icon($icon, array('role' => 'img', 'aria-label' => $label)); return (string) ob_get_clean();
	}
}

Plugin::instance()->widgets_manager->register(new linkpva_Blog_Widget());
