<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
        public function AllCategory()
    {
        $category = ProductCategory::latest()->get();
        return view("admin.backend.category.all_category", compact("category"));
    }
    //End Method

    public function StoreCategory(Request $request){
        ProductCategory::insert([
            'category_name' => $request->category_name,
            'category_slag' => strtolower(str_replace(' ', '-',$request->category_name))
        ]);
        $notification = array(
            'message' => 'Product Category Inserted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    //End Method

    public function EditCategory($id){
        $category = ProductCategory::find($id);
        return response()->json($category);
    }
    //End Method

    public function UpdateCategory(Request $request){
        $cat_id = $request->cat_id;
        ProductCategory::find($cat_id)->update([
            'category_name' => $request->category_name,
            'category_slag' => strtolower(str_replace(' ', '-',$request->category_name))
        ]);
        $notification = array(
            'message' => 'Product Category Updated Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    //End Method
    public function DeleteCategory($id){
        ProductCategory::find($id)->delete();
        $notification = array(
            'message' => 'Product Category Deleted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    //End Method
}
