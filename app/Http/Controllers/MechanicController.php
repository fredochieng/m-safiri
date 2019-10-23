<?php

namespace App\Http\Controllers;

use App\Models\mechanics\Mechanic;
use Illuminate\Http\Request;

class MechanicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data['mechanics'] = Mechanic::getMechanics();
       return view('mechanics.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function show(Mechanic $mechanic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function edit(Mechanic $mechanic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mechanic $mechanic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mechanic $mechanic)
    {
        //
    }
}
