<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function index()
    {
        return view('admin.help'); // create this view next
    }
}
