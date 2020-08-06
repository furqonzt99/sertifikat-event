<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Peserta;
use App\Sertifikat;

class EventController extends Controller {

    public function tambah(Request $request) {

        $this->validate($request, [
            'nama' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'sertifikat' => 'required|image|max:2048',
            ]);

        if($request->hasFile('sertifikat')) {
            $file = $request->file('sertifikat');
            $name = 'raihcita-' . \Carbon\Carbon::now()->format('Y-m-dH:i:s') . '.' . $file->getClientOriginalExtension();
            $path = public_path(). '/template';
            $upload = $file->move($path,$name);

            Event::create([
                'nama' => $request->nama,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'sertifikat' => $name,
            ]);
        }

        $event = Event::all();

        return redirect()->back()->withInput(['event' => $event]);
    }

    public function update(Request $request, $id) {

        $this->validate($request, [
            'nama' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'sertifikat' => 'image|max:2048',
            ]);

        $event = Event::find($id);

        if($request->hasFile('sertifikat')) {
            $file = $request->file('sertifikat');
            $name = 'raihcita-' . \Carbon\Carbon::now()->format('Y-m-dH:i:s') . '.' . $file->getClientOriginalExtension();
            $path = public_path(). '/template';
            $upload = $file->move($path,$name);

            unlink(public_path('template/'. $event->sertifikat));

            $event->update([
                'nama' => $request->nama,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'sertifikat' => $name,
            ]);
        } else {
            $event->update([
                'nama' => $request->nama,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
            ]);
        }

        $event = Event::all();

        return redirect()->back()->withInput(['event' => $event]);
    }

    public function hapus($id) {

        $gambar = Event::find($id);

        $sertifikat = Sertifikat::where('id_event', $id)->delete();

        Peserta::where('event_id', $id)->delete();

        unlink(public_path('template/'. $gambar->sertifikat));

        $gambar->delete();

        $event = Event::all();

        return redirect()->back()->withInput(['event' => $event]);
    }

    public function detail($id) {

        $event =  Event::find($id);

        $peserta = Event::find($id)->peserta;

        return view('detail-event', ['peserta' => $peserta], ['event' => $event]);
    }
}
