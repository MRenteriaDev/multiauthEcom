<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $coupons =  DB::table('coupons')->get();
        return view('admin.coupon.index', compact('coupons'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'coupon' => 'required|min:2|max:50|unique:coupons',
            'discount' => 'required'
        ]);

        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;

        DB::table('coupons')->insert($data);
        return Redirect()->back()->with('success', 'Coupon Added Succesfully');
    }

    public function edit($id)
    {
        $coupon = DB::table('coupons')->where('id', $id)->first();
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'coupon' => 'required|min:2|max:50|unique:coupons',
            'discount' => 'required'
        ]);

        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;

        DB::table('coupons')->where('id', $id)->update($data);

        return Redirect()->route('coupon.index')->with('success', 'Coupon Edited Successfully');
    }

    public function delete($id)
    {
        DB::table('coupons')->where('id', $id)->delete();

        return Redirect()->back()->with('success', 'Coupon Deleted Succesfully');
    }
}
