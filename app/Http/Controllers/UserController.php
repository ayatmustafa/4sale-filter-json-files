<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\DataProviders\DataProviderXService;
use App\Services\DataProviderService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function index(UserRequest $request, $env = "development")
    {
        $service = new DataProviderService();
        $service->setEnv($env);
        $users = $service->getAllUsersData($request->validated());

        return response()->json([
            'Status' => true,
            'Count'  => $users->count(),
            'Data'   => $users,
        ], 200);
    }
}
