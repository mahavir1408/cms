<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['login'] = "login";
$route['admin/logout'] = "login/logout";

$route['admin/category/(:num)'] = "category/index";
$route['admin/category/add-category'] = "category/add";
$route['admin/category/edit-category/(:num)'] = "category/edit";

$route['admin/pages/(:num)'] = "pages/index";
$route['admin/pages/create-page'] = 'pages/createPage';
$route['admin/pages/delete/(:num)'] = 'pages/delete';
$route['admin/pages/seo/(:num)'] = 'pages/seo';
$route['admin/pages/image/(:num)'] = 'pages/image';
$route['admin/pages/publish/(:num)'] = 'pages/publish_unpublish';
$route['admin/pages/unpublish/(:num)'] = 'pages/publish_unpublish';

$route['default_controller'] = "welcome";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */