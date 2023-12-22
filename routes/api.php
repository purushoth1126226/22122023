<?php

use App\Http\Controllers\Admin\Api\Auth\AdminlogoutApiController;
use App\Http\Controllers\Admin\Api\Auth\AdminpasswordloginApiController;
use App\Http\Controllers\Admin\Api\Customer\AdmincustomerApiController;
use App\Http\Controllers\Admin\Api\Faq\AdminfaqApiController;
use App\Http\Controllers\Admin\Api\Fcm\AdminfcmApiController;
use App\Http\Controllers\Admin\Api\Notification\AdminnotificationApiController;
use App\Http\Controllers\Admin\Api\Order\AdminorderhistoryApiController;
use App\Http\Controllers\Admin\Api\Productcategory\AdminproductcategoryApiController;
use App\Http\Controllers\Admin\Api\Product\AdminproductApiController;
use App\Http\Controllers\Admin\Api\Profile\AdminpofileApiController;
use App\Http\Controllers\Admin\Api\Support\AdminsupportApiController;
use Illuminate\Support\Facades\Route;

//AUTH
Route::group(['prefix' => 'v1/admin'], function () {
    // LOGIN
    Route::post('adminpasswordlogin', [AdminpasswordloginApiController::class, 'adminpasswordlogin']);
});

Route::group(['prefix' => 'v1/admin', 'middleware' => 'auth:api', 'scopes:admin'], function () {

    // PROFILE
    Route::controller(AdminpofileApiController::class)
        ->group(function () {
            Route::get('admingetprofile', 'admingetprofile');
            Route::post('adminupdateprofile', 'adminupdateprofile');
            Route::post('adminchangepassword', 'adminchangepassword');
            Route::post('adminchangeavatar', 'adminchangeavatar');
        });

    // DEVICE INFO
    Route::post('adminsavedeviceinfo', [AdminfcmApiController::class, 'adminsavedeviceinfo']);

    // SUPPORT
    Route::post('adminsupport', [AdminsupportApiController::class, 'adminsupport']);

    // FAQ
    Route::post('adminfaq', [AdminfaqApiController::class, 'adminfaq']);

    // LOGOUT
    Route::get('adminlogout', [AdminlogoutApiController::class, 'adminlogout']);

    // NOTIFICATION
    Route::get('adminnotification', [AdminnotificationApiController::class, 'adminnotification']);

    // CUSTOMER
    Route::post('adminsearchcustomer', [AdmincustomerApiController::class, 'adminsearchcustomer']);

    // PRODUCT CATEGORY
    Route::post('adminsearchproductcategory', [AdminproductcategoryApiController::class, 'adminsearchproductcategory']);

    // PRODUCT SEARCH
    Route::controller(AdminproductApiController::class)
        ->group(function () {
            Route::post('adminsearchproduct', 'adminsearchproduct');
            Route::post('adminoverallproductsearch', 'adminoverallproductsearch');
        });

    // PLACE ORDER
    Route::get('adminplaceorder', [AdminplaceorderApiController::class, 'adminplaceorder']);

    // ORDER HISTORY
    Route::controller(AdminorderhistoryApiController::class)
        ->group(function () {
            Route::post('adminyourorderhistory', 'adminyourorderhistory');
            Route::post('adminoverallorderhistory', 'adminoverallorderhistory');
        });

});
