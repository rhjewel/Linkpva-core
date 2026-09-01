<?php
/*-------------------------------------------------------
		  ** Portfolio Page  Options
--------------------------------------------------------*/

CSF::createSection($prefix, array(
  'parent' => 'custom_post_type_settings',
  'id'     => 'case_study_archive_settings',
  'title'  => esc_html__('Case Study Options', 'linkpva-core'),
  'icon'   => 'fa fa-folder-open',
  'fields' => array(
    // A Subheading
    array(
      'type'    => 'subheading',
      'content' => esc_html__('Case Study archive', 'linkpva-core'),
    ),
    array(
      'id'    => 'breadcrumb_cpt_case_heading',
      'type'  => 'text',
      'title' => esc_html__('Breadcrumb Heading', 'linkpva-core'),
    ),
    array(
      'id'         => 'breadcrumb_cpt_case_short_desc',
      'type'       => 'textarea',
      'class'      => 'egns_desc',
      'title'      => esc_html__('Breadcrumb Description', 'linkpva-core'),
    ),
    array(
      'id'      => 'case_study_posts_per_page',
      'type'    => 'number',
      'title'   => esc_html__('Posts per page limit', 'linkpva-core'),
      'default' => 9,
    ),

  ),

));
