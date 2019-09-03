<?php

namespace App\Http\Controllers\Admin;


use App\Model\Admin\MenuModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

        $locations = MenuModel::getMenuLocations();
        view()->share('locations', $locations);
    }

    public function index(){

        $items = DB::table('menu')->paginate(10);

        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();
        $data['menus'] = $items;

        return view('admin.content.menu.index', $data);

    }

    public function create(){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();


        return view('admin.content.menu.submit', $data);

    }
    public function slugify($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }


    public function edit($id){
        $data = array();


        $item = MenuModel::find($id);
        $data['menu'] = $item;

        return view('admin.content.menu.edit', $data);

    }

    public function delete($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();

        $item = MenuModel::find($id);
        $data['menu'] = $item;

        return view('admin.content.menu.delete', $data);

    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            //'slug' => 'required',
            'desc' => 'required',
            'location' => 'required',

        ]);

        $input = $request->all();


        $item = new MenuModel();

        $item->name = $input['name'];
        $item->slug =  $input['slug'] ? $this->slugify($input['slug']) : $this->slugify($input['name']);
        $item->desc = $input['desc'];
        $item->location = isset($input['location']) ? $input['location']: 0;


        $item->save();

        return redirect('/admin/menu');

    }

    public function update(Request $request,$id){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            //'slug' => 'required',
            'desc' => 'required',
            'location' => 'required',
        ]);

        $input = $request->all();

        $item = MenuModel::find($id);

        $item->name = $input['name'];
        $item->slug = $input['slug'] ? $this->slugify($input['slug']) : $this->slugify($input['name']);
        $item->desc = $input['desc'];
        $item->location = isset($input['location']) ? $input['location']: 0;



        $item->save();

        return redirect('/admin/menu');

    }

    public function destroy($id){
        $item = MenuModel::find($id);

        $item->delete();

        return redirect('/admin/menu');

    }

}
