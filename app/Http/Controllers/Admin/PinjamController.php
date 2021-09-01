<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PinjamExport;
use App\Http\Controllers\Controller;
use App\Imports\PinjamImport;
use App\Models\Kontak;
use App\Models\Pinjam;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pinjam.index', [
            'pinjam' => Pinjam::paginate(8)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pinjam.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request)
    {
        $this->validate($request, [
            'besar_pinjam' => 'required',
            'jangka' => 'required',
            'bunga' => 'required',
            'tipe_pinjaman' => 'required',
            'keterangan' => 'required',
            'nasabah_id' => 'required|exists:kontaks,id',
            'petugas_id' => 'required|exists:kontaks,id',
        ]);
        $besar_pinjam = (int)preg_replace('/[^\d.]/', '', $request->besar_pinjam);
        $jangka = $request->jangka;
        $bunga = $request->bunga;
        $tipe = $request->tipe_pinjaman;
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
            return view('admin.pinjam.detail', [
                'resource' => $resource,
                'besar_angsuran' => $besar_angsuran,
                'tipe' => $tipe,
                'besar_pinjam' => (int)preg_replace('/[^\d.]/', '', $request->besar_pinjam),
                'jangka' => $jangka,
                'bunga' => $bunga,
                'keterangan' => $request->keterangan,
                'nasabah_id' => $request->nasabah_id,
                'petugas_id' => $request->petugas_id
            ]);
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
            return view('admin.pinjam.detail', [
                'resource' => $resource,
                'besar_angsuran' => $besar_angsuran,
                'tipe' => $tipe,
                'besar_pinjam' => (int)preg_replace('/[^\d.]/', '', $request->besar_pinjam),
                'jangka' => $jangka,
                'bunga' => $bunga,
                'keterangan' => $request->keterangan,
                'nasabah_id' => $request->nasabah_id,
                'petugas_id' => $request->petugas_id
            ]);
        } else {
            return back()->with('error', 'Tidak Ada Tipe Yang Dipilih');
        }
    }

    public function store(Request $request)
    {
        Pinjam::create([
            'jumlah_pinjaman' => (int)preg_replace('/[^\d.]/', '', $request->besar_pinjman),
            'jangka' => $request->jangka,
            'bungapersen' => $request->bungapersen,
            'type' => $request->tipe,
            'total_bunga' => $request->bunga,
            'total_pokok' => $request->pokok,
            'keterangan' => $request->keterangan,
            'nasabah_id' => $request->nasabah_id,
            'petugas_id' => $request->petugas_id
        ]);
        return redirect()->route('admin.pinjam.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function show(Pinjam $pinjam)
    {
        $besar_pinjam = $pinjam->jumlah_pinjaman;
        $jangka = $pinjam->jangka;
        $bunga = $pinjam->bungapersen;
        $tipe = $pinjam->type;
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
            return view('admin.pinjam.show', [
                'resource' => $resource,
                'besar_angsuran' => $besar_angsuran,
                'tipe' => $tipe,
                'besar_pinjam' => $pinjam->jumlah_pinjaman,
                'jangka' => $jangka,
                'bunga' => $bunga,
                'keterangan' => $pinjam->keterangan
            ]);
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
            return view('admin.pinjam.show', [
                'resource' => $resource,
                'besar_angsuran' => $besar_angsuran,
                'tipe' => $tipe,
                'besar_pinjam' => $pinjam->jumlah_pinjaman,
                'jangka' => $jangka,
                'bunga' => $bunga,
                'keterangan' => $pinjam->keterangan,
                'nasabah_id' => $pinjam->nasabah_id,
                'petugas_id' => $pinjam->petugas_id
            ]);
        } else {
            return back()->with('error', 'Tidak Ada Tipe Yang Dipilih');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function edit(Pinjam $pinjam)
    {
        return view('admin.pinjam.edit', [
            'pinjam' => $pinjam
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pinjam $pinjam)
    {
        $this->validate($request, [
            'besar_pinjam' => 'required',
            'jangka' => 'required',
            'bungapersen' => 'required',
            'tipe_pinjaman' => 'required',
            'keterangan' => 'required',
            'nasabah_id' => 'required|exists:kontaks,id',
            'petugas_id' => 'required|exists:kontaks,id',
        ]);
        $tipe = $request->tipe_pinjaman;
        $bunga =  $request->bungapersen;
        $jangka = $request->jangka;
        $besar_pinjam = (int)preg_replace('/[^\d.]/', '', $request->besar_pinjam);

        $array_bunga = [0 => 'bunga'];
        $array_pokok = [0 => 'pokok'];
        $array_pinjaman = [0 => (int)preg_replace('/[^\d.]/', '', $request->besar_pinjam)];
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
            Pinjam::where('id', $pinjam->id)->update([
                'jumlah_pinjaman' => (int)preg_replace('/[^\d.]/', '', $request->besar_pinjam),
                'jangka' => $request->jangka,
                'bungapersen' => $request->bungapersen,
                'type' => $request->tipe_pinjaman,
                'total_bunga' => array_sum($array_bunga),
                'total_pokok' => array_sum($array_pokok),
                'keterangan' => $request->keterangan,
                'nasabah_id' => $request->nasabah_id,
                'petugas_id' => $request->petugas_id
            ]);
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

            Pinjam::where('id', $pinjam->id)->update([
                'jumlah_pinjaman' => (int)preg_replace('/[^\d.]/', '', $request->besar_pinjam),
                'jangka' => $request->jangka,
                'bungapersen' => $request->bungapersen,
                'type' => $request->tipe_pinjaman,
                'total_bunga' => array_sum($array_bunga),
                'total_pokok' => array_sum($array_pokok),
                'keterangan' => $request->keterangan,
                'nasabah_id' => $request->nasabah_id,
                'petugas_id' => $request->petugas_id
            ]);
        }


        return redirect()->route('admin.pinjam.index')->with('success', 'Berhasil Mengudpate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $pinjam->delete();
        return back()->with('success', 'Berhasil Menghapus Pinjaman');
    }
    public function export()
    {
        ob_end_clean();
        ob_start();
        return Excel::download(new PinjamExport(), 'Pinjam Export.xlsx');
    }
    public function import_form()
    {
        return view('admin.pinjam.import',[
            'kontak' => Kontak::get()
        ]);
    }
    public function import(Request $request)
    {
        $this->validate($request, [
            'import' => 'required|mimes:csv,xlsx,xls'
        ]);
        try {
            $file = $request->file('import');
            $name_file = rand() . '_' . $file->getClientOriginalName();
            $file->move('import/pinjam/', $name_file);
            Excel::import(new PinjamImport, public_path('import/pinjam/' . $name_file));
            return redirect('/admin/simpanpinjam/pinjam');
        } catch (Exception $err) {
            dd($err->getMessage());
        }
    }
}
