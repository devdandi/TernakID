<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiModel as Api;

class ApiController extends Controller
{
    private $headers;
	private $data = array();
    public function daftar_user(Request $req)
    {
    	$nama = $req->nama;
    	$username = $req->username;
    	$email = $req->email;
    	$address = $req->address;
    	$phone = $req->phone;
    	$password = md5($req->password);

    	$daftar = Api::daftar_user($nama, $username, $email, $address, $phone, $password);
    	if($daftar == "emailTrue") {
    		$this->data['user'] = true;
    		$this->data['account'] = $email;
    		$this->data['message'] = "Email has been registered";
    		return json_encode($this->data, JSON_PRETTY_PRINT);
    	}else if($daftar == false) {
    		$this->data['user'] = 'just now';
    		$this->data['message'] = "Account has successfully created at " . now();
    		$this->data['account'] = $this->email;
    		echo json_encode($data);
    	}else if($daftar == "usernameTrue"){
    		$this->data['user'] = true;
    		$this->data['message'] = "Username has been registered";

    		return json_encode($this->data, JSON_PRETTY_PRINT);
    	}else{
    		$this->data['message'] = "something went wrong";
    		return json_encode($this->data, JSON_PRETTY_PRINT);
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
    		$this->data['user'] = false;
    		$this->data['message'] = "Email not registered";
            return json_encode($this->data, JSON_PRETTY_PRINT);
    	}else if ($login){
    		$this->data['user'] = true;
    		$this->data['message'] = "login";
    		$this->data['client_information'] = $this->getIpClient($_SERVER['REMOTE_ADDR']);
    		$this->data['data'] = $login;
    		return json_encode($this->data, JSON_PRETTY_PRINT);
    	}else{
    		$this->data['message'] = "something went wrong";
    		return json_encode($this->data, JSON_PRETTY_PRINT);
    	}
    }
    public function search(Request $req)
    {
    	// search product or anything 

    }
    public function product()
    {
        if (isset($_GET['q'])) {
            $product_name = Api::product($_GET['q']);
            $this->data['status'] = true;
            $this->data['message'] = "GET BY NAME";
            $this->data['data'] = $product_name;
            return json_encode($this->data, JSON_PRETTY_PRINT);
        }else{
            $product_name = Api::product();
            $this->data['status'] = true;
            $this->data['message'] = "GET ALL";
            $this->data['data'] = $product_name;
            return json_encode($this->data, JSON_PRETTY_PRINT);
        }
    }

    public function get_kios(Request $req)
    {
    	$validate = $req->Validate([
    		'input' => 'required|max:20|min:5'
    	]);

    	$name = $req->input;

    	$search = Api::get_kios($name);
    	if($search == false) {
    		$this->data['status'] = false;
    		$this->data['message'] = 'kios not found';
    		return json_encode($this->data, JSON_PRETTY_PRINT);
    	}else{
    		$this->data['status'] = true;
    		$this->data['message'] = 'kios found';
    		$this->data['data'] = $search;
    		return json_encode($this->data, JSON_PRETTY_PRINT);
    	}

    }

    public function maps(Request $req)
    {
    	
    }
    public function getCode(Request $req)
    {

    }
    public function daftar_kios(Request $req)
    {

    }

    public function handleError()
    {
    	try {
    		echo "++++++++++ B I T C H ++++++++++";
    	}catch(Exception $e) {
    		echo $e;
    	}
    	echo clearstatcache(microtime(true), cyrus_authenticate($this->data))->getallheaders();
    }
    public function getIpClient($ip)
    {
    	$url = "http://ip-api.com/php/".$ip;
    	$curl = curl_init();

    	curl_setopt($curl, CURLOPT_URL, $url);
    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    	$output = curl_exec($curl);
    	curl_close($curl);
    	return $output;
    }
    public function test(Request $req) {
        return $this->getIpClient($req->ip());
    }
    public function __destruct()
    {
        return "ok";
    }
}
