<?php

namespace App\Mail;

use App\Models\Campaign;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Campaign $campaign,
        public Subscriber $subscriber,
        public string $trackingUrl
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->campaign->newsletter->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter',
            with: [
                'newsletter' => $this->campaign->newsletter,
                'trackingUrl' => $this->trackingUrl,
                'unsubscribeUrl' => url('/api/unsubscribe/' . $this->subscriber->id),
            ],
        );
    }
}