<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SubscribeRequest;

use App\Services\SubscribeService;

use Redirect;

class SubscribeRequestController extends Controller
{
    public function store(Request $request)
    {
    	if( empty( $request->email) ) {
    		return Redirect::back()->withErrors(['Please enter a valid email address']);
    	}
    	$saveSubscriber = SubscribeRequest::saveData($request);
        return $saveSubscriber;
    }
}
