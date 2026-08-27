<?php

/*-----------------------------------------
	CONTROL CORE CLASSES FOR AVOID ERRORS
------------------------------------------*/
if (class_exists('CSF')) {

  /*-----------------------------------
	    PAGE METABOX SECTION
	------------------------------------*/
  CSF::createMetabox(
    "EGNS_CAREER_META_ID",
    array(
      'id'              => 'career_meta_option',
      'title'           => esc_html__('Job Informations', 'linkpva-core'),
      'post_type'       => 'career',
      'context'         => 'normal',
      'priority'        => 'high',
      'show_restore'    => true,
      'enqueue_webfont' => true,
      'async_webfont'   => false,
      'output_css'      => false,
      'nav'             => 'normal',
      'theme'           => 'dark',
    )
  );


  /*-----------------------------------
		REQUIRE META FILES
	------------------------------------*/

  CSF::createSection(
    "EGNS_CAREER_META_ID",
    array(
      'parent' => 'career_meta_option',
      'fields' => array(
        array(
          'type'    => 'subheading',
          'content' => esc_html__('Job Details', 'linkpva-core'),
        ),
        array(
          'id'       => 'job_posted_date',
          'type'     => 'date',
          'settings' => array(
            'dateFormat' => 'dd M, yy',
          ),
          'title' => esc_html__('Job Posted Date', 'linkpva-core'),
        ),
        array(
          'id'       => 'job_deadline_date',
          'type'     => 'date',
          'settings' => array(
            'dateFormat' => 'dd M, yy',
          ),
          'title' => esc_html__('Deadline Date', 'linkpva-core'),
        ),
        array(
          'id'      => 'job_location',
          'type'    => 'radio',
          'inline'  => true,
          'title'   => esc_html__('Location', 'linkpva-core'),
          'options' => array(
            'Onsite' => 'Onsite',
            'Remote' => 'Remote',
            'Hybrid' => 'Hybrid',
          ),
          'default' => 'Onsite'
        ),
        array(
          'id'      => 'job_type',
          'type'    => 'checkbox',
          'inline'  => true,
          'title'   => esc_html__('Job Types', 'linkpva-core'),
          'options' => array(
            'Full-time'  => 'Full-time',
            'Part-time'  => 'Part-time',
            'Contract'   => 'Contract',
            'Internship' => 'Internship',
            'Seasonal'   => 'Seasonal',
          ),
          'default' => 'Full-time'
        ),
        array(
          'id'      => 'job_experience',
          'type'    => 'text',
          'title'   => esc_html__('Experience', 'linkpva-core'),
          'default' => '1-3 Years',
        ),
        array(
          'id'      => 'job_vacancy',
          'type'    => 'text',
          'title'   => esc_html__('Vacancy', 'linkpva-core'),
          'default' => '02',
        ),
        array(
          'id'      => 'job_salary',
          'type'    => 'text',
          'title'   => esc_html__('Salary Range', 'linkpva-core'),
          'default' => '$90K - $170K<span class="year">( Annualy)</span>',
        ),
        array(
          'type'    => 'subheading',
          'content' => esc_html__('Right Side Content', 'linkpva-core'),
        ),
        array(
          'id'      => 'apply_heading',
          'type'    => 'text',
          'title'   => esc_html__('Heading', 'linkpva-core'),
          'default' => 'Ready to grow your career with us?',
        ),
        array(
          'id'      => 'apply_now_lbl',
          'type'    => 'text',
          'title'   => esc_html__('Button label', 'linkpva-core'),
          'default' => 'Apply Now',
        ),
        array(
          'id'      => 'apply_desc',
          'type'    => 'textarea',
          'class'   => 'egns_desc',
          'title'   => esc_html__('Short Description', 'linkpva-core'),
          'default' => 'We’re ready to meet with you & opptimistic you will doing great well!',
        ),
        array(
          'id'      => 'apply_note',
          'type'    => 'textarea',
          'class'   => 'egns_desc',
          'title'   => esc_html__('Short Note', 'linkpva-core'),
          'default' => wp_kses_post('<strong>Note: </strong>By applying, you will agree our <a href="#">privacy-policy & terms conditions.</a>.'),
        ),
        array(
          'id'      => 'career_apply_form_shortcode',
          'type'    => 'text',
          'title'   => esc_html__('Form Shortcode', 'linkpva-core'),
          'default' => '[contact-form-7 title="Linkpva Career Form"]',
        ),

      )
    )
  );
}
