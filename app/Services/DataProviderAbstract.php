<?php

namespace App\Services;

use App\Enums\FilterEnum;
use App\Enums\ProvidesEnum;

abstract class DataProviderAbstract{

    private string $fileName;
    private string $storageDataPath;

    abstract protected  function filterByKey($key): string;

    abstract protected function GetStatusValue($status): int;

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function setFileName($provider): void
    {
        $this->fileName = constant(get_class(new ProvidesEnum()) . "::" . $provider);
    }

    public function getStorageDataPath(): string
    {
        return $this->storageDataPath ?? "dataProviders/";
    }

    public function setStorageDataPath($env): void
    {
         $this->storageDataPath = ( $env == "testing" ? "dataProviders/tests/" : "dataProviders/" );
    }

    public function getUsersData($request)
    {
        $data = json_decode(file_get_contents(storage_path($this->getStorageDataPath() . $this->getFileName())))->users;

        return $this->filter(collect($data), $request);
    }

    public function filter($dataCollection, $request)
    {
        foreach ($request as $key=>$value)
            {
                if($dataCollection) {
                    if($key && !empty($this->filterByKey($key))) {
                        if($key == FilterEnum::StatusCode) {
                            $dataCollection = $dataCollection->where($this->filterByKey($key), $this->GetStatusValue($value));
                        }else{
                            $dataCollection = $dataCollection->where($this->filterByKey($key), $value);
                        }

                    }else{
                        $this->balanceCustomFilter($dataCollection, $key, $value);
                    }
                }
            }

        return $dataCollection;
    }

    public function balanceCustomFilter(&$dataCollection, $filter, $value)
    {
        if($filter == "balanceMin") {
            $dataCollection = $dataCollection->where($this->filterByKey('balance'), '>=', $value);
        }
        if($filter == "balanceMax") {
            $dataCollection = $dataCollection->where($this->filterByKey('balance'), '<=', $value);
        }
    }
}
