<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Admin');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Admin::index');
$routes->get('admin', 'Admin::index');
$routes->get('dashboard', 'Admin::dashboard');
$routes->get('logout', 'Admin::logout');
$routes->post('update_password', 'Admin::update_password');



//$routes->get('DeleteBanner', 'CompanyController::delete_image');

$routes->get('Notifications', 'NotificationController::index');
$routes->get('AddNotification', 'NotificationController::add_notification_form');
$routes->get('Notification_details', 'NotificationController::notification_details');
$routes->get('sendnotification', 'NotificationController::send_Notification');
$routes->get('NotificationDelete', 'NotificationController::delete_notification');





$routes->get('CustomOfferDetails', 'CustomOfferController::index');
$routes->get('AddCustomOffer', 'CustomOfferController::AddCustomOffer');
$routes->get('CustomOffer_Details', 'CustomOfferController::CustomOffer_Details');
$routes->get('EditCustomOffer', 'CustomOfferController::edit_Offer_details');
$routes->get('CustomOfferDelete', 'CustomOfferController::delete_customOffer');




$routes->get('ContactUs', 'Contact::index');
$routes->get('Contact', 'ApiContact::index');

$routes->Post('transaction', 'ApiTransaction::index');

$routes->get('Customers', 'CustomerController::Allcustomerlist');
$routes->get('Customer_List', 'CustomerController::customerlist');
$routes->get('VipCustomers', 'CustomerController::Vipcustomerlist');

$routes->get('AddCustomer', 'CustomerController::index');

$routes->get('EditCustomer', 'CustomerController::edit_customer');

$routes->get('CustomerDetails', 'CustomerController::customerdetails');

$routes->get('DeleteCustomer', 'CustomerController::delete_customer');

$routes->get('Dashboard', 'Admin::dashboard');
$routes->get('multipleImage', 'Form::multipleImage');

$routes->get('Form', 'Form::index');
//package detalis
$routes->get('package', 'Admin::package');
$routes->get('editpackage', 'Admin::edditpackage');

//BOUNSE
$routes->get('bounce', 'Admin::Bounce');
$routes->get('editbounce', 'Admin::edditBounce');

//admin charges
$routes->get('pointsharecharges', 'Admin::pointShareCharges');
$routes->get('editsharepoint', 'Admin::edditpointShareCharges');

//generate pin
$routes->get('genratepin', 'PinController::genratePin');
$routes->get('pinlist', 'PinController::index');
$routes->get('pinpreview', 'PinController::preview');

//purchase pin
$routes->get('purchasepin', 'PinController::purchasePin');
$routes->get('listpurchasepin', 'PinController::purchasePinList');
$routes->get('listpurchaserenewalpin', 'PinController::purchaseRenewalPinList');
$routes->get('linkslist', 'PinController::linkslist');
$routes->get('linkgenerate', 'PinController::linkGenerate');
 $routes->get('pintransfertouser', 'PinController::userTransferPin');
 $routes->get('listpintransfertouser', 'PinController::userTransferPinList');


  $routes->get('adminpintransfertouser', 'PinController::userTransferPinbyadmin');
  $routes->get('adminlistpintransfertouser', 'PinController::adminuserTransferPinbyadmin');


/// Transaction 

$routes->get('viewtransaction', 'TransactionController::index');
$routes->get('previewtransaction', 'TransactionController::preview');
$routes->get('invoicetransaction', 'TransactionController::invoice');
$routes->get('invoice', 'InvoiceController::index');
$routes->get('invoicetransactionpdf', 'TransactionController::downloadPDF');


$routes->get('reports', 'ReportController::index');
$routes->get('transactionreport', 'ReportController::TransactionReport');
$routes->get('pointreport', 'ReportController::PointsReport');

///Wallet System

$routes->get('wallethistory', 'WalletSystem::index');
$routes->get('pointshere', 'WalletSystem::sharePoints');
$routes->get('pointsherelist', 'WalletSystem::sharePointslist');
$routes->get('adminpointshere', 'WalletSystem::adminSharePoints');
$routes->get('adminpointsherelist', 'WalletSystem::adminSharePointslist');

$routes->get('withdrawpoint', 'WalletSystem::withdrawPoint');



///profile
$routes->get('Profile', 'Profile::index');



//Reward
$routes->get('rewardlist', 'Reward::index');
$routes->get('addreward', 'Reward::add');


$routes->get('awardlist', 'Award::index');
$routes->get('addaward', 'Award::add');

$routes->get('awardrewardclaimlist', 'OffersClaim::index');
$routes->get('userawardrewardclaimlist', 'OffersClaim::userList');

//referral team
$routes->get('referralfTeam', 'CustomerController::refferalTeam');
$routes->get('Refferal/(:any)', 'Invite::socialLink/$1');


$routes->get('userawardlist', 'Award::userlist');
$routes->get('userrewardlist', 'Reward::userlist');

// identity card

$routes->get('addform', 'IdentityController::index');
$routes->match(['get', 'post'],'save', 'IdentityController::save_data');
$routes->get('card_list', 'IdentityController::card_history');
$routes->match(['get', 'post'],'idcard', 'IdentityController::idcard');

//KYC
$routes->get('userkyc', 'KycController::index');
$routes->post('savekyc', 'KycController::saveKyc');
$routes->get('kyclist', 'KycController::adminKycList');
$routes->get('delkyc', 'KycController::delKyc');

$routes->get('admin_brochure', 'BrochureController::adminBrochure');
$routes->get('user_brochure', 'BrochureController::userBrochure');

$routes->get('admin_pamphlet', 'PamphletController::adminPamphlet');
$routes->get('user_pamphlet', 'PamphletController::userPamphlet');

$routes->get('admin_booklet', 'BookletController::adminBooklet');
$routes->get('user_booklet', 'BookletController::userBooklet');

//Feedback
$routes->get('addfeedback', 'FeedbackController::userAddFeedback');
$routes->get('userfeedbacklist', 'FeedbackController::userFeedbackList');
$routes->get('adminfeedbacklists', 'FeedbackController::index');


// GST
$routes->get('GST', 'Admin::gstlist');
$routes->get('editGST', 'Admin::edditgstlist');


$routes->get('TDS', 'Admin::tdslist');
$routes->get('editTDS', 'Admin::eddittdslist');


// active team list

$routes->get('activeteam', 'Admin::activeTeam');


// subscriptionExpired CRON

$routes->get('subscriptionexpired', 'Cronjob::subscriptionExpired');


// staff management
$routes->get('liststaff', 'StaffController::index');
$routes->get('addstaff', 'StaffController::add');





/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
