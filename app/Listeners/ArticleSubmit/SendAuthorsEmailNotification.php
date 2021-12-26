<?php

namespace App\Listeners\ArticleSubmit;

use App\Events\ArticleSubmit;
use App\Mail\SendAuthorMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendAuthorsEmailNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ArticleSubmit $event
     * @return void
     */
    public function handle(ArticleSubmit $event)
    {
        foreach ($event->authors as $author){
            Mail::to($author)->send(new SendAuthorMail($event->id,$event->title));
            sleep(1);
        }
        echo "mail sent";
    }
}
