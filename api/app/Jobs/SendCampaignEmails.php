<?php

namespace App\Jobs;

use App\Mail\NewsletterMail;
use App\Models\Campaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCampaignEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Campaign $campaign,
        public array $subscribers
    ) {
    }

    public function handle(): void
    {
        foreach ($this->subscribers as $subscriber) {
            $trackingUrl = route('track.open', [
                'campaign_id' => $this->campaign->id,
                'subscriber_id' => $subscriber->id,
            ]);

            Mail::to($subscriber->email)->queue(new NewsletterMail(
                $this->campaign,
                $subscriber,
                $trackingUrl
            ));
        }

        $this->campaign->update([
            'status' => 'sent',
            'sent_at' => now(),
        ]);
    }
}
