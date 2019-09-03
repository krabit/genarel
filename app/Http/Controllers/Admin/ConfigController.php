<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ConfigModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $items = ConfigModel::all();

        $config= array();
        $config[]='web_name';
        $config[]='header_logo';
        $config[]='footer_logo';
        $config[]='intro';
        $config[]='desc';

        $default = array();

        foreach ($items as $item){
            $key = $item->name;
            $default[$key] =$item->value;
        }

        foreach ($config as $item_config){
            if (!isset($default[$item_config])){
                $default[$item_config]='';
            }
        }

        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data = array();
        $data['configs'] = $default;


        return view('admin.content.config.index', $data);
    }


    public function store(Request $request){

        $input = $request->all();


        $config= array();
        $config[]='web_name';
        $config[]='header_logo';
        $config[]='footer_logo';
        $config[]='intro';
        $config[]='desc';


       foreach ($config as $item_config){

            $record = ConfigModel::where('name', $item_config)->first();

            if (isset($record->id)){
                $item =ConfigModel::find($record->id);
                $item->value = isset($input[$item_config]) ? $input[$item_config] :'';
                $item->default= '';
                $item->save();
            } else{
                $item = new ConfigModel();
                $item->name = $item_config;
                $item->value = isset($input[$item_config]) ? $input[$item_config] :'';
                $item->default= '';
                $item->save();
            }

        }



        return redirect('/admin/config');
    }
}
