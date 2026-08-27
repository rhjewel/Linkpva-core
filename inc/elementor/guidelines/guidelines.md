# LinkPVA Elementor Widget Guidelines

This document defines the project standard for creating and updating Elementor widgets in `linkpva-core`. It describes this repository specifically and must not be treated as generic Elementor documentation.

## 1. Project Map

- Core plugin: `wp-content/plugins/linkpva-core`
- Plugin bootstrap: `linkpva-core.php`
- Elementor loader: `inc/elementor/elementor.php`
- Widget files: `inc/elementor/widgets/class-{slug}-elementor-widget.php`
- Plugin widget scripts: `inc/assets/js/`
- Plugin icon assets: `inc/assets/css/` and `inc/assets/js/`
- Plugin fallback image: `inc/assets/image/not-found.png`
- Theme: `wp-content/themes/linkpva`
- Plugin widget stylesheet: `wp-content/plugins/linkpva-core/inc/assets/css/el-widgets.css`
- Theme CSS source: `wp-content/themes/linkpva/assets/css/style.scss`
- Theme compiled CSS: `wp-content/themes/linkpva/assets/css/style.css`
- Theme JavaScript: `wp-content/themes/linkpva/assets/js/custom.js`
- Theme images and logos: `wp-content/themes/linkpva/assets/images/`
- Theme archive and single templates: `wp-content/themes/linkpva/inc/`

Widgets are loaded from the `$elementor_widgets` array in `Egns_Core\Egns_Elementor::_widget_registered()`. The loader looks for a flat file named:

```text
inc/elementor/widgets/class-{slug}-elementor-widget.php
```

A slug in the loader is skipped when its file does not exist. A new widget is complete only when both the widget file and matching loader entry exist.

The Elementor category is always `linkpva_widgets`. The plugin text domain is always `linkpva-core`.

## 2. Non-Negotiable Rules

1. Do not leave static demo content in widget render output.
2. Every visible text, image, link, icon, item, label, badge, and button must come from an Elementor control, WordPress data, theme options, or a documented project helper.
3. Preserve the supplied LinkPVA DOM structure and frontend classes. Theme CSS and JavaScript depend on hooks such as `linkpva-*`, `header-area`, `main-menu`, `menu-list`, `mega-menu`, `section-title`, `swiper`, and widget-specific data attributes.
4. Use the supplied markup as the source of truth. Reuse data and helpers from archive/single templates without adding wrappers or visible elements that are absent from the requested design.
5. Match style controls to selectors that exist in `style.scss`, `style.css`, or `el-widgets.css`.
6. Scope every Elementor style selector with `{{WRAPPER}}`.
7. Escape render output with the appropriate WordPress function.
8. Keep `inc/elementor/elementor.php` focused on widget/category registration, shared widget CSS, and shared icon libraries.
9. Keep widget controls and rendering logic in the widget class. Put reusable frontend behavior in `inc/assets/js/`.
10. Do not edit Elementor core, vendor libraries, minified third-party files, or generated assets unless the task explicitly requires it.
11. Every new widget needs a Content tab and a Style tab unless the user explicitly asks to omit one.
12. Run `php -l` on every edited PHP file before finalizing.

## 3. Widget Class Standard

Use the existing project shape:

```php
<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}

class linkpva_Example_Widget extends Widget_Base
{
	public function get_name()
	{
		return 'linkpva_example';
	}

	public function get_title()
	{
		return esc_html__('LinkPVA Example', 'linkpva-core');
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
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
	}
}

Plugin::instance()->widgets_manager->register(new linkpva_Example_Widget());
```

Recommended method order:

1. Identity methods: `get_name()`, `get_title()`, `get_icon()`, `get_categories()`
2. Optional `get_style_depends()` and `get_script_depends()`
3. `register_controls()`
4. Content/layout control methods
5. Style control methods
6. Query, normalization, and render helpers
7. `render()`
8. Final widget registration

If an existing `render()` method already contains approved LinkPVA markup, preserve its structure and make that markup dynamic.

## 4. Naming

Use stable, project-prefixed IDs:

- Widget name: `linkpva_{slug}`
- Content control: `linkpva_{widget}_{group}_{field}`
- Style control: `linkpva_{widget}_style_{component}_{property}`
- Section ID: `linkpva_{widget}_{content|layout|style_component}`
- Widget-specific data attribute: `data-linkpva-{widget}-widget`

Examples:

- `linkpva_hero_banner_title`
- `linkpva_blog_query_posts_per_page`
- `linkpva_people_query_categories`
- `linkpva_case_study_style_card_title_color`

