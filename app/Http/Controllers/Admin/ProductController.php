<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    //product list page
    public function list()
    {
        $products = Product::when(request('searchKey'), function ($query) {
            $query->whereAny(['name', 'price', 'count'], 'like', '%' . request('searchKey') . '%');
        })
            ->paginate(3);

        return view('admin.product.list', compact('products'));
    }

    //create Page
    public function createPage()
    {
        $categories = Category::get();
        return view('admin.product.create', compact('categories'));
    }

    //create
    public function create(Request $request)
    {
        // dd($request->all());
        $this->validationCheck($request, "create");
        $data = $this->requestProductData($request);
        if ($request->hasFile('image')) {
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path() . '/productImage/', $fileName);
            $data['image'] = $fileName;
        }

        Product::create($data);
        Alert::success('Insert Success', 'Category Insert Succefully');

        return to_route('productList');
    }

    //edit
    public function edit($id)
    {
        $products = Product::select('products.id', 'products.name', 'products.price', 'products.description', 'products.category_id', 'products.count', 'products.image', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.id', $id)->first();
        // dd($products ->toArray());
        $categories = Category::get();
        return view('admin.product.edit', compact('products', 'categories'));
    }

    //update
    public function update(Request $request)
    {
        // dd($request->all());
        $this->validationCheck($request, "update");
        $data = $this->requestProductData($request);
        // dd($request->all());
        if ($request->hasFile('image')) {
            // delete old Img

            if (file_exists(public_path('productImage/' . $request->oldImage))) {
                unlink(public_path('productImage/' . $request->oldImage));
            }
            // upload new Image
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();

            $request->file('image')->move(public_path() . '/productImage/', $fileName);
            $data['image'] = $fileName;
        } else {
            $data['image'] = $request->oldImage;
        }
        // dd($data);
        Product::where('id', $request->productId)->update($data);
        Alert::success('Update Success', 'Category Update Succefully');

        return to_route('productList');
    }

    //delete
    public function delete($id)
    {
        Product::where('id', $id)->delete();
        Alert::success('delete Success', 'Product Delete Succefully');
        return back();
    }

    //details
    public function details($id)
    {
        $data = Product::select('products.id', 'products.name', 'products.price', 'products.description', 'products.category_id', 'products.count', 'products.image', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.id', $id)->first();

        return view('admin.product.details', compact('data'));
    }

    //create Update Validation Check
    private function validationCheck($request, $action)
    {
        $rules = [
            'name' => 'required|unique:products,name,' . $request->productId,
            'price' => 'required',
            'count' => 'required|numeric',
            'categoryName' => 'required',
            'description' => 'required',
        ];

        if ($action == "create") {
            $rules['image'] = 'required|mimes:png,jpg,jpeg,avif,webp';
        } else if ($action == "update" && $request->hasFile('image')) {
            $rules['image'] = 'mimes:png,jpg,jpeg,avif,webp';
        }

        $message = [
            'image.required' => 'Image ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
            'image.mimes' => '"png,jpg,jpeg,avif,webp" file types များကိုသာ လက်ခံပါသည်။',
            'name.required' => 'Name ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
            'price.required' => 'Price ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
            'count.required' => 'Count ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
            'categoryName.required' => 'Category ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
            'description.required' => 'Description ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
        ];
        $validator = $request->validate($rules, $message);
    }

    //request product date
    private function requestProductData($request)
    {
        return [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->categoryName,
            'count' => $request->count,
        ];
    }
}
