<?php

namespace Egns_Core;

/**
 * Register LinkPVA Elementor widgets and shared editor assets.
 *
 * @since 1.0.0
 */
if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists(__NAMESPACE__ . '\\Egns_Elementor')) {
	class Egns_Elementor
	{
		/**
		 * Register Elementor integrations.
		 */
		public function __construct()
		{
			add_action('elementor/elements/categories_registered', array($this, '_widget_categories'));
			add_action('elementor/widgets/register', array($this, '_widget_registered'));
			add_action('elementor/editor/before_enqueue_styles', array($this, 'linkpva_enqueue_style'));
			add_action('elementor/frontend/before_enqueue_styles', array($this, 'linkpva_enqueue_style'));
			add_filter('elementor/icons_manager/additional_tabs', array($this, 'add_custom_icon_to_elementor_icons'));
		}

		/**
		 * Enqueue the shared widget stylesheet.
		 */
		public function linkpva_enqueue_style()
		{
			$style_path = EGNS_CORE_ROOT_PATH . '/inc/assets/css/el-widgets.css';
			$version    = file_exists($style_path) ? filemtime($style_path) : EGNS_CORE_VERSION;

			wp_enqueue_style('linkpva-widgets', EGNS_CORE_INC_ASSETS . '/css/el-widgets.css', array(), $version);
		}

		/**
		 * Register the LinkPVA Elementor category.
		 *
		 * @param \Elementor\Elements_Manager $elements_manager Elementor elements manager.
		 */
		public function _widget_categories($elements_manager)
		{
			$elements_manager->add_category(
				'linkpva_widgets',
				array(
					'title' => esc_html__('LinkPVA Widgets', 'linkpva-core'),
					'icon'  => 'fa fa-plug',
				)
			);
		}

		/**
		 * Load registered widget classes.
		 */
		public function _widget_registered()
		{
			if (!class_exists('Elementor\Widget_Base')) {
				return;
			}

			$elementor_widgets = apply_filters('linkpva_widgets', array(
				'demo',
				'header',
				'footer',
			));

			if (!is_array($elementor_widgets)) {
				return;
			}

			foreach (array_unique($elementor_widgets) as $widget) {
				$widget = sanitize_key($widget);

				if ('' === $widget) {
					continue;
				}

				$widget_file = EGNS_CORE_INC . '/elementor/widgets/class-' . $widget . '-elementor-widget.php';

				if (file_exists($widget_file)) {
					require_once $widget_file;
				}
			}
		}

		/**
		 * Add Bootstrap Icons and Boxicons to Elementor's icon control.
		 *
		 * @param array $icons Existing Elementor icon tabs.
		 * @return array
		 */
		public function add_custom_icon_to_elementor_icons($icons)
		{
			$icon_sets = array(
				'bootstrap'        => array(
					'label'          => esc_html__('Bootstrap Icons', 'linkpva-core'),
					'url'            => EGNS_CORE_INC_ASSETS . '/css/bootstrap-icons.css',
					'prefix'         => 'bi-',
					'display_prefix' => 'bi',
					'label_icon'     => 'bi bi-bootstrap-fill',
					'version'        => '1.11.3',
					'json'           => EGNS_CORE_INC_ASSETS . '/js/bootstrap-icons.json',
				),
				'boxicons-regular' => array(
					'label'          => esc_html__('Boxicons Regular', 'linkpva-core'),
					'url'            => EGNS_CORE_INC_ASSETS . '/css/boxicons.min.css',
					'prefix'         => 'bx-',
					'display_prefix' => 'bx',
					'label_icon'     => 'bi bi-box-seam-fill',
					'version'        => '2.1.4',
					'json'           => EGNS_CORE_INC_ASSETS . '/js/boxicons.json',
				),
				'boxicons-solid'   => array(
					'label'          => esc_html__('Boxicons Solid', 'linkpva-core'),
					'url'            => EGNS_CORE_INC_ASSETS . '/css/boxicons.min.css',
					'prefix'         => 'bxs-',
					'display_prefix' => 'bx',
					'label_icon'     => 'bi bi-box-seam-fill',
					'version'        => '2.1.4',
					'json'           => EGNS_CORE_INC_ASSETS . '/js/boxicons-bxs.json',
				),
				'boxicons-logos'   => array(
					'label'          => esc_html__('Boxicons Logos', 'linkpva-core'),
					'url'            => EGNS_CORE_INC_ASSETS . '/css/boxicons.min.css',
					'prefix'         => 'bxl-',
					'display_prefix' => 'bx',
					'label_icon'     => 'bi bi-box-seam-fill',
					'version'        => '2.1.4',
					'json'           => EGNS_CORE_INC_ASSETS . '/js/boxicons-bxl.json',
				),
			);

			foreach ($icon_sets as $name => $icon_set) {
				$icons[$name] = array(
					'name'          => $name,
					'label'         => $icon_set['label'],
					'url'           => $icon_set['url'],
					'enqueue'       => array($icon_set['url']),
					'prefix'        => $icon_set['prefix'],
					'displayPrefix' => $icon_set['display_prefix'],
					'labelIcon'     => $icon_set['label_icon'],
					'ver'           => $icon_set['version'],
					'fetchJson'     => $icon_set['json'],
					'native'        => true,
				);
			}

			return $icons;
		}
	}
}
