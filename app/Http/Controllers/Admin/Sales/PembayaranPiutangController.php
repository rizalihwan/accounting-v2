<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Http\Controllers\Controller;
use App\Models\Sale\FakturSale;
use App\Models\Sale\PembayaranPiutangDetailSale;
use App\Models\Sale\PembayaranPiutangSale;
use App\Models\Sale\PiutangSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Validator};

class PembayaranPiutangController extends Controller
{
    protected $kode;
    
    public function __construct()
    {
        $number = PembayaranPiutangSale::count();
        if ($number > 0) {
            $number = PembayaranPiutangSale::max('kode');
            $strnum = substr($number, 2, 3);
            $strnum = $strnum + 1;
            if (strlen($strnum) == 3) {
                $kode = 'CP' . $strnum;
            } else if (strlen($strnum) == 2) {
                $kode = 'CP' . "0" . $strnum;
            } else if (strlen($strnum) == 1) {
                $kode = 'CP' . "00" . $strnum;
            }
        } else {
            $kode = 'CP' . "001";
        }
        $this->kode = $kode;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayarans =  PembayaranPiutangSale::select('id', 'tanggal', 'kode', 'pelanggan_id', 'total')->with('pelanggan')->paginate(10);
        return view('admin.sales.pembayaran.index', compact('pembayarans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sales.pembayaran.create', [
            'kode' => $this->kode
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules = [
            'pelanggan_id' => 'required|exists:kontaks,id',
            'akun_id' => 'exists:akuns,id',
            'tanggal' => 'required|date|date_format:Y-m-d',
            'pembayarans.*.faktur_id' => 'required|exists:faktur_sales,id',
            'pembayarans.*.jumlah' => 'required',
            'pembayarans.*.bayar' => 'required',
            'total' => 'required',
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        try {
            DB::transaction(function () use ($request) {
                $pembayarans = PembayaranPiutangSale::create(
                    array_merge(
                        $request->except('pembayarans', 'total', 'jumlah'),
                        [
                            'total' => preg_replace('/[^\d.]/', '', $request->total)
                        ]
                    )
                );

                foreach ($request->pembayarans as $pembayaran) {
                    PembayaranPiutangDetailSale::create([
                        'pembayaran_piutang_sale_id' => $pembayarans->id,
                        'faktur_id' => $pembayaran['faktur_id'],
                        'bayar' => preg_replace('/[^\d.]/', '', $pembayaran['bayar']),
                    ]);

                    $piutang = PiutangSale::where('faktur_id', $pembayaran['faktur_id'])->first();
                    
                    $piutang->update([
                        'lunas' => preg_replace('/[^\d.]/', '', $pembayaran['bayar']),
                        'sisa' => $piutang->total_hutang - preg_replace('/[^\d.]/', '', $pembayaran['bayar']),
                        'status' => $piutang->total_hutang == preg_replace('/[^\d.]/', '', $pembayaran['bayar']) ? '1' : '0'
                    ]);

                    if($piutang->status == 1){
                        $faktur = FakturSale::findOrFail($pembayaran['faktur_id']);
                        $faktur->update([
                            'status' => '1'
                        ]);
                    }
                }
            });

            return redirect()->route('admin.sales.pembayaran.index')->with('success', 'Pembayaran berhasil Tersimpan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
