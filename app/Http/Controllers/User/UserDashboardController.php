<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserDashboardController extends Controller
{
    //direct user dashboard page
    public function index()
    {
        $category = Category::get();
        $product = Product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->get();
        $customerCount = User::where('role', 'user')->count();
        $rating = Rating::select('ratings.count as rating_count', 'users.name', 'users.nickname', 'users.profile', 'ratings.created_at')
            ->leftJoin('users', 'ratings.user_id', 'users.id')
            ->orderBy('created_at', 'asc')->get();
        return view('user.home', compact('category', 'product', 'customerCount', 'rating'));
    }
}
