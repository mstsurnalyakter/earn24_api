<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WithdrawController extends Controller
{
    public function addWithdraw(Request $request){
        $rules=[
            'amount' => 'required|string',
            'userId' => 'required|string',
            'paymentMethod' => 'required|string',
            'paymentNumber' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $withdraw = new Withdraw();
        $withdraw->amount = $request->input('amount');
        $withdraw->userId = $request->input('userId');
        $withdraw->paymentMethod = $request->input('paymentMethod');
        $withdraw->paymentNumber = $request->input('paymentNumber');
        $withdraw->save();
        return response()->json(['message' => 'Withdraw  successfully'], 201);

    }
}
