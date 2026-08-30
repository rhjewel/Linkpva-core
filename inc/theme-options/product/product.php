<?php
if (class_exists('CSF')) {

  /*-----------------------------------
	    PAGE METABOX SECTION
	------------------------------------*/
  CSF::createMetabox("EGNS_PRODUCT_META_ID", array(
    'id'              => 'product_meta_option',
    'title'           => esc_html__('Product Features', 'linkpva-core'),
    'post_type'       => 'product',
    'context'         => 'normal',
    'priority'        => 'high',
    'show_restore'    => true,
    'enqueue_webfont' => true,
    'async_webfont'   => false,
    'output_css'      => false,
    'nav'             => 'normal',
    'theme'           => 'dark',
  ));


  /*-----------------------------------
		REQUIRE META FILES
	------------------------------------*/

  CSF::createSection("EGNS_PRODUCT_META_ID", array(
    'parent' => 'product_meta_option',
    'fields' => array(
      array(
        'id'      => 'product_feature_lbl',
        'type'    => 'textarea',
        'default' => 'Verification details
Completed profile
Delivery information',
      ),
    )
  ));
}
