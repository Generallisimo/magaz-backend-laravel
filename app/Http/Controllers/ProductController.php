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
    public function shopBlog(){
        $sessionId=Session::getId();
        Cart::session($sessionId); 
        $cart=Cart::getContent();
        $sum = Cart::getTotal('price');
        return view('shop/blog', [
            'cart'=>$cart,
            'sum'=>$sum,
        ]);
    }


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
    // карзина товаров с подтверждением 
    public function checkOut(){            
        $user=Auth::user();
        
        // так должен выводится юзер из сессии также можно дампить страницы итд
        // dd($user);

        $sessionId=Session::getId();
        Cart::session($sessionId); 
        $cart=Cart::getContent();
        $sum = Cart::getTotal('price');
        // Выводим историю заказов
        // выводит id user  $user->getAuthIdentifier() но json формате
        $orders = Order::query()->where(['user_id' => $user->getAuthIdentifier()])->orderBy('id','desc')->get();
        
        // переводим в другой формат
        $orders->transform(function($order){
             $order->cart_data = unserialize($order->cart_data);
            // dd($order);
             return $order;
        }); 
        // выводим сообщение о успешном заказе
        $messageSuccessOrder = session('successOrder');
        if(!empty($messageSuccessOrder)){
            return view('shop/checkout', [        
                'cart'=>$cart,
                'sum'=>$sum,
                // выводим user на страницу
                'user'=>$user,
                'orders'=>$orders,
                // добавляем переменную
            ])->with('messageSuccessOrder', $messageSuccessOrder);
        }
        return view('shop/checkout', [        
            'cart'=>$cart,
            'sum'=>$sum,
            // выводим user на страницу
            'user'=>$user,
            'orders'=>$orders,
        ])->with('messageSuccessOrder', $messageSuccessOrder);
    }
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
    // акканут личный
    public function accIndex(){
        $sessionId=Session::getId();
        Cart::session($sessionId); 
        $cart=Cart::getContent();
        $sum = Cart::getTotal('price');
        return view('shop/account', [
            'cart'=>$cart,
            'sum'=>$sum,
        ]);
    }
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
    public function makeOrder(Request $request){
        // дампим страницу и проверяем на работу запросов
        // dd($request);
        $user=Auth::user();
        $sessionId=Session::getId();
        Cart::session($sessionId); 
        $cart=Cart::getContent();
        $sum = Cart::getTotal('price');
        // вводим то, что хотим вывести в БД
        $order = new Order();
        $order->user_id = $user->id;
        $order->cart_data = $order->setCartDataAttribute($cart);
        $order->total_sum = $sum;
        // так сразу можно перечислить несолько объектов в один столбец
        $order->address = $request->address.' '. $request->post.' '. $request->city.' '. $request->prov;
        $order->phone = $request->phone;
        // $order->save(); 
        if($order->save()){
            // отправка сообщения на почту
            Mail::to('admindadydd@rambler.ru')->send(new OrderIn([
                'cart' => $cart,
                'sum' => $sum,
                'user' => $user,
            ]));
            // пишет, что запрос спам и не дает отправить
            Mail::to($request->user())->send(new OrderOut([
                'cart' => $cart,
                'sum' => $sum, 
                'user' => $user,
            ]));
            // чистим карзину после заказа
            Cart::clear();
            // Сообщение после 
            Session::flash('successOrder', 'Good, wait 5 minut, please!');
            return back();
        }
        // если ошибка
        Session::flash('error Order', 'Error!');
        return back();
    }
}
