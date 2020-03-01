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

$route['default_controller']                =   'Authentication/user_login_process';

$route['dashboard']                         =   'dashboard/home';
$route['dashboard/account']                 =   'dashboard/ManageAccount';
$route['dashboard/wallet/request']          =   'dashboard/RequestPayment';
$route['dashboard/preventivi/analytics']    =   'dashboard/AnalisiPreventivi';

$route['account/logout']                    =   'Authentication/logout';
$route['account/login']                     =   'Authentication/user_login_process';

$route['setup/install']                     =   'Migrate/Create';


$route['api/settings/update']               =   'api/settings/updatepass';
$route['api/analytics/(:any)']              =   'api/analytics/prints/$1';
$route['api/analytics/getall']              =   'api/analytics/getall';
$route['api/feedback/preventivo']           =   'api/analytics/Send';
$route['api/manager/user/add']              =   'api/UserManager/AddUser';
$route['api/manager/user/delete']           =   'api/UserManager/DeleteUser';
$route['api/request/add']                   =   'api/Requests/AddRequest';
$route['api/request/edit']                  =   'api/Requests/EditRequest';
$route['api/request/delete']                =   'api/Requests/DeleteRequest';
$route['api/request/get']                   =   'api/Requests/GetOrder';
$route['api/request/send']                  =   'api/Requests/SendMail';

$route['api/calendar/send']                 =   'api/calendar/sendRequest';
$route['api/calendar/read']                 =   'api/calendar/readRequest';


$route['richieste/pagamento/paypal']        =   'payments/PayPal/GuestForm';