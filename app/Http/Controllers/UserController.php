<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // List all readers
    public function readers()
    {
        $readers = User::where('role', 'reader')->get();
        return view('admin.users.readers', compact('readers'));
    }
}
