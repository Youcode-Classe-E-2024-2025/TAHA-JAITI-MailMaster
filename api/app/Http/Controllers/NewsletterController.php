<?php

namespace App\Http\Controllers;

use App\Helpers\Res;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Services\NewsletterService;
use Illuminate\Support\Facades\Auth;

class NewsletterController extends Controller
{

    private NewsletterService $newsletterService;

    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        return Newsletter::where('user_id', $user->id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $res = $this->newsletterService->save($request);

        return $res ? Res::success('Newsletter created successfully', $res) : Res::error('Failed to create newsletter');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $newsletter = Newsletter::find($id);
        if (!$newsletter) {
            return Res::error('Newsletter not found');
        }
        return Res::success('Newsletter retrieved successfully', $newsletter);
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