Use `style_one`, `style_two`, and `style_three` when the frontend has real layout variants. Do not create variant names that have no matching markup or CSS.

## 5. Content Controls

### Text

- Small labels and short values: `Controls_Manager::TEXT`
- Headings: `TEXT`, or `TEXTAREA` for longer copy
- Body copy: `TEXTAREA`
- Intentional rich content: `WYSIWYG`, rendered with `wp_kses_post()`
- Use `label_block => true` for long or important fields.
- Do not translate dynamic user-entered content.

### Images

Every static template image must become a `MEDIA` control unless it is supplied by a post thumbnail, theme option, or another documented WordPress source.

```php
'default' => array(
	'url' => Utils::get_placeholder_image_src(),
),
```

Render rules:

- Prefer `Group_Control_Image_Size::get_attachment_image_html()` when the widget exposes image-size controls.
- Otherwise use the selected media URL and `Control_Media::get_image_alt()` when an attachment ID exists.
- Always provide useful `alt` text; use an empty alt only for decorative images.
- Do not hard-code `assets/images/...` paths as user content defaults.
- For query widgets, use the post thumbnail and fall back to `includes_url('images/media/default.png')` or `EGNS_CORE_INC_ASSETS . '/image/not-found.png'` according to the existing widget pattern.

### Icons

Use `Controls_Manager::ICONS` for configurable icons and render them with `Icons_Manager::render_icon()`.

The loader registers these Elementor icon tabs:

- Bootstrap Icons
- Boxicons Regular
- Boxicons Solid
- Boxicons Logos

Style selectors must support font icons and SVG output where applicable:

```text
{{WRAPPER}} .selector i
{{WRAPPER}} .selector svg
{{WRAPPER}} .selector svg path
```

Use `MEDIA` only for uploaded image/SVG artwork, not for normal icon slots.

### Links and Buttons

Use `Controls_Manager::URL`. Prefer Elementor render attributes:

```php
$this->add_link_attributes('button', $settings['linkpva_example_button_link']);
?>
<a <?php $this->print_render_attribute_string('button'); ?>>
	<?php echo esc_html($settings['linkpva_example_button_text']); ?>
</a>
<?php
```

Optional buttons need:

1. Show/hide switcher
2. Text control
3. URL control
4. Icon control when the design contains an icon
5. Matching render guard and control conditions
6. Typography, color, background, border, radius, padding, and hover controls

Keep primary and secondary button selectors separate. If hover is drawn with `::before` or `::after`, target that pseudo-element in the relevant style control.

### Repeaters

Use a `REPEATER` for navigation items, cards, social links, contact rows, tabs, accordion items, gallery items, and other repeated structures.

- Include only fields used by the rendered item.
- Set `title_field`.
- Provide realistic defaults through a helper when the list is large.
- Skip empty rows in render output.
- Keep child data inside its parent item.
- For a simple per-card list, prefer one newline-delimited `TEXTAREA` inside the card repeater rather than a second repeater linked by an arbitrary key.

### Switchers and Conditions

Optional visible blocks need a `SWITCHER` with:

- `return_value => 'yes'`
- an explicit default
- conditions on dependent content controls
- a render guard
- a condition on any style section that only applies to that block

Review title, subtitle, description, badges, ratings, social links, search, filters, slider navigation, slider pagination, CTA buttons, decorative media, contact information, and optional metadata separately.

Do not add `RAW_HTML` notice controls unless the user requests an editor notice.

## 6. Header, Menu, and Template Widgets

LinkPVA registers `mega-menu`, `header-blocks`, and `footer-blocks` as template post types.

For header and menu widgets:

1. Preserve the exact root classes and JS hooks used by the theme header templates.
2. For navigation rendered inside a `header-blocks` template/widget, use `Egns_Core\Egns_Helper::egns_get_theme_menu()` from `wp-content/plugins/linkpva-core/helpers/helper.php`. Do not duplicate `wp_nav_menu()` configuration or replace the assigned theme menu with a static repeater.
3. Use the `mega-menu` post type only when the design requires Elementor/template-based mega-menu content.
4. Use `home_url('/')`, `get_permalink()`, or selected URL controls instead of `.html` links.
5. Support the theme's light/dark or desktop/mobile logos only when those variants exist in the supplied markup.
6. Keep mobile menu, dropdown, search, and sidebar controls conditional on their matching switchers.
7. Use registered icon controls for menu, search, close, and dropdown icons where the design permits configurable icons.

### Required Header Menu Helper

The theme registers the `primary-menu` location, and the helper preserves the LinkPVA menu markup, link `<span>` wrappers, dropdown icon, `menu-list` class, depth, fallback message, and custom walker integration.

