<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\DataProviders\DataProviderXService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function index(UserRequest $request)
    {
        $users = resolve(UserService::class)->getAllUsersData($request->validated());

        return response()->json([
            'status' => true,
            'data' => $users,
        ], 200);
    }
}
