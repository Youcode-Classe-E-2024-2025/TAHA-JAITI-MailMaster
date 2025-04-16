<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\Newsletter;
use Illuminate\Http\Request;



class CampaignService
{


    public function create(Request $request)
    {
        $validated = $request->validate([
            'newsletter_id' => 'required|exists:newsletters,id',
            'status' => 'in:draft,sent',
        ]);

        $newsletter = Newsletter::findOrFail($validated['newsletter_id']);

        $campaign = Campaign::create([
            'newsletter_id' => $newsletter->id,
            'status' => $validated['status'] ?? 'draft',
        ]);

        return $campaign ?? null;
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'status' => 'in:draft,sent',
        ]);

        $campaign = Campaign::findOrFail($id);

        if ($validated['status']) {
            $campaign->status = $validated['status'];
        }

        $campaign->save();

        return $campaign;
    }

    public function send(Request $request, string $id){
        $campaign = Campaign::findOrFail($id);

        if ($campaign->status === 'sent') {
            return Res::error('Campaign already sent', 400);
        }
    }

}