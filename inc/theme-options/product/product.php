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
				'title'   => esc_html__('Card Features', 'linkpva-core'),
        'default' => 'Verification details
Completed profile
Delivery information',
      ),
			array(
				'id'     => 'product_specifications',
				'type'   => 'repeater',
				'title'  => esc_html__('Product Specifications', 'linkpva-core'),
				'fields' => array(
					array(
						'id'    => 'specification_label',
						'type'  => 'text',
						'title' => esc_html__('Label', 'linkpva-core'),
					),
					array(
						'id'    => 'specification_value',
						'type'  => 'text',
						'title' => esc_html__('Value', 'linkpva-core'),
					),
				),
				'default' => array(
					array('specification_label' => 'Verification', 'specification_value' => 'Details included'),
					array('specification_label' => 'Profile status', 'specification_value' => 'Completed profile'),
					array('specification_label' => 'Email included', 'specification_value' => 'See final listing'),
					array('specification_label' => 'Delivery', 'specification_value' => 'After order confirmation'),
					array('specification_label' => 'Replacement', 'specification_value' => 'Policy conditions apply'),
				),
			),
    )
  ));
}
