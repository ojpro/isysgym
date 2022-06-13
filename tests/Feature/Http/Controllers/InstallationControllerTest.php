<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InstallationControllerTest extends TestCase
{
    /**
     * check if the install api routes exists
     *
     * @return void
     */
    public function test_is_the_install_api_routes_exists()
    {
        $response = $this->get(route('install.index'));

        $response->assertStatus(200);
    }
}
