<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = Attendance::with('member')->get();

        return response()->json($attendances);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreAttendanceRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttendanceRequest $request)
    {
        $request->validated();

        $attendance = Attendance::create($request->all());

        return response()->json($attendance);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Attendance $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        $attendance = Attendance::findOrFail($attendance->id);

        return response()->json($attendance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateAttendanceRequest $request
     * @param \App\Models\Attendance $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $request->validated();

        $attendance = Attendance::findOrFail($attendance->id);

        $attendance->update($request->all());

        return response()->json(['success' => 'Attendnace updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Attendance $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendance = Attendance::findOrFail($attendance->id);

        $attendance->delete();

        return response()->json(['success' => 'Attendance deleted successfully.']);
    }
}
