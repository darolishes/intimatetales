<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class PluginController extends Controller
{
    public function index(): Response
    {
        return response()->view('welcome');
    }
}
