<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePixTransferRequest;
use App\Http\Requests\UpdatePixTransferRequest;
use App\Models\PixTransfer;

class PixTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(PixTransfer::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePixTransferRequest  $request
     */
    public function store(StorePixTransferRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PixTransfer  $pixTransfer
     */
    public function show(PixTransfer $pixTransfer)
    {
        return response()->json($pixTransfer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePixTransferRequest  $request
     * @param  \App\Models\PixTransfer  $pixTransfer
     */
    public function update(UpdatePixTransferRequest $request, PixTransfer $pixTransfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PixTransfer  $pixTransfer
     */
    public function destroy(PixTransfer $pixTransfer)
    {
        //
    }
}
