<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaySlipHistory;
use Illuminate\Http\Request;

class OrderBoardController extends Controller
{
    //direct orderlist page
    public function list()
    {
        $order = Order::select('orders.*', 'products.name as product_name', 'products.image as product_img', 'users.nickname', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->leftJoin('products', 'products.id', 'orders.product_id')
            ->orderBy('orders.created_at', 'desc')
            ->groupBy('orders.order_code')
            ->paginate(5);
        // dd($order);
        return view('admin.orderBoard.list', compact('order'));
    }

    //details page
    public function userOrderdetails($orderCode)
    {
        $orderDetails = Order::select('orders.*', 'products.name as product_name', 'products.price as product_price', 'products.price as product_price', 'users.name as user_name', 'users.nickname')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->leftJoin('products', 'products.id', 'orders.product_id')
            ->where('orders.order_code', $orderCode)
            ->get();
        // dd($orderDetails);

        $payslipData = PaySlipHistory::select('pay_slip_histories.*', 'payments.type')
            ->leftJoin('payments', 'payments.id', 'pay_slip_histories.payment_method')
            ->where('order_code', $orderCode)
            ->first();
        $total = 0;
        foreach ($orderDetails as $item) {
            $total += $item->count * $item->product_price;
        }
        // dd($paymentType
        // dd($payslipData);
        return view('admin.orderBoard.details', compact('orderDetails', 'total', 'payslipData'));
    }

    //change order status
    public function changeStatus(Request $request)
    {
        // logger($request->all());
        Order::where('order_code', $request->order_code)->update([
            'status' => $request->status,
        ]);
    }
}
