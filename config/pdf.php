<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Laravel Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('../temp/'),
    'font_path' => base_path('/public/fonts/IRANSansWeb.ttf')
];

//return [
//    'format'           => 'A4', // See https://mpdf.github.io/paging/page-size-orientation.html
//    'author'           => 'John Doe',
//    'subject'          => 'This Document will explain the whole universe.',
//    'keywords'         => 'PDF, Laravel, Package, Peace', // Separate values with comma
//    'creator'          => 'Laravel Pdf',
//    'display_mode'     => 'fullpage'
//];