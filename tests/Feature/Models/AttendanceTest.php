<?php

namespace Tests\Feature\Models;

use App\Models\Attendance;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttendanceTest extends TestCase
{
    /**
     * Check if the api working.
     *
     * @return void
     */
    public function test_check_if_the_api_working()
    {
        $response = $this->get(route('attendance.index'));

        $response->assertStatus(200);
    }

    /**
     * validate a attendance before create it
     */
    public function test_validate_attendnace()
    {
        $member = Member::factory()->create();

        $attendance = [
            'attended_at' => 'hey',
            'member_id' => 2
        ];

        $http_response_header = $this->post(route('attendance.store'), $attendance);

        $http_response_header->assertStatus(302);

        $this->assertDatabaseCount('attendances', 0);
    }

    /**
     * create new attendance
     */
    public function test_create_new_attendance()
    {
        $member = Member::factory()->create();

        $attendance = [
            'attended_at' => Carbon::now()->toDateString(),
            'member_id' => $member['id']
        ];

        $this->post(route('attendance.store'), $attendance);

        $this->assertDatabaseHas('attendances', $attendance);
    }

    /**
     * fetch attendance
     */
    public function test_fetch_attendance()
    {
        $member = Member::factory()->create();

        $attendance = [
            'attended_at' => Carbon::now()->toDateString(),
            'member_id' => $member['id']
        ];

        $response = $this->post(route('attendance.store'), $attendance);

        $http_response_header = $this->get(route('attendance.show', $response['id']));

        $http_response_header->assertJson($attendance);
    }

    /**
     * fetch all attendance
     */
    public function test_fetch_all_attendances()
    {
        $member = Member::factory()->create();

        $attendance = [
            'attended_at' => Carbon::now()->toDateString(),
            'member_id' => $member['id']
        ];

        $this->post(route('attendance.store'), $attendance);

        $http_response_header = $this->get(route('attendance.index'));

        $http_response_header->assertJson([$attendance]);
    }

    /**
     * update an attendance
     */
    public function test_update_an_attendance()
    {
        $member = Member::factory()->create();

        $attendance = Attendance::create([
            'attended_at' => Carbon::now()->toDateString(),
            'member_id' => $member['id']
        ]);

        $this->put(route('attendance.update', $attendance), [
            'attended_at' => Carbon::now()->nextWeekday()->toDateString()
        ]);

        $this->assertDatabaseHas('attendances', [
            'attended_at' => Carbon::now()->nextWeekday()->toDateString()
        ]);
    }

    /**
     * delete an attendance
     */
    public function test_delete_an_attendnace(){

        $member = Member::factory()->create();

        $attendance = Attendance::create([
            'attended_at' => Carbon::now()->toDateString(),
            'member_id' => $member['id']
        ]);

        $this->delete(route('attendance.destroy',$attendance));

        $this->assertDatabaseCount('attendances',0);
    }
}
