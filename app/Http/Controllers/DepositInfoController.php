<?php

namespace App\Http\Controllers;

use App\Models\DepositInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepositInfoController extends Controller
{
    
    // public function index(){
    //     $deposits = DepositInfo::all();
    //     return response()->json(['deposits' => $deposits], 200);
    // }
    public function index(){
        $deposits = DepositInfo::all();
        return response()->json(['deposits'=>$deposits], 200);
    }
    public function addDeposit(Request $request){
        $rules=[
            'amount' => 'required|string',
            'userId' => 'required|string',
            'transactionId' => 'required|string',
            'paymentMethod' => 'required|string',
            'paymentNumber' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $deposit = new DepositInfo();
        $deposit->amount = $request->input('amount');
        $deposit->userId = $request->input('userId');
        $deposit->transactionId = $request->input('transactionId');
        $deposit->paymentMethod = $request->input('paymentMethod');
        $deposit->paymentNumber = $request->input('paymentNumber');
        $deposit->save();

        return response()->json(['message' => 'Deposit added successfully'], 201);
    }
}