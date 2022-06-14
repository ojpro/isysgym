<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGymRequest;
use App\Http\Requests\UpdateGymRequest;
use App\Models\Gym;

class GymController extends Controller
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
     * Create new gym record
     * @param StoreGymRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreGymRequest $request)
    {
        // validate the request
        $validated = $request->validated();

        // store the data
        $gym = Gym::create($request->all());

        // return a response
        // TODO: spelling faults
        return response()->json(['success' => 'Gym Created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Gym $gym
     * @return \Illuminate\Http\Response
     */
    public function show(Gym $gym)
    {
        $row = Gym::findOrFail($gym->id);

        return response()->json($row);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateGymRequest $request
     * @param \App\Models\Gym $gym
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGymRequest $request, Gym $gym)
    {
        $gym = Gym::findOrFail($gym->id);

        $gym->update($request->all());

        return response()->json(['success'=>'Gym Updated Successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Gym $gym
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gym $gym)
    {
       $gym = Gym::findOrFail($gym->id);

       $gym->delete();

       return response()->json(['success'=>'Gym Deleted Successfully.']);
    }
}
