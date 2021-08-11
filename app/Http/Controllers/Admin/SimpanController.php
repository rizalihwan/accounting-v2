<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Simpan;
use Illuminate\Http\Request;

class SimpanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.simpan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.simpan.create');
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
     * @param  \App\Models\Simpan  $simpan
     * @return \Illuminate\Http\Response
     */
    public function show(Simpan $simpan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Simpan  $simpan
     * @return \Illuminate\Http\Response
     */
    public function edit(Simpan $simpan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Simpan  $simpan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Simpan $simpan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Simpan  $simpan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Simpan $simpan)
    {
        //
    }
}
