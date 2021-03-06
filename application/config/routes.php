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
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/
//~ $route['default_controller'] = 'node';
$route['default_controller']  = "node";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['default_controller']  = "node";
$route['login']         = "sessions/login";
$route['admin/(:any)']      = 'admin/$1';
$route['cron/(:any)']      = 'cron/$1';


$route['en/list'] = 'node/list';
$route['es/list'] = 'node/list';

$route['en/register'] = 'node/register';
$route['es/register'] = 'node/register';

$route['en/listmenu'] = 'node/listmenu';
$route['es/listmenu'] = 'node/listmenu';

$route['en/menus'] = 'node/menus';
$route['add-menus'] = 'node/addMenu';
$route['es/menus'] = 'node/menus';

$route['en/payment'] = 'node/payment';
$route['es/payment'] = 'node/payment';

$route['en/profile'] = 'node/profile';
$route['es/profile'] = 'node/profile';

$route['en/contact'] = 'node/contact';
$route['es/contact'] = 'node/contact';

$route['en/orders/(:num)'] = 'node/orders/$1';
$route['es/orders/(:num)'] = 'node/orders/$1';
$route['en/orders'] = 'node/orders';
$route['es/orders'] = 'node/orders';


$route['en/error'] = 'node/paymentError';
$route['es/error'] = 'node/paymentError';

$route['en/success'] = 'node/paymentSuccess';
$route['es/success'] = 'node/paymentSuccess';

$route['en/checkout'] = 'ajax/checkout';
$route['es/checkout'] = 'ajax/checkout';

$route['en/forgot_password'] = 'node/forgotPassword';
$route['es/forgot_password'] = 'node/forgotPassword';

$route['en/terms'] = 'node/terms';
$route['es/terms'] = 'node/terms';

$route['en/change_password/(:any)'] = 'node/changePassword';
$route['es/change_password/(:any)'] = 'node/changePassword';

$route['en/order-details/(:any)'] = 'node/orderDetails/$1';
$route['es/order-details/(:any)'] = 'node/orderDetails/$1';

$route['en/logout'] = 'node/logout';
$route['es/logout'] = 'node/logout';

$route['en'] = 'node/index';
$route['es'] = 'node/index';

$route['en/get_promo_code_detail'] = 'ajax/getPromoCodeDetail';
$route['es/get_promo_code_detail'] = 'ajax/getPromoCodeDetail';

$route['en/invoice-users/(:num)/(:num)'] = 'node/invoiceUsers/$1/$2';
$route['es/invoice-users/(:num)/(:num)'] = 'node/invoiceUsers/$1/$2';

$route['en/invoice-business/(:num)/(:num)'] = 'node/invoiceBusiness/$1/$2';
$route['es/invoice-business/(:num)/(:num)'] = 'node/invoiceBusiness/$1/$2';

$route['en/business-invoice'] = 'node/businessInvoice';
$route['es/business-invoice'] = 'node/businessInvoice';

$route['en/user-invoice'] = 'node/userInvoice';
$route['es/user-invoice'] = 'node/userInvoice';