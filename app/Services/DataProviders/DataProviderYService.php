<?php

namespace App\Services\DataProviders;

use App\Enums\FilterEnum;
use App\Enums\StatusEnum;
use App\Services\DataProviderAbstract;

class DataProviderYService extends DataProviderAbstract{

    public function filterByKey($key): string
    {
         $filter = [
            FilterEnum::StatusCode => "status",
            FilterEnum::Currency   => "currency",
            FilterEnum::Balance    => "balance",
            FilterEnum::Email      => "email",
            FilterEnum::CreatedAt  => "created_at",
            FilterEnum::Id         => "id"
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
