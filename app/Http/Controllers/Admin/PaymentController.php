<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //redirect payment
    public function create()
    {
        $data = PAyment::get();
        return view('admin.payment.create', compact('data'));
    }

    //create payment
    public function createPayment(Request $request)
    {
        $validation = $request->validate([
            'type' => 'required',
            'accName' => 'required',
            'accNo' => 'required',
        ]);

        $data = [
            'type' => $request->type,
            'account_number' => $request->accNo,
            'account_name' => $request->accName,
        ];

        Payment::create($data);
        return back();
    }
}
