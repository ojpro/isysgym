<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
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
        $response = $this->get(route('install.getState'));

        $response->assertStatus(200);
    }

    /**
     * GET /install return true if not installed
     */
    public function test_get_install_return_false_if_app_not_installed()
    {
        Config::set('APP_INSTALLED', false);

        $http_response_header = $this->get(route('install.getState'));

        // TODO: use a better way to check the state
        $this->assertTrue($http_response_header->content() == 'false');
    }

    /**
     * install routes won't work if the app already installed
     * assert error 404 [NOT FOUND]
     */
    public function test_install_routes_not_working_if_app_installed()
    {

        Config::set('APP_INSTALLED', true);

        $http_response_header = $this->get(route('install.getState'));

        $http_response_header->assertNotFound();
    }

    /**
     * Setup Database Configuration
     */
    public function test_setup_database_configuration()
    {

        $configs = [
            'DB_HOST' => 'localhost',
            'DB_PORT' => 3306,
            'DB_DATABASE' => 'gym',
            'DB_USERNAME' => 'dev',
            'DB_PASSWORD' => 'password'
        ];

        $this->post(route('install.database'), $configs);

        foreach ($configs as $key => $config) {
            // Prevent Asserting Database name in test mode
            if ($key == 'DB_DATABASE') {
                continue;
            }

            $this->assertTrue(env($key) == $config);
        }

    }

    /**
     * POST /install make the app installed
     */
    public function test_post_to_install_route_makes_the_app_installed()
    {
        $this->post(route('install.setState'));

        $this->assertTrue(Config::get('APP_INSTALLED'));
    }

    /**
     * System won't work if the app not installed
     */
    // TODO: work in this situation
    public function system_not_working_if_the_app_not_installed()
    {
        Config::set('APP_INSTALLED', true);

        $http_response_header = $this->get('/');

        $http_response_header->assertForbidden();
    }
}
