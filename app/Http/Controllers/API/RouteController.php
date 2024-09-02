<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RouteController extends Controller
{
    //get all product list
    public function productList()
    {
        $products = Product::get();
        $user = User::get();

        $data = [
            'product' => $products,
            'user' => $user,
        ];
        return response()->json($data, 200);
    }

    //get all product list
    public function categoryList()
    {
        $category = Category::orderBy('id', 'desc')
            ->get();

        return response()->json($category, 200);
    }

    //making them complex
    // get all product list
    //  public function categoryList(){
    //     $category = Category::get();
    //     $products = Product::get();

    //     $data = [
    //         'product' => [
    //            'code lab' => $products
    //         ],
    //         'category' => $category
    //     ];
    //     return response()->json($data,200);
    // }

    // get all product list
    //  public function categoryList(){
    //     $category = Category::get();
    //     $products = Product::get();

    //     $data = [
    //         'product' => [
    //             'code lab' => [
    //                 'test' => $products
    //             ]
    //         ],
    //         'category' => $category
    //     ];
    //     return response()->json($data,200);
    // }

    // category create (post)
    public function categoryCreate(Request $request)
    {
        // dd($request->all());
        // dd($request->header('HeaderData'));
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        Category::create($data);
        return response()->json($data, 200);
    }

    //delet category (post)
    public function categoryDelete(Request $request)
    {
        $data = Category::where('id', $request->category_id)->first();
        if (isset($data)) {
            Category::where('id', $request->category_id)->delete();
            return response()->json(["status" => true, "message" => "delete success"], 200);
        }
        // return !empty($data)

    }

    // category delete (get)
    public function DeleteCategory($id)
    {
        $data = Category::where('id', $id)->first();
        if (isset($data)) {
            Category::where('id', $id)->delete();
            return response()->json(["status" => true, "message" => "delete success", 'deleteData' => $data], 200);
        }
        return response()->json(["status" => false, "message" => "No Category"], 500);
        // return !empty($data)

    }

    // category update (post)
    public function categoryUpdate(Request $request){
        $categoryId = $request->category_id;
        $dbsource = Category::where('id',$categoryId)->first();

        if(isset($dbsource)){
            $data = $this->getCategoryData($request);
            $response = Category::where('id', $categoryId)->update($data);
            return response()->json(['status' => true, 'category' => $response, "message" => "success"]);
        }
        return response()->json(["status" => false, "message" => "No Category"], 500);
    }

    private function getCategoryData($request){
        return [
            'id' => $request->category_id,
            'name' => $request->category_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
