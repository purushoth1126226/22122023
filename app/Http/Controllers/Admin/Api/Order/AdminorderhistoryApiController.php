<?php

namespace App\Http\Controllers\Admin\Api\Order;

use App\Http\Controllers\Helper\BaseApiController;
use App\Repository\Admin\Api\Interfacelayer\Order\IOrderhistoryApiRepository;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;

class AdminorderhistoryApiController extends BaseApiController
{

    public $orderhistory;

    public function __construct(IOrderhistoryApiRepository $orderhistory)
    {
        $this->orderhistory = $orderhistory;
    }

    public function individualhistory()
    {
        try {
            return $this->callrepofuncion('orderhistory', 'individualhistory', null, false);

        } catch (Exception $e) {
            return $this->exceptionone(null, 'individualhistory', $e->getMessage(), false, 404);
        } catch (QueryException $e) {
            return $this->exceptiontwo(null, 'individualhistory', $e->getMessage(), false, 404);
        } catch (PDOException $e) {
            return $this->exceptionthree(null, 'individualhistory', $e->getMessage(), false, 404);
        }
    }

    public function overallhistory()
    {
        try {
            return $this->callrepofuncion('orderhistory', 'overallhistory', null, false);

        } catch (Exception $e) {
            return $this->exceptionone(null, 'overallhistory', $e->getMessage(), false, 404);
        } catch (QueryException $e) {
            return $this->exceptiontwo(null, 'overallhistory', $e->getMessage(), false, 404);
        } catch (PDOException $e) {
            return $this->exceptionthree(null, 'overallhistory', $e->getMessage(), false, 404);
        }
    }

}
