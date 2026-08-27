<?php
/*-------------------------------------------------------
		  ** Project Page  Options
--------------------------------------------------------*/

CSF::createSection($prefix, array(
  'parent' => 'custom_post_type_settings',
  'id'     => 'career_archive_settings',
  'title'  => esc_html__('Career Options', 'linkpva-core'),
  'icon'   => 'fa fa-briefcase',
  'fields' => array(
    // A Subheading
    array(
      'type'    => 'subheading',
      'content' => esc_html__('Career archive', 'linkpva-core'),
    ),
    array(
      'id'         => 'breadcrumb_cpt_creer_heading',
      'type'       => 'text',
      'title'      => esc_html__('Breadcrumb Heading', 'linkpva-core'),
    ),
    array(
      'id'      => 'career_posts_per_page',
      'type'    => 'number',
      'title'   => esc_html__('Posts per page', 'linkpva-core'),
      'default' => 9,
    ),

  ),



));
