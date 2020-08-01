<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\PesertaImport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Peserta;

class PesertaController extends Controller
{
    public function import(Request $request) {
        // $request->validate([
        //     'peserta' => 'required|mimes:xls',
        // ]);

        $import = new PesertaImport();

        $import->setKelas($request->id);

        Peserta::where('event_id',$request->id)->delete();

        Excel::import($import, request()->file('peserta'));

        return redirect()->back()->with('success',  'Data Berhasil Diimport!');

    }
}
