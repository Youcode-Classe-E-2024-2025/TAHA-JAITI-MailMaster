<?php

namespace App\Services;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterService
{


    public function save(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $newsletter = Newsletter::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => auth()->id(),
        ]);

        return $newsletter ?? null;
    }


}
