<?php

namespace App\Http\Controllers\Frontend;
/*use Illuminate\*/
use App\Model\Front\ShopProductModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopCartController extends Controller
{
    //
    public function index(){
        $data = array();

        $cartColection = \Cart::getContent();
       $data['cart_products']=$cartColection;

       $products = array();
       foreach ($cartColection as $p){
           $pid = $p->id;
           $products[$pid] = ShopProductModel::find($pid);
       }
        $data['products'] = $products;
        $data['total_payment'] = \Cart::getTotal();
        $data['total_qtt_cart'] = \Cart::getTotalQuantity();

        return view('frontend.cart.index', $data);
    }
    public function add(Request $request){

        $input = $request->all();

        $product_id= (int)$input['w3ls1_item'];
        $quantity = (int)$input['add'];


       $product =ShopProductModel::find($product_id);
        $response['status']=0;
        if(isset($product->id)){
            \Cart::add(array(
                'id'=>$product_id,
                'name'=>$product->name,
                'price'=>$product->priceSale,
                'quantity'=>$quantity,
                'attributes'=>array()
            ));
            $response['status']=1;
            session()->save();

        }
        echo json_encode($response);
        exit;

    }
    public function update(Request $request){



        $input = $request->all();

        $product_id= (int)$input['pid'];
        $qtt= (int)$input['quantity'];


        $product =ShopProductModel::find($product_id);
        $response['status']=0;
        if(isset($product->id)){
            \ Cart::update($product->id, array(
                'quantity' => $qtt,
            ));
            \Cart::update($product->id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $qtt,
                ),
            ));
            $response['status']=1;
            session()->save();

        }
        echo json_encode($response);
        exit;



    }
    public function remove(Request $request){

        $input = $request->all();

        $product_id= (int)$input['pid'];


        $product =ShopProductModel::find($product_id);
        $response['status']=0;
        if(isset($product->id)){
            \ Cart::remove($product->id);
            $response['status']=1;
            session()->save();

        }
        echo json_encode($response);
        exit;

    }
    public function clear(){
        \Cart::clear();

    }
}
