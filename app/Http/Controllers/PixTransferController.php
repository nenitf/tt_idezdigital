<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\PixTransfer;
use App\Http\Resources\PixTransferResource;

class PixTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pixTransfers = PixTransfer::where('user_id', Auth::id())->get();
        return PixTransferResource::collection($pixTransfers)->collection;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     */
    public function store(Request $request)
    {
        $pixTransfer = PixTransfer::create([
            'user_id' => Auth::id(),
            'key' => $request->key,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return new PixTransferResource($pixTransfer);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     */
    public function show($id)
    {
        $pixTransfer = PixTransfer::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return new PixTransferResource($pixTransfer);
    }
}
