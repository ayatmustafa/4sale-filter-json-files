<?php

namespace App\Services;

abstract class DataProviderAbstract{
    abstract protected  function filterByKey($key): string;

    abstract protected function GetStatusValue($status): int;


    public function getUsersData($request = [])
    {
        $data = json_decode(file_get_contents(database_path("dataproviders/".$this->fileName)))->users;

        return $this->filter(collect($data), $request);
    }

    public function filter($dataCollection, $request)
    {
        foreach ($request as $key=>$value)
            {
                if($key && !empty($this->filterByKey($key)))
                {
                    if($key == "statusCode")
                    {
                        $dataCollection = $dataCollection->where($this->filterByKey($key), $this->GetStatusValue($value));
                    }else{
                        $dataCollection = $dataCollection->where($this->filterByKey($key), $value);
                    }

                }else{
                    $this->balanceCustomFilter($dataCollection, $key, $value);
                }
            }

        return $dataCollection;
    }

    public function balanceCustomFilter(&$dataCollection, $filter, $value)
    {
        if($filter == "balanceMin" && $dataCollection)
        {
            $dataCollection = $dataCollection->where($this->filterByKey('balance'), '>=', $value);
        }
        if($filter == "balanceMax" && $dataCollection)
        {
            $dataCollection = $dataCollection->where($this->filterByKey('balance'), '<=', $value);
        }
    }
}
