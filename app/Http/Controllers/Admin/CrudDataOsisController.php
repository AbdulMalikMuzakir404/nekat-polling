<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Calon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Traits\ImageUploading;

class CrudDataOsisController extends Controller
{
    use ImageUploading;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getCalonOsis($nis){
        $siswa = User::firstWhere('nis',$nis);

        $siswa=[
            'nama' => $siswa->nama,
        ];

        return $siswa;
    }

    public function getWakilCalonOsis($nis){
        $siswa = User::firstWhere('nis',$nis);

        $siswa=[
            'nama' => $siswa->nama,
        ];
        return $siswa;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if($request->has('search'))
        {
            $dataCalon = Calon::where('nama_calon', 'LIKE', '%' . $request->search . '%')->orderBy('created_at', 'desc')->paginate(15);
            Session::put('halaman_url', request()->fullUrl());
        } else
        {
            $dataCalon = Calon::orderBy('created_at', 'desc')->paginate(15);
            Session::put('halaman_url', request()->fullUrl());
        }

        return view('admin.pages.create-osis', compact('dataCalon'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_calon' => 'required|string',
            'nama_wakil_calon' => 'required|string',
            'nis_calon' => 'required|string|unique:calons',
            'nis_wakil_calon' => 'required|string|unique:calons',
            'team' => 'required',
            'visi' => 'required|string',
            'misi' => 'required|string'
        ]);

        if ($validate->fails()) {
            return redirect()->route('data-osis.create')->with('error', $validate->fails());
        }

        DB::beginTransaction();
        try {
            DB::commit();
            $osis = Calon::create([
                'nama_calon' => $request->nama_calon,
                'nama_wakil_calon' => $request->nama_wakil_calon,
                'nis_calon' => $request->nis_calon,
                'nis_wakil_calon' => $request->nis_wakil_calon,
                'team' => $request->team,
                'visi' => $request->visi,
                'misi' => $request->misi
            ]);

            if($request->input('foto_calon', false)){
                $osis->addMedia(storage_path('tmp/uploads/') . $request->input('foto_calon'))->toMediaCollection('foto_calon');
            }

            return redirect()->route('data-osis.create')->with('success', 'Data Calon OSIS berhasil dimasukan');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('data-osis.create')->with('error', 'Data Calon OSIS gagal dimasukan');
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
        $calon = Calon::findOrFail($id);

        try{
            return response()->json([
                'data' => $calon
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
            'nama_calon' => 'required|string',
            'nama_wakil_calon' => 'required|string',
            'nis_calon' => 'required|string',
            'nis_wakil_calon' => 'required|string',
            'team' => 'required',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'status_polling' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->route('data-osis.create')->with('error', $validate->fails());
        }

        DB::beginTransaction();
        try {
            DB::commit();

            $osis = Calon::findOrFail($request->osis_id);
            $osis->update($request->all());

            if($request->input('foto_calon_edit', false)){
                if(!$osis->foto_calon || $request->input('foto_calon_edit') !== $osis->foto_calon->file_name){
                    isset($osis->foto_calon) ? $osis->foto_calon->delete() : null;
                    $osis->addMedia(storage_path('tmp/uploads/') . $request->input('foto_calon_edit'))->toMediaCollection('foto_calon');
                }
            } else if($osis->foto_calon){
                $osis->foto_calon->delete();
            }

            return redirect()->route('data-osis.create')->with('success', 'Data OSIS berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('data-osis.create')->with('error', 'Data OSIS gagal diubah');
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            Calon::findOrFail($id)->delete();
            return redirect()->route('data-osis.create')->with('success', 'Data Calon OSIS berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('data-osis.create')->with('error', 'Data Calon OSIS gagal dihapus');
            throw $th;
        }
    }
}
