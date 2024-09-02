<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminDashboardController extends Controller
{
    //direct admin dshboard page
    public function index()
    {
        $total_sale_amount = Order::sum('total_price');
        $userCount = User::where('role', 'user')->count();
        $adminCount = User::where('role', 'admin')->orWhere('role', 'superadmin')->count();
        $orderPending = Order::where('status', 0)->groupBy('order_code')->count();
        $orderSuccess = Order::where('status', 1)->groupBy('order_code')->count();
        $orderDenied = Order::where('status', 2)->groupBy('order_code')->count();
        $categoryList = Category::get()->count();
        $products = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'categories.id', 'products.category_id');
        $productList = $products->limit(7)->get();
        $productCount = $products->count();
        // dd($productList);
        return view('admin.home', compact('total_sale_amount', 'userCount', 'adminCount', 'orderPending', 'orderSuccess', 'orderDenied', 'categoryList', 'productList', 'productCount'));
    }
}
