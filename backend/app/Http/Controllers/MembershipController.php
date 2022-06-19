<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMembershipRequest;
use App\Http\Requests\UpdateMembershipRequest;
use App\Models\Membership;
use Illuminate\Support\Facades\DB;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memberships = Membership::withCount(['members' => function ($query) {
            //LEARNED: clause in orm relations
            $query->select(DB::raw('count(distinct(uuid))'));
        }])->withCount('subscriptions')->get();


        return response()->json($memberships);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreMembershipRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMembershipRequest $request)
    {
        $request->validated();

        $membership = Membership::create($request->all());

        return response()->json($membership);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Membership $membership
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
        $membership = Membership::findOrFail($membership->id);

        return response()->json($membership);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateMembershipRequest $request
     * @param \App\Models\Membership $membership
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMembershipRequest $request, Membership $membership)
    {
        $request->validated();

        $membership = Membership::findOrFail($membership->id);

        $membership->update($request->all());

        return response()->json(['success' => 'Membership updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Membership $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        $membership = Membership::findOrFail($membership->id);

        $membership->delete();

        return response()->json(['success' => 'Membership deleted successfully.']);
    }
}
