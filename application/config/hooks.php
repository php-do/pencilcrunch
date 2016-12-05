<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
$authentication = 'SystemHooks';

// Check if the system status is maintenance mode
$hook['post_controller'][] = [
	'class'    => $authentication,
	'function' => 'IsInMaintenanceMode',
	'filename' => "$authentication.php",
	'filepath' => 'hooks',
	'params'   => []
];

// validate if this user is in sesion
$hook['post_controller'][] = [
	'class'    => $authentication,
	'function' => 'IsTheUserOffline',
	'filename' => "$authentication.php",
	'filepath' => 'hooks',
	'params'   => []
];

// validate if the admin is loged
$hook['post_controller'][] = [
	'class'    => $authentication,
	'function' => 'IsTheUserLoged',
	'filename' => "$authentication.php",
	'filepath' => 'hooks',
	'params'   => []
];