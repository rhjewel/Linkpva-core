<?php
/*-------------------------------------------------------
		  ** people Page  Options
--------------------------------------------------------*/

CSF::createSection($prefix, array(
  'parent' => 'custom_post_type_settings',
  'id'     => 'people_archive_settings',
  'title'  => esc_html__('People Options', 'linkpva-core'),
  'icon'   => 'fa fa-folder-open',
  'fields' => array(
    // A Subheading
    array(
      'type'    => 'subheading',
      'content' => esc_html__('People archive', 'linkpva-core'),
    ),
    array(
      'id'         => 'breadcrumb_cpt_people_heading',
      'type'       => 'text',
      'title'      => esc_html__('Breadcrumb Heading', 'linkpva-core'),
    ),
    array(
      'id'      => 'people_posts_per_page',
      'type'    => 'number',
      'title'   => esc_html__('Posts per page', 'linkpva-core'),
      'default' => 8,
    ),

  ),

));
