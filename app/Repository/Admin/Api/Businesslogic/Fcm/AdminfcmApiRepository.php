<?php

namespace App\Repository\Admin\Api\Businesslogic\Fcm;

use App\Models\Miscellaneous\Trackmessagehelper;
use App\Repository\Admin\Api\Interfacelayer\Fcm\IAdminfcmApiRepository;

class AdminfcmApiRepository implements IAdminfcmApiRepository
{
    public function adminsavedeviceinfo()
    {
        $admin = auth()->user();

        $admin->update([
            'device_token' => request('device_token'),
            'device_model' => request('device_model'),
            'device_brand' => request('device_brand'),
            'device_manufacturer' => request('device_manufacturer'),
        ]);

        Trackmessagehelper::trackmessage($admin, $admin, 'admin_api_adminsavedeviceinfo', response()->apisessionid(), 'API', 'Admin Device Info');
        return [true, null, 'adminsavedeviceinfo'];
    }
}
