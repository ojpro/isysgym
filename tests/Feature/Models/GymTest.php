<?php

namespace Tests\Feature\Models;

use App\Models\ContactInformation;
use App\Models\Gym;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GymTest extends TestCase
{
    /**
     * Test if the gym api exists
     */
    public function test_check_if_the_gym_api_exists()
    {
        $http_response_header = $this->get(route('gym.index'));

        $http_response_header->assertOk();
    }

    /**
     * prevent creating empty record
     */
    public function test_empty_record_not_accepted()
    {
        $http_response_header = $this->post(route('gym.store'), []);

        $http_response_header->assertStatus(302);
    }

    /**
     * Can create record with the name only
     */
    public function test_create_record_with_name_only()
    {
        $gym = [
            'name' => 'GYMStar'
        ];

        $http_response_header = $this->post(route('gym.store'), $gym);

        $this->assertDatabaseHas('gyms', $gym);
    }

    /**
     * Can't create a reference for not existed contact information record
     */
    public function test_cant_create_reference_to_not_existed_contact_record()
    {
        $gym = [
            'name' => 'iGYMy',
            'contact_information' => 3
        ];

        $http_response_header = $this->post(route('gym.store'), $gym);

        $this->assertDatabaseCount('gyms', 0);
    }

    /**
     * store only gyms with unique contact info ref
     */
    public function test_only_unique_contact_info_ref()
    {
        $contactInfo = ContactInformation::create();

        $gym1 = [
            'name' => 'DaddyGYM',
            'contact_information' => $contactInfo['id']
        ];

        $gym2 = [
            'name' => 'JustWorkout',
            'contact_information' => $contactInfo['id']
        ];

        $http_response_header1 = $this->post(route('gym.store'), $gym1);

        $http_response_header2 = $this->post(route('gym.store'), $gym2);

        $this->assertDatabaseCount('gyms', 1);

    }

    /*
     * Get Gym Info
     */
    public function test_fetch_gym_info(){
        $gym = Gym::create(['name'=>'TestGym']);

        $http_response_header = $this->get(route('gym.show',$gym));

        $http_response_header->assertJson(['name'=>'TestGym']);
    }
    /*
     * Test 404 when the gym not exists
     */
    public function test_error_404_for_non_exist_gym(){
        $http_response_header = $this->get(route('gym.show',1));

        $http_response_header->assertStatus(404);

    }
    /**
     * Update a record
     */
    public function test_update_a_record()
    {
        $gym = Gym::create([
            'name' => 'GymStar',
        ]);

        $newName = ['name' => 'NewGYM'];

        $http_response_header = $this->put(route('gym.update', $gym), $newName);

        $this->assertDatabaseHas('gyms', $newName);
    }

    /*
     * Test destroy a gym record
     */
    public function test_delete_a_gym(){
        $contact = ContactInformation::create([]);

        $gym = Gym::create([
            'name'=>'DelGym',
            'contact_information'=>$contact['id']
        ]);

        $this->delete(route('gym.destroy',$gym));

        $this->assertDatabaseCount('gyms',0);

        // TODO*: assert that based tables removed to
//        $this->assertDatabaseCount('contact_information',0);

    }

}
