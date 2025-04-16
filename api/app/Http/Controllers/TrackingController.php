<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class TrackingController extends Controller
{

    public function trackOpen(Request $request, int $campaign_id, int $subscriber_id): Response
    {
        if (!$request->hasValidSignature()) {
            abort(Response::HTTP_FORBIDDEN, 'Invalid or expired tracking URL');
        }

        $campaign = Campaign::findOrFail($campaign_id);
        $subscriber = Subscriber::findOrFail($subscriber_id);

        $campaign->subscribers()->updateExistingPivot($subscriber->id, [
            'opened' => true,
            'opened_at' => now(),
        ]);

        $pixel = base64_decode('R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==');
        return response($pixel, Response::HTTP_OK)
            ->header('Content-Type', 'image/gif')
            ->header('Content-Length', strlen($pixel));
    }
}
