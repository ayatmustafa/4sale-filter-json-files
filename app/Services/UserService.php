<?php

namespace App\Services;

use App\Enums\ProvidesEnum;

class UserService{
    public function getAllUsersData($request = [])
    {
        $data = [];

        if(isset($request["provider"]))
        {

            return $this->getProviderData($request["provider"], $request);

        }else{
            foreach (array_keys(ProvidesEnum::getConstants()) as $classPreName)
            {
                $data[] = $this->getProviderData($classPreName, $request);
            }

            return collect($data)->flatten();
        }
    }

    private function getProviderData($provider, $request)
    {
        $classPrefix = "App\\Services\\DataProviders\\";    // class namespace prefix
        $fullyQualifiedClassName = $classPrefix . $provider . "Service";
        $providerObj = new $fullyQualifiedClassName();

        return $providerObj->getUsersData($request);
    }
}
