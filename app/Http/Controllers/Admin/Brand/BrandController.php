<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\Model\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $brands = Brand::all();
        return  view('admin.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|min:2|max:15|unique:brands',
            'brand_logo' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $image = $request->file('brand_logo');
        if ($image) {
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalName());
            $image_full_name = $image_name . $ext;
            $upload_path = 'public/media/brand/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);

            $data['brand_logo'] = $image_url;
            $update = DB::table('brands')->insert($data);

            return Redirect()->route('brand.index')->with('success', 'Brand Created Succesfully');
        }
    }

    public function edit($id)
    {
        $brand = Brand::find($id);

        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|min:2|max:15|unique:brands',
            'brand_logo' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        $old_logo = $request->old_logo;
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $image = $request->file('brand_logo');
        if ($image) {
            unlink($old_logo);
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalName());
            $image_full_name = $image_name . $ext;
            $upload_path = 'public/media/brand/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);

            $data['brand_logo'] = $image_url;
            $brand = DB::table('brands')->where('id', $id)->update($data);

            return Redirect()->route('brand.index')->with('success', 'Brand Updated Succesfully');
        }
    }

    public function delete($id)
    {
        $data = DB::table('brands')->where('id', $id)->first();
        $image = $data->brand_logo;
        unlink($image);
        $brand = DB::table('brands')->where('id', $id)->delete();

        return Redirect()->route('brand.index')->with('success', 'Brand Deleted Succesfully');
    }
}
