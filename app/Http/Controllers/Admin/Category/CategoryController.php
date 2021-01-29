<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Model\Admin\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|min:2|max:20|unique:categories'
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->created_at = Carbon::now();
        $category->save();


        return Redirect()->route('category.index')->with('success', 'Category Added Succesfully');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|min:2|max:20|unique:categories'
        ]);

        $data = array();
        $data['category_name'] = $request->category_name;
        $update = DB::table('categories')->where('id', $id)->update($data);

        return Redirect()->route('category.index')->with('success', 'Category Updated Succesfully');
    }

    public function delete($id)
    {
        Category::find($id)->delete();

        return Redirect()->route('category.index')->with('success', 'Category Deleted Succesfully');
    }
}
