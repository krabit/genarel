<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Front\NewsletterModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsLetterController extends Controller
{
    public function index(){
        return view('frontend.newsletter.index');
    }
    public function store(Request $request){

        $validatedData = $request->validate([
            'Email' => 'required',
           ]);

        $input = $request->all();


        $item = new NewsletterModel();

        $item->email = $input['Email'];



        $item->save();

        return redirect('/newsletter');


    }
}
