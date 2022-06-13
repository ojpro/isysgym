<?php

namespace Tests\Feature\Models;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /**
     * Test if the role's api route exists
     *
     * @return void
     */
    public function test_role_api()
    {
        $response = $this->get(route('role.index'));

        $response->assertStatus(200);
    }

    /*
     * Create new role
     */
    public function test_create_new_role()
    {

        $details = [
            'name' => 'Admin',
            'description' => 'Administrator Role with full permissions'
        ];

        $this->post(route('role.store'), $details);

        $this->assertDatabaseHas('roles', $details);

    }

    /*
     * test if it a unique role
     */
    public function test_prevent_duplicated_roles()
    {
        $role = [
            'name' => 'editor'
        ];

        $this->post(route('role.store'), $role);

        $this->post(route('role.store'), $role);

        $this->assertDatabaseCount('roles', 1);
    }

    /*
     * fetch role information
     */
    public function test_fetch_role_info()
    {
        $role = [
            'name' => 'editor',
            'description' => 'User with possibility to write articles.'
        ];

        $newRole = Role::create($role);

        $http_response_header = $this->get(route('role.show', $newRole->id));

        $http_response_header->assertJson($role);
    }

    /*
     * Fetch all roles
     */
    public function test_fetch_all_roles()
    {
        $roles = Role::factory()->count(5)->create();

        $http_response_header = $this->get(route('role.index'));

        $http_response_header->assertJson($roles->toArray());
    }

    /*
     * Update Role
     */
    public function test_update_role()
    {
        $role = Role::factory()->create();

        $name = ['name' => 'Admin'];

       $http_response_header =  $this->put(route('role.update', $role), $name);

        $this->assertDatabaseHas('roles', $name);
    }

    /*
     * Delete a role
     */
    public function test_delete_a_role(){
        $role = Role::factory()->create();

        $this->delete(route('role.destroy',$role->id));

        $this->assertDatabaseCount('roles',0);
    }
}
