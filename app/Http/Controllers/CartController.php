<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail; 
use App\Product;

class CartController extends Controller
{
    
    // фун-ия для корзины
    public function addCart(Request $request){
        
        $product = Product::query()->where(['id' => $request->id])->first();
        // Session -> Face нужно выбрать для прокидывания сессии
        $sessionId=Session::getId();
        Cart::session($sessionId)->add([
            // то что мы хотим добавить в карзину записываем сюда
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            // кол-во товара
            'quantity' => $request->qty ?? 1,
            // то что не учтено библиотекой
            'attributes' => [
                'image'=> $product->image,
            ],
        ]);
        // нужно вставить перед каждым view вместе с сессией чтобы работало на всех рендингах
        $cart=Cart::getContent();
        // метод который позваляет остаться на странице при нажатии
        return redirect()->back();
    }
    // удаление из корзины
    public function removeCart($id){        
        // $product = Product::query()->where(['id' => 1])->get('id');
        // $products = $product->id;
        // dd($id);

        $sessionId=Session::getId();
        Cart::session($sessionId);
        $cart=Cart::getContent( );
        
        // $carts = Product::query()->where(['id' => $request->id])->get();
        // dd($product);
        // Session -> Face нужно выбрать для прокидывания сессии
        Cart::session($sessionId)->remove($id);
        // нужно вставить перед каждым view вместе с сессией чтобы работало на всех рендингах
        // метод который позваляет остаться на странице при нажатии
        return redirect()->back();
    }
    
}
