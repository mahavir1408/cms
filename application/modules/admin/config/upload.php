<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['upload'] = Array(	
    'upload_path' 	=> IMAGES_PATH,
    'allowed_types' => 'gif|jpg|png',
    'max_size' 		=> '2097152',	
	'max_width'		=> '0',
	'max_height'	=> '0',
	'overwrite'		=> TRUE,
	'remove_spaces'  => TRUE
);