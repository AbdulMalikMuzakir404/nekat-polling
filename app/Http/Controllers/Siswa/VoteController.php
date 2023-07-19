<?php

namespace App\Http\Controllers\Siswa;

use App\Models\User;
use App\Models\Calon;
use App\Models\Polling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function vote(string $id)
    {
        DB::beginTransaction();
        try{
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

            return redirect()->route('siswa.success')->with('success', 'Voting Success');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('siswa.home')->with('error', 'Voting Gagal!');
            throw $th;
        }

    }
}
