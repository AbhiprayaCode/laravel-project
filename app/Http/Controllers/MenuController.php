<?php

namespace App\Http\Controllers;

use App\Models\menus;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index() {
        $products = products::all(["id", "name", "description", "price"])
            ->sortBy('id');
        return view("dashboard", compact("products"));
    }

    public function add() {
        return view("menus/add-form");
    }

    public function update(string $id) {
        $products = products::find($id);
        return view("menus/update-form", ["products" => $products]);
    }

}
