<?php

namespace App\Services;

use App\Enums\ProvidesEnum;

class UserService{
    public function getAllUsersData($request = [])
    {
        $classPrefix = "App\\Services\\DataProviders\\";    // class namespace prefix
        $data = [];

        if(isset($request["provider"]))
        {
            $fullyQualifiedClassName = $classPrefix . $request["provider"]. "Service";
            $providerObj = new $fullyQualifiedClassName();

            return $providerObj->getUsersData($request);

        }else{
            foreach (array_keys(ProvidesEnum::getConstants()) as $classPreName)
            {
                $fullyQualifiedClassName = $classPrefix . $classPreName. "Service";
                $providerObj = new $fullyQualifiedClassName();
                $data[] = $providerObj->getUsersData($request);
            }

            return collect($data)->flatten();
        }
    }
}
