<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderIn;
use App\Mail\OrderOut;
use App\Models\Order;
use App\Product;
use App\Slide;

class ChekoutController extends Controller
{
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
