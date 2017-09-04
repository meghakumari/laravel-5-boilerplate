<?php
namespace App\Services;

use Log;
use Exception;

use Mail;
use Config;

use App\Models\AccessLog;

class SubscribeService
{

	public function __construct()
	{
		//
	}

	public function sendMailToAdmin($emailId)
	{
		try {

			Mail::send('emails.send-admin-subscribe-email', ['emailId' => $emailId], function($message) use($emailId) {
			    
			    $message->to(Config::get('app.admin-email'))
			            ->subject('Congratulations! You have a new subscriber')
			            ->replyTo($emailId);
			    $message->from(Config::get('app.noreply-email'), Config::get('app.name'));
			});

			AccessLog::accessLog(NULL, 'App\Services', 'SubscribeService', 'sendMailToAdmin', 'try-block', 'Mail not send to admin for emailId'.$emailId);
			return; 

		} catch ( Exception $e ) {
			
			AccessLog::accessLog(NULL, 'App\Services', 'SubscribeService', 'sendMailToAdmin', 'catch-block', $e->getMessage());
		}
	}

	public function sendMailToSubscriber($emailId)
	{
		try {

			Mail::send('emails.send-user-subscribe-email', ['emailId' => $emailId], function($message) use($emailId) {
			    
			    $message->to($emailId)
			            ->subject('Thanks for requesting an invite')
			            ->replyTo($emailId);
			    $message->from(Config::get('app.noreply-email'), Config::get('app.name'));
			});

			AccessLog::accessLog(NULL, 'App\Services', 'SubscribeService', 'sendMailToSubscriber', 'try-block', 'Mail not send to subscriber for emailId'.$emailId);
			return;

		} catch ( Exception $e ) {
			
			AccessLog::accessLog(NULL, 'App\Services', 'SubscribeService', 'sendMailToSubscriber', 'catch-block', $e->getMessage());
		}
	}
}
