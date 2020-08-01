<?php

namespace App\Imports;

use App\Peserta;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use DateTime;

class PesertaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private $kelas;

    public function setKelas(int $kelas) {
        $this->kelas = $kelas;
    }

    public function model(array $row)
    {
        $peserta = new Peserta([
            'nama' => $row['nama_lengkap'],
            'email' => $row['email_address'],
            'provinsi' => $row['asal_provinsi'],
            'usia' => $row['usia'],
            'pekerjaan' => $row['pekerjaan'],
            'institusi' => $row['institusi_sekolah'],
            'event_id' => $this->kelas,
        ]);

        return $peserta;

    }
}
