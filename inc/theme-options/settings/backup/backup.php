<?php
/*-------------------------------------------------------
		   ** Backup  Options
--------------------------------------------------------*/

CSF::createSection($prefix, array(
	'id'     => 'backup',
	'title'  => esc_html__('Import / Export', 'linkpva-core'),
	'icon'   => 'fa fa-upload',
	'fields' => array(
		array(
			'type'    => 'notice',
			'style'   => 'warning',
			'content' => esc_html__('You can save your current options. Download a Backup and Import.', 'linkpva-core'),
		),
		array(
			'type'  => 'backup',
			'title' => esc_html__('Backup & Import', 'linkpva-core')
		)
	)
));
