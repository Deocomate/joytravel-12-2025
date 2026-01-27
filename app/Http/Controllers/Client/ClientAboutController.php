<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ClientAboutController extends Controller
{
    public function index(): View
    {
        // Static data is now defined in the blade template
        return view('client.about.index');
    }
}
