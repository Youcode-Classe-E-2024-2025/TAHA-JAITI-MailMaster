<?php


namespace App\Services;

use App\Models\Subscriber;
use Illuminate\Http\Request;


class SubscriberService
{


    public function create(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email|unique:subscribers',
            'name' => 'nullable|string|max:255',
            'status' => 'in:active,unsubscribed',
        ]);

        $subscriber = Subscriber::create($validated);

        return $subscriber ?? null;
    }


    public function update(Request $request, string $id)
    {
        $subscriber = Subscriber::find($id);
        if (!$subscriber) {
            return null;
        }

        $validated = $request->validate([
            'email' => 'sometimes|required|string|email|unique:subscribers,email,' . $id,
            'name' => 'sometimes|nullable|string|max:255',
            'status' => 'sometimes|in:active,unsubscribed',
        ]);

        $subscriber->update($validated);

        return $subscriber;
    }
}
