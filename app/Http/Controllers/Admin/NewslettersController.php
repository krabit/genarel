<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\NewslettersModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NewslettersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $items = DB::table('newsletters')->paginate(10);

        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();
        $data['newsletters'] = $items;


        return view('admin.content.newletters.index', $data);
    }
    public function create(){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();


        return view('admin.content.newletters.submit', $data);

    }

    public function edit($id){
        $data = array();


        $item = NewslettersModel::find($id);
        $data['newsletters'] = $item;


        return view('admin.content.newletters.edit', $data);

    }

    public function delete($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();

        $item = NewslettersModel::find($id);
        $data['newsletters'] = $item;

        return view('admin.content.newletters.delete', $data);

    }
    public function store(Request $request){

        $validatedData = $request->validate([
            'email' => 'required',
            ]);

        $input = $request->all();


        $item = new NewslettersModel();

        $item->email = $input['email'];

        $item->save();

        return redirect('/admin/newletters');

    }

    public function update(Request $request,$id){

        $validatedData = $request->validate([
            'email' => 'required',
        ]);

        $input = $request->all();

        $item = NewslettersModel::find($id);
        $item->email = $input['email'];
        $item->save();

        return redirect('/admin/newletters');

    }

    public function destroy($id){
        $item = NewslettersModel::find($id);

        $item->delete();

        return redirect('/admin/newletters');

    }



}
