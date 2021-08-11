<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Http\Controllers\Controller;
use App\Models\Sale\PenawaranSale;
use App\Models\Sale\PengirimanSale;
use App\Models\Sale\PengirimanSaleDetail;
use App\Models\Sale\PesananSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PengirimanController extends Controller
{
    private $kode;

    public function __construct()
    {
        $number = PengirimanSale::count();
        if ($number > 0) {
            $number = PengirimanSale::max('kode');
            $strnum = (int)substr($number, 2, 3);
            $strnum = $strnum + 1;
            if (strlen($strnum) == 3) {
                $kode = 'PP' . $strnum;
            } else if (strlen($strnum) == 2) {
                $kode = 'PP' . "0" . $strnum;
            } else if (strlen($strnum) == 1) {
                $kode = 'PP' . "00" . $strnum;
            }
        } else {
            $kode = 'PP' . "001";
        }
        $this->kode = $kode;
    }

    public function index()
    {
        $pengirmans = PengirimanSale::select('id', 'tanggal', 'kode', 'total', 'status', 'pelanggan_id')->with('pelanggan:id,nama');

        return view('admin.sales.pengiriman.index', [
            'pengirimans' => $pengirmans->paginate(5),
            'countPengiriman' => $pengirmans->count(),
        ]);
    }

    public function create()
    {
        return view('admin.sales.pengiriman.create', [
            'kode' => $this->kode,
        ]);
    }

    public function store(Request $request)
    {
        $error = Validator::make($request->all(), [
            'pelanggan_id' => 'required|exists:kontaks,id',
            'pesanan_id' => 'exists:pesanan_sales,id',
            'tanggal' => 'required|date|date_format:Y-m-d',
            'pengirimans.*.product_id' => 'required|exists:products,id',
            'pengirimans.*.jumlah' => 'required|numeric',
            'pengirimans.*.satuan' => 'required',
            'pengirimans.*.harga' => 'required',
            'pengirimans.*.total' => 'required',
            'total' => 'required',
        ]);

        if ($error->fails()) {
            return redirect()->back()->withErrors($error);
        }

        try {
            DB::transaction(function () use ($request) {
                $pengirimans = PengirimanSale::create(
                    array_merge(
                        $request->except('pengirimans', 'total'),
                        [
                            'total' => preg_replace('/[^\d.]/', '', $request->total)
                        ]
                    )
                );

                $pesanan = PesananSale::findOrFail($request->pesanan_id);
                $pesanan->update([
                    'status' => '1'
                ]);

                foreach ($request->pengirimans as $pengiriman) {
                    PengirimanSaleDetail::create([
                        'pengiriman_id' => $pengirimans->id,
                        'product_id' => $pengiriman['product_id'],
                        'satuan' => $pengiriman['satuan'],
                        'harga' => preg_replace('/[^\d.]/', '', $pengiriman['harga']),
                        'jumlah' => $pengiriman['jumlah'],
                        'total' => preg_replace('/[^\d.]/', '', $pengiriman['total']),
                    ]);
                }
            });

            return redirect()->route('admin.sales.pengiriman.index')->with('success', 'Pengiriman berhasil Tersimpan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function show($id)
    {
        $pengiriman = PengirimanSale::with('pengiriman_details.product', 'pelanggan')->findOrFail($id);

        return view('admin.sales.pengiriman.show', compact('pengiriman'));
    }

    public function edit($id)
    {
        $pengiriman = PengirimanSale::with('pelanggan:id,nama,kode_kontak', 'pesanan:id,kode', 'pengiriman_details')
            ->findOrFail($id);

        if (empty($pengiriman)) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }

        return view('admin.sales.pengiriman.edit', compact('pengiriman'));
    }

    public function update(Request $request, $id)
    {
        $req = $request->except('_token', '_method');

        $validate = Validator::make($req, [
            'pengirimans.*.product_id' => 'required|exists:products,id',
            'pengirimans.*.jumlah' => 'required|numeric',
            'pengirimans.*.satuan' => 'required',
            'pengirimans.*.harga' => 'required',
            'pengirimans.*.total' => 'required',
            'total' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $pengiriman = PengirimanSale::with('pelanggan:id,nama,kode_kontak', 'pesanan:id,kode')
            ->findOrFail($id);

        if (empty($pengiriman)) {
            return redirect()->route('admin.sales.pesanan.index')->with('error', 'Pesanan tidak ada.');
        }

        try {
            DB::transaction(function () use ($id, $req, $pengiriman) {
                $detail_id = [];

                foreach ($req['pengirimans'] as $value) {
                    $detail_id[] = $value['id'];
                }

                $detail_id = array_filter($detail_id, fn ($value) => !is_null($value) && $value !== '');

                PengirimanSaleDetail::where('pengiriman_id', $id)
                    ->whereNotIn('id', $detail_id)
                    ->delete();

                foreach ($req['pengirimans'] as $item) {
                    if ($item['id'] != null) {
                        PengirimanSaleDetail::where('id', $item['id'])->update([
                            'product_id' => $item['product_id'],
                            'satuan' => $item['satuan'],
                            'harga' => preg_replace('/[^\d.]/', '', $item['harga']),
                            'jumlah' => $item['jumlah'],
                            'total' => preg_replace('/[^\d.]/', '', $item['total']),
                        ]);
                    } else {
                        PengirimanSaleDetail::create([
                            'pengiriman_id' => $id,
                            'product_id' => $item['product_id'],
                            'satuan' => $item['satuan'],
                            'harga' => preg_replace('/[^\d.]/', '', $item['harga']),
                            'jumlah' => $item['jumlah'],
                            'total' => preg_replace('/[^\d.]/', '', $item['total']),
                        ]);
                    }
                }

                $pengiriman->update([
                    'total' => preg_replace('/[^\d.]/', '', $req['total'])
                ]);
            });

            return redirect()->route('admin.sales.pengiriman.index')->with('success', 'Pengiriman berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $pesanans = PengirimanSale::findOrFail($id);
        $pesanans->delete();

        return redirect()->back()->with('success', 'Pengiriman berhasil Dihapus');
    }
}
