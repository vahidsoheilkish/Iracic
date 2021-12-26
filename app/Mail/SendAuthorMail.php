<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAuthorMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $id;
    public $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id , $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.send_author_mail.custom_template')
            ->with([$this->id,$this->title]);
//        return $this->view('mail.send_author_mail.custom_template')
//            ->with([$this->id,$this->title]);
    }


}
