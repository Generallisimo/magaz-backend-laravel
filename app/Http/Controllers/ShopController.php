<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail; 
use App\Product;

class ShopController extends Controller
{
        // контролер для вывода товаров на страницу
        public function shopList(){
            $sessionId=Session::getId();
            Cart::session($sessionId); 
            $cart=Cart::getContent();
            $sum = Cart::getTotal('price');
            // обращаемся ко всем элементам в БД
            $products = Product::all();
            // выводим на страницу наше значение
            return view('shop/shop', [
                'products' => $products,
                'cart'=>$cart,
                'sum'=>$sum,
            ]);
        }
}
