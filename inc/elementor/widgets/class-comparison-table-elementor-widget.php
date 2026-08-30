<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit;
}

class linkpva_Comparison_Table_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'linkpva_comparison_table';
    }

    public function get_title()
    {
        return esc_html__('LinkPVA Comparison Table', 'linkpva-core');
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
        $this->register_table_controls();
        $this->register_rows_controls();
        $this->register_section_style_controls();
        $this->register_heading_style_controls();
        $this->register_table_style_controls();
        $this->register_header_style_controls();
        $this->register_content_style_controls();
        $this->register_price_style_controls();
        $this->register_action_style_controls();
        $this->register_mobile_style_controls();
    }

    private function register_heading_controls()
    {
        $this->start_controls_section('linkpva_comparison_heading_content', array('label' => esc_html__('Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
        $this->add_control('linkpva_comparison_show_tag', array('label' => esc_html__('Show Tag', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_comparison_tag', array('label' => esc_html__('Tag', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('Full Comparison', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_comparison_show_tag' => 'yes')));
        $this->add_control('linkpva_comparison_title', array('label' => esc_html__('Title', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Compare Available Listings', 'linkpva-core'), 'label_block' => true, 'rows' => 3));
        $this->add_control('linkpva_comparison_show_description', array('label' => esc_html__('Show Description', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $this->add_control('linkpva_comparison_description', array('label' => esc_html__('Description', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Review the starting price and primary specification for each sample listing.', 'linkpva-core'), 'label_block' => true, 'condition' => array('linkpva_comparison_show_description' => 'yes')));
        $this->end_controls_section();
    }

    private function register_table_controls()
    {
        $this->start_controls_section('linkpva_comparison_table_content', array('label' => esc_html__('Table Labels', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
        $labels = array(
            'listing' => esc_html__('Listing', 'linkpva-core'),
            'category' => esc_html__('Category', 'linkpva-core'),
            'detail' => esc_html__('Primary detail', 'linkpva-core'),
            'price' => esc_html__('Starting price', 'linkpva-core'),
            'action' => esc_html__('Action', 'linkpva-core'),
        );
        foreach ($labels as $key => $default) {
            $this->add_control('linkpva_comparison_' . $key . '_label', array('label' => sprintf(esc_html__('%s Label', 'linkpva-core'), $default), 'type' => Controls_Manager::TEXT, 'default' => $default, 'label_block' => true));
        }
        $this->end_controls_section();
    }

    private function register_rows_controls()
    {
        $this->start_controls_section('linkpva_comparison_rows_content', array('label' => esc_html__('Comparison Rows', 'linkpva-core'), 'tab' => Controls_Manager::TAB_CONTENT));
        $repeater = new Repeater();
        $repeater->add_control('listing', array('label' => esc_html__('Listing', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('LinkedIn PVA Account', 'linkpva-core'), 'label_block' => true));
        $repeater->add_control('category', array('label' => esc_html__('Category', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('PVA', 'linkpva-core'), 'label_block' => true));
        $repeater->add_control('detail', array('label' => esc_html__('Primary Detail', 'linkpva-core'), 'type' => Controls_Manager::TEXTAREA, 'default' => esc_html__('Phone-verified options', 'linkpva-core'), 'label_block' => true));
        $repeater->add_control('price', array('label' => esc_html__('Price', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('$29', 'linkpva-core')));
        $repeater->add_control('price_suffix', array('label' => esc_html__('Price Suffix', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('per account', 'linkpva-core')));
        $repeater->add_control('show_action', array('label' => esc_html__('Show Action', 'linkpva-core'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'yes', 'default' => 'yes'));
        $repeater->add_control('action_text', array('label' => esc_html__('Action Text', 'linkpva-core'), 'type' => Controls_Manager::TEXT, 'default' => esc_html__('View', 'linkpva-core'), 'condition' => array('show_action' => 'yes')));
        $repeater->add_control('action_link', array('label' => esc_html__('Action Link', 'linkpva-core'), 'type' => Controls_Manager::URL, 'placeholder' => '#', 'default' => array('url' => '#'), 'condition' => array('show_action' => 'yes')));
        $repeater->add_control('action_icon', array('label' => esc_html__('Action Icon', 'linkpva-core'), 'type' => Controls_Manager::ICONS, 'default' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'), 'condition' => array('show_action' => 'yes')));
        $this->add_control('linkpva_comparison_rows', array('label' => esc_html__('Rows', 'linkpva-core'), 'type' => Controls_Manager::REPEATER, 'fields' => $repeater->get_controls(), 'title_field' => '{{{ listing }}}', 'default' => $this->get_default_rows()));
        $this->end_controls_section();
    }

    private function register_section_style_controls()
    {
        $this->start_controls_section('linkpva_comparison_section_style', array('label' => esc_html__('Section', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_comparison_section_background', 'selector' => '{{WRAPPER}} .linkpva-pricing-comparison'));
        $this->add_responsive_control('linkpva_comparison_section_padding', array('label' => esc_html__('Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-comparison' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->end_controls_section();
    }

    private function register_heading_style_controls()
    {
        $this->start_controls_section('linkpva_comparison_heading_style', array('label' => esc_html__('Heading', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_responsive_control('linkpva_comparison_heading_width', array('label' => esc_html__('Maximum Width', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 280, 'max' => 1200)), 'selectors' => array('{{WRAPPER}} .linkpva-section-heading' => 'max-width: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_comparison_heading_spacing', array('label' => esc_html__('Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 160)), 'selectors' => array('{{WRAPPER}} .linkpva-section-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_comparison_tag_color', array('label' => esc_html__('Tag Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-section-tag' => 'color: {{VALUE}};'), 'condition' => array('linkpva_comparison_show_tag' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_comparison_tag_typography', 'selector' => '{{WRAPPER}} .linkpva-section-tag', 'condition' => array('linkpva_comparison_show_tag' => 'yes')));
        $this->add_responsive_control('linkpva_comparison_tag_spacing', array('label' => esc_html__('Tag Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-section-tag' => 'margin-bottom: {{SIZE}}{{UNIT}};'), 'condition' => array('linkpva_comparison_show_tag' => 'yes')));
        $this->add_control('linkpva_comparison_title_color', array('label' => esc_html__('Title Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-section-heading h2' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_comparison_title_typography', 'selector' => '{{WRAPPER}} .linkpva-section-heading h2'));
        $this->add_responsive_control('linkpva_comparison_title_spacing', array('label' => esc_html__('Title Bottom Spacing', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'selectors' => array('{{WRAPPER}} .linkpva-section-heading h2' => 'margin-bottom: {{SIZE}}{{UNIT}};')));
        $this->add_control('linkpva_comparison_description_color', array('label' => esc_html__('Description Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-section-heading p' => 'color: {{VALUE}};'), 'condition' => array('linkpva_comparison_show_description' => 'yes')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_comparison_description_typography', 'selector' => '{{WRAPPER}} .linkpva-section-heading p', 'condition' => array('linkpva_comparison_show_description' => 'yes')));
        $this->end_controls_section();
    }

    private function register_table_style_controls()
    {
        $this->start_controls_section('linkpva_comparison_table_style', array('label' => esc_html__('Table Wrapper', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_group_control(Group_Control_Background::get_type(), array('name' => 'linkpva_comparison_table_background', 'selector' => '{{WRAPPER}} .linkpva-pricing-table-wrap'));
        $this->add_group_control(Group_Control_Border::get_type(), array('name' => 'linkpva_comparison_table_border', 'selector' => '{{WRAPPER}} .linkpva-pricing-table-wrap'));
        $this->add_responsive_control('linkpva_comparison_table_radius', array('label' => esc_html__('Border Radius', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', '%'), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_group_control(Group_Control_Box_Shadow::get_type(), array('name' => 'linkpva_comparison_table_shadow', 'selector' => '{{WRAPPER}} .linkpva-pricing-table-wrap'));
        $this->add_responsive_control('linkpva_comparison_cell_padding', array('label' => esc_html__('Cell Padding', 'linkpva-core'), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array('px', 'rem'), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table th, {{WRAPPER}} .linkpva-pricing-table td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};')));
        $this->add_control('linkpva_comparison_divider_color', array('label' => esc_html__('Row Divider Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table th, {{WRAPPER}} .linkpva-pricing-table td' => 'border-bottom-color: {{VALUE}};')));
        $this->end_controls_section();
    }

    private function register_header_style_controls()
    {
        $this->start_controls_section('linkpva_comparison_header_style', array('label' => esc_html__('Table Header', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_control('linkpva_comparison_header_background', array('label' => esc_html__('Background Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table thead th' => 'background-color: {{VALUE}};')));
        $this->add_control('linkpva_comparison_header_color', array('label' => esc_html__('Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table thead th' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_comparison_header_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-table thead th'));
        $this->end_controls_section();
    }

    private function register_content_style_controls()
    {
        $this->start_controls_section('linkpva_comparison_content_style', array('label' => esc_html__('Row Content', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_control('linkpva_comparison_listing_color', array('label' => esc_html__('Listing Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table tbody th' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_comparison_listing_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-table tbody th'));
        $this->add_control('linkpva_comparison_body_color', array('label' => esc_html__('Body Text Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table tbody td:nth-of-type(1), {{WRAPPER}} .linkpva-pricing-table tbody td:nth-of-type(2)' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_comparison_body_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-table tbody td:nth-of-type(1), {{WRAPPER}} .linkpva-pricing-table tbody td:nth-of-type(2)'));
        $this->end_controls_section();
    }

    private function register_price_style_controls()
    {
        $this->start_controls_section('linkpva_comparison_price_style', array('label' => esc_html__('Price', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_control('linkpva_comparison_price_color', array('label' => esc_html__('Price Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table tbody td:nth-of-type(3) strong' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_comparison_price_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-table tbody td:nth-of-type(3) strong'));
        $this->add_control('linkpva_comparison_suffix_color', array('label' => esc_html__('Suffix Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table tbody td:nth-of-type(3) small' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_comparison_suffix_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-table tbody td:nth-of-type(3) small'));
        $this->end_controls_section();
    }

    private function register_action_style_controls()
    {
        $this->start_controls_section('linkpva_comparison_action_style', array('label' => esc_html__('Actions', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_comparison_action_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-table td:last-child a'));
        $this->add_responsive_control('linkpva_comparison_action_gap', array('label' => esc_html__('Icon Gap', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 0, 'max' => 40)), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table td:last-child a' => 'gap: {{SIZE}}{{UNIT}};')));
        $this->add_responsive_control('linkpva_comparison_action_icon_size', array('label' => esc_html__('Icon Size', 'linkpva-core'), 'type' => Controls_Manager::SLIDER, 'range' => array('px' => array('min' => 8, 'max' => 60)), 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table td:last-child a i' => 'font-size: {{SIZE}}{{UNIT}};', '{{WRAPPER}} .linkpva-pricing-table td:last-child a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};')));
        $this->start_controls_tabs('linkpva_comparison_action_tabs');
        $this->start_controls_tab('linkpva_comparison_action_normal', array('label' => esc_html__('Normal', 'linkpva-core')));
        $this->add_control('linkpva_comparison_action_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table td:last-child a' => 'color: {{VALUE}};')));
        $this->end_controls_tab();
        $this->start_controls_tab('linkpva_comparison_action_hover', array('label' => esc_html__('Hover', 'linkpva-core')));
        $this->add_control('linkpva_comparison_action_hover_color', array('label' => esc_html__('Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table td:last-child a:hover, {{WRAPPER}} .linkpva-pricing-table td:last-child a:focus' => 'color: {{VALUE}};')));
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    private function register_mobile_style_controls()
    {
        $this->start_controls_section('linkpva_comparison_mobile_style', array('label' => esc_html__('Mobile Labels', 'linkpva-core'), 'tab' => Controls_Manager::TAB_STYLE));
        $this->add_control('linkpva_comparison_mobile_label_color', array('label' => esc_html__('Label Color', 'linkpva-core'), 'type' => Controls_Manager::COLOR, 'selectors' => array('{{WRAPPER}} .linkpva-pricing-table tbody td::before' => 'color: {{VALUE}};')));
        $this->add_group_control(Group_Control_Typography::get_type(), array('name' => 'linkpva_comparison_mobile_label_typography', 'selector' => '{{WRAPPER}} .linkpva-pricing-table tbody td::before'));
        $this->end_controls_section();
    }

    private function get_default_rows()
    {
        $rows = array(
            array('LinkedIn PVA Account', 'PVA', 'Phone-verified options', '$29'),
            array('3+ Years Aged Account', 'Aged', '3+ year age range', '$34'),
            array('5+ Years Aged Account', 'Aged', '5+ year age range', '$39'),
            array('Verified LinkedIn Account', 'Verified', 'Verification details', '$49'),
            array('UK Verified Account', 'Verified', 'UK region', '$55'),
            array('Account With 1K+ Followers', 'Followers', '1K+ follower range', '$79'),
        );
        $defaults = array();
        foreach ($rows as $row) {
            $defaults[] = array(
                'listing' => $row[0],
                'category' => $row[1],
                'detail' => $row[2],
                'price' => $row[3],
                'price_suffix' => esc_html__('per account', 'linkpva-core'),
                'show_action' => 'yes',
                'action_text' => esc_html__('View', 'linkpva-core'),
                'action_link' => array('url' => '#'),
                'action_icon' => array('value' => 'bi bi-arrow-right', 'library' => 'bootstrap'),
            );
        }
        return $defaults;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $rows = !empty($settings['linkpva_comparison_rows']) && is_array($settings['linkpva_comparison_rows']) ? $settings['linkpva_comparison_rows'] : array();
        $labels = array(
            'listing' => $settings['linkpva_comparison_listing_label'] ?? '',
            'category' => $settings['linkpva_comparison_category_label'] ?? '',
            'detail' => $settings['linkpva_comparison_detail_label'] ?? '',
            'price' => $settings['linkpva_comparison_price_label'] ?? '',
            'action' => $settings['linkpva_comparison_action_label'] ?? '',
        );
?>
        <section class="linkpva-section linkpva-pricing-comparison linkpva-comparison-table-widget" aria-labelledby="comparison-heading">
            <div class="container">
                <div class="linkpva-section-heading text-center">
                    <?php if ('yes' === ($settings['linkpva_comparison_show_tag'] ?? '') && !empty($settings['linkpva_comparison_tag'])) : ?>
                        <span class="linkpva-section-tag"><?php echo esc_html($settings['linkpva_comparison_tag']); ?></span>
                    <?php endif; ?>
                    <?php if (!empty($settings['linkpva_comparison_title'])) : ?>
                        <h2 id="comparison-heading"><?php echo esc_html($settings['linkpva_comparison_title']); ?></h2>
                    <?php endif; ?>
                    <?php if ('yes' === ($settings['linkpva_comparison_show_description'] ?? '') && !empty($settings['linkpva_comparison_description'])) : ?>
                        <p><?php echo esc_html($settings['linkpva_comparison_description']); ?></p>
                    <?php endif; ?>
                </div>

                <?php if (!empty($rows)) : ?>
                    <div class="linkpva-pricing-table-wrap">
                        <table class="linkpva-pricing-table is-detailed">
                            <thead>
                                <tr>
                                    <th scope="col"><?php echo esc_html($labels['listing']); ?></th>
                                    <th scope="col"><?php echo esc_html($labels['category']); ?></th>
                                    <th scope="col"><?php echo esc_html($labels['detail']); ?></th>
                                    <th scope="col"><?php echo esc_html($labels['price']); ?></th>
                                    <th scope="col"><span class="visually-hidden"><?php echo esc_html($labels['action']); ?></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $index => $row) :
                                    if (empty($row['listing']) && empty($row['category']) && empty($row['detail']) && empty($row['price'])) {
                                        continue;
                                    }
                                    $show_action = 'yes' === ($row['show_action'] ?? '') && !empty($row['action_text']);
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo esc_html($row['listing'] ?? ''); ?></th>
                                        <td><?php echo esc_html($row['category'] ?? ''); ?></td>
                                        <td><?php echo esc_html($row['detail'] ?? ''); ?></td>
                                        <td>
                                            <?php if (!empty($row['price'])) : ?><strong><?php echo esc_html($row['price']); ?></strong><?php endif; ?>
                                            <?php if (!empty($row['price_suffix'])) : ?><small><?php echo esc_html($row['price_suffix']); ?></small><?php endif; ?>
                                        </td>
                                        <?php if ($show_action) :
                                            $link_key = 'comparison_action_' . $index;
                                            $this->add_link_attributes($link_key, !empty($row['action_link']) && is_array($row['action_link']) ? $row['action_link'] : array());
                                        ?>
                                            <td>
                                                <a <?php echo $this->get_render_attribute_string($link_key); ?>>
                                                    <?php echo esc_html($row['action_text']); ?>
                                                    <?php if (!empty($row['action_icon']['value'])) : Icons_Manager::render_icon($row['action_icon'], array('aria-hidden' => 'true'));
                                                    endif; ?>
                                                </a>
                                            </td>
                                        <?php else : ?>
                                            <td></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </section>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new linkpva_Comparison_Table_Widget());
