<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\BannerModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){


        $items = DB::table('banners')->paginate(10);

        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();
        $data['banners'] = $items;

        return view('admin.content.banners.index', $data);
    }
    public function create(){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();
        $data['locations'] = BannerModel::getBannerLocations();


        return view('admin.content.banners.submit', $data);

    }

    public function edit($id){
        $data = array();


        $item = BannerModel::find($id);
        $data['banner'] = $item;
        $data['locations'] = BannerModel::getBannerLocations();

        return view('admin.content.banners.edit', $data);

    }

    public function delete($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();

        $item = BannerModel::find($id);
        $data['banner'] = $item;

        return view('admin.content.banners.delete', $data);

    }
    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'link' => 'required',
            'image' => 'required',
            ]);

        $input = $request->all();


        $item = new BannerModel();

        $item->name = $input['name'];
        $item->images = isset($input['image']) ? json_encode($input['image']) : '';
        $item->link = $input['link'];
        $item->location_id = isset($input['location_id']) ? $input['location_id'] :'';
        $item->intro = isset($input['intro']) ? $input['intro'] :'';
        $item->desc = isset($input['desc']) ? $input['desc'] :'';



        $item->save();

        return redirect('/admin/banners');

    }

    public function update(Request $request,$id){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'link' => 'required',
            'image' => 'required',
        ]);

        $input = $request->all();

        $item = BannerModel::find($id);
        $item->name = $input['name'];
        $item->image = isset($input['image']) ? json_encode($input['image']) : '';
        $item->link = $input['link'];
        $item->location_id = isset($input['location_id']) ? $input['location_id'] :'';
        $item->intro = isset($input['intro']) ? $input['intro'] :'';
        $item->desc = isset($input['desc']) ? $input['desc'] :'';


        $item->save();

        return redirect('/admin/banners');

    }

    public function destroy($id){
        $item = BannerModel::find($id);

        $item->delete();

        return redirect('/admin/banners');

    }


}