<?php

namespace App\Http\Controllers\Excel;

use Illuminate\Http\Request;
use App\Exports\ExportDataPanitia;
use App\Imports\ImportDataPanitia;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class ExportDataPanitiaController extends Controller
{
    public function exportDataPanitia()
    {
        try {
            return Excel::download(new ExportDataPanitia, 'data-panitia.xlsx');
        } catch (\Throwable $th) {
            return redirect()->route('data-panitia.create')->with('error', 'Error Export Data');
            throw $th;
        }
    }

    public function importDataPanitia(Request $request)
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
            $file->storeAs('public/file_panitia', $nama_file);

            Excel::import(new ImportDataPanitia, public_path('/storage/file_panitia/' . $nama_file));

            return redirect()->route('data-panitia.create')->with('success', 'Import Data Panitia Berhasil');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('data-panitia.create')->with('error', 'Error Import Data Panitia');
            throw $th;
        }
    }
}
