<?php

namespace App\Listeners;

use App\Events\RequestAnswer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SubmitTaskResult implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param RequestAnswer $requestAnswer
     * @return void
     */
    public function handle(RequestAnswer $requestAnswer)
    {
        Log::info('Send Email', ['to' => $requestAnswer->request->email, 'comment' => $requestAnswer->request->comment]);
    }
}
