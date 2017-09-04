<?php

namespace App\Models;

use Log;
use Exception;

use Illuminate\Database\Eloquent\Model;

use Watson\Validating\ValidatingTrait;

class AccessLog extends Model
{
    use ValidatingTrait;

    protected $fillable = [];

    protected $table = 'access_logs'; 

    public $timestamps = true;

    protected $rules = [
    ];

    public static function accessLog($logActivityCode = NULL, $moduleType, $module, $moduleFunction = NULL, $longEvent = NULL, $logMessage)
    {
    	try {

    		$logObject = new self;
    		$logObject->log_activity_code = !empty($logActivityCode) ? $logActivityCode : NULL;
    		$logObject->module_type = !empty($moduleType) ? $moduleType : NULL;
    		$logObject->module = !empty($module) ? $module : NULL;
    		$logObject->module_function = !empty($moduleFunction) ? $moduleFunction : NULL;
    		$logObject->long_event = !empty($longEvent) ? $longEvent : NULL;
    		$logObject->log_message = !empty($logMessage) ? json_encode($logMessage) : NULL;

    		if ( !$logObject->save() ) {

                AccessLog::accessLog(NULL, 'App\Models', 'AccessLog', 'accessLog', 'catch-block', 'log not saved');
            }   
    		return;

    	} catch ( Exception $e ) {
    		
    		AccessLog::accessLog(NULL, 'App\Models', 'AccessLog', 'accessLog', 'catch-block', $e->getMessage());
    	}
    }
}
