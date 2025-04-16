<?php

namespace App\Http\Controllers;

use App\Helpers\Res;
use App\Models\Campaign;
use App\Services\CampaignService;
use Auth;
use Illuminate\Http\Request;

class CampaignController extends Controller
{

    private CampaignService $campaignService;

    public function __construct(CampaignService $campaignService) {
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
