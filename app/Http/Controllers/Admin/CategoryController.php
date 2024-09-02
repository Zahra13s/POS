<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    //category list page
    public function list()
    {
        $data = Category::orderBy('created_at', 'desc')->paginate(5);
        return view("admin.category.list", compact("data"));
    }

    //category create page
    public function createPage()
    {
        return view("admin.category.create");
    }

    //create data
    public function create(Request $request)
    {
        // dd($request->all());
        $validator = $request->validate([
            'category' => 'required|unique:categories,name',
        ],
        [
            'category.required' => 'Category Field ကိုဖြည့်စွက်ရန်လိုအပ်ပါသည်',
            'category.unique' => 'Name ယူထားပြီးသား ဖြစ်ပါသည်',
        ]);

        Category::create([
            'name' => $request->category,
        ]);
        // return back()->with(['success' => 'insert success']);
        Alert::success('Insert Success', 'Category Insert Succefully');

        return back();
    }

    //delete category
    public function delete($id)
    {
        Category::where('id', $id)->delete();
        // return back()->with(['success' => 'insert success']);
        Alert::success('Delete Success', 'Category Delete Succefully');

        return back();

    }

    //edit category
    public function edit($id)
    {
        $data = Category::where('id', $id)->first();
        // dd($data->toArray());
        return view('admin.category.edit', compact('data'));

    }

    //update category
    public function update(Request $request)
    {
        
        $validator = $request->validate([
            'category' => 'required|unique:categories,name,' . $request->categoryId,
        ]);

        Category::where('id', $request->categoryId)->update([
            'name' => $request->category,
        ],
            [
                'category.required' => 'Category Field ကိုဖြည့်စွက်ရန်လိုအပ်ပါသည်',
                'category.unique' => 'Name ယူထားပြီးသား ဖြစ်ပါသည်',
            ]);
        Alert::success('Update Success', 'Category Update Succefully');
        return to_route('categoryList');
    }
}
