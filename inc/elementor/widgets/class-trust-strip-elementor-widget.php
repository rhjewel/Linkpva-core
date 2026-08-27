<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit;
}

class linkpva_Trust_Strip_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'linkpva_trust_strip';
    }

    public function get_title()
    {
        return esc_html__('LinkPVA Trust Strip', 'linkpva-core');
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
        $this->register_grid_style_controls();
        $this->register_item_style_controls();
        $this->register_icon_style_controls();
        $this->register_title_style_controls();
        $this->register_description_style_controls();
    }

    private function register_content_controls()
    {
        $this->start_controls_section(
            'linkpva_trust_strip_content',
            array(
                'label' => esc_html__('Trust Items', 'linkpva-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'linkpva_trust_strip_show_icons',
            array(
                'label'        => esc_html__('Show Icons', 'linkpva-core'),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'linkpva_trust_strip_show_descriptions',
            array(
                'label'        => esc_html__('Show Descriptions', 'linkpva-core'),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
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
            'title',
            array(
                'label'       => esc_html__('Title', 'linkpva-core'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            )
        );
        $repeater->add_control(
            'description',
            array(
                'label'       => esc_html__('Description', 'linkpva-core'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            )
        );

        $this->add_control(
            'linkpva_trust_strip_items',
            array(
                'label'       => esc_html__('Items', 'linkpva-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
                'default'     => $this->get_default_items(),
            )
        );

        $this->end_controls_section();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section(
            'linkpva_trust_strip_style_section',
            array(
                'label' => esc_html__('Section', 'linkpva-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_responsive_control(
            'linkpva_trust_strip_style_margin_top',
            array(
                'label'      => esc_html__('Top Offset', 'linkpva-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'range'      => array(
                    'px'  => array('min' => -200, 'max' => 200),
                    'rem' => array('min' => -12, 'max' => 12, 'step' => 0.1),
                ),
                'selectors'  => array('{{WRAPPER}} .linkpva-trust-strip' => 'margin-top: {{SIZE}}{{UNIT}};'),
            )
        );

        $this->add_responsive_control(
            'linkpva_trust_strip_style_padding',
            array(
                'label'      => esc_html__('Padding', 'linkpva-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%', 'rem'),
                'selectors'  => array('{{WRAPPER}} .linkpva-trust-strip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'),
            )
        );

        $this->end_controls_section();
    }

    private function register_grid_style_controls()
    {
        $this->start_controls_section(
            'linkpva_trust_strip_style_grid',
            array(
                'label' => esc_html__('Grid', 'linkpva-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_responsive_control(
            'linkpva_trust_strip_style_columns',
            array(
                'label'   => esc_html__('Columns', 'linkpva-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '4',
                'options' => array(
                    '1' => esc_html__('One', 'linkpva-core'),
                    '2' => esc_html__('Two', 'linkpva-core'),
                    '3' => esc_html__('Three', 'linkpva-core'),
                    '4' => esc_html__('Four', 'linkpva-core'),
                    '5' => esc_html__('Five', 'linkpva-core'),
                    '6' => esc_html__('Six', 'linkpva-core'),
                ),
                'selectors' => array('{{WRAPPER}} .linkpva-trust-grid' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));'),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array('name' => 'linkpva_trust_strip_style_grid_background', 'selector' => '{{WRAPPER}} .linkpva-trust-grid')
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array('name' => 'linkpva_trust_strip_style_grid_border', 'selector' => '{{WRAPPER}} .linkpva-trust-grid')
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array('name' => 'linkpva_trust_strip_style_grid_shadow', 'selector' => '{{WRAPPER}} .linkpva-trust-grid')
        );

        $this->add_responsive_control(
            'linkpva_trust_strip_style_grid_radius',
            array(
                'label'      => esc_html__('Border Radius', 'linkpva-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors'  => array('{{WRAPPER}} .linkpva-trust-grid' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'),
            )
        );

        $this->add_responsive_control(
            'linkpva_trust_strip_style_grid_gap',
            array(
                'label'      => esc_html__('Grid Gap', 'linkpva-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'range'      => array('px' => array('min' => 0, 'max' => 60)),
                'selectors'  => array('{{WRAPPER}} .linkpva-trust-grid' => 'gap: {{SIZE}}{{UNIT}};'),
            )
        );

        $this->end_controls_section();
    }

    private function register_item_style_controls()
    {
        $this->start_controls_section(
            'linkpva_trust_strip_style_item',
            array(
                'label' => esc_html__('Items', 'linkpva-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_responsive_control(
            'linkpva_trust_strip_style_item_height',
            array(
                'label'      => esc_html__('Minimum Height', 'linkpva-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'range'      => array('px' => array('min' => 40, 'max' => 260)),
                'selectors'  => array('{{WRAPPER}} .linkpva-trust-item' => 'min-height: {{SIZE}}{{UNIT}};'),
            )
        );

        $this->add_responsive_control(
            'linkpva_trust_strip_style_item_padding',
            array(
                'label'      => esc_html__('Padding', 'linkpva-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%', 'rem'),
                'selectors'  => array('{{WRAPPER}} .linkpva-trust-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'),
            )
        );

        $this->add_responsive_control(
            'linkpva_trust_strip_style_item_gap',
            array(
                'label'      => esc_html__('Content Gap', 'linkpva-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'range'      => array('px' => array('min' => 0, 'max' => 60)),
                'selectors'  => array('{{WRAPPER}} .linkpva-trust-item' => 'gap: {{SIZE}}{{UNIT}};'),
            )
        );

        $this->add_responsive_control(
            'linkpva_trust_strip_style_item_alignment',
            array(
                'label'   => esc_html__('Vertical Alignment', 'linkpva-core'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => array(
                    'flex-start' => array('title' => esc_html__('Top', 'linkpva-core'), 'icon' => 'eicon-v-align-top'),
                    'center'     => array('title' => esc_html__('Center', 'linkpva-core'), 'icon' => 'eicon-v-align-middle'),
                    'flex-end'   => array('title' => esc_html__('Bottom', 'linkpva-core'), 'icon' => 'eicon-v-align-bottom'),
                ),
                'selectors' => array('{{WRAPPER}} .linkpva-trust-item' => 'align-items: {{VALUE}};'),
            )
        );

        $this->add_control(
            'linkpva_trust_strip_style_item_background',
            array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-trust-item' => 'background-color: {{VALUE}};'))
        );

        $this->add_control(
            'linkpva_trust_strip_style_item_divider_color',
            array('label' => esc_html__('Divider Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-trust-item' => 'border-color: {{VALUE}};'))
        );

        $this->end_controls_section();
    }

    private function register_icon_style_controls()
    {
        $this->start_controls_section(
            'linkpva_trust_strip_style_icon',
            array(
                'label'     => esc_html__('Icons', 'linkpva-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => array('linkpva_trust_strip_show_icons' => 'yes'),
            )
        );

        $this->add_responsive_control(
            'linkpva_trust_strip_style_icon_box_size',
            array(
                'label'      => esc_html__('Box Size', 'linkpva-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range'      => array('px' => array('min' => 20, 'max' => 100)),
                'selectors'  => array('{{WRAPPER}} .linkpva-trust-item > i, {{WRAPPER}} .linkpva-trust-item > svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'),
            )
        );

        $this->add_responsive_control(
            'linkpva_trust_strip_style_icon_size',
            array(
                'label'      => esc_html__('Icon Size', 'linkpva-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'range'      => array('px' => array('min' => 6, 'max' => 50)),
                'selectors'  => array(
                    '{{WRAPPER}} .linkpva-trust-item > i'   => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .linkpva-trust-item > svg' => 'padding: calc((100% - {{SIZE}}{{UNIT}}) / 2);',
                ),
            )
        );

        $this->add_control(
            'linkpva_trust_strip_style_icon_color',
            array(
                'label'     => esc_html__('Icon Color', 'linkpva-core'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .linkpva-trust-item > i, {{WRAPPER}} .linkpva-trust-item > svg' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .linkpva-trust-item > svg path'                              => 'fill: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'linkpva_trust_strip_style_icon_background',
            array('label' => esc_html__('Background', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-trust-item > i, {{WRAPPER}} .linkpva-trust-item > svg' => 'background-color: {{VALUE}};'))
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array('name' => 'linkpva_trust_strip_style_icon_border', 'selector' => '{{WRAPPER}} .linkpva-trust-item > i, {{WRAPPER}} .linkpva-trust-item > svg')
        );

        $this->add_responsive_control(
            'linkpva_trust_strip_style_icon_radius',
            array(
                'label'      => esc_html__('Border Radius', 'linkpva-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%'),
                'selectors'  => array('{{WRAPPER}} .linkpva-trust-item > i, {{WRAPPER}} .linkpva-trust-item > svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'),
            )
        );

        $this->end_controls_section();
    }

    private function register_title_style_controls()
    {
        $this->start_controls_section(
            'linkpva_trust_strip_style_title',
            array('label' => esc_html__('Titles', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE)
        );

        $this->add_control(
            'linkpva_trust_strip_style_title_color',
            array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-trust-item strong' => 'color: {{VALUE}};'))
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array('name' => 'linkpva_trust_strip_style_title_typography', 'selector' => '{{WRAPPER}} .linkpva-trust-item strong')
        );

        $this->add_responsive_control(
            'linkpva_trust_strip_style_title_spacing',
            array(
                'label'      => esc_html__('Bottom Spacing', 'linkpva-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'range'      => array('px' => array('min' => 0, 'max' => 40)),
                'selectors'  => array('{{WRAPPER}} .linkpva-trust-item strong' => 'margin-bottom: {{SIZE}}{{UNIT}};'),
            )
        );

        $this->end_controls_section();
    }

    private function register_description_style_controls()
    {
        $this->start_controls_section(
            'linkpva_trust_strip_style_description',
            array(
                'label'     => esc_html__('Descriptions', 'linkpva-core'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => array('linkpva_trust_strip_show_descriptions' => 'yes'),
            )
        );

        $this->add_control(
            'linkpva_trust_strip_style_description_color',
            array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-trust-item small' => 'color: {{VALUE}};'))
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array('name' => 'linkpva_trust_strip_style_description_typography', 'selector' => '{{WRAPPER}} .linkpva-trust-item small')
        );

        $this->end_controls_section();
    }

    private function get_default_items()
    {
        return array(
            array('icon' => array('value' => 'bi bi-card-checklist', 'library' => 'bootstrap'), 'title' => esc_html__('Detailed Information', 'linkpva-core'), 'description' => esc_html__('Clear listing specifications', 'linkpva-core')),
            array('icon' => array('value' => 'bi bi-grid', 'library' => 'bootstrap'), 'title' => esc_html__('Multiple Options', 'linkpva-core'), 'description' => esc_html__('Compare account types', 'linkpva-core')),
            array('icon' => array('value' => 'bi bi-box-seam', 'library' => 'bootstrap'), 'title' => esc_html__('Clear Delivery', 'linkpva-core'), 'description' => esc_html__('Know the order process', 'linkpva-core')),
            array('icon' => array('value' => 'bi bi-chat-dots', 'library' => 'bootstrap'), 'title' => esc_html__('Purchase Support', 'linkpva-core'), 'description' => esc_html__('Help when you need it', 'linkpva-core')),
        );
    }

    private function render_icon($icon)
    {
        if (!empty($icon['value'])) {
            Icons_Manager::render_icon($icon, array('aria-hidden' => 'true'));
        }
    }

    protected function render()
    {
        $settings          = $this->get_settings_for_display();
        $widget_id         = sanitize_html_class($this->get_id());
        $items             = is_array($settings['linkpva_trust_strip_items']) ? $settings['linkpva_trust_strip_items'] : array();
        $show_icons        = 'yes' === $settings['linkpva_trust_strip_show_icons'];
        $show_descriptions = 'yes' === $settings['linkpva_trust_strip_show_descriptions'];
        $items             = array_values(
            array_filter(
                $items,
                function ($item) use ($show_descriptions) {
                    return !empty($item['title']) || ($show_descriptions && !empty($item['description']));
                }
            )
        );

        if (empty($items)) {
            return;
        }
?>
        <section class="linkpva-trust-strip" data-linkpva-trust-strip-widget="<?php echo esc_attr($widget_id); ?>">
            <div class="container">
                <div class="linkpva-trust-grid">
                    <?php foreach ($items as $item) : ?>
                        <?php
                        $title       = !empty($item['title']) ? $item['title'] : '';
                        $description = $show_descriptions && !empty($item['description']) ? $item['description'] : '';

                        if ('' === $title && '' === $description) {
                            continue;
                        }
                        ?>
                        <div class="linkpva-trust-item">
                            <?php if ($show_icons) : ?><?php $this->render_icon($item['icon'] ?? array()); ?><?php endif; ?>
                            <span>
                                <?php if ('' !== $title) : ?><strong><?php echo esc_html($title); ?></strong><?php endif; ?>
                                <?php if ('' !== $description) : ?><small><?php echo esc_html($description); ?></small><?php endif; ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new linkpva_Trust_Strip_Widget());
