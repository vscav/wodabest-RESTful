<?php

namespace App\Http\Controllers;

use App\Category as Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Retrieve all categories from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $categories = Category::all();
        
            return response()->json($categories);
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }
}
