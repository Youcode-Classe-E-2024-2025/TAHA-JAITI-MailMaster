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
            'newsletter_id' => $validated['newsletter_id'],
            'status' => $validated['status'] ?? 'draft',
        ]);
    }


}