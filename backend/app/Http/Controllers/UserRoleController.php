<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRoleRequest;
use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\UserRole;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreUserRoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRoleRequest $request)
    {
        $request->validated();

        $userRole = UserRole::create($request->all());

        return response()->json($userRole);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\UserRole $userRole
     * @return \Illuminate\Http\Response
     */
    public function show(UserRole $userRole)
    {
        $userRole = UserRole::findOrFail($userRole->id);

        return response()->json($userRole);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateUserRoleRequest $request
     * @param \App\Models\UserRole $userRole
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRoleRequest $request, UserRole $userRole)
    {
        $uRole = UserRole::findOrFail($userRole->id);

        $uRole->update($request->all());

        return response()->json(['success' => 'User\' role updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\UserRole $userRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRole $userRole)
    {
        $userRole = UserRole::findOrFail($userRole->id);

        $userRole->delete();

        return response()->json(['success'=>'user\'s role deleted successfully.']);
    }
}
