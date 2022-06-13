<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * check if the api exists
     *
     * @return void
     */
    public function test_if_the_users_api_exists()
    {
        $response = $this->get(route('user.index'));

        $response->assertStatus(200);
    }

    /*
     * Validate before create
     */
    public function test_validation_before_create_users()
    {

        $user = [
            'email' => 'mail.com',
            'password' => '1234'
        ];

        $this->post(route('user.store'), $user);

        $this->assertDatabaseCount('users', 0);
    }

    /**
     * Create new user
     */
    public function test_create_new_user()
    {
        $user = [
            'full_name' => 'Oussama ELJABBARI',
            'email' => 'contact@ojpro.me',
            'password' => '12345678'
        ];

        $this->post(route('user.store'), $user);

        $this->assertDatabaseCount('users', 1);
    }

    /*
     * prevent create user with duplicated email
     */
    public function test_prevent_create_user_with_duplicated_email()
    {
        $user1 = [
            'full_name' => 'Ali',
            'email' => 'contactme@gmail.com',
            'password' => '1278327838'
        ];

        $user2 = [
            'full_name' => 'Morad',
            'email' => 'contactme@gmail.com',
            'password' => '7878587587'
        ];

        $this->post(route('user.store'), $user1);

        $create_user2 = $this->post(route('user.store'), $user2);

        $create_user2->assertStatus(302);
    }

    /*
     * Assert that the password has hashed
     */
    public function test_the_password_hashed()
    {
        $userInfo = [
            'full_name' => 'Oussama ELJABBARI',
            'email' => 'contact@ojpro.me',
            'password' => 'password'
        ];

        $this->post(route('user.store'), $userInfo);

        $this->assertDatabaseMissing('users', ['password' => 'password']);
    }

    /*
     * fetch User Info
     */
    public function test_fetch_user_info()
    {
        $userInfo = [
            'full_name' => 'Oussama ELJABBARI',
            'email' => 'hey@ojpro.me',
            'password' => 'password1234'
        ];

        $user = User::create($userInfo);

        $http_response_header = $this->get(route('user.show', $user->id));

        $http_response_header->assertJson([
            'full_name' => 'Oussama ELJABBARI',
            'email' => 'hey@ojpro.me'
        ]);
    }

    /*
     * Fetch all user
     */
    public function test_fetch_all_user_info()
    {
        $users = User::factory()->count(5)->create();

        $http_response_header = $this->get(route('user.index'));

        $http_response_header->assertJson($users->toArray());
    }

    /*
     * Update a user info
     */
    public function test_update_user_info()
    {
        $user = User::factory()->create();

        $newInfo = [
            'email' => 'support@ojpro.me'
        ];

        $response = $this->put(route('user.update', $user), $newInfo);

        $this->assertDatabaseHas('users', $newInfo);
    }

    /*
     * Delete user
     */
    public function test_delete_a_user()
    {
        $user = User::factory()->create();

        $this->delete(route('user.destroy', $user));

        $this->assertDatabaseCount('users', 0);
    }
}
