<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Peserta;
use App\Sertifikat;
use PDF;

class SertifikatController extends Controller
{
    public function form_cetak() {
        $event = Event::all();

        return view('cetak-sertifikat', ['event' => $event]);
    }

    public function cetak(Request $request) {

        $this->validate($request, [
            'kelas' => 'required',
            'email' => 'required|email:rfc,dns',
            ]);

        $peserta_valid = Event::find($request->kelas)->peserta->where('email', $request->email)->first();
        $event = Event::find($request->kelas)->first();

        if ($peserta_valid != null) {

            $sertifikat = Sertifikat::where('id_event', $request->kelas)
                                    ->where('email', $request->email)
                                    ->first();

            if ($sertifikat == null) {
                Sertifikat::create([
                    'id_event' => $request->kelas,
                    'email' => $request->email,
                ]);
            } else {
                $sertifikat->update([
                    'id_event' => $request->kelas,
                    'email' => $request->email,
                ]);
            }

            $sertifikatjadi = Sertifikat::where('id_event', $request->kelas)
                                    ->where('email', $request->email)
                                    ->first();

            $nomor = 'RC' . sprintf("%06d", $sertifikatjadi->id);

            $peserta = Event::find($request->kelas)->peserta->where('email', $request->email)->first();

            $pdf = PDF::loadview('layouts.cetak', ['nomor' => $nomor, 'peserta' => $peserta, 'event' => $event]);
            $pdf->setPaper('A4', 'landscape');
            return $pdf->download($nomor.'-'.$peserta->nama);
        } else {
            return redirect()->back()->with('error', 'Anda Tidak Terdaftar!');
        }
    }

    public function form_cek(Request $request) {

        return view('cek-sertifikat');
    }

    public function cek(Request $request) {

        $this->validate($request, [
            'nomor' => 'required|size:9',
            ]);

        //ambil nomor nya saja
        $nomor = $request->nomor;
        $filter = filter_var($nomor, FILTER_SANITIZE_NUMBER_INT);
        $hasil = intval($filter);

        $sertifikat = Sertifikat::find($hasil);


        if ($sertifikat != null) {
            $event = $sertifikat->id_event;
            $email = $sertifikat->email;
            $gambar = Event::find($sertifikat->id_event);

            $peserta = Event::find($event)->peserta->where('email', $email)->first();
            $pdf = PDF::loadview('layouts.cetak', ['nomor' => $nomor, 'peserta' => $peserta, 'event' => $gambar]);
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream($nomor.'-'.$peserta->nama.'.pdf');
        } else {

            return redirect()->back()->with('error', 'Nomor Sertifikat Anda Tidak Terdaftar');
        }
    }
}
