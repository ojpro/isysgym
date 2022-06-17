<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();

        return response()->json($members);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreMemberRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberRequest $request)
    {
        $request->validated();

        // Hash the password
        $request->merge(
            [
                'password' => Hash::make($request->password),
                'uuid' => \Illuminate\Support\Str::uuid()->toString()
            ]
        );

        $member = Member::create($request->all());

        return response()->json($member);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        $member = Member::findOrFail($member->id);

        return response()->json($member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateMemberRequest $request
     * @param \App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        $request->validated();

        $member = Member::findOrFail($member->id);

        // Hash the password
        $request->merge(
            ['password' => Hash::make($request->password)]
        );

        $member->update($request->all());


        return response()->json([
            'success' => 'Member information updated successgully.'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member = Member::findOrFail($member->id);

        $member->delete();

        return response()->json(['success' => 'Member deleted successfully.']);
    }
}
