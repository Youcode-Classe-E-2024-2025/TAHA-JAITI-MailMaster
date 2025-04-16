<?php

namespace App\Http\Controllers;

use App\Helpers\Res;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Services\SubscriberService;

class SubscriberController extends Controller
{

    private SubscriberService $subscriberService;

    public function __construct(SubscriberService $subscriberService)
    {
        $this->subscriberService = $subscriberService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Res::success(Subscriber::all(), 'Subscribers retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $res = $this->subscriberService->create($request);

        return $res ? Res::success($res, 'Subscriber created successfully') :
            Res::error('Failed to create subscriber', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subscriber = Subscriber::find($id);
        if (!$subscriber) {
            return Res::error('Subscriber not found', 404);
        }
        return Res::success($subscriber, 'Subscriber retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $res = $this->subscriberService->update($request, $id);
        if (!$res) {
            return Res::error('Failed to update subscriber', 400);
        }
        return Res::success($res, 'Subscriber updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subscriber = Subscriber::find($id);
        if (!$subscriber) {
            return Res::error('Subscriber not found', 404);
        }

        $subscriber->delete();

        return Res::success(null, 'Subscriber deleted successfully');
    }

    public function unsubscribe(Subscriber $subscriber)
    {
        $subscriber->update(['status' => 'unsubscribed']);
        return Res::success(null, 'Unsubscribed successfully');
    }
}
