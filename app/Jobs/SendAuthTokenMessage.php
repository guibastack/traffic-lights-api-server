<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue as ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable as Dispatchable;
use Illuminate\Bus\Queueable as Queueable;
use Illuminate\Support\Facades\Mail as Mail;
use App\Mails\AuthTokenMessage as AuthTokenMessage;

class SendAuthTokenMessage implements ShouldQueue {

    use Dispatchable, Queueable;

    private string $email;
    private string $authToken;
    private string $identifier;

    public function __construct(string $email, string $authToken, string $identifier) {

        $this->email = $email;
        $this->authToken = $authToken;
        $this->identifier = $identifier;

    }

    public function handle(): void {
        
        Mail::to($this->email)->send(new AuthTokenMessage($this->authToken, $this->identifier));

    }

}
