<?php

namespace Tests\Feature\Models;

use App\Models\ContactInformation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactInformationTest extends TestCase
{
    /**
     * Check if the create contact api exist
     *
     * @return void
     */
    public function test_create_contact_api_exists()
    {
        $response = $this->post(route('contact.store'));

        $response->assertStatus(200);
    }

    /**
     * validate the request
     */
    public  function test_create_validation(){
        $contact = [
            'address'=> 1673673
        ];

        $http_response_header = $this->post(route('contact.store'),$contact,['Accept'=>'application/json']);

        $http_response_header->assertJsonStructure([
            'errors'
        ]);
    }

    /**
     * Create new Record
     */
    public function test_can_create_empty_contact(){
        $contact = ContactInformation::create([]);

        $this->assertModelExists($contact);
    }

    /**
     * create new contact
     */
    public function test_create_new_contact(){

        $contact = [
            'address'=> 'Fez, Morocco',
            'phone_number' => '7784878874'
        ];

        $this->post(route('contact.store'),$contact);

        $this->assertDatabaseHas('contact_information',$contact);
    }

    /**
     * Fetch contact information by id
     */
    public function test_fetch_contact_info(){
        $contacts = ContactInformation::factory()->count(5)->create();

        $http_response_header = $this->get(route('contact.show',$contacts[3]->id));

        $http_response_header->assertJson([
            'id'=>$contacts[3]->id
        ]);
    }

    /*
     * Test not found row
     */
    public function test_not_found(){
        $http_response_header = $this->get(route('contact.show',3));

        $http_response_header->assertStatus(404);
    }
    /**
     * Update contact information
     */
    public function test_update_contact(){
        $contact = ContactInformation::create(['address'=>'casa']);

        $this->patch(route('contact.update',$contact->id),['address'=>'fez']);

        $this->assertDatabaseHas('contact_information',['address'=>'fez']);
    }

    // Delete contact information

    public function test_delete_contact(){
        $contact = ContactInformation::create();

        $this->delete(route('contact.destroy',$contact->id));

        $this->assertDatabaseCount('contact_information',0);
    }
}
