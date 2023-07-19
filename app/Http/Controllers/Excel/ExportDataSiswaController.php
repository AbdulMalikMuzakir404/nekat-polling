<?php

namespace App\Http\Controllers\Excel;

use Illuminate\Http\Request;
use App\Exports\ExportDataSiswa;
use App\Imports\ImportDataSiswa;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class ExportDataSiswaController extends Controller
{
    public function exportDataSiswa()
    {
        try {
            return Excel::download(new ExportDataSiswa, 'data-siswa.xlsx');
        } catch (\Throwable $th) {
            return redirect()->route('data-siswa.create')->with('error', 'Error Export Data');
            throw $th;
        }
    }

    public function importDataSiswa(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        if ($validate->fails()) {
            return redirect()->route('data-siswa.create')->with('error', $validate->fails());
        }

        DB::beginTransaction();
        try {
            DB::commit();
            $file = $request->file('file');
            $nama_file = rand().$file->getClientOriginalName();
            $file->storeAs('public/file_siswa', $nama_file);

            Excel::import(new ImportDataSiswa, public_path('/storage/file_siswa/' . $nama_file));

            return redirect()->route('data-siswa.create')->with('success', 'Import Data Siswa Berhasil');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('data-siswa.create')->with('error', 'Error Import Data Siswa');
            throw $th;
        }
    }
}
