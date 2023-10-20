<?php

namespace App\Services\DataProviders;

use App\Enums\FilterEnum;
use App\Enums\ProvidesEnum;
use App\Enums\StatusEnum;
use App\Services\DataProviderAbstract;

class DataProviderXService extends DataProviderAbstract{
    protected $fileName = ProvidesEnum::DataProviderX;

    protected function filterByKey($key): string
    {
         $filter = [
             FilterEnum::StatusCode => "statusCode",
             FilterEnum::Currency   => "Currency",
             FilterEnum::Balance    => "parentAmount"
        ];

        return $filter[$key] ?? '';
    }

    protected function GetStatusValue($status): int
    {

        $arrStatus = [
            StatusEnum::Authorised => 1,
            StatusEnum::Decline    => 2,
            StatusEnum::Refunded   => 3
        ];

        return $arrStatus[$status] ?? '';
    }

}
