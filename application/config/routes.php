<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Index_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['captcha_regno_image/(:any)'] = 'tool/Captcha_controller/mark_regno_image/$1';
/*
 * PC端
 * */
$route['article_list.html'] = 'waitui/Index_controller/article_list';
$route['article_search/(:any)'] = 'waitui/Index_controller/article_search/$1';
$route['article_detail/([\d]+)\.html'] = 'waitui/Index_controller/article_detail/$1';

$route['mark_list.html'] = 'waitui/Index_controller/mark_list';
$route['mark_search.html'] = 'waitui/Index_controller/mark_search';//不传关键词
$route['mark_search/(:any)'] = 'waitui/Index_controller/mark_search/$1';//传关键词
$route['mark_detail/(:any)\.html'] = 'waitui/Index_controller/mark_detail/$1';

$route['domain_list.html'] = 'waitui/Index_controller/domain_list';
$route['domain_detail/(:any)'] = 'waitui/Index_controller/domain_detail/$1';

$route['agreement.html'] = 'waitui/Index_controller/agreement';

$route['my_account'] = 'waitui/Index_controller/my_account';
$route['my_domain'] = 'waitui/Index_controller/my_domain';
$route['my_mark'] = 'waitui/Index_controller/my_mark';
$route['my_mark/([\d]+)'] = 'waitui/Index_controller/my_mark/$1';

$route['login_out'] = 'waitui/Index_controller/login_out';

/*
 * 手机端
 * */
$route['m'] = 'mobile/Index_controller';

$route['m/share/(:any)'] = 'mobile/Index_controller/share/$1';

$route['m/login_out'] = 'mobile/Index_controller/login_out';

$route['m/article_list.html'] = 'mobile/Index_controller/article_list';

$route['m/article_detail/([\d]+)\.html'] = 'mobile/Index_controller/article_detail/$1';

$route['m/welfare_list.html'] = 'mobile/Index_controller/welfare_list';

$route['m/welfare_entry.html'] = 'mobile/Index_controller/welfare_entry';

$route['m/account.html'] = 'mobile/Index_controller/account';

$route['m/userinfo.html'] = 'mobile/Index_controller/userinfo';

$route['m/nickname.html'] = 'mobile/Index_controller/nickname';

$route['m/about.html'] = 'mobile/Index_controller/about';

$route['m/agreement.html'] = 'mobile/Index_controller/agreement';
