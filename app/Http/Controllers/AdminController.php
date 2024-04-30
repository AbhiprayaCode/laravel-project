<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\order_items;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $products = products::all(["id", "name", "description", "price"])
            ->sortBy('id');
        return view("/admin/admin", compact("products"));
    }

    public function getCategories(){
        $categories = categories::all();
        return view("admin.add", compact("categories"));
    }

    public function addProduct(Request $request){
        $product = new products();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        // Retrieve category ID from the form
        $category_id = $request->category;
        $product->category_id = $category_id;

        $product->save();

        return redirect('/admin')->with('success', 'Product added successfully.');
    }

    public function addIndex(){
        return view("/admin/add");
    }

public function addCategory(Request $request){
    $category = new categories();
    $category->name = $request->category;
    $category->save();

    return redirect('/admin/add/products')->with('success', 'Category added successfully.');
}

public function deleteProduct($id){
            // Disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

    $product = products::find($id);

    if(!$product){
        return redirect('/admin')->with('error', 'Product not found.');
    }

    $product->delete();

            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

    return redirect('/admin')->with('success', 'Product deleted successfully.');
}

public function getProductForUpdate($id){
    $product = products::find($id);
    $categories = categories::all();

    if(!$product){
        return redirect('/admin')->with('error', 'Product not found.');
    }

    return view('admin.update-form', compact('product', 'categories'));
}


public function updateProduct(Request $request, $id){
    $product = products::find($id);
    $categories = categories::all();

    if(!$product){
        return redirect('/admin')->with('error', 'Product not found.');
    }

    if(empty($request->name) || empty($request->description) || empty($request->price)){
        return redirect('/admin')->with('error', 'Error: Please fill in all fields.');
    }

    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;

    $product->save();

    return redirect('/admin')->with('success', 'Product updated successfully.');
}

public function displayData(){
    $products = products::all();
    $categories = categories::all();
    $orderItems = order_items::with('product', 'order')->get();

    return view('admin.orders.index', compact('products', 'categories', 'orderItems'));
}

public function updateOrderStatus($id, Request $request){
    $orderItem = order_items::find($id);

    if(!$orderItem){
        return redirect('/admin/orders/list')->with('error', 'Order Item not found.');
    }

    $orderItem->order->status = $request->status;
    $orderItem->order->save();

    return redirect('/admin/orders/list')->with('success', 'Order status updated successfully.');
}
}
