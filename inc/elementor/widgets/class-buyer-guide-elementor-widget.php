<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}

class linkpva_Buyer_Guide_Widget extends Widget_Base
{
	public function get_name()
	{
		return 'linkpva_buyer_guide';
	}

	public function get_title()
	{
		return esc_html__('LinkPVA Buyer Guide', 'linkpva-core');
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
		$this->register_intro_controls();
		$this->register_article_controls();
		$this->register_section_style_controls();
		$this->register_layout_style_controls();
		$this->register_intro_style_controls();
		$this->register_heading_style_controls();
		$this->register_link_style_controls();
		$this->register_article_style_controls();
	}

	private function register_intro_controls()
	{
		$this->start_controls_section('linkpva_buyer_guide_intro_content', array('label' => esc_html__('Guide Introduction', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_buyer_guide_show_tag', array('label' => esc_html__('Show Tag', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_buyer_guide_tag', array('label' => esc_html__('Tag', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Buyer Guide', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_buyer_guide_show_tag' => 'yes')));
		$this->add_control('linkpva_buyer_guide_title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('What to Consider When Choosing a LinkedIn Account', 'linkpva-core'), 'label_block' => true));
		$this->add_control('linkpva_buyer_guide_show_description', array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
		$this->add_control('linkpva_buyer_guide_description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Clear product information makes it easier to compare available listings and understand what each option includes.', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_buyer_guide_show_description' => 'yes')));
		$this->add_control('linkpva_buyer_guide_show_link', array('label' => esc_html__('Show Resource Link', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes', 'separator' => 'before'));
		$this->add_control('linkpva_buyer_guide_link_text', array('label' => esc_html__('Link Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Explore buyer resources', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_buyer_guide_show_link' => 'yes')));
		$this->add_control('linkpva_buyer_guide_link', array('label' => esc_html__('Link', 'linkpva-core'), 'type' => Controls_Manager::URL, 'default' => array('url' => home_url('/blog/')), 'show_external' => true, 'condition' => array('linkpva_buyer_guide_show_link' => 'yes')));
		$this->add_control('linkpva_buyer_guide_link_icon', array('label' => esc_html__('Link Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'), 'condition' => array('linkpva_buyer_guide_show_link' => 'yes')));
		$this->end_controls_section();
	}

	private function register_article_controls()
	{
		$this->start_controls_section('linkpva_buyer_guide_article_content', array('label' => esc_html__('Article Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
		$this->add_control('linkpva_buyer_guide_article', array('label' => esc_html__('Content', 'linkpva-core'), 'type' => Controls_Manager::WYSIWYG, 'default' => $this->get_default_article(), 'label_block' => true));
		$this->end_controls_section();
	}

	private function register_section_style_controls()
	{
		$this->start_controls_section('linkpva_buyer_guide_style_section', array('label' => esc_html__('Section', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_buyer_guide_style_section_background', 'selector' => '{{WRAPPER}} .linkpva-seo-content'));
		$this->add_responsive_control('linkpva_buyer_guide_style_section_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-seo-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_layout_style_controls()
	{
		$this->start_controls_section('linkpva_buyer_guide_style_layout', array('label' => esc_html__('Layout', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_responsive_control('linkpva_buyer_guide_style_column_gap', array('label' => esc_html__('Column Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 150)), 'selectors' => array('{{WRAPPER}} .linkpva-seo-content > .container > .row' => '--bs-gutter-x: calc({{SIZE}}{{UNIT}} * 2);')));
		$this->add_responsive_control('linkpva_buyer_guide_style_row_gap', array('label' => esc_html__('Row Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 150)), 'selectors' => array('{{WRAPPER}} .linkpva-seo-content > .container > .row' => '--bs-gutter-y: calc({{SIZE}}{{UNIT}} * 2);')));
		$this->end_controls_section();
	}

	private function register_intro_style_controls()
	{
		$this->start_controls_section('linkpva_buyer_guide_style_intro', array('label' => esc_html__('Introduction Card', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_buyer_guide_style_intro_background', 'selector' => '{{WRAPPER}} .linkpva-seo-intro'));
		$this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_buyer_guide_style_intro_border', 'selector' => '{{WRAPPER}} .linkpva-seo-intro'));
		$this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_buyer_guide_style_intro_shadow', 'selector' => '{{WRAPPER}} .linkpva-seo-intro'));
		$this->add_responsive_control('linkpva_buyer_guide_style_intro_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-seo-intro' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_buyer_guide_style_intro_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-seo-intro' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_buyer_guide_style_intro_sticky_offset', array('label' => esc_html__('Sticky Top Offset', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 300)), 'selectors' => array('{{WRAPPER}} .linkpva-seo-intro' => 'top: {{SIZE}}{{UNIT}};')));
		$this->end_controls_section();
	}

	private function register_heading_style_controls()
	{
		$this->start_controls_section('linkpva_buyer_guide_style_heading', array('label' => esc_html__('Introduction Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_control('linkpva_buyer_guide_style_tag_color', array('label' => esc_html__('Tag Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-seo-intro .linkpva-section-tag' => 'color: {{VALUE}};'), 'condition' => array('linkpva_buyer_guide_show_tag' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_buyer_guide_style_tag_typography', 'selector' => '{{WRAPPER}} .linkpva-seo-intro .linkpva-section-tag', 'condition' => array('linkpva_buyer_guide_show_tag' => 'yes')));
		$this->add_responsive_control('linkpva_buyer_guide_style_tag_spacing', array('label' => esc_html__('Tag Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-seo-intro .linkpva-section-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_buyer_guide_show_tag' => 'yes')));
		$this->add_control('linkpva_buyer_guide_style_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-seo-intro h2' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_buyer_guide_style_title_typography', 'selector' => '{{WRAPPER}} .linkpva-seo-intro h2'));
		$this->add_responsive_control('linkpva_buyer_guide_style_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-seo-intro h2' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_buyer_guide_style_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-seo-intro > p' => 'color: {{VALUE}};'), 'condition' => array('linkpva_buyer_guide_show_description' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_buyer_guide_style_description_typography', 'selector' => '{{WRAPPER}} .linkpva-seo-intro > p', 'condition' => array('linkpva_buyer_guide_show_description' => 'yes')));
		$this->add_responsive_control('linkpva_buyer_guide_style_description_spacing', array('label' => esc_html__('Description Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-seo-intro > p' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_buyer_guide_show_description' => 'yes')));
		$this->end_controls_section();
	}

	private function register_link_style_controls()
	{
		$this->start_controls_section('linkpva_buyer_guide_style_link', array('label' => esc_html__('Resource Link', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE, 'condition' => array('linkpva_buyer_guide_show_link' => 'yes')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_buyer_guide_style_link_typography', 'selector' => '{{WRAPPER}} .linkpva-seo-intro .linkpva-text-link'));
		$this->add_responsive_control('linkpva_buyer_guide_style_link_gap', array('label' => esc_html__('Icon Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 30)), 'selectors' => array('{{WRAPPER}} .linkpva-seo-intro .linkpva-text-link' => 'gap: {{SIZE}}{{UNIT}};')));
		$this->add_responsive_control('linkpva_buyer_guide_style_link_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 6, 'max' => 48)), 'selectors' => array('{{WRAPPER}} .linkpva-text-link i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-text-link svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
		$this->start_controls_tabs('linkpva_buyer_guide_style_link_tabs');
		$this->start_controls_tab('linkpva_buyer_guide_style_link_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
		$this->add_control('linkpva_buyer_guide_style_link_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-text-link' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-text-link svg path' => 'fill: {{VALUE}};')));
		$this->end_controls_tab();
		$this->start_controls_tab('linkpva_buyer_guide_style_link_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
		$this->add_control('linkpva_buyer_guide_style_link_hover_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-text-link:hover, {{WRAPPER}} .linkpva-text-link:focus-visible' => 'color: {{VALUE}};', '{{WRAPPER}} .linkpva-text-link:hover svg path, {{WRAPPER}} .linkpva-text-link:focus-visible svg path' => 'fill: {{VALUE}};')));
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	private function register_article_style_controls()
	{
		$this->start_controls_section('linkpva_buyer_guide_style_article', array('label' => esc_html__('Article Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
		$this->add_responsive_control('linkpva_buyer_guide_style_article_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-article-copy' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
		$this->add_control('linkpva_buyer_guide_style_article_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-article-copy p' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_buyer_guide_style_article_typography', 'selector' => '{{WRAPPER}} .linkpva-article-copy p'));
		$this->add_responsive_control('linkpva_buyer_guide_style_article_paragraph_spacing', array('label' => esc_html__('Paragraph Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'size_units' => array('px', 'rem'), 'range' => array('px' => array('min' => 0, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-article-copy p' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
		$this->add_control('linkpva_buyer_guide_style_article_emphasis_color', array('label' => esc_html__('Emphasis Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-article-copy strong' => 'color: {{VALUE}};')));
		$this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_buyer_guide_style_article_emphasis_typography', 'selector' => '{{WRAPPER}} .linkpva-article-copy strong'));
		$this->end_controls_section();
	}

	private function get_default_article()
	{
		return '<p>' . esc_html__('When looking to', 'linkpva-core') . ' <strong>' . esc_html__('buy LinkedIn accounts', 'linkpva-core') . '</strong>, ' . esc_html__('start by identifying the specifications that are relevant to your intended, lawful use. Account age, verification information, profile completeness, region, connection or follower range, and delivery conditions can differ between listings. A useful marketplace should present these details clearly so that you can compare options without relying on vague labels.', 'linkpva-core') . '</p>'
			. '<p>' . esc_html__('LinkPVA organizes', 'linkpva-core') . ' <strong>' . esc_html__('LinkedIn accounts for sale', 'linkpva-core') . '</strong> ' . esc_html__('into clear categories, including verified, PVA, follower-based, and', 'linkpva-core') . ' <strong>' . esc_html__('aged LinkedIn accounts', 'linkpva-core') . '</strong>. ' . esc_html__('Each category serves a different requirement, so the name of a product alone should not determine your choice. Review the complete listing, available variations, included information, expected delivery method, and any buyer requirements before adding a product to your cart.', 'linkpva-core') . '</p>'
			. '<p>' . esc_html__('Terms such as “verified” or “premium LinkedIn accounts” should always be supported by specific product information. They do not imply endorsement by LinkedIn or guarantee any particular performance. Check what the seller means by each label, and review the delivery, refund, and replacement policies before completing an order. If any specification is unclear, contact purchase support first.', 'linkpva-core') . '</p>'
			. '<p>' . esc_html__('A straightforward ordering process should let you confirm the chosen variation, provide only the information required to process the order, and understand what happens after checkout. Delivery timing may vary by product and order review requirements. Customers are responsible for ensuring that their purchase and intended use comply with applicable law and relevant platform rules. LinkPVA is an independent marketplace and is not affiliated with or endorsed by LinkedIn.', 'linkpva-core') . '</p>';
	}

	private function render_icon($icon)
	{
		if (is_array($icon) && !empty($icon['value'])) {
			Icons_Manager::render_icon($icon, array('aria-hidden' => 'true'));
		}
	}

	protected function render()
	{
		$settings         = $this->get_settings_for_display();
		$widget_id        = sanitize_html_class($this->get_id());
		$heading_id       = 'linkpva-buyer-guide-heading-' . $widget_id;
		$show_tag         = 'yes' === ($settings['linkpva_buyer_guide_show_tag'] ?? '') && !empty($settings['linkpva_buyer_guide_tag']);
		$show_description = 'yes' === ($settings['linkpva_buyer_guide_show_description'] ?? '') && !empty($settings['linkpva_buyer_guide_description']);
		$show_link        = 'yes' === ($settings['linkpva_buyer_guide_show_link'] ?? '') && !empty($settings['linkpva_buyer_guide_link_text']) && !empty($settings['linkpva_buyer_guide_link']['url']);
		$has_title        = !empty($settings['linkpva_buyer_guide_title']);
		$has_intro        = $has_title || $show_tag || $show_description || $show_link;
		$article          = isset($settings['linkpva_buyer_guide_article']) ? trim($settings['linkpva_buyer_guide_article']) : '';

		if (!$has_intro && '' === $article) {
			return;
		}

		if ($show_link) {
			$this->add_link_attributes('linkpva_buyer_guide_link', $settings['linkpva_buyer_guide_link']);
			$this->add_render_attribute('linkpva_buyer_guide_link', 'class', 'linkpva-text-link');
		}
		?>
		<section class="linkpva-section linkpva-seo-content" data-linkpva-buyer-guide-widget="<?php echo esc_attr($widget_id); ?>"<?php if ($has_title) : ?> aria-labelledby="<?php echo esc_attr($heading_id); ?>"<?php endif; ?>>
			<div class="container">
				<div class="row g-5">
					<?php if ($has_intro) : ?>
						<div class="<?php echo '' === $article ? 'col-12' : 'col-lg-5'; ?>">
							<div class="linkpva-seo-intro">
								<?php if ($show_tag) : ?><span class="linkpva-section-tag"><?php echo esc_html($settings['linkpva_buyer_guide_tag']); ?></span><?php endif; ?>
								<?php if ($has_title) : ?><h2 id="<?php echo esc_attr($heading_id); ?>"><?php echo esc_html($settings['linkpva_buyer_guide_title']); ?></h2><?php endif; ?>
								<?php if ($show_description) : ?><p><?php echo esc_html($settings['linkpva_buyer_guide_description']); ?></p><?php endif; ?>
								<?php if ($show_link) : ?><a <?php $this->print_render_attribute_string('linkpva_buyer_guide_link'); ?>><?php echo esc_html($settings['linkpva_buyer_guide_link_text']); ?> <?php $this->render_icon($settings['linkpva_buyer_guide_link_icon'] ?? array()); ?></a><?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
					<?php if ('' !== $article) : ?>
						<div class="<?php echo $has_intro ? 'col-lg-7' : 'col-12'; ?>">
							<div class="linkpva-article-copy"><?php echo wp_kses_post($article); ?></div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<?php
	}
}

Plugin::instance()->widgets_manager->register(new linkpva_Buyer_Guide_Widget());