Elementor widget classes use the `Elementor` namespace, so call the plugin helper with its fully qualified class name:

```php
<?php
\Egns_Core\Egns_Helper::egns_get_theme_menu(
	'primary-menu',
	'',
	'',
	'',
	'<i class="d-lg-none d-flex bi bi-plus dropdown-icon"></i>',
	'menu-list',
	3
);
?>
```

Parameter order:

1. Theme location
2. Container class
3. HTML before the helper-generated link text `<span>`
4. HTML after the helper-generated link text `<span>`
5. HTML appended after each menu item, normally the dropdown icon
6. `<ul>` menu class
7. Maximum menu depth

The helper prints the menu itself. Call it directly; do not wrap it in `echo`. Keep `menu-list`, `dropdown-icon`, and the responsive icon classes when the supplied header markup relies on the existing LinkPVA menu JavaScript and CSS.

## 7. Post Types, Taxonomies, and Query Widgets

LinkPVA registers these public content post types:

- `career`
- `people`
- `case-study`

Template/internal post types:

- `mega-menu`
- `header-blocks`
- `footer-blocks`

Registered taxonomies:

- Career: `career-category`, `career-tag`
- People: `people-category`, `people-tag`
- Case study: `case-study-category`, `case-study-tag`
- Standard posts: built-in `category` and `post_tag`

For a listing, grid, slider, related-content, or search widget, review these controls:

1. Posts per page
2. Relevant taxonomy terms
3. Manual/specific posts when curated ordering is useful
4. Order by: only values supported by the widget query
5. Order: `ASC` or `DESC`
6. Pagination, load-more, or result limits when present in the design
7. Sticky-post behavior for standard posts

Query rules:

- Sanitize post types, `orderby`, and `order` against explicit allowlists.
- Sanitize IDs with `absint()`.
- Use `tax_query` only when selected terms exist.
- When manual posts are selected, use `post__in` and `orderby => post__in` if selected order must be preserved.
- Use `post_status => publish` for public frontend listings.
- Use `ignore_sticky_posts => true` unless the widget intentionally exposes sticky behavior.
- Reset post data after every custom loop.
- Do not rely on the global post ID in AJAX or custom-query card helpers; pass or read the queried post ID explicitly.

The supplied card/section markup is the source of truth. Map only its visible media, category, title, excerpt, author, date, social links, button, filter, and pagination elements. Do not copy unrelated parts from an archive template.

### AJAX Patterns

When a widget requires AJAX, keep the endpoint and rendering logic in a dedicated feature class rather than growing `inc/elementor/elementor.php`. Follow this pattern:

1. Register authenticated and unauthenticated actions when the feature is public.
2. Verify the feature-specific nonce first.
3. `wp_unslash()` request data before sanitizing.
4. Allowlist settings and enforce numeric limits server-side.
5. Build `WP_Query` arguments from sanitized values only.
6. Escape the returned markup.
7. Call `wp_reset_postdata()`.
8. Respond with `wp_send_json_success()` or `wp_send_json_error()`.

Do not enqueue an AJAX script globally when its widget is not present on the page.

## 8. Style Tab Requirements

Build style controls from real LinkPVA selectors. Use separate sections where applicable:

- Section/root
- Heading, subtitle, and description
- Card/container
- Image/media area
- Content area
- Metadata and badges
- Buttons and inline links
- Icons
- Navigation and menus
- Filters, form fields, pagination, and load-more controls
- Slider arrows and pagination

Use appropriate Elementor controls:

- `Group_Control_Typography`
- `Group_Control_Background`
- `Group_Control_Border`
- `Group_Control_Box_Shadow`
- responsive `DIMENSIONS` for padding/margin
- responsive `SLIDER` for width, height, size, gap, and radius
- `COLOR` for text, icon, background, and border colors
- `CHOOSE` or responsive controls for alignment

Coverage rules:

1. Scope selectors with `{{WRAPPER}}`.
2. Give titles color and typography controls.
3. Give descriptions color, typography, and spacing controls when the theme defines spacing.
4. Style visually distinct labels, metadata, badges, prices, ratings, and links separately.
5. Cards should expose the relevant background, border, radius, shadow, padding, and content gap controls.
6. Media wrappers should expose relevant height, radius, overlay, and spacing controls.
7. Buttons need normal and hover tabs when hover styling exists.
8. Optional blocks must conditionally hide their style sections.
9. Multi-style widgets must use selectors and conditions for the active layout only.
10. Cover pseudo-elements when the theme uses them for hover fills, underlines, arrows, or decorative effects.

Before finalizing, compare every visible selector in the rendered markup against the Style tab and close meaningful customization gaps.

## 9. Render and Security Rules

