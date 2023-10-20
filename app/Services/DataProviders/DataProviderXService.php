<?php

namespace App\Services\DataProviders;

use App\Services\DataProviderAbstract;

class DataProviderXService extends DataProviderAbstract{
    protected $fileName = "DataProviderX.json";

    protected function filterByKey($key): string
    {
         $filter = [
            "statusCode" => "statusCode",
            "currency"   => "Currency",
            "balance"    => "parentAmount"
        ];

        return $filter[$key] ?? '';
    }

    protected function GetStatusValue($status): int
    {
        $arrStatus = [
               "authorised" => 1,
               "decline"    => 2,
               "refunded"   => 3
        ];

        return $arrStatus[$status] ?? '';
    }

}
