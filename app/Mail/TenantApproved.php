<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TenantApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $reason;

    public function __construct()
    {
    }

    public function build()
    {
        return $this->view('emails.tenant_approval_success')
                    ->subject('Tenant Approval Success');
    }
}
