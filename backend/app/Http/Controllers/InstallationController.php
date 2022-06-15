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
    public function getInstalledState()
    {
        return response()->json(Config::get('APP_INSTALLED'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setInstalledState(Request $request)
    {
        Config::set('APP_INSTALLED',true);

        return response()->json(Config::get('APP_INSTALLED'));
    }
}
