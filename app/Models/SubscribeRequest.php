<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Log;
use Exception;
use Validator;
use Carbon\Carbon;

use App\Models\AccessLog;

use App\Jobs\SubscribeMails\SendSubscribeMailToAdmin;
use App\Jobs\SubscribeMails\SendSubscribeMailToSubscriber;

use Watson\Validating\ValidatingTrait;

class SubscribeRequest extends Model
{
    use ValidatingTrait;

    protected $table = 'subscribe_requests';

    protected $rules = [
    	
    ];

    public static function saveData($request) 
    {
        try {
            $response =  [
                            'status'    => true,
                            'message'   => "Thank you! We’ve sent you a mail." ,
                            'id'        => [],
                            'log'       => [],
                        ];
            if ( empty( $request->email) && filter_var($request->email, FILTER_VALIDATE_EMAIL) != false) {
                $response['status'] = false;
                $response['log'][] = 'Enter valid email address';
                return $response;
            }

            $saveSubscriber = new SubscribeRequest();
            $saveSubscriber->email = $request->email;
            if ( !$saveSubscriber->save() ) {
                $response['status'] = false;
                $response['log'][] = 'Something went wrong and request not saved.';
                return $response;
            }
            
            $job = (new SendSubscribeMailToAdmin($saveSubscriber->email))->onQueue('admin-invite');
            dispatch($job);

            $job = (new SendSubscribeMailToSubscriber($saveSubscriber->email))->onQueue('subscriber-mail');
            dispatch($job);

            return $response;
            
        } catch ( Exception $e ) {
            
            AccessLog::accessLog(NULL, 'App\Models', 'SubscribeRequest', 'saveData', 'catch-block', $e->getMessage());
        }
    }	
}
