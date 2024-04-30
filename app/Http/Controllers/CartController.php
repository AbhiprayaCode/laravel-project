<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\order;
use App\Models\order_items;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // public function __construct(){
    //     $this->middleware("auth");
    // }


    public function index(){
        $cart = Cart::all()
            ->sortBy('id');
        return view('cart.index',compact('cart'));
    }

    public function store($product_id){
        // Cart::create([
        //     'user_id' => Auth::user()->id,
        //     'product_id' => $request->product_id,
        //     'quantity' => 1,
        // ]);
        $menu = order::findOrFail($product_id);


    // Membuat stocks baru
    $stocks = new order();
    $stocks->products_id = $product_id;

    // Menyimpan stocks ke database
    $stocks->save();

        return redirect('/cart')->with('success','successfully inserted!');
    }

public function addToCart(Request $request, $product_id){
    // Check if the cart item exists for this user and product
    $cartItem = Cart::where('user_id', Auth::user()->id)
                    ->where('product_id', $product_id)
                    ->first();

    if ($cartItem) {
        // If exists, just update the quantity
        $cartItem->quantity += 1;
    } else {
        // If not exists, create a new cart item
        $cartItem = new Cart();
        $cartItem->user_id = Auth::user()->id;
        $cartItem->product_id = $product_id;
        $cartItem->quantity = 1;
    }

    // Save the cart item
    $cartItem->save();

    // Redirect back with success message
    return redirect()->back()->with('success', 'Product added to cart successfully!');
}

public function incrementQuantity($cart_id) {
    $cartItem = Cart::find($cart_id);
    if ($cartItem) {
        $cartItem->quantity += 1;
        $cartItem->save();
        return redirect()->back()->with('success', 'Quantity increased by 1.');
    }
    return redirect()->back()->with('error', 'Cart item not found.');
}

public function decrementQuantity($cart_id) {
    $cartItem = Cart::find($cart_id);
    if ($cartItem) {
        if ($cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cartItem->save();
            return redirect()->back()->with('success', 'Quantity decreased by 1.');
        } else {
            $cartItem->delete();
            return redirect()->back()->with('error', 'Quantity cannot be less than 1. Cart item deleted.');
        }
    }
    return redirect()->back()->with('error', 'Cart item not found.');
}

public function checkout()
{
    // Ambil detail pesanan dari tabel cart
    $cartItems = Cart::where('user_id', auth()->id())->get();

    // Simpan detail pesanan ke dalam tabel orders
    foreach ($cartItems as $cartItem) {
        $orders = new Order();
        $orders->user_id = auth()->id(); // Memasukkan user_id ke dalam tabel orders
        $orders->save();

        $order = new order_items();
        $order->product_id = $cartItem->product_id;
        $order->quantity = $cartItem->quantity;
        $order->unit_price = products::find($cartItem->product_id)->price; // Add unit_price based on the price in the products table
        $order->order_id = $orders->id; // Add order_id based on the id in the orders table

        $order->save();

    }

    // Hapus item dari tabel cart
    Cart::where('user_id', auth()->id())->delete();

    return redirect()->route('cart.index')->with('success', 'Checkout berhasil!');
}

// public function showOrderStatus()
// {
//     $orderItems = order_items::whereHas('order', function ($query) {
//         $query->where('user_id', auth()->id());
//     })->get();

//     $orderItems->load('product', 'order');

//     foreach ($orderItems as $orderItem) {
//         $orderItem->status = $orderItem->order->status; // Assign the status from the order to the order item
//     }
//     $orders = $orderItems; // Definisikan variabel $orders


//     return view('orders.index', compact('orders'));
// }

public function showProductsByOrderItems()
{
    $orderItems = order_items::whereHas('order', function ($query) {
        $query->where('user_id', auth()->id());
    })->with('product', 'order')->get();

    $products = products::all();

    return view('orders.index', compact('products', 'orderItems'));
}


public function cancelOrder($id)
{
    $orderItem = order_items::find($id);
    $orders = order::whereHas('OrderItems', function ($query) use ($id) {
        $query->where('id', $id);
    })->first();

    if (!$orderItem) {
        return redirect()->back()->with('error', 'Order item not found.');
    }
    // Mengubah nilai enum dari 'old_value' menjadi 'new_value'
    $orders->status = 'cancelled';
    $orders->save();
    $orderItem->delete();

    return redirect()->back()->with('success', 'Order item canceled successfully.');
}




}
