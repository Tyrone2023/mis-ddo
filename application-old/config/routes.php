<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'pages/view';

$route['personnel'] = 'pages/personnel';
$route['dept_summary'] = 'pages/dept_summary';
$route['personel_add'] = 'pages/personel_add';
$route['personnel_profile/(:any)'] = 'pages/personnel_profile/$1';
$route['twoOonefiles'] = 'pages/twoOonefiles';

$route['plantilla'] = 'pages/plantilla';
$route['plantilla_add'] = 'pages/plantilla_add';
$route['plantilla_update/(:any)'] = 'pages/plantilla_update/$1';
$route['plantilla_del/(:any)'] = 'pages/plantilla_del/$1';

$route['items/(:any)'] = 'pages/items/$1';
$route['position'] = 'pages/position';
$route['requirment'] = 'pages/requirment';
$route['view_status_unview/(:any)'] = 'pages/view_status_unview/$1';
$route['view_status_view/(:any)'] = 'pages/view_status_view/$1';

$route['reg'] = 'pages/reg';
$route['register'] = 'pages/register';
$route['registered_profile/(:any)'] = 'pages/registered_profile/$1';

$route['profile_ap/(:any)'] = 'pages/profile_ap/$1';
$route['profile_staff/(:any)'] = 'pages/profile_staff/$1';

$route['pass'] = 'pages/pass';
$route['apply'] = 'pages/apply';
$route['applicant'] = 'pages/applicant';
$route['ap_delete/(:any)'] = 'pages/ap_delete/$1';

$route['users'] = 'pages/users';
$route['user_add'] = 'pages/user_add';
$route['user_edit/(:any)'] = 'pages/user_edit/$1';
$route['user_delete/(:any)'] = 'pages/user_delete/$1';

$route['hrusers'] = 'pages/hrusers';
$route['eval_user_add'] = 'pages/eval_user_add';
$route['hruser_edit/(:any)'] = 'pages/user_edit/$1';

$route['log_in'] = 'pages/log_in';
$route['logout'] = 'pages/logout';
$route['lock'] = 'pages/lock';
$route['lock_user_screen'] = 'pages/lock_user_screen';

$route['profile/(:any)'] = 'pages/profile/$1';
$route['new_applicant'] = 'pages/new_applicant';
$route['secretariat'] = 'pages/secretariat';

$route['evaluators_account/(:any)'] = 'pages/evaluators_account/$1';

$route['register_profile/(:any)'] = 'pages/register_profile/$1';

$route['user_pass/(:any)'] = 'pages/user_pass/$1';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
