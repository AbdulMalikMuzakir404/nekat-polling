<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Calon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalonOsisApiController extends Controller
{
    public function calonOsis()
    {
        try {
            $calonOsis = Calon::whereYear('created_at', date('Y'))->where('status_polling', true)->get();

            return response()->json([
                'success' => true,
                'data' => $calonOsis
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th
            ], 422);
        }
    }
}
