<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class SalesInformationController extends Controller
{
    //direct list
    public function list()
    {
        $order = Order::select('orders.*', 'products.name as product_name', 'products.image as product_img', 'users.nickname', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->leftJoin('products', 'products.id', 'orders.product_id')
            ->where('orders.status', 1)
            ->orderBy('orders.created_at', 'desc')
        // ->groupBy('orders.order_code')
            ->paginate(5);
        // dd($order);

        return view('admin.saleinformation.salesinformation', compact('order'));
    }
}
