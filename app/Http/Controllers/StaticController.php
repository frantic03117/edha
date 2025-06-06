<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class StaticController extends Controller
{
    public static function getAllLinks()
    {
        $items = Category::with('subcategory')->get();
        return $items;
    }
}