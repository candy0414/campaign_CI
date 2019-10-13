<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Load_Controller';	
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['(:any)/campaigns'] = 'manage_campaigns/index/$1';
$route['(:any)/add_campaign'] = 'add_campaign/index/$1';
$route['(:any)/(:any)/report'] = 'report/index/$2';
$route['(:any)/(:any)/view_campaign'] = 'view_campaign/index/$2';
$route['(:any)/(:any)/edit'] = 'edit/index/$2';
$route['(:any)/login'] = 'login/index/'.rawurldecode('$1');
$route['(:any)/task'] = 'task/index/$1';
$route['(:any)/completion'] = 'completion/index/$1';
