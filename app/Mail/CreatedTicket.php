<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;
use Illuminate\Support\Facades\Storage;

class CreatedTicket extends Mailable
{
    use Queueable, SerializesModels;

    public $sendTo, $subject, $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sendTo, $subject, $slug, $email)
    {
        $this->sendTo = $sendTo;
        $this->subject = $subject;
        $this->url = "http://127.0.0.1:8000/manager/tickets/$slug/?email=$email";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(Auth::user()->email, Auth::user()->name)
        ->subject('The new ticket created!')
        ->markdown('mails.tickets.created')
        ->with([
            'name' =>$this->sendTo,
            'subject' => $this->subject,
            'url' => $this->url,
        ]);
    }
}
