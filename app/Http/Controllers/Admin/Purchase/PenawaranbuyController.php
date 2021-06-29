<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Models\Buy;
use App\Models\BuyDetail;
use App\Http\Controllers\Controller;
<<<<<<< HEAD
use App\Models\Kontak;
use App\Models\Rekening;
=======
>>>>>>> 6eeebd1cec9f9891291efacea7801061a6a2d6ed
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PenawaranbuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indeks = Buy::all();
<<<<<<< HEAD
        return view('admin.purchase.penawaran.index',compact('indeks'));
=======
        return view('admin.penawaran.index',compact('indeks'));
>>>>>>> 6eeebd1cec9f9891291efacea7801061a6a2d6ed
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
<<<<<<< HEAD
        return view('admin.purchase.penawaran.create',[

        ]);
=======
        //
>>>>>>> 6eeebd1cec9f9891291efacea7801061a6a2d6ed
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
<<<<<<< HEAD
        return view('admin.purchase.penawaran.'.$id);
=======
        //
>>>>>>> 6eeebd1cec9f9891291efacea7801061a6a2d6ed
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
