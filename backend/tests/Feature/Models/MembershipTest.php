<?php

namespace Tests\Feature\Models;

use App\Models\Gym;
use App\Models\Membership;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MembershipTest extends TestCase
{
    /**
     * check the api
     *
     * @return void
     */
    public function test_the_api()
    {
        $response = $this->get(route('membership.index'));

        $response->assertStatus(200);
    }

    /**
     * create new membership
     */
    public function test_create_new_membership()
    {
        $gym = Gym::create([
            'name' => 'GYMStar'
        ]);

        $membership = [
            'title' => 'Starter',
            'gym_id' => $gym['id'],
            'price' => 7,
            'number_of_attendances' => 3
        ];

        $http_response_header = $this->post(route('membership.store'), $membership);

        $this->assertDatabaseHas('memberships', $membership);
    }

    /**
     * Validate creation
     */
    public function test_create_validation()
    {
        $membership = [
            'title' => 'Starter',
            'gym_id' => 3,
            'price' => 19.3,
            'number_of_attendances' => 0
        ];

        $http_response_header = $this->post(route('membership.store'), $membership);

        $http_response_header->assertStatus(302);
    }

    /**
     * fetch membership information
     */
    public function test_fetch_membership_info()
    {
        $gym = Gym::create([
            'name' => 'GYMBaby'
        ]);

        $membership = Membership::create([
            'title' => 'Intermediate',
            'gym_id' => $gym['id'],
            'price' => 19.3,
            'number_of_attendances' => 4
        ]);

        $http_response_header = $this->get(route('membership.show', $membership->id));

        $http_response_header->assertJson($membership->toArray());
    }

    /**
     * fetch all memberships
     */
    public function test_fetch_all_memberships()
    {
        Gym::create([
            'name' => 'testGYM'
        ]);

        $memberships = Membership::factory()->count(3)->create();

        $http_response_header = $this->get(route('membership.index'));

        $http_response_header->assertJson($memberships->toArray());
    }

    /**
     * update membership
     */
    public function test_update_membership()
    {
        $gym = Gym::create([
            'name' => 'YGYMY'
        ]);

        $membership = Membership::create([
            'title' => 'Advance',
            'gym_id' => $gym['id'],
            'price' => 20.4,
            'number_of_attendances' => 6
        ]);

        $this->put(route('membership.update', $membership), [
            'price' => 25.4,
            'number_of_attendances' => 7
        ]);

        $this->assertDatabaseHas('memberships', [
            'price' => 25.4,
            'number_of_attendances' => 7
        ]);
    }

    /**
     * delete a membership
     */
    public function test_delete_a_membership()
    {
        $gym = Gym::create([
            'name' => 'BobGYM'
        ]);

        $membership = Membership::create([
            'title' => 'Beginner',
            'gym_id' => $gym['id'],
            'price' => 9,
            'number_of_attendances' => 3
        ]);

        $this->delete(route('membership.destroy', $membership['id']));

        $this->assertDatabaseCount('memberships', 0);
    }
}
