<?php

namespace App\Http\Controllers\Admin\Api\Order;

use App\Http\Controllers\Helper\BaseApiController;
use Exception;
use Illuminate\Database\QueryException;
use PDOException;

class AdminplaceorderApiController extends BaseApiController
{

    public $placeorder;

    public function __construct(IAdminplaceorderApiRepository $placeorder)
    {
        $this->placeorder = $placeorder;
    }

    public function individualhistory()
    {
        try {
            return $this->callrepofuncion('placeorder', 'individualhistory', null, true);

        } catch (Exception $e) {
            return $this->exceptionone(null, 'individualhistory', $e->getMessage(), true, 404);
        } catch (QueryException $e) {
            return $this->exceptiontwo(null, 'individualhistory', $e->getMessage(), true, 404);
        } catch (PDOException $e) {
            return $this->exceptionthree(null, 'individualhistory', $e->getMessage(), true, 404);
        }
    }

}
