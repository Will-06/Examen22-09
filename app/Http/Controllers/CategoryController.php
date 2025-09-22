<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::included()
            ->filter()
            ->getOrPaginate();

        return response()->json($categories);
    }


    public function show($id)
    {
        $category = Category::included()->findOrFail($id);

        return response()->json($category);
    }
}
