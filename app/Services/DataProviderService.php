<?php

namespace App\Services;

use App\Enums\FilterEnum;
use App\Enums\ProvidesEnum;

class DataProviderService{

    private $providerObj;
    public function getAllUsersData($request = [])
    {
        $data = [];

        if(isset($request["provider"])) {
            return $this->mappingData($this->getProviderData($request["provider"], $request));
        }else{
            foreach (array_keys(ProvidesEnum::getConstants()) as $classPreName)
            {
                $users  = $this->getProviderData($classPreName, $request);
                $data[] = $this->mappingData($users);
            }
            return  collect($data)->flatten(1);
        }
    }

    //get data per provider as it's filed filter if exist in request
    private function getProviderData($provider, $request)
    {
        $classPrefix = "App\\Services\\DataProviders\\";    // class namespace prefix
        $fullyQualifiedClassName = $classPrefix . $provider . "Service";
        $this->providerObj = new $fullyQualifiedClassName();
        $this->providerObj->setFileName($provider);

        return $this->providerObj->getUsersData($request);
    }

    //mapping data as common filter for it's own fields and unset what it's refer from it's own
    private function mappingData($users)
    {
        return $users->map(function ($item) {

            foreach (FilterEnum::getConstants() as $key => $filter)
            {
                $filed = $this->providerObj->filterByKey($filter);
                $item = (array) $item;
                $item[$key] = $item[$filed] ?? "";
                unset($item[$filed] );
            }

            return $item;
        }
        );
    }

}
