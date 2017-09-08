<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Models\User;
//Rule Method
use App\Http\Requests\UserRequest;


use Models\fellowship;
use Models\verse;
use Input;
use Validator;
use Redirect;

class LoginController extends Controller
{
	//導入到登入畫面
	public function show()
	{
		return view('login.login');
	}

	//登入驗證程式部分
	public function login()
	{

	    $input = Input::all();
	    $test = Input::get('ACCOUNT');
	    \Debugbar::info($test);
	    $rules = ['email'=>'required|email',
	              'password'=>'required'
	              ];



	    $validator = Validator::make($input, $rules);
   		 if ($validator->passes()) 
   		 {
        		$attempt = Auth::attempt([
	            'email' => $input['email'],
	            'password' => $input['password']
	        	]);
	        if ($attempt) {
		            return Redirect::intended('post');
		        }
	        return Redirect::to('login')
		                ->withErrors(['fail'=>'Email or password is wrong!']);
	     }
	    //fails
		return 1;


	}

	public function logout()
	{
		Auth::logout();
    	return Redirect::to('login');

	}
}