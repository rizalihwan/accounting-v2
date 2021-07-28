<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::paginate(5);

        return view('admin.bank.index',compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $cek = Bank::select(['id', 'kode'])->where('kode', $request->kode)->count();

            $response = '<span class="text-success">Available.</span>';

            if ($cek > 0) {
                $response = '<span class="text-danger">Not Available.</span>';
                return response()->json(['invalid' => $response]);
            }

            return response()->json(['valid' => $response]);
        }

        $this->validate($request, [
            'kode' => 'required|min:4|unique:banks',
            'nama_bank' => 'required|string',
        ]);

        try {
            Bank::create($request->all());
        } catch (\Exception $e) {
            return back()->with('error', 'Data Gagal Disimpan!');
        }
        return redirect()->route('admin.bank.index')
                        ->with('success','Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        return view('admin.bank.show',compact('bank'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        return view('admin.bank.edit',compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        try {
            $bank->update($request->all());
        } catch (\Exception $e) {
            return back()->with('error', 'Data Gagal Diupdate!');
        }
        return redirect()->route('admin.bank.index')
                        ->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        $bank->delete();

        return redirect()->route('bank.index')
                        ->with('success','Data Berhasil Dihapus');
    }
}
