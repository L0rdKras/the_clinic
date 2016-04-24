<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $apiUrl = 'http://mindicador.cl/api';

        $json = file_get_contents($apiUrl);

        $dailyIndicators = json_decode($json);

        return view('home',compact('dailyIndicators'));
    }

}