1. Start with `$settings = $this->get_settings_for_display();`.
2. Normalize arrays before opening the markup: media, icons, repeaters, links, IDs, and query settings.
3. Keep markup readable and close to the approved theme HTML.
4. Skip empty optional blocks instead of printing empty wrappers.
5. Use:
   - `esc_html()` for plain text
   - `esc_attr()` for attributes
   - `esc_url()` for URLs
   - `wp_kses_post()` only for intentionally allowed rich HTML
6. Sanitize data before using it in a query, CSS class, ID, data attribute, shortcode, or AJAX response.
7. Use core helpers such as `get_permalink()`, `get_the_title()`, `get_the_post_thumbnail_url()`, `get_the_terms()`, and `get_category_link()` for WordPress data.
8. Do not echo raw settings, request values, post meta, query variables, or term data.
9. Use unique IDs derived from `$this->get_id()` when JavaScript or accessibility relationships require them.
10. Preserve accessible labels, heading order, keyboard behavior, and `aria-*` relationships from the supplied design.

## 10. Assets and JavaScript

`Egns_Elementor::linkpva_enqueue_style()` enqueues:

- `linkpva-widgets`, sourced from the plugin's `inc/assets/css/el-widgets.css`

Feature scripts must be registered only when a real widget requires them. Use `get_script_depends()` or a dedicated feature integration so scripts are not loaded globally on unrelated pages.

Rules:

1. Reuse an existing project script when it already owns the frontend behavior.
2. Put substantial widget-specific JavaScript in `inc/assets/js/` and enqueue it with a stable `linkpva-*` handle.
3. Use Elementor frontend/preview hooks so behavior initializes both on the frontend and after editor element rendering.
4. Scope selectors to the widget wrapper or a unique `data-linkpva-*` attribute.
5. Prevent duplicate listeners and duplicate slider/map instances during editor rerenders.
6. Check third-party globals such as `Swiper` or `L` before initialization.
7. Keep only truly shared asset registration in `elementor.php`; keep widget behavior in its widget class or feature script.
8. Do not add large inline scripts or styles inside `render()`.
9. Use `EGNS_CORE_INC_ASSETS` for plugin asset URLs, `EGNS_CORE_ROOT_PATH` for plugin asset paths, and theme constants/helpers for theme assets.
10. Use `filemtime()` only after confirming the local file exists; fall back to `EGNS_CORE_VERSION` when appropriate.

If changing established theme styling, update the correct source and compiled output according to the project's current build workflow. Do not edit source maps manually.

## 11. Internationalization and Formatting

- Use `linkpva-core` for all plugin UI strings.
- Use `esc_html__()`, `esc_attr__()`, or `__()` according to output context.
- Do not translate user content or database values.
- Keep control labels concise and human-readable.
- Follow the existing file's indentation style; new widget PHP should use tabs consistently.
- Use one logical statement per line and consistent brace placement.
- Avoid duplicate code, unnecessary nesting, and unrelated logic in `register_controls()` or `render()`.

## 12. Validation Checklist

Before completing an Elementor widget change, verify:

1. Static demo content has been removed or intentionally converted into control defaults.
2. Every visible value is dynamic or comes from a documented project source.
3. Images use media controls, post thumbnails, theme options, or an approved fallback.
4. Configurable icons use Elementor icon controls.
5. Repeated content uses repeaters or WordPress query data.
6. Optional blocks have switchers, conditions, render guards, and conditional style sections.
7. Style controls cover the major visible areas and use real `{{WRAPPER}}`-scoped selectors.
8. Theme classes, data attributes, and JavaScript hooks are preserved.
9. Queries and AJAX values are allowlisted and sanitized.
10. Custom queries reset post data.
11. Output is escaped for its context.
12. New widget slugs are added to `$elementor_widgets` and the matching file exists.
13. Required assets are registered/enqueued without duplicate initialization.
14. No `.html` demo links or hard-coded demo image paths remain.
15. Menus inside `header-blocks` use `\Egns_Core\Egns_Helper::egns_get_theme_menu()` rather than static menu markup or a duplicate `wp_nav_menu()` call.
16. `php -l` passes for every edited PHP file.

## 13. AI Agent Instruction

When asking an AI agent to build or update LinkPVA widgets, reference this file and say:

> Follow `wp-content/plugins/linkpva-core/inc/elementor/guidelines/guidelines.md`. Use LinkPVA theme classes and assets, keep `elementor.php` as the loader/shared integration layer, make demo markup dynamic, scope style controls with `{{WRAPPER}}`, preserve frontend hooks, sanitize queries and AJAX data, escape output, and validate edited PHP with `php -l`.
