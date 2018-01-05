<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    
    public function postSignUp(Request $request){
    	
    	//validamos los datos
    	$this->validate($request, [
        	'email' => 'required|unique:users',
        	'first_name' => 'required',
        	'password' => 'required',
    	]);

    	$email     = $request['email'];
    	$first_name= $request['first_name'];
    	//inciprttar eñl password
    	$password  = bcrypt($request['password']);

    	//asginamos los valores
    	$user=new User();
    	$user->email=$email;
    	$user->first_name=$first_name;
    	$user->password=$password;

    	$user->save();

    	//protegemos la ruta dashboard
    	Auth::login($user);
    	return redirect()->route('dashboard');

    }
    public function postSignIn(Request $request){

    	$this->validate($request, [
        	'email' => 'required',
        	'password' => 'required',
    	]);
    	//verificamos si esta logeado
    	if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
    		return redirect()->route('dashboard');
    	}
    	return redirect()->back();//vuelve a la pagina de origen
    }
    public function getLogout(){

    	Auth::logout();
    	return redirect()->route('home');
    }
    public function getAccount(){
        return view('account',['user'=>Auth::user()]);
    }
    public function postSaveAccount(Request $request){
        $this->validate($request, [
            'first_name' => 'required|max:120'
            
        ]);    
        $user=Auth::user();
        $user->first_name=$request['first_name'];
        $user->save();
        $file=$request->file('image');
        $filename=$request['first_name'].'-'.$user->id.'.jpg';
        if ($file) {
            Storage::disk('local')->put($filename, File::get($file));
        }
        return redirect()->route('account');
    }
    public function getUserImage($filename){
        $file=Storage::disk('local')->get($filename);
        return new Response($file,200);
    }
}
