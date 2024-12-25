<?php

namespace App\Http\Controllers;

use App\Models\Deposite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepositeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {
        $rules=[
            'amount' => 'required|string',
            'user_id' => 'required|string',
            'transaction_id' => 'required|string',
            'paymentMethod' => 'required|string',
            'paymentNumber' => 'required|string',
        ];

        
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return $validator->error();
        }

        $deposite = new Deposite();
        $deposite->amount=$request->amount;
        $deposite->user_id=$request->user_id;
        $deposite->user_id=$request->user_id;
        $deposite->transaction_id=$request->transaction_id;
        $deposite->paymentNumber=$request->payment_number;
        if ($deposite->save()) {
            return response()->json(['message' => 'Deposite has been added successfully'], 201);
        } else {
            return response()->json(['message' => 'Failed to add Deposite'], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Deposite $deposite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deposite $deposite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deposite $deposite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deposite $deposite)
    {
        //
    }
}
