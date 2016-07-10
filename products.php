<?php

$product = array(
	
	// PRODUCT ARRAY KEY -- MAKE SURE THIS IS UNIQUE
	'code01' => array(
		'name' 		=> 'Sample Product 01',
		'price'		=> 19.95,
		'currency'	=> 'USD',
		'files'		=> array(
			array( // PRODUCT FILES
					'name'     => 'Sample Audio MP3', // normal name of the file
					'filename' => 'audio-lesson.mp3', // filename the customer will gets
					'source'   => 'sample.mp3'        // actual location of the file
													  // does not need to be the same filename
													  // location can elsewhere too like:
													  // 'source'   => '../../store/sample.mp3'
				),
			array( // SECOND FILE FOR THIS PRODUCT
					'name'     => 'Sample PDF eBook',
					'filename' => 'workbook.pdf',
					'source'   => 'sample.pdf'
				),
		)
	),
	
	// SECOND PRODUCT
	'code02' => array(
		'name' 		=> 'Sample Product 02',
		'price'		=> 97.00,
		'currency'	=> 'USD',
		'files'		=> array(
			array( // PRODUCT FILES
					'name'     => 'Sample Audio MP3',
					'filename' => 'audio-lesson.mp3',
					'source'   => 'sample.mp3'
				),
			array( // SECOND FILE FOR THIS PRODUCT
					'name'     => 'Sample PDF eBook',
					'filename' => 'workbook.pdf',
					'source'   => 'sample.pdf'
				),
		)
	),
	
);
