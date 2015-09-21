<?php 
/*
|--------------------------------------------------------------------------
| Environments
|--------------------------------------------------------------------------
|
| This configuration file will automatically set the ENVIRONMENT constant
| based on the server address (e.g. $_SERVER['HTTP_HOST'])
|
|	$environments = array(
|				'development' => array('localhost*', '192.:*'),
|				'production' => array('mysite.com'),
|				);
*/

$environments = array(
				'development' => array('dev.feuerwehr-bs.de'),
                'production' => array('feuerwehr-bs.de'),
				);