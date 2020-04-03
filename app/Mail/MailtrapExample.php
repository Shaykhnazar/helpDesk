<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;
class MailtrapExample extends Mailable
{
    use Queueable, SerializesModels;

    public $sendTo ,$url, $comment, $slug, $fromName, $statusChanged;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sendTo, $comment = '', $slug, $statusChanged = '', $email)
    {
        $this->sendTo   = $sendTo;
        $this->comment  = $comment ?? '';
        $this->statusChanged  = $statusChanged ?? '';
        $this->url = "http://127.0.0.1:8000/user/tickets/$slug/?email=$email";

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(Auth::user()->email, Auth::user()->name)
        ->subject('The ticket was answered')
        ->markdown('mails.tickets.mail')
        ->with([
            'name' => $this->sendTo,
            'comment' => $this->comment,
            'statusChanged' => $this->statusChanged,
            'url' => $this->url,
        ]);
    }
}

