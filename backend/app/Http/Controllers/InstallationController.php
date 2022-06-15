<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstallationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class InstallationController extends Controller
{
    public function __construct()
    {
        // Not Found page if the app already installed
        if (env('APP_INSTALLED')) {
            abort(403);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInstalledState()
    {
        return response()->json(env('APP_INSTALLED', false));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setInstalledState(Request $request)
    {
        setEnv('APP_INSTALLED', true);

        return response()->json(env('APP_INSTALLED'));
    }

    /**
     * Configure Database Connection
     */
    public function setupDatabase(StoreInstallationRequest $request)
    {
        $request->validated();

        foreach ($request->all() as $key => $config) {
            setEnv($key, $config);
        }

        //TODO: write tests
        if (!$this->testConnection()) {
            return response()
                ->json(['error' => 'Connection failed, please check database\' credentials.']);
        }

        if (!$this->migrateTables()) {
            return response()->json(['error' => 'Unable to create database\'s tables, please try again.']);
        }

        return response()->json(['success' => 'Database created successfully.']);
    }

    /**
     * Test to connection to the database
     * @return bool
     */

    private function testConnection(): bool
    {
        try {
            if (DB::connection()->getDatabaseName()) {
                return true;
            }
        } catch (\Exception $exception) {
            return false;
        }

    }

    /**
     * Migrate tables
     *
     * @return bool
     */
    public function migrateTables(): bool
    {
        try {
            // TODO: it should be sync until finish
            Artisan::call('migrate:fresh');
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
