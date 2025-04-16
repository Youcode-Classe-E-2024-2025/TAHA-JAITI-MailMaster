<?php

namespace App\Http\Controllers;

use App\Helpers\Res;
use App\Models\Campaign;
use App\Mail\NewsletterMail;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Services\CampaignService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{

    private CampaignService $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        return Campaign::whereHas('newsletter', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $res = $this->campaignService->create($request);

        return $res ? Res::success('Campaign created successfully', $res) : Res::error('Campaign creation failed');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $campaign = Campaign::findOrFail($id);
        $user = Auth::user();
        if ($campaign->newsletter->user_id !== $user->id) {
            return Res::error('Unauthorized', 403);
        }
        return Res::success('Campaign retrieved successfully', $campaign);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $res = $this->campaignService->update($request, $id);
        return $res ? Res::success('Campaign updated successfully', $res) : Res::error('Campaign update failed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $campaign = Campaign::findOrFail($id);
        $user = Auth::user();
        if ($campaign->newsletter->user_id !== $user->id) {
            return Res::error('Unauthorized', 403);
        }

        $campaign->delete();
        return Res::success('Campaign deleted successfully');
    }

    public function send(Request $request, string $id)
    {
        $res = $this->campaignService->send($request, $id);
        return $res ? Res::success('Campaign sent successfully', $res) : Res::error('Campaign sending failed');
    }

    public function preview(string $id)
    {
        $campaign = Campaign::findOrFail($id);
        $subscriber = Subscriber::where('id', Auth::user()->id)->first();
        if (!$subscriber) {
            return Res::error('Subscriber not found', 404);
        }

        $trackingUrl = URL::temporarySignedRoute(
            'track.open',
            now()->addMinutes(30),
            ['campaign' => $campaign->id, 'subscriber' => $subscriber->id]
        );

        return new NewsletterMail($campaign, $subscriber, $trackingUrl);
    }
}