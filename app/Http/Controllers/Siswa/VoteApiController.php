<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Calon;
use App\Models\Polling;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VoteApiController extends Controller
{
    public function vote(string $id)
    {
        DB::beginTransaction();
        try{
            $cek = User::whereId(auth()->user()->id)->where('voting', true)->where('status', 'active')->get();
            if($cek->isEmpty()) {
                DB::commit();
                Polling::create([
                    'user_id' => Auth::user()->id,
                    'calon_id' => $id
                ]);

                $calon = Calon::whereId($id)->first();
                $suara = $calon->suara += 1;
                $calon->update([
                    'suara' => $suara
                ]);

                User::whereId(Auth::user()->id)->update([
                    'voting' => true
                ]);

                return response()->json([
                    'message' => 'berhasil vote',
                    'status' => true
                ], 200);
            } else {
                return response()->json([
                    'message' => 'anda sudah vote',
                    'status' => false
                ], 422);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'message' => 'gagal vote',
                'status' => false
            ], 422);
            throw $th;
        }

    }
}
