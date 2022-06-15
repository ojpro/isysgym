<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstallationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

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

        return response()->json(['success' => 'Database Configuration created successfully.']);
    }
}
