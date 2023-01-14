<!-- подключаем основной файл с разметкой -->
@extends('shop.layouts.master')
<!-- даем название странице -->
@section('title', 'Single-product')
<!-- вставляем контент -->
@section('content')
<!-- пишем фун-ию GET запроса -->
@foreach($products as $product)
    <!-- ##### Single Product Details Area Start ##### -->
    <section class="single_product_details_area d-flex align-items-center">

        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix">
            <div class="">
                <!-- картинку по id -->
                <img src="{{asset("/storage/$product->image")}}" alt="">
            </div>
        </div>

        <!-- Single Product Description -->
        <div class="single_product_desc clearfix">
            <span>Ksyusha Beauty</span>
            <a href="cart.html">
                <!-- воводим название по id -->
                <h2>{{$product->name}}</h2>
            </a>
            <!-- для скидочной цены -->
            <!-- <p class="product-price"><span class="old-price">$65.00</span> $49.00</p> -->

            <!-- вовдим id цены -->
            <p class="product-price">{{$product->price}} $</p>
            <!-- выводим описание по id -->
            <p class="product-desc">{{$product->description}}</p>

            <!-- Form -->
            <form class="cart-form clearfix" method="post">
                <!-- Select Box -->
                <!-- <div class="select-box d-flex mt-50 mb-30">
                    <select name="select" id="productSize" class="mr-5">
                        <option value="value">Size: XL</option>
                        <option value="value">Size: X</option>
                        <option value="value">Size: M</option>
                        <option value="value">Size: S</option>
                    </select>
                    <select name="select" id="productColor">
                        <option value="value">Color: Black</option>
                        <option value="value">Color: White</option>
                        <option value="value">Color: Red</option>
                        <option value="value">Color: Purple</option>
                    </select>
                </div> -->
                <!-- Cart & Favourite Box -->
                <div class="cart-fav-box d-flex align-items-center">
                    <!-- Cart -->
                    <button type="submit" name="addtocart" value="5" class="btn essence-btn">Add to cart</button>
                    <!-- Favourite -->
                    <div class="product-favourite ml-4">
                        <a href="#" class="favme fa fa-heart"></a>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- ##### Single Product Details Area End ##### -->
    @endforeach
@endsection