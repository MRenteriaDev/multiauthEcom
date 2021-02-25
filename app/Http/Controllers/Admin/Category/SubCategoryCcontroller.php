<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SubCategoryCcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $category = DB::table('categories')->get();
        $subcat = DB::table('subcategories')
            ->join('categories', 'subcategories.category_id', 'categories.id')
            ->select('subcategories.*', 'categories.category_name')
            ->get();
        return view('admin.subcategory.index', compact('category', 'subcat'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required|max:50'
        ]);

        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;

        DB::table('subcategories')->insert($data);

        return Redirect()->back()->with('success', 'SubCategory successfully added');
    }

    public function delete($id)
    {
        DB::table('subcategories')->where('id', $id)->delete();

        return Redirect()->back()->with('success', 'Subcategory deleted successfully');
    }

    public function edit($id)
    {
        $subcat = DB::table('subcategories')->where('id', $id)->first();
        $category = DB::table('categories')->get();

        return view('admin.subcategory.edit', compact('subcat', 'category'));
    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        DB::table('subcategories')->where('id', $id)->update($data);

        return Redirect()->route('subcategory.index')->with('success', 'Subcategory added succesfully');
    }
}
