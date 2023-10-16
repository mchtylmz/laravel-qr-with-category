<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest();
        if ($search = request('q')) {
            $categories->where('name','LIKE',"%{$search}%");
        }
        $categories = $categories->paginate(15);

        return view('category.index', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        if (empty($request->name)) {
            return response()->json([
                'message' => 'Kategori Adı zorunludur!'
            ], 400);
        }

        Category::create([
            'name' => $request->name
        ]);

        return response()->json([
            'message' => 'Kategori başarıyla eklendi!'
        ]);
    }
    public function delete(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Kategori başarıyla silindi!'
        ]);
    }
}
