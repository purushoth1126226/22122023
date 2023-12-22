<?php

namespace App\Http\Controllers\Admin\Api\Product;

use Exception;
use PDOException;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Helper\BaseApiController;
use App\Http\Requests\Admin\Api\Product\ProductRequest;
use App\Http\Requests\Commonvalidation\Api\Common\SearchRequest;
use App\Repository\Admin\Api\Interfacelayer\Product\IAdminproductApiRepository;

class AdminproductApiController extends BaseApiController
{

    public $adminproductapi;

    public function __construct(IAdminproductApiRepository $adminproductapi)
    {
        $this->adminproductapi = $adminproductapi;
    }

    public function adminsearchproduct(ProductRequest $request)
    {
        try {
            return $this->callrepofuncion('adminproductapi', 'adminsearchproduct', null, false);

        } catch (Exception $e) {
            return $this->exceptionone(null, 'adminsearchproduct', $e->getMessage(), false, 404);
        } catch (QueryException $e) {
            return $this->exceptiontwo(null, 'adminsearchproduct', $e->getMessage(), false, 404);
        } catch (PDOException $e) {
            return $this->exceptionthree(null, 'adminsearchproduct', $e->getMessage(), false, 404);
        }
    }

    public function adminoverallproductsearch(SearchRequest $request)
    {
        try {
            return $this->callrepofuncion('adminproductapi', 'adminoverallproductsearch', null, false);

        } catch (Exception $e) {
            return $this->exceptionone(null, 'adminsearchproduct', $e->getMessage(), false, 404);
        } catch (QueryException $e) {
            return $this->exceptiontwo(null, 'adminsearchproduct', $e->getMessage(), false, 404);
        } catch (PDOException $e) {
            return $this->exceptionthree(null, 'adminsearchproduct', $e->getMessage(), false, 404);
        }
    }

}
