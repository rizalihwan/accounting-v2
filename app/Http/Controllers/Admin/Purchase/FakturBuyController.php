<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Purchase\FakturBuy;
use App\Models\Purchase\FakturBuyDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Validator};

class FakturBuyController extends Controller
{
    protected $kode;
    
    public function __construct()
    {
        $number = FakturBuy::count();
        if ($number > 0) {
            $number = FakturBuy::max('kode');
            $strnum = substr($number, 2, 3);
            $strnum = $strnum + 1;
            if (strlen($strnum) == 3) {
                $kode = 'PF' . $strnum;
            } else if (strlen($strnum) == 2) {
                $kode = 'PF' . "0" . $strnum;
            } else if (strlen($strnum) == 1) {
                $kode = 'PF' . "00" . $strnum;
            }
        } else {
            $kode = 'PF' . "001";
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
        $fakturs = FakturBuy::select('id', 'tanggal', 'kode', 'pemasok_id', 'total', 'status')
            ->with('pemasok')
            ->paginate(10);

        return view('admin.purchase.faktur.index', compact('fakturs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.purchase.faktur.create', [
            'kode' => $this->kode,
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
            'pemasok_id' => 'required|exists:kontaks,id',
            'pesanan_id' => 'exists:pesanan_buys,id',
            'tanggal' => 'required|date|date_format:Y-m-d',
            'status' => 'sometimes',
            'fakturs.*.product_id' => 'required|exists:products,id',
            'fakturs.*.jumlah' => 'required|numeric',
            'fakturs.*.satuan' => 'required',
            'fakturs.*.harga' => 'required',
            'fakturs.*.total' => 'required',
            'total' => 'required',
        ];

        if (!empty($request->status)) {;
            $rules['akun_id'] = 'required|exists:akuns,id';
        }

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        try {
            DB::transaction(function () use ($request) {
                $fakturs = FakturBuy::create(array_merge(
                    $request->except('fakturs', 'akun_id', 'status', 'total'),
                    [
                        'akun_id' => $request->akun_id ?? null,
                        'status' => !empty($request->status) && !empty($request->akun_id) ? '1' : '0',
                        'total' => preg_replace('/[^\d.]/', '', $request->total),
                    ]
                ));

                foreach ($request->fakturs as $faktur) {
                    FakturBuyDetail::create([
                        'faktur_id' => $fakturs->id,
                        'product_id' => $faktur['product_id'],
                        'satuan' => $faktur['satuan'],
                        'harga' => preg_replace('/[^\d.]/', '', $faktur['harga']),
                        'jumlah' => $faktur['jumlah'],
                        'total' => preg_replace('/[^\d.]/', '', $faktur['total']),
                    ]);
                }
            });

            return redirect()->route('admin.purchase.faktur.index')->with('success', 'Faktur berhasil tersimpan');
        } catch (\Exception $e) {
            return back()->with('error', 'Faktur tidak Tersimpan!' . $e->getMessage());
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
        return view('admin.purchase.faktur.'.$id);
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
        $fakturs = FakturBuy::findOrFail($id);
        $fakturs->delete();

        return redirect()->back()->with('success', 'Faktur berhasil Dihapus');
    }
}
