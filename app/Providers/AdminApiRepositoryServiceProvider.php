<?php

namespace App\Providers;

use App\Repository\Admin\Api\Businesslogic\Auth\AdminlogoutApiRepository;
use App\Repository\Admin\Api\Businesslogic\Auth\AdminpasswordloginApiRepository;
use App\Repository\Admin\Api\Businesslogic\Customer\AdmincustomerApiRepository;
use App\Repository\Admin\Api\Businesslogic\Faq\AdminfaqApiRepository;
use App\Repository\Admin\Api\Businesslogic\Fcm\AdminfcmApiRepository;
use App\Repository\Admin\Api\Businesslogic\Notification\AdminnotificationApiRepository;
use App\Repository\Admin\Api\Businesslogic\Order\OrderhistoryApiRepository;
use App\Repository\Admin\Api\Businesslogic\Productcategory\AdminproductcategoryApiRepository;
use App\Repository\Admin\Api\Businesslogic\Product\AdminproductApiRepository;
use App\Repository\Admin\Api\Businesslogic\Profile\AdminprofileApiRepository;
use App\Repository\Admin\Api\Businesslogic\Support\AdminsupportApiRepository;
use App\Repository\Admin\Api\Interfacelayer\Auth\IAdminlogoutApiRepository;
use App\Repository\Admin\Api\Interfacelayer\Auth\IAdminpasswordloginApiRepository;
use App\Repository\Admin\Api\Interfacelayer\Customer\IAdmincustomerApiRepository;
use App\Repository\Admin\Api\Interfacelayer\Faq\IAdminfaqApiRepository;
use App\Repository\Admin\Api\Interfacelayer\Fcm\IAdminfcmApiRepository;
use App\Repository\Admin\Api\Interfacelayer\Notification\IAdminnotificationApiRepository;
use App\Repository\Admin\Api\Interfacelayer\Order\IOrderhistoryApiRepository;
use App\Repository\Admin\Api\Interfacelayer\Productcategory\IAdminproductcategoryApiRepository;
use App\Repository\Admin\Api\Interfacelayer\Product\IAdminproductApiRepository;
use App\Repository\Admin\Api\Interfacelayer\Profile\IAdminprofileApiRepository;
use App\Repository\Admin\Api\Interfacelayer\Support\IAdminsupportApiRepository;
use Illuminate\Support\ServiceProvider;

class AdminApiRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        // LOGIN
        $this->app->bind(IAdminpasswordloginApiRepository::class, AdminpasswordloginApiRepository::class);

        //LOGOUT
        $this->app->bind(IAdminlogoutApiRepository::class, AdminlogoutApiRepository::class);

        //FAQ
        $this->app->bind(IAdminfaqApiRepository::class, AdminfaqApiRepository::class);

        //FCM
        $this->app->bind(IAdminfcmApiRepository::class, AdminfcmApiRepository::class);

        //NOTIFICATION
        $this->app->bind(IAdminnotificationApiRepository::class, AdminnotificationApiRepository::class);

        //PROFILE
        $this->app->bind(IAdminprofileApiRepository::class, AdminprofileApiRepository::class);

        //SUPPORT
        $this->app->bind(IAdminsupportApiRepository::class, AdminsupportApiRepository::class);

        //CUSTOMER
        $this->app->bind(IAdmincustomerApiRepository::class, AdmincustomerApiRepository::class);

        //PRODUCT CATEGORY
        $this->app->bind(IAdminproductcategoryApiRepository::class, AdminproductcategoryApiRepository::class);

        //PRODUCT
        $this->app->bind(IAdminproductApiRepository::class, AdminproductApiRepository::class);

        //ORDER HISTORY
        $this->app->bind(IOrderhistoryApiRepository::class, OrderhistoryApiRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
