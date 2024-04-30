<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\products;
use App\Models\stocks;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\menus;

class OrderController extends Controller
{
    public function index()
    {
        $orders = order::orderBy("created_at","desc")->paginate(10);
        return view('orders.index',compact('orders_tables'));
    }

    public function add($products_id)
{
    // Mencari menu berdasarkan ID
    $menu = products::findOrFail($products_id);


    // Membuat stocks baru
    $stocks = new order();
    $stocks->products_id = $products_id;

    // Menyimpan stocks ke database
    $stocks->save();

    // Redirect ke halaman yang diinginkan dengan pesan sukses
    return redirect('/orders')->with('success', 'Order berhasil ditambahkan.');
}


}
