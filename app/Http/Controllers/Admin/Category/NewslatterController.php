<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class NewslatterController extends Controller
{

    public function index()
    {
        $newslatters = DB::table('newslatters')->get();
        return view('admin.newslatter.index', compact('newslatters'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email'
        ]);

        $data = array();
        $data['email'] = $request->email;

        DB::table('newslatters')->insert($data);

        return Redirect()->route('home')->with('success', 'Subscribe succesfully');
    }

    public function delete($id)
    {
        DB::table('newslatters')->where('id', $id)->delete();
        return Redirect()->back()->with('success', 'Newslatter Deleted Succesfully');
    }
}
