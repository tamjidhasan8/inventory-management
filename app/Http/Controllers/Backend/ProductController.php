<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\WareHouse;
use App\Models\Supplier;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    public function AllCategory()
    {
        $category = ProductCategory::latest()->get();
        return view("admin.backend.category.all_category", compact("category"));
    }
    //End Method

    public function StoreCategory(Request $request)
    {
        ProductCategory::insert([
            'category_name' => $request->category_name,
            'category_slag' => strtolower(str_replace(' ', '-', $request->category_name))
        ]);
        $notification = array(
            'message' => 'Product Category Inserted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    //End Method

    public function EditCategory($id)
    {
        $category = ProductCategory::find($id);
        return response()->json($category);
    }
    //End Method

    public function UpdateCategory(Request $request)
    {
        $cat_id = $request->cat_id;
        ProductCategory::find($cat_id)->update([
            'category_name' => $request->category_name,
            'category_slag' => strtolower(str_replace(' ', '-', $request->category_name))
        ]);
        $notification = array(
            'message' => 'Product Category Updated Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    //End Method
    public function DeleteCategory($id)
    {
        ProductCategory::find($id)->delete();
        $notification = array(
            'message' => 'Product Category Deleted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
    //End Method


    //Add Product All Methods

    public function AllProduct()
    {
        $allData = Product::orderBy('id', 'desc')->get();
        return view('admin.backend.product.product_list', compact('allData'));
    }
    //End Method

    public function AddProduct(Request $request)
    {
        $categories = ProductCategory::all();
        $brands = Brand::all();
        $suppliers = Supplier::all();
        $warehouses = WareHouse::all();

        return view('admin.backend.product.add_product', compact('categories', 'brands', 'suppliers', 'warehouses'));
    }
    //End Method

    public function StoreProduct(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'code' => $request->code,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'warehouse_id' => $request->warehouse_id,
            'supplier_id' => $request->supplier_id,
            'price' => $request->price,
            'stock_alert' => $request->stock_alert,
            'note' => $request->note,
            'product_qty' => $request->product_qty,
            // 'discount'=> $request->discount,
            'status' => $request->status,
            'created_at' => now(),
        ]);

        $product_id = $product->id;
        //Multiple Image Upload
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $img) {
                $manager    = new ImageManager(new Driver());
                $name_gen   = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                $imgs = $manager->read($img);
                $imgs->resize(150, 90)->save(public_path('upload/productImg/' . $name_gen));
                $save_url = 'upload/productImg/' . $name_gen;


                ProductImage::create([
                    'product_id' => $product_id,
                    'image' => $save_url,
                ]);
            }
        }
        $notification = array(
            'message' => 'Product Inserted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.product')->with($notification);
    }
    //End Method

    public function EditProduct($id){
        $editData = Product::find($id);
        $categories = ProductCategory::all();
        $brands = Brand::all();
        $suppliers = Supplier::all();
        $warehouses = WareHouse::all();
        $multyimg = ProductImage::where('product_id', $id)->get();

        return view('admin.backend.product.edit_product', compact('categories', 'brands', 'suppliers', 'warehouses', 'editData', 'multyimg'));
    }
    //End Method
}
