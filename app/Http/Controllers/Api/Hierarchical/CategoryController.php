<?php

namespace App\Http\Controllers\Api\Hierarchical;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hierarchical\Category;
use App\Http\Resources\Hierarchical\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return CategoryResource::collection($categories);
    }
}
