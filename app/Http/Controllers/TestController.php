<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SubscribeRequest;

use App\Services\SubscribeService;

use Redirect;

class TestController extends Controller
{

    public function index(Request $request)
    {

        $serviceObject = new SubscribeService();
        $serviceObject->sendMailToAdmin('here@sakds.com');
        die;	
    }
}
