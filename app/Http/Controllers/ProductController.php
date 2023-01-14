<?php

namespace App\Http\Controllers;

use App\Mail\OrderIn;
use App\Mail\OrderOut;
use App\Models\Order;
use App\Product;
use App\Slide;
use Illuminate\Http\Request;
//  не видит глобальный поиск по корзине добавляем сюда
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail; 

// создаем контролер с рендингом страниц
class ProductController extends Controller


{
    // для home страницы
    public function shopIndex(){
        // вставка сессии
        $sessionId=Session::getId();
        Cart::session($sessionId); 
        $cart=Cart::getContent();
        $sum = Cart::getTotal('price');
        // рандомные товары 
        $randProducts = Product::query()->inRandomOrder()->limit(3)->get();
        $slides = Slide::all();
        return view('shop/index', [
            'randProducts'=>$randProducts,
            'slides'=>$slides,
            'cart'=>$cart,
            'sum'=>$sum,
        ]);
    }
}
