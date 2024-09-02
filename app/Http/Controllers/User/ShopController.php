<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PaySlipHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class ShopController extends Controller
{
    //direct shop lis
    public function shop($category_id = null)
    {
        // dd($category_id);
        $category = Category::get();
        $product = Product::when(request('searchKey'), function ($query) {
            $query->where('products.name', 'like', '%' . request('searchKey') . '%');
        });

        if (request('minPrice') != null && request('maxPrice') != null) {
            $product = $product->whereBetween('price', [request('minPrice'), request('maxPrice')]);
        }

        if (request('minPrice') != null && request('maxPrice') == null) {
            $product = $product->where('products.price', '>=', request('minPrice'));
        }

        if (request('minPrice') == null && request('maxPrice') != null) {
            $product = $product->where('products.price', '<=', request('maxPrice'));
        }

        $product = $product->select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'categories.id', 'products.category_id');

        if ($category_id == null) {
            $product = $product->paginate(9);
        } else {
            $product = $product->where('products.category_id', $category_id)->paginate(9);
        }
        return view('user.shop', compact('product', 'category'));
    }

    //shop deetails
    public function details($id)
    {
        $product = Product::select('products.id', 'products.name', 'products.price', 'products.description', 'products.category_id', 'products.count', 'products.image', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.id', $id)->first();
        // dd($product->toArray());
        $comment = Comment::select('comments.*', 'users.name as user_name', 'users.nickname', 'users.profile as user_profile')
            ->leftJoin('users', 'comments.user_id', 'users.id')
            ->where('comments.product_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        $productRating = Rating::where('product_id', $id)->avg('count');
        $ratingCount = Rating::where('product_id', $id)->get();
        $userRating = Rating::select('count')->where('product_id', $id)->where('user_id', Auth::user()->id)->first();
        $userRating = $userRating == null ? 0 : $userRating['count'];
        // $ratingStatus = Rating::where('product_id', $id)->where('user_id',Auth::user()->id)->first();

        $productList = Product::select('products.id', 'products.name', 'products.price', 'products.description', 'products.category_id', 'products.count', 'products.image', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->get();
// dd($productList->toArray());
        return view('user.details', compact('product', 'comment', 'productRating', 'ratingCount', 'userRating', 'productList'));
    }

    //comment
    public function comment(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);

        $data = [
            'product_id' => $request->productId,
            'user_id' => $request->userId,
            'message' => $request->message,
        ];
        Comment::create($data);
        Alert::success('Comment Success', 'Comments Succefully');
        return back();
    }

    //add rating
    public function addRating(Request $request)
    {
        // dd($request->all());

        $ratingCheckData = Rating::where('product_id', $request->productId)->where('user_id', $request->userId)->first();

        if ($ratingCheckData == null) {
            Rating::create([
                'product_id' => $request->productId,
                'user_id' => $request->userId,
                'count' => $request->productRating,
            ]);
        } else {
            Rating::where('product_id', $request->productId)->where('user_id', $request->userId)->update([
                'count' => $request->productRating,
            ]);
        }
        return back();

    }

    //cart
    public function cart()
    {
        $id = Auth::user()->id;
        $cart = Cart::select('carts.*', 'products.name', 'products.image', 'products.price')
            ->leftJoin('products', 'products.id', 'carts.product_id')
            ->where('user_id', $id)->get();

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item->price * $item->qty;
        }

        $payment = Payment::get();
        // dd($totalPrice);

        return view('user.cart', compact('cart', 'totalPrice', 'payment'));
    }

    //add to cart
    public function addToCart(Request $request)
    {
        // dd($request->all());
        $productId = $request->productId;
        $qty = $request->qty;
        $userId = Auth::user()->id;

        Cart::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'qty' => $qty,
        ]);

        return to_route('shopList');
    }

    //remove cart
    public function removeCart(Request $request)
    {
        logger($request->all());
        Cart::where('id', $request->cartId)->delete();

        $data = Cart::where("user_id", Auth::user()->id)->get();

        $serverResponse = [
            'data' => $data,
            'status' => 200,
            'message' => 'success',
        ];

        return response()->json($serverResponse, 200);
    }

    //order
    public function order(Request $request)
    {
        // logger($request->all());
        $orderArr = [];
        foreach ($request->all() as $item) {

            array_push($orderArr, [
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'status' => 0,
                'order_code' => $item['order_code'],
                'count' => $item['qty'],
                'total_price' => $item['total_price'],
            ]);

            // Order::create([
            //     'user_id' => $item['user_id'],
            //     'product_id' => $item['product_id'],
            //     'status' => 0,
            //     'order_code' => $item['order_code'],
            //     'count' => $item['qty'],
            //     'total_price' => $item['total_price']
            // ]);
        }
        Session::put('orderList', $orderArr);
        logger(Session::get('orderList'));

        // Cart::where('user_id', $item['user_id'])->where('product_id', $item['product_id'])->delete();

        return response()->json([
            "message" => 'success',
            "status" => 200,
        ], 200);
    }

    //direct orderlists
    public function orderList()
    {
        $order = Order::where('user_id', Auth::user()->id)
            ->groupBy('order_code')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('user.orderList', compact('order'));
    }
    //direct pyment page

    public function payment()
    {
        // dd(Session::get('orderList'));
        $orderProduct = Session::get('orderList');
        $total = 0;
        foreach ($orderProduct as $item) {
            $total += $item['total_price'];
        }
        $payment = Payment::OrderBy('type','asc')->get();
        return view('user.payment', compact('payment', 'total', 'orderProduct'));
    }

    //orderproduct
    public function orderProduct(Request $request)
    {
        //cart to order table
        //clean cart
        //user
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'paymentMethod' => 'required',
            'orderCode' => 'required',
            'totalAmount' => 'required',
            'payslipImg' => 'required',

        ]);
        // dd($request->all());
        $cartProduct = Session::get('orderList');
        foreach ($cartProduct as $item) {
            Order::create($item);
            Cart::where('user_id', $item['user_id'])
                ->where('product_Id', $item['product_id'])
                ->delete();
        }
        $data = [
           'customer_name' => $request->name,
           'phone' => $request->phone,
           'payment_method' => $request->paymentMethod,
           'order_code' => $request->orderCode,
           'order_amount' => $request->totalAmount,
           'payslip_image' => $request->payslipImg
        ];

        if ($request->hasFile('payslipImg')) {
            $fileName = uniqid() . $request->file('payslipImg')->getClientOriginalName();
            $request->file('payslipImg')->move(public_path() . '/payslipRecord/', $fileName);
            $data['payslip_image'] = $fileName;
        }

        // dd($data);
         PaySlipHistory::create($data);
         return to_route('orderList');
    }
}
