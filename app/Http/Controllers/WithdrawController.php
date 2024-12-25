<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WithdrawController extends Controller
{

    public function index(){
        $withdraws = Withdraw::all();
        return response()->json(['withdraws'=>$withdraws], 200);
    }
    public function addWithdraw(Request $request){
        $rules=[
            'amount' => 'required|string',
            'userId' => 'required|string',
            'paymentMethod' => 'required|string',
            'paymentNumber' => ['required', 'string', 'regex:/^(?:\+88|88)?(01[3-9]\d{8})$/'],
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
