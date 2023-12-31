<?php

namespace App\Services\DataProviders;

use App\Enums\FilterEnum;
use App\Enums\StatusEnum;
use App\Services\DataProviderAbstract;

class DataProviderXService extends DataProviderAbstract{

    Public function filterByKey($key): string
    {
         $filter = [
             FilterEnum::StatusCode => "statusCode",
             FilterEnum::Currency   => "Currency",
             FilterEnum::Balance    => "parentAmount",
             FilterEnum::Email      => "parentEmail",
             FilterEnum::CreatedAt  => "registerationDate",
             FilterEnum::Id         => "parentIdentification"
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
