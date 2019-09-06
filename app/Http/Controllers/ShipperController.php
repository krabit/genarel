<?php

namespace App\Http\Controllers;

use App\Model\Admin\ShopOrderModel;
use App\Model\ShipperModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ShipperController extends Controller
{
    //


    /**
     * Hàm khởi tạo của class được chạy ngay khi khởi tạo đổi tượng
     * Hàm này nó luôn được chạy trước các hàm khác trong class
     * SellerController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:shipper')->only('index');
    }


    /**
     * Phương thức trả về view khi đăng nhập shipper thành công
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {

        $data= array();
        $data['orders']=DB::table('orders')->where('status','<=','1')->orderBy('id','desc')->get();
        if (Auth::check()){
            $name = Auth::guard('shipper')->email;
            echo $name;
        }{
            echo 'null';
        }


        return view('shipper.dashboard',$data);
    }


    /**
     * Phương thức trả về view dùng để đăng ký tài khoản seller
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        return view('shipper.auth.register');
    }



    public function join($id) {
        $data= array();
        $item = ShopOrderModel::find($id);
        $data['order']= $item;
        return view('shipper.shipper', $data);
    }




    public function store(Request $request) {

        // validate dữ liệu được gửi từ form đi
        $this->validate($request, array(
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'permission' => 'required'
        ));

        // Khởi tạo model để lưu admin mới
        $sellerModel = new ShipperModel();
        $sellerModel->name = $request->name;
        $sellerModel->email = $request->email;
        $sellerModel->permission = $request->permission;
        $sellerModel->password = bcrypt($request->password);
        $sellerModel->save();

        return redirect()->route('shipper.auth.login');
    }

    public function add(Request $request,$id){


        $item = ShopOrderModel::find($id);
        $this->validate($request, array(
            'name' => 'required',
        ));


        $item->shipper = $request->name;
        $item->status = 2;
        $item->save();


        return redirect('/shipper');
    }
    public function finish($id){
        $item = ShopOrderModel::find($id);
        $item->status = 3;
        $item->save();
    }


}
