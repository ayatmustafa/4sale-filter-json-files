<?php

namespace App\Services\DataProviders;

use App\Services\DataProviderAbstract;

class DataProviderYService extends DataProviderAbstract{
    protected $fileName = "DataProviderY.json";

    protected function filterByKey($key): string
    {
         $filter = [
            "statusCode" => "status",
            "currency"   => "currency",
            "balance"    => "balance"
        ];

        return $filter[$key] ?? '';
    }

    protected function GetStatusValue($status): int
    {
        $arrStatus = [
               "authorised" => 100,
               "decline"    => 200,
               "refunded"   => 300
        ];

        return $arrStatus[$status] ?? '';
    }

}
