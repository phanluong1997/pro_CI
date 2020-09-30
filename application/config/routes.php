<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
identification for dev
Hieu => OtMain
Thao => Ot1
Luong => Ot2
| -------------------------------------------------------------------------
*/
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
$route['default_controller'] = 'home';
$route['404_override'] = 'home/page404';
$route['translate_uri_dashes'] = FALSE;
// $route['404'] = 'home/page404';

//dashboard
$route['dashboard'] = 'dashboard/home';
$route['(dashboard/profile).html'] = 'dashboard/auths/profile';
$route['(dashboard/add-password).html'] = 'dashboard/auths/addPass';
$route['(dashboard/change-password).html'] = 'dashboard/auths/changePass';
$route['(dashboard/forget-password).html'] = 'dashboard/auths/forgetPass';
$route['(dashboard/message-update-password).html'] = 'dashboard/auths/updatePass';
$route['(dashboard/update-password).html/(:any)'] = 'dashboard/auths/updatePass';
$route['(dashboard/upload-identity-card).html'] = 'dashboard/auths/uploadIdentityCard';
$route['(dashboard/update-referent).html'] = 'dashboard/auths/updateReferent';

//dashboard - AuthsController (SignUp + checkEmail - Login + checkLogin...) - OT1
$route['(dashboard/SignUp).html'] = 'dashboard/auths/SignUp';
$route['(dashboard/checkEmail).html'] = 'dashboard/auths/checkEmail';
$route['(dashboard/update-profile).html'] = 'dashboard/auths/updateProfile';
$route['(dashboard/login).html'] = 'dashboard/auths/login';
$route['(dashboard/login-google).html'] = 'dashboard/auths/loginGoogle';
$route['(dashboard/checklogin).html'] = 'dashboard/auths/checklogin';
$route['(dashboard/logout).html'] = 'dashboard/auths/logout';
//dashboard notify - OTMain
$route['(dashboard/notify).html'] = 'dashboard/auths/notify';
$route['(dashboard/notify-forget-password).html'] = 'dashboard/auths/notifyForgetPass';
$route['(dashboard/active-account).html/(:any)'] = 'dashboard/auths/activeAccount';
$route['(dashboard/active-notify).html'] = 'dashboard/auths/activeNotify';

//dashboard - WithdrawController - OT1
$route['(dashboard/withdraw).html'] = 'dashboard/withdraw/Withdraw';
$route['(dashboard/checkamount).html'] = 'dashboard/withdraw/checkAmount';
$route['(dashboard/trans-to-pending).html/(:any)'] = 'dashboard/withdraw/transToPending';
$route['(dashboard/notify-withdraw).html'] = 'dashboard/withdraw/notifyWithDraw';
$route['(dashboard/trans-to-pending-success).html'] = 'dashboard/withdraw/notifyPendingSuccess';

//dashboard - AjaxController - OT1
$route['(dashboard/history-Withdraw).html'] = 'dashboard/ajax/get_historyWithdraw';
$route['(dashboard/get-Eth-AmountMin-CostWithdraw).html'] = 'dashboard/ajax/getETH_AmountMin_CostWithdraw';

//dashboard - transfer - OT2
$route['(dashboard/transfer).html'] = 'dashboard/transfer/Transfer';
$route['(dashboard/checkamountTransfer).html'] = 'dashboard/transfer/checkAmountTransfer';
// $route['(dashboard/checktransferto).html'] = 'dashboard/transfer/checkTransferto';

//admin
$route['cpanel'] = 'cpanel/home';
$route['(cpanel/login).html'] = 'cpanel/auths/login';
$route['(cpanel/logout).html'] = 'cpanel/auths/logout';


