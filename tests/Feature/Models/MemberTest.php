<?php

namespace Tests\Feature\Models;

use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MemberTest extends TestCase
{
    /**
     * Check Member's API route
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get(route('member.index'));

        $response->assertStatus(200);
    }

    /**
     * Create new Member
     */
    public function test_create_new_member()
    {
        $member = Member::factory()->makeOne();

        $this->post(route('member.store'), $member->toArray());

        $this->assertDatabaseCount('members', 1);
    }

    /**
     * Validate creation
     */
    public function test_create_validation()
    {
        $member = [
            'last_name' => 'Handi',
            'email' => 'contact.me',
            'gender' => 'm'
        ];

        $http_response_header = $this->post(route('member.store'), $member);

        $http_response_header->assertStatus(302);
    }

    /**
     * Assert the the password has been hashed
     */

    public function test_password_hashed()
    {
        $member = [
            'first_name' => 'Oussama',
            'last_name' => 'ELJABBARI',
            'email' => 'contact@ojpro.me',
            'password' => 'password'
        ];

        $this->post(route('member.store'), $member);

        $this->assertDatabaseMissing('members', $member);
    }

    /**
     * fetch member information
     */
    public function test_fetch_member_info()
    {
        $member = Member::factory()->create();

        $http_response_header = $this->get(route('member.show', $member));

        $http_response_header->assertJson($member->toArray());
    }

    /**
     * fetch all members
     */
    public function test_fetch_all_members()
    {
        $members = Member::factory()->count(10)->create();

        $http_response_header = $this->get(route('member.index'));

        $http_response_header->assertJson($members->toArray());
    }

    /**
     * update member info
     */
    public function test_update_member_info()
    {
        $member = Member::factory()->create();

        $info = [
            'first_name' => 'Osama',
            'last_name' => 'ELJABBARI',
            'email' => 'contact@ojpro.me'
        ];

        $this->put(route('member.update', $member), $info);

        $this->assertDatabaseHas('members', $info);
    }

    /**
     * delete a member
     */

    public function test_delete_a_member()
    {
        $member = Member::factory()->create();

        $this->delete(route('member.destroy',$member));

        $this->assertDatabaseCount('members',0);
    }
}
