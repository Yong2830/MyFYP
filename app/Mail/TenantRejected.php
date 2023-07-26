<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TenantRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $reason;

    public function __construct($reason)
    {
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->view('emails.tenant_rejected')
                    ->subject('Tenant Rejection')
                    ->with(['reason' => $this->reason]);
    }
}
