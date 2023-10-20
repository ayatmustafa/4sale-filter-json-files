<?php

namespace App\Http\Controllers;

use App\Services\DataProviders\DataProviderXService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function index(Request $request)
    {
        $users = resolve(DataProviderXService::class)->getUsersData($request->all());

        return response()->json([
            'status' => true,
            'data' => $users,
        ], 200);
    }
}
