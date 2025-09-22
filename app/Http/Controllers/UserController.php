<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::included()
            ->filter()
            ->getOrPaginate();

        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::included()->findOrFail($id);

        return response()->json($user);
    }
}
