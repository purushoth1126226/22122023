<?php

namespace App\Http\Controllers\Admin\Api\Customer;

use App\Http\Controllers\Helper\BaseApiController;
use App\Http\Requests\Commonvalidation\Api\Common\SearchRequest;
use App\Repository\Admin\Api\Interfacelayer\Customer\IAdmincustomerApiRepository;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;

class AdmincustomerApiController extends BaseApiController
{

    public $admincustomerapi;

    public function __construct(IAdmincustomerApiRepository $admincustomerapi)
    {
        $this->admincustomerapi = $admincustomerapi;
    }

    public function adminsearchcustomer(SearchRequest $request)
    {
        try {
            return $this->callrepofuncion('admincustomerapi', 'adminsearchcustomer', null, false);

        } catch (Exception $e) {
            return $this->exceptionone(null, 'adminsearchcustomer', $e->getMessage(), false, 404);
        } catch (QueryException $e) {
            return $this->exceptiontwo(null, 'adminsearchcustomer', $e->getMessage(), false, 404);
        } catch (PDOException $e) {
            return $this->exceptionthree(null, 'adminsearchcustomer', $e->getMessage(), false, 404);
        }
    }

}
