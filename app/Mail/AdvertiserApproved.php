<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdvertiserApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $reason;

    public function __construct()
    {
    }

    public function build()
    {
        return $this->view('emails.advertiser_approval_success')
                    ->subject('Advertiser Approval Success');
    }
}
