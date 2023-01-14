<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail; 
use App\Product;

class ProductRetailController extends Controller
{
    // для товаров по переходу req-делает запрос
    public function productRetails(Request $request){
        $sessionId=Session::getId();
        Cart::session($sessionId); 
        $cart=Cart::getContent();
        $sum = Cart::getTotal('price');
        // обозначаем запрос по id
        $products = Product::query()->where(['id' => $request->id])->get();
        // dd($products);
        return view('shop/single-product-details', [
            'products' => $products,
            'cart'=>$cart,
            'sum'=>$sum,
        ]);
    }
}
