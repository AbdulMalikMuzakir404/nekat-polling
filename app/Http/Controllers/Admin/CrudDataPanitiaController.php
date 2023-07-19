<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CrudDataPanitiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
            $dataPanitia = User::where('users.role', 'panitia')->where('name', 'LIKE', '%' . $request->search . '%')->orderBy('created_at', 'desc')->paginate(15);
            Session::put('halaman_url', request()->fullUrl());
        } else
        {
            $dataPanitia = User::where('users.role', 'panitia')->orderBy('created_at', 'desc')->paginate(15);
            Session::put('halaman_url', request()->fullUrl());
        }

        return view('admin.pages.create-panitia', compact('dataPanitia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validate->fails()) {
            return redirect()->route('data-panitia.create')->with('error', $validate->fails());
        }

        DB::beginTransaction();
        try {
            DB::commit();
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'password_show' => $request->password,
                'role' => 'panitia'
            ]);

            return redirect()->route('data-panitia.create')->with('success', 'Data panitia berhasil dimasukan');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('data-panitia.create')->with('error', 'Data panitia gagal dimasukan');
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
        $panitia = User::findOrFail($id);

        try{
            return response()->json([
                'data' => $panitia
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
    public function update(Request $request, string $id)
    {
        //
    }

    public function ubah(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|max:50',
            'password' => 'required|string|min:8',
        ]);

        if ($validate->fails()) {
            return redirect()->route('data-panitia.create')->with('error', $validate->fails());
        }

        DB::beginTransaction();
        try {
            DB::commit();

            User::findOrFail($request->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'password_show' => $request->password,
                'status' => $request->status
            ]);


            return redirect()->route('data-panitia.create')->with('success', 'Data panitia berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('data-panitia.create')->with('error', 'Data panitia gagal diubah');
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

            return redirect()->route('data-panitia.create')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('data-panitia.create')->with('error', 'Data gagal terhapus');
        }
    }
}
