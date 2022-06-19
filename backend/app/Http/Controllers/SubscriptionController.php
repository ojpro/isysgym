<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscription::with('member:id,first_name,last_name')
            ->with('membership:id,title')
            ->orderByDesc('created_at')->get();

        return response()->json($subscriptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreSubscriptionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriptionRequest $request)
    {
        $request->validated();

        $subscription = Subscription::create($request->all());

        return $this->show($subscription);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Subscription $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        $subscription = Subscription::with('member:id,first_name,last_name')->with('membership:id,title')->findOrFail($subscription->id);

        return response()->json($subscription);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateSubscriptionRequest $request
     * @param \App\Models\Subscription $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $subscription = Subscription::findOrFail($subscription->id);

        $subscription->update($request->all());

        return response()->json(['success' => 'Subscription Updated Successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Subscription $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        $subscription = Subscription::findOrFail($subscription->id);

        $subscription->delete();

        return response()->json(['success' => 'Subscription Deleted Successfully.']);
    }
}
