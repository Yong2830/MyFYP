<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdvertiserRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $reason;

    public function __construct($reason)
    {
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->view('emails.advertiser_rejected')
                    ->subject('Advertiser Rejection')
                    ->with(['reason' => $this->reason]);
    }
}
