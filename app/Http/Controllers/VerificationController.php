<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class VerificationController extends Controller
{
    public function sendEmail($type, $to) 
    {
    	try {
    		Mail::send('email', ['nama' => 'TernakID', 'pesan' => 'TEST', function ($message)])
    	}
    }
}
