<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\ParentUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CrudDataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if($request->has('search'))
        {
            $dataSiswa = User::with('childUser')->where('users.role', 'siswa')->where('nis', 'LIKE', '%' . $request->search . '%')->orderBy('created_at', 'desc')->paginate(15);
            Session::put('halaman_url', request()->fullUrl());
        } else
        {
            $dataSiswa = User::with('childUser')->where('users.role', 'siswa')->orderBy('created_at', 'desc')->paginate(15);
            Session::put('halaman_url', request()->fullUrl());
        }

        return view('admin.pages.create-siswa', compact('dataSiswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'nis' => 'required|string|unique:users',
            'email' => 'email|max:50|unique:users',
            'password' => 'required|string|min:8',
            'kelas' => 'required|string',
            'jurusan' => 'required|string',
            'jenis_kelamin' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->route('data-siswa.create')->with('error', $validate->fails());
        }

        DB::beginTransaction();
        try {
            DB::commit();
            $user = User::create([
                'name' => $request->name,
                'nis' => $request->nis,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'password_show' => $request->password
            ]);

            ParentUser::create([
                'user_id' => $user->id,
                'kelas' => $request->kelas,
                'jurusan' => $request->jurusan,
                'jenis_kelamin' => $request->jenis_kelamin
            ]);

            return redirect()->route('data-siswa.create')->with('success', 'Data siswa berhasil dimasukan');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('data-siswa.create')->with('error', 'Data siswa gagal dimasukan');
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = User::with('childUser')->findOrFail($id);

        try{
            return response()->json([
                'data' => $siswa
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Invalid'
            ], 401);
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    public function ubah(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'nis' => 'required|string',
            'email' => 'required|email|max:50',
            'password' => 'required|string|min:8',
            'kelas' => 'required|string',
            'jurusan' => 'required|string',
            'jenis_kelamin' => 'required',
            'voting' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->route('data-siswa.create')->with('error', $validate->fails());
        }

        DB::beginTransaction();
        try {
            DB::commit();

            User::findOrFail($request->user_id)->update([
                'name' => $request->name,
                'nis' => $request->nis,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'password_show' => $request->password,
                'status' => $request->status,
                'voting' => $request->voting
            ]);

            ParentUser::where('user_id', $request->user_id)->update([
                'kelas' => $request->kelas,
                'jurusan' => $request->jurusan,
                'jenis_kelamin' => $request->jenis_kelamin
            ]);

            return redirect()->route('data-siswa.create')->with('success', 'Data siswa berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('data-siswa.create')->with('error', 'Data siswa gagal diubah');
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            DB::commit();

            User::findOrFail($id)->delete();

            return redirect()->route('data-siswa.create')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('data-siswa.create')->with('error', 'Data gagal terhapus');
        }
    }
}
