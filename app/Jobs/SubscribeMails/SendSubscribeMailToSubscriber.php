<?php

namespace App\Jobs\SubscribeMails;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Services\SubscribeService;

use App\Models\AccessLog;

class SendSubscribeMailToSubscriber implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emailId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($emailId)
    {
        $this->emailId = $emailId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {

            $serviceObject = new SubscribeService();
            $serviceObject->sendMailToSubscriber($this->emailId);
            $this->delete();

        } catch(Exception $e) {

            AccessLog::accessLog(NULL, 'App\Jobs\Mails', 'OrderSuccessfulMail', 'handle', 'catch-block', $e->getMessage());
        }
    }
}
