<?php

namespace App\Http\Controllers;

use App\Helpers\Res;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{

    private 

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
        //
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
