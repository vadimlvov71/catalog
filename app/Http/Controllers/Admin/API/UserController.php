<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function currentUser(Request $request)
    {
        // Возвращаем текущего залогиненного пользователя как JSON
        return response()->json($request->user());
    }
}