<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiModel as Api;

class ApiController extends Controller
{
    public function daftar_user(Request $req)
    {
    	$data = array();
    	$nama = $req->nama;
    	$username = $req->username;
    	$email = $req->email;
    	$address = $req->address;
    	$phone = $req->phone;
    	$password = md5($req->password);

    	$daftar = Api::daftar_user($nama, $username, $email, $address, $phone, $password);
    	if($daftar == "emailTrue") {
    		$data['user'] = true;
    		$data['account'] = $email;
    		$data['message'] = "Email has been registered";
    		echo json_encode($data);
    	}else if($daftar == false) {
    		$data['user'] = 'just now';
    		$data['message'] = "Account has successfully created at " . now();
    		$data['account'] = $email;
    		echo json_encode($data);
    	}else if($daftar == "usernameTrue"){
    		$data['user'] = true;
    		$data['message'] = "Username has been registered";
    		echo json_encode($data);
    	}else{
    		$data['message'] = "something went wrong";
    		echo json_encode($data);
    	}
    }
    public function login_user(Request $req)
    {
    	$validate = $req->validate([
    		'email' => 'required',
    		'password' => 'required|min:6'
    	]);

    	$email = $req->email;
    	$password = md5($req->password);
    	$login = Api::login_user($email, $password);
    	if ($login == 'emailNotFound') {
    		$data['user'] = false;
    		$data['message'] = "Email not registered";
    		echo json_encode($data);
    	}else if ($login){
    		$data['user'] = true;
    		$data['message'] = "login";
    		$data['data'] = $login;
    		echo json_encode($data);
    	}else{
    		$data['message'] = "something went wrong";
    	}
    }
    public function search(Request $req)
    {

    }
    
}
