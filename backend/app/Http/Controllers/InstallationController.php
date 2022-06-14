<?php

namespace App\Http\Controllers;

use App\Models\Gym;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class InstallationController extends Controller
{
    public function __construct()
    {
        // Not Found page if the app already installed

        if (Config::get('APP_INSTALLED')) {
            abort(404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Config::get('APP_INSTALLED', false));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // store database credentials
        $this->storeDatabaseCredentials($request->database);

        // store gym name
        $gym = $this->storeGymName($request->gym);

        // create new role
        $role = $this->createAdminRole();

        // add gym_id to the admin array
        $request->merge([
            'admin' =>
                array_push($request->admin, [
                    'gym_id' => $gym->id
                ])
        ]);

        dd($request->admin);

        // store admin credentials
        $admin = $this->storeAdminCredentials($request->admin);

        // assign a role for the created admin
        $this->assignAdminRole($role, $admin);


    }

    /**
     * store database credentials in the env file
     * @param array $credentials
     */
    public function storeDatabaseCredentials(array $credentials)
    {

    }

    /**
     * store gym's name
     * @param array $gym
     *
     * @return Gym
     */
    public function storeGymName(array $gym)
    {

    }

    /**
     * create admin role
     * @return Role
     */
    public function createAdminRole()
    {

    }

    /**
     * Store admin credentials
     *
     * @return User
     */
    public function storeAdminCredentials(array $admin)
    {

    }

    /**
     * Assign created role to the admin
     */
    public function assignAdminRole(Role $role, User $admin)
    {

    }
}
