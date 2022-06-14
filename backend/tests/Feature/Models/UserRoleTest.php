<?php

namespace Tests\Feature\Models;

use App\Http\Controllers\UserRoleController;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRoleTest extends TestCase
{
    /**
     * check if the user role api exists
     * @return void
     */
    public function test_check_the_user_role_api()
    {
        $response = $this->get(route('user-role.store'));

        $response->assertStatus(200);
    }

    /*
     * Create new user role
     *
     */
    public function test_create_user_role()
    {
        $user = $this->post(route('user.store'), [
            'full_name' => 'Ali MOHADI',
            'email' => 'ali232@gmail.com',
            'password' => '1290238943hjfdiur'
        ]);

        $role = $this->post(route('role.store'), [
            'name' => 'Admin'
        ]);

        $userRole = $this->post(route('user-role.store'), [
            'user_id' => $user['id'],
            'role_id' => $role['id']
        ]);

        $this->assertDatabaseHas('user_roles', [
            'user_id' => $user['id'],
            'role_id' => $role['id']
        ]);
    }

    /**
     * Validate user role on create
     */
    public function test_validate_user_role()
    {

        $http_response_header = $this->post(route('user-role.store'), [
            'user_id' => 2,
            'role_id' => 10
        ]);

        $http_response_header->assertStatus(302);
    }

    /**
     * prevent create empty user role
     */
    public function test_prevent_create_empty_user_role()
    {
        $user = User::factory()->create();

        $this->post(route('user-role.store'), [
            'user_id' => $user['id']
        ]);

        $this->assertDatabaseCount('user_roles', 0);
    }

    /**
     * Prevent use of two roles for the same user
     */
    public function test_prevent_user_from_having_2_roles()
    {
        $user = User::factory()->create();

        $role1 = Role::create([
            'name' => 'admin'
        ]);

        $role2 = Role::create([
            'name' => 'editor'
        ]);

        $http_response_header = $this->post(route('user-role.store'), [
            'user_id' => $user['id'],
            'role_id' => $role1['id'],
        ]);

        $http_response_header2 = $this->post(route('user-role.store'), [
            'user_id' => $user['id'],
            'role_id' => $role2['id'],
        ]);

        $this->assertDatabaseCount('user_roles', 1);
    }

    /**
     * Fetch User's role
     */
    public function test_fetch_user_role()
    {
        $user = User::factory()->create();

        $role = Role::create([
            'name' => 'admin'
        ]);

        $userRole = $this->post(route('user-role.store'), [
            'user_id' => $user['id'],
            'role_id' => $role['id']
        ]);

        $http_response_header = $this->get(route('user-role.show', $userRole['id']));

        $http_response_header->assertJson([
            'user_id' => $user['id'],
            'role_id' => $role['id']
        ]);
    }

    /**
     * update user's role
     */
    public function test_update_user_role()
    {
        $user = User::factory()->create();

        $role = Role::create([
            'name' => 'admin'
        ]);

        $role2 = Role::create([
            'name' => 'subscriber'
        ]);

        $userRole = $this->post(route('user-role.store'), [
            'user_id' => $user['id'],
            'role_id' => $role['id']
        ]);

        $this->put(route('user-role.update', $userRole['id']), [
            'role_id' => $role2['id']
        ]);

        $this->assertDatabaseHas('user_roles', [
            'role_id' => $role2['id']
        ]);
    }

    /**
     * Delete user's role
     */

    public function test_delete_user_role(){
        $user = User::factory()->create();

        $role = Role::create([
            'name' => 'admin'
        ]);

        $userRole = $this->post(route('user-role.store'), [
            'user_id' => $user['id'],
            'role_id' => $role['id']
        ]);

        $this->delete(route('user-role.destroy',$userRole['id']));

        $this->assertDatabaseCount('user_roles',0);
    }
}
