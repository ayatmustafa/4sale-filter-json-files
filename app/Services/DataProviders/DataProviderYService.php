<?php

namespace App\Services\DataProviders;

use App\Enums\FilterEnum;
use App\Enums\ProvidesEnum;
use App\Enums\StatusEnum;
use App\Services\DataProviderAbstract;

class DataProviderYService extends DataProviderAbstract{
    protected $fileName = ProvidesEnum::DataProviderY;

    protected function filterByKey($key): string
    {
         $filter = [
            FilterEnum::StatusCode => "status",
            FilterEnum::Currency   => "currency",
            FilterEnum::Balance    => "balance"
        ];

        return $filter[$key] ?? '';
    }

    protected function GetStatusValue($status): int
    {

        $arrStatus = [
               StatusEnum::Authorised => 100,
               StatusEnum::Decline    => 200,
               StatusEnum::Refunded   => 300
        ];

        return $arrStatus[$status] ?? '';
    }

}
