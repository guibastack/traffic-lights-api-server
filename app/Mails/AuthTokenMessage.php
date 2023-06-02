<?php

namespace App\Mails;

use Illuminate\Mail\Mailable as Mailable;
use Illuminate\Mail\Mailables\Envelope as Envelope;
use Illuminate\Mail\Mailables\Content as Content;

class AuthTokenMessage extends Mailable {

    private string $authToken;
    private string $identifier;

    public function __construct(string $authToken, string $identifier) {

        $this->authToken = $authToken;
        $this->identifier = $identifier;

    }

    public function envelope(): Envelope {

        return new Envelope(
            subject: 'New auth token - ' . config('app.name'),
        );

    }

    public function content(): Content {

        return new Content(
            view: 'Mails.AuthTokenMessage',
            with: [
                'authToken' => $this->authToken,
                'identifier' => $this->identifier,
            ],
        );

    }

    public function attachments(): array {

        return [

        ];

    }

}
