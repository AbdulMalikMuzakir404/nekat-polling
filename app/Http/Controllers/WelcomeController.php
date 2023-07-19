<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calon;

class WelcomeController extends Controller
{
    public function index()
    {
        $kandidat = Calon::WhereYear('created_at', date('Y'))->where('status_polling', 1)->paginate(5);

        return view('welcome', compact('kandidat'));
    }
}
