<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Calon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiswaHomeController extends Controller
{
    public function index()
    {
        $kandidat = Calon::WhereYear('created_at', date('Y'))->where('status_polling', 1)->paginate(5);

        return view('siswa.home', compact(
            'kandidat',
        ));
    }

    public function success()
    {
        return view('success');
    }
}
