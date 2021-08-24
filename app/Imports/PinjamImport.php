<?php

namespace App\Imports;

use App\Models\Pinjam;
use Maatwebsite\Excel\Concerns\ToModel;

class PinjamImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function rumus($besar_pinjam, $jangka, $bunga, $tipe_pinjaman)
    {
        $besar_pinjam = (int)preg_replace('/[^\d.]/', '', $besar_pinjam);
        $jangka = $jangka;
        $bunga = $bunga;
        $tipe = $tipe_pinjaman;
        $array_bunga = [0 => 'bunga'];
        $array_pokok = [0 => 'pokok'];
        $array_pinjaman = [0 => $besar_pinjam];
        if ($tipe == 'Anuitas') {
            //tentuin bunga ke persen 6 ke 6%
            $bungapersen = $bunga / 100;
            // tentuin tahun dari jangka
            $tahun = $jangka / 12;

            // ===>mencari anuitas<===
            $c = pow((1 + $bungapersen), $tahun);
            $d = $c - 1;
            $fax = ($bungapersen * $c) / $d;
            $anuitas = round($fax, 6);
            // ===>mencari anuitas<===

            $besar_angsur = ($besar_pinjam * $anuitas) / 12;
            $besar_angsuran = $besar_angsur;

            $angsuran_bunga = $besar_pinjam * $bungapersen / 12;
            $angsuran_pokok = $besar_angsuran - $angsuran_bunga;

            $b = 1;
            $no = 1;
            for ($i = 1; $i <= $jangka; $i++) {

                if ($i == 13 || $no == 13) {
                    $ang_bunga = $besar_pinjam * $bungapersen / 12;
                    $angsuran_bunga = round($ang_bunga);
                    $angsuran_pokoks = $besar_angsuran - $angsuran_bunga;
                    $angsuran_pokok = round($angsuran_pokoks);
                    $no = 1;
                }

                $no++;
                array_push($array_bunga, $angsuran_bunga);
                array_push($array_pokok, $angsuran_pokok);

                $besar_pinjam -= $array_pokok[$b];
                $b++;
                array_push($array_pinjaman, $besar_pinjam);
            }
            $resource = [
                'bunga' => $array_bunga,
                'pokok' => $array_pokok,
                'pinjaman' => $array_pinjaman
            ];

            return [
                'bunga' => array_sum($array_bunga),
                'pokok' => array_sum($array_pokok)
            ];
        } else if ($tipe == 'Flat') {
            //tentuin bunga ke persen 6 ke 6%
            $bungapersen = $bunga / 100;
            // tentuin tahun dari jangka
            $tahun = $jangka / 12;

            // ===>mencari anuitas<===
            $c = pow((1 + $bungapersen), $tahun);
            $d = $c - 1;
            $fax = ($bungapersen * $c) / $d;
            $anuitas = round($fax, 6);
            // ===>mencari anuitas<===

            $besar_angsur = ($besar_pinjam * $anuitas) / 12;
            $besar_angsuran = $besar_angsur;

            $angsuran_bunga = $besar_pinjam * $bungapersen / 12;
            $angsuran_pokok = $besar_angsuran - $angsuran_bunga;

            $b = 1;
            $no = 1;
            for ($i = 1; $i <= $jangka; $i++) {
                $no++;
                array_push($array_bunga, $angsuran_bunga);
                array_push($array_pokok, $angsuran_pokok);

                $besar_pinjam -= $array_pokok[$b];
                $b++;
                array_push($array_pinjaman, $besar_pinjam);
            }
            $resource = [
                'bunga' => $array_bunga,
                'pokok' => $array_pokok,
                'pinjaman' => $array_pinjaman
            ];
            return [
                'bunga' => array_sum($array_bunga),
                'pokok' => array_sum($array_pokok)
            ];
        }
    }
    public function model(array $row)
    {
        return new Pinjam([
            'jumlah_pinjaman' => $row[1],
            'jangka' => $row[2],
            'bungapersen' => $row[3],
            'type' => $row[4],
            'total_bunga' => (int)$this->rumus($row[1], $row[2], $row[3], $row[4])['bunga'],
            'total_pokok' => (int)$this->rumus($row[1], $row[2], $row[3], $row[4])['pokok'],
            'keterangan' => $row[5],
            'petugas_id' => $row[6],
            'nasabah_id' => $row[7]
        ]);
    }
}
