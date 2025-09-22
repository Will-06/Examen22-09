<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::included()
            ->filter()
            ->getOrPaginate();

        return response()->json($roles);
    }

    public function show($id)
    {
        $role = Role::included()->findOrFail($id);

        return response()->json($role);
    }
}
