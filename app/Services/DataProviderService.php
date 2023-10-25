<?php

namespace App\Services;

use App\Enums\FilterEnum;
use App\Enums\ProvidesEnum;

class DataProviderService{

    private $providerObj, $provider;
    private string $env ;

    public function getEnv(): string
    {
        return $this->env;
    }

    public function setEnv($env): void
    {
        $this->env = $env;
    }

    public function getAllUsersData($request = [])
    {
        $data = [];

        if(isset($request["provider"])) {

            return paginate($this->dataMapper($this->getProviderData($request["provider"], $request)), config('app.numberOfItemsPerPage'));
        }else{
            foreach (array_keys(ProvidesEnum::getConstants()) as $classPreName)
            {
                $users  = $this->getProviderData($classPreName, $request);
                $data[] = $this->dataMapper($users);
            }

            return  paginate(collect($data)->flatten(1),  config('app.numberOfItemsPerPage'));
        }
    }

    //get data per provider as it's filed filter if exist in request
    private function getProviderData($provider, $request)
    {
        $classPrefix = "App\\Services\\DataProviders\\";    // class namespace prefix
        $this->provider = $provider;
        $fullyQualifiedClassName = $classPrefix . $provider . "Service";
        $this->providerObj = new $fullyQualifiedClassName();
        $this->providerObj->setFileName($provider);
        $this->providerObj->setStorageDataPath($this->getEnv());

        return $this->providerObj->getUsersData($request);
    }

    //mapping data as common filter for it's own fields and unset what it's refer from it's own
    private function dataMapper($users)
    {
        return $users->map(function ($item) {

            foreach (FilterEnum::getConstants() as $key => $filter)
            {
                $filed = $this->providerObj->filterByKey($filter);
                $item = (array) $item;
                $item[$this->provider]['Provider'] = $this->provider;
                $item[$this->provider][$key] = $item[$filed];
                unset($item[$filed]);
            }

            return $item[$this->provider];

        });
    }

}
