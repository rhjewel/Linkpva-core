<?php
/*-------------------------------------------------------
		  ** Project Page  Options
--------------------------------------------------------*/

CSF::createSection($prefix, array(
  'parent' => 'custom_post_type_settings',
  'id'     => 'product_archive_settings',
  'title'  => esc_html__('Product Options', 'linkpva-core'),
  'icon'   => 'fa fa-briefcase',
  'fields' => array(
    // A Subheading
    array(
      'type'    => 'subheading',
      'content' => esc_html__('Product archive', 'linkpva-core'),
    ),
    array(
      'id'         => 'breadcrumb_cpt_product_heading',
      'type'       => 'text',
      'title'      => esc_html__('Breadcrumb Heading', 'linkpva-core'),
    ),
    array(
      'id'         => 'breadcrumb_cpt_product_short_desc',
      'type'       => 'textarea',
      'class'      => 'egns_desc',
      'title'      => esc_html__('Breadcrumb Description', 'linkpva-core'),
    ),

  ),



));
