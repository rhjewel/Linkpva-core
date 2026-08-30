<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit;
}

class linkpva_Policy_Layout_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'linkpva_policy_layout';
    }

    public function get_title()
    {
        return esc_html__('LinkPVA Policy Layout', 'linkpva-core');
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
        $this->register_layout_style_controls();
        $this->register_navigation_style_controls();
        $this->register_heading_style_controls();
        $this->register_subheading_style_controls();
        $this->register_content_style_controls();
        $this->register_link_style_controls();
    }

    private function register_content_controls()
    {
        $this->start_controls_section(
            'linkpva_policy_layout_content',
            array(
                'label' => esc_html__('Policy Content', 'linkpva-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'linkpva_policy_layout_show_navigation',
            array(
                'label'        => esc_html__('Show Navigation', 'linkpva-core'),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );
        $this->add_control(
            'linkpva_policy_layout_navigation_label',
            array(
                'label'       => esc_html__('Navigation Label', 'linkpva-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Policy sections', 'linkpva-core'),
                'label_block' => true,
                'condition'   => array('linkpva_policy_layout_show_navigation' => 'yes'),
            )
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'navigation_label',
            array(
                'label'       => esc_html__('Navigation Label', 'linkpva-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Overview', 'linkpva-core'),
                'label_block' => true,
            )
        );
        $repeater->add_control(
            'heading',
            array(
                'label'       => esc_html__('Section Heading', 'linkpva-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('1. Overview', 'linkpva-core'),
                'label_block' => true,
            )
        );
        $repeater->add_control(
            'content',
            array(
                'label'   => esc_html__('Section Content', 'linkpva-core'),
                'type'    => Controls_Manager::WYSIWYG,
                'default' => esc_html__('Add the policy details for this section.', 'linkpva-core'),
            )
        );
        $this->add_control(
            'linkpva_policy_layout_sections',
            array(
                'label'       => esc_html__('Policy Sections', 'linkpva-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ heading }}}',
                'default'     => $this->get_default_sections(),
            )
        );

        $this->end_controls_section();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section(
            'linkpva_policy_layout_style_section',
            array(
                'label' => esc_html__('Section', 'linkpva-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'linkpva_policy_layout_style_section_background',
                'selector' => '{{WRAPPER}} .linkpva-policy-layout-widget',
            )
        );
        $this->add_responsive_control(
            'linkpva_policy_layout_style_section_padding',
            array(
                'label'      => esc_html__('Padding', 'linkpva-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%', 'rem'),
                'selectors'  => array('{{WRAPPER}} .linkpva-policy-layout-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'),
            )
        );
        $this->end_controls_section();
    }

    private function register_layout_style_controls()
    {
        $this->start_controls_section(
            'linkpva_policy_layout_style_layout',
            array(
                'label' => esc_html__('Layout', 'linkpva-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_responsive_control(
            'linkpva_policy_layout_style_content_width',
            array(
                'label'      => esc_html__('Content Width', 'linkpva-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', '%'),
                'range'      => array(
                    'px' => array('min' => 320, 'max' => 1200),
                    '%'  => array('min' => 40, 'max' => 100),
                ),
                'selectors'  => array('{{WRAPPER}} .linkpva-policy-content' => 'width: 100%; max-width: {{SIZE}}{{UNIT}};'),
            )
        );
        $this->add_responsive_control(
            'linkpva_policy_layout_style_columns_gap',
            array(
                'label'     => esc_html__('Columns Gap', 'linkpva-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => array('px' => array('min' => 0, 'max' => 150)),
                'selectors' => array('{{WRAPPER}} .linkpva-policy-layout' => 'gap: {{SIZE}}{{UNIT}};'),
                'condition' => array('linkpva_policy_layout_show_navigation' => 'yes'),
            )
        );
        $this->end_controls_section();
    }

    private function register_navigation_style_controls()
    {
        $this->start_controls_section(
            'linkpva_policy_layout_style_navigation',
            array(
                'label'     => esc_html__('Navigation', 'linkpva-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => array('linkpva_policy_layout_show_navigation' => 'yes'),
            )
        );
        $this->add_responsive_control(
            'linkpva_policy_layout_style_navigation_sticky_offset',
            array(
                'label'     => esc_html__('Sticky Offset', 'linkpva-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => array('px' => array('min' => 0, 'max' => 300)),
                'selectors' => array('{{WRAPPER}} .linkpva-policy-nav' => 'top: {{SIZE}}{{UNIT}};'),
            )
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'linkpva_policy_layout_style_navigation_typography',
                'selector' => '{{WRAPPER}} .linkpva-policy-nav a',
            )
        );
        $this->add_responsive_control(
            'linkpva_policy_layout_style_navigation_item_padding',
            array(
                'label'     => esc_html__('Item Padding', 'linkpva-core'),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => array('{{WRAPPER}} .linkpva-policy-nav a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'),
            )
        );
        $this->add_responsive_control(
            'linkpva_policy_layout_style_navigation_border_width',
            array(
                'label'     => esc_html__('Left Border Width', 'linkpva-core'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => array('px' => array('min' => 0, 'max' => 10)),
                'selectors' => array('{{WRAPPER}} .linkpva-policy-nav a' => 'border-left-width: {{SIZE}}{{UNIT}};'),
            )
        );
        $this->start_controls_tabs('linkpva_policy_layout_style_navigation_states');
        $this->start_controls_tab('linkpva_policy_layout_style_navigation_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
        $this->add_control(
            'linkpva_policy_layout_style_navigation_color',
            array(
                'label'     => esc_html__('Text Color', 'linkpva-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array('{{WRAPPER}} .linkpva-policy-nav a' => 'color: {{VALUE}};'),
            )
        );
        $this->add_control(
            'linkpva_policy_layout_style_navigation_border_color',
            array(
                'label'     => esc_html__('Border Color', 'linkpva-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array('{{WRAPPER}} .linkpva-policy-nav a' => 'border-color: {{VALUE}};'),
            )
        );
        $this->end_controls_tab();
        $this->start_controls_tab('linkpva_policy_layout_style_navigation_active', array('label' => esc_html__('Hover & Active', 'linkpva-core')));
        $this->add_control(
            'linkpva_policy_layout_style_navigation_active_color',
            array(
                'label'     => esc_html__('Text Color', 'linkpva-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array('{{WRAPPER}} .linkpva-policy-nav a:hover, {{WRAPPER}} .linkpva-policy-nav a:focus-visible, {{WRAPPER}} .linkpva-policy-nav a.is-active' => 'color: {{VALUE}};'),
            )
        );
        $this->add_control(
            'linkpva_policy_layout_style_navigation_active_border_color',
            array(
                'label'     => esc_html__('Border Color', 'linkpva-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array('{{WRAPPER}} .linkpva-policy-nav a:hover, {{WRAPPER}} .linkpva-policy-nav a:focus-visible, {{WRAPPER}} .linkpva-policy-nav a.is-active' => 'border-color: {{VALUE}};'),
            )
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    private function register_heading_style_controls()
    {
        $this->start_controls_section('linkpva_policy_layout_style_heading', array('label' => esc_html__('Section Headings', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_control('linkpva_policy_layout_style_heading_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-policy-content > h2' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_policy_layout_style_heading_typography', 'selector' => '{{WRAPPER}} .linkpva-policy-content > h2'));
        $this->add_responsive_control('linkpva_policy_layout_style_heading_spacing', array('label' => esc_html__('Spacing', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-policy-content > h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_subheading_style_controls()
    {
        $this->start_controls_section('linkpva_policy_layout_style_subheading', array('label' => esc_html__('Content Subheadings', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_control('linkpva_policy_layout_style_subheading_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-policy-content h3' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_policy_layout_style_subheading_typography', 'selector' => '{{WRAPPER}} .linkpva-policy-content h3'));
        $this->add_responsive_control('linkpva_policy_layout_style_subheading_spacing', array('label' => esc_html__('Spacing', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'selectors' => array('{{WRAPPER}} .linkpva-policy-content h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_content_style_controls()
    {
        $this->start_controls_section('linkpva_policy_layout_style_content', array('label' => esc_html__('Text & Lists', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_control('linkpva_policy_layout_style_content_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-policy-content p, {{WRAPPER}} .linkpva-policy-content li' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_policy_layout_style_content_typography', 'selector' => '{{WRAPPER}} .linkpva-policy-content p, {{WRAPPER}} .linkpva-policy-content li'));
        $this->add_responsive_control('linkpva_policy_layout_style_paragraph_spacing', array('label' => esc_html__('Paragraph Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-policy-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_policy_layout_style_list_indent', array('label' => esc_html__('List Indent', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 80)), 'selectors' => array('{{WRAPPER}} .linkpva-policy-content ul, {{WRAPPER}} .linkpva-policy-content ol' => 'padding-left: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_policy_layout_style_list_marker_color', array('label' => esc_html__('List Marker Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-policy-content li::marker' => 'color: {{VALUE}};')));
        $this->end_controls_section();
    }

    private function register_link_style_controls()
    {
        $this->start_controls_section('linkpva_policy_layout_style_links', array('label' => esc_html__('Content Links', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_policy_layout_style_link_typography', 'selector' => '{{WRAPPER}} .linkpva-policy-content a'));
        $this->start_controls_tabs('linkpva_policy_layout_style_link_states');
        $this->start_controls_tab('linkpva_policy_layout_style_link_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
        $this->add_control('linkpva_policy_layout_style_link_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-policy-content a' => 'color: {{VALUE}};')));
        $this->end_controls_tab();
        $this->start_controls_tab('linkpva_policy_layout_style_link_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
        $this->add_control('linkpva_policy_layout_style_link_hover_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-policy-content a:hover, {{WRAPPER}} .linkpva-policy-content a:focus-visible' => 'color: {{VALUE}};')));
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    private function get_default_sections()
    {
        return array(
            array(
                'navigation_label' => esc_html__('Overview', 'linkpva-core'),
                'heading'          => esc_html__('1. Overview', 'linkpva-core'),
                'content'          => '<p>' . esc_html__('LinkPVA products are intended for digital delivery after payment and order confirmation. The exact method, included information, estimated timeframe, and any customer requirements must be stated on the relevant product page.', 'linkpva-core') . '</p>',
            ),
            array(
                'navigation_label' => esc_html__('Delivery timing', 'linkpva-core'),
                'heading'          => esc_html__('2. Delivery timing', 'linkpva-core'),
                'content'          => '<p>' . esc_html__('Delivery estimates begin after an order is successfully confirmed and any required review is complete. An estimate is not a guarantee unless the product page expressly states otherwise.', 'linkpva-core') . '</p><ul><li>' . esc_html__('Standard delivery timeframe: to be confirmed', 'linkpva-core') . '</li><li>' . esc_html__('Manual review requirements: to be confirmed', 'linkpva-core') . '</li><li>' . esc_html__('Support escalation timeframe: to be confirmed', 'linkpva-core') . '</li></ul>',
            ),
            array(
                'navigation_label' => esc_html__('Delivery method', 'linkpva-core'),
                'heading'          => esc_html__('3. Delivery method', 'linkpva-core'),
                'content'          => '<p>' . esc_html__('Sensitive order information should be provided only through the approved protected customer workflow. Credentials must not appear in public URLs, analytics events, page source, or email subject lines.', 'linkpva-core') . '</p>',
            ),
            array(
                'navigation_label' => esc_html__('Customer responsibilities', 'linkpva-core'),
                'heading'          => esc_html__('4. Customer responsibilities', 'linkpva-core'),
                'content'          => '<p>' . esc_html__('Customers must provide accurate order contact information, review the product requirements, and ensure their purchase and intended use comply with applicable law and platform rules.', 'linkpva-core') . '</p>',
            ),
            array(
                'navigation_label' => esc_html__('Delivery issues', 'linkpva-core'),
                'heading'          => esc_html__('5. Delivery issues', 'linkpva-core'),
                'content'          => '<p>' . esc_html__('If an order appears delayed or incomplete, contact support using the confirmed order number. Never send passwords or unnecessary sensitive information through an unsecured support form.', 'linkpva-core') . '</p><h3>' . esc_html__('Policy contact', 'linkpva-core') . '</h3><p>' . sprintf(esc_html__('Questions about delivery can be submitted through the %s.', 'linkpva-core'), '<a href="' . esc_url(home_url('/contact/')) . '">' . esc_html__('support form', 'linkpva-core') . '</a>') . '</p>',
            ),
        );
    }

    private function normalize_policy_sections($sections)
    {
        if (!is_array($sections)) {
            return array();
        }

        $normalized = array();
        foreach ($sections as $section) {
            $navigation_label = isset($section['navigation_label']) ? trim(wp_strip_all_tags($section['navigation_label'])) : '';
            $heading = isset($section['heading']) ? trim(wp_strip_all_tags($section['heading'])) : '';
            $content = isset($section['content']) ? trim($section['content']) : '';

            if ('' === $heading && '' === $content) {
                continue;
            }

            $normalized[] = array(
                'navigation_label' => '' !== $navigation_label ? $navigation_label : ('' !== $heading ? $heading : esc_html__('Policy section', 'linkpva-core')),
                'heading'          => $heading,
                'content'          => $content,
            );
        }

        return $normalized;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $sections = $this->normalize_policy_sections($settings['linkpva_policy_layout_sections'] ?? array());
        $show_navigation = 'yes' === ($settings['linkpva_policy_layout_show_navigation'] ?? '');
        $widget_id = sanitize_html_class($this->get_id());
        $navigation_label = !empty($settings['linkpva_policy_layout_navigation_label']) ? $settings['linkpva_policy_layout_navigation_label'] : esc_html__('Policy sections', 'linkpva-core');

        if (empty($sections)) {
            return;
        }
?>
        <section class="linkpva-inner-section linkpva-policy-layout-widget" data-linkpva-policy-layout-widget="<?php echo esc_attr($widget_id); ?>">
            <div class="container">
                <div class="linkpva-policy-layout<?php echo $show_navigation ? '' : ' linkpva-policy-layout-no-nav'; ?>">
                    <?php if ($show_navigation) : ?>
                        <nav class="linkpva-policy-nav" aria-label="<?php echo esc_attr($navigation_label); ?>">
                            <?php foreach ($sections as $index => $section) : ?>
                                <?php $section_id = 'linkpva-policy-' . $widget_id . '-' . ($index + 1); ?>
                                <a class="<?php echo 0 === $index ? 'is-active' : ''; ?>" href="#<?php echo esc_attr($section_id); ?>"><?php echo esc_html($section['navigation_label']); ?></a>
                            <?php endforeach; ?>
                        </nav>
                    <?php endif; ?>
                    <article class="linkpva-policy-content">
                        <?php foreach ($sections as $index => $section) : ?>
                            <?php $section_id = 'linkpva-policy-' . $widget_id . '-' . ($index + 1); ?>
                            <?php if ('' !== $section['heading']) : ?>
                                <h2 id="<?php echo esc_attr($section_id); ?>"><?php echo esc_html($section['heading']); ?></h2>
                            <?php else : ?>
                                <span id="<?php echo esc_attr($section_id); ?>" class="linkpva-policy-anchor" aria-hidden="true"></span>
                            <?php endif; ?>
                            <?php if ('' !== $section['content']) : ?>
                                <?php echo wp_kses_post($section['content']); ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </article>
                </div>
            </div>
        </section>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new linkpva_Policy_Layout_Widget());
