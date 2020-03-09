<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ApiModel extends Model
{
    public static function daftar_user($nama, $username, $email, $address, $phone, $password) 
    {
    	$check = DB::table('users')->where('email', $email)->count();

    	if($check > 0) {
    		return "emailTrue";
    	}else{
    		$check_username = DB::table('users')->where('username', $username);
    		if($check_username->count() > 0) {
    			return "usernameTrue";
    		}else{

    		$data = array(
    			'name' => $nama,
    			'username' => $username,
    			'email' => $email,
    			'address' => $address,
    			'phone' => $phone,
    			'email_verified_at' => now(),
    			'password' => $password,
    			'role' => 0,
    			'remember_token' => 0,
    			'created_at' => now(),
    			'updated_at' => now()
    		);
    		$save = DB::table('users')->insert($data);
    		if($save) {
    			return false;
    		}
    		}
    	}
    }
    public static function login_user($email, $password)
    {
    	$check_email = DB::table('users')->where('email', $email);
    	if($check_email->count() < 1) {
    		return 'emailNotFound';
    	}else{
    		$check_login = DB::table('users')->where('email', $email)->where('password', $password);
    		if($check_login->count() > 0 ) {
    			return $check_login->get();
    		}else{
    			return 'error';
    		}
    	}
    }
}
