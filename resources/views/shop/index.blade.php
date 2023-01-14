<!-- подключаем основной файл с разметкой -->
@extends('shop.layouts.master')
<!-- даем название странице -->
@section('title', 'Home')
<!-- вставляем контент -->
@section('content')
@include('shop.layouts.right')
    <!-- карусель -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach($slides as $slide)
        <div class="carousel-item active">
            <img src="{{asset("/storage/$slide->image")}}"" class="d-block w-100" alt="...">
        </div>
        @endforeach
        <!-- <div class="carousel-item">
        <img src="/img/image/f2.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="/img/image/f3.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="/img/image/f4.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="/img/image/f5.png" class="d-block w-100" alt="...">
        </div> -->
    </div>
    <!-- кнопки для карусели -->
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">    
        <span class="visually-hidden" style="font-size: 55px; color:red;">&lt;</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">        
        <span class="visually-hidden"  style="font-size: 55px; color:red;">&gt;</span>
    </a>
    </div>

    <!-- Начало главной страницы с контейнером -->
    <div class="top_catagory_area section-padding-80 clearfix">
        <div class="container">
            <div class="section-heading text-center">
                <h2>Popular Products</h2>
            </div>
            <!-- начало контейнера для товаров -->
            <div class="row">
            <!-- создаем фун-ию для вывода товаров -->
            @foreach($randProducts as $randProduct)
                <!-- здесь мы создаем функцию для товара чтобы перенсти все из БД -->
                <!-- Продукт -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-product-wrapper">
                        <!-- Картинка для товара-->
                        <div class="product-img">
                            <!-- так выводятся картинки на Laravel 9 из БД -->
                            <img src="{{asset("/storage/$randProduct->image")}}" alt="">

                            <!-- Смена картинки при наведении Thumb -->
                            <!-- <img class="hover-img" src="img/product-img/product-2.jpg" alt=""> -->

                            <!-- Надпись вверху со скидкой -->
                            <!-- <div class="product-badge offer-badge">
                                <span>-30%</span>
                            </div> -->

                            <!-- Добавить в избранные -->
                            <!-- <div class="product-favourite">
                                <a href="#" class="favme fa fa-heart"></a>
                            </div> -->
                        </div>

                        <!-- Описание товара -->
                        <div class="product-description">
                            <!-- название компании -->
                            <span>Ksyusha Beauty</span>
                            <!-- так мы делаем переход к каждому товару индивидуально -->
                            <a href="#">
                                <!-- название товара (такой вывод у Laravel из БД) -->
                                <h6>{{$randProduct->name}}</h6>
                            </a>
                            <!-- цены на товар со скидкой -->
                            <!-- <p class="product-price"><span class="old-price">$75.00</span> $55.00</p> -->

                            <!-- цена -->
                            <p class="product-price">${{$randProduct->price}}</p>
                            <!-- при наведение чтобы добавить в каталог-->
                            <div class="hover-content">
                                <div class="add-to-cart-btn">
                                    <!-- добавляем товары в корзину через кнопку -->
                                    <a href="{{route('addcart', ['id' => $randProduct->id])}}" class="btn essence-btn">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- закрываем фун-ию -->
                @endforeach
            </div>        
        </div>
    </div>
    <!-- ##### Top Catagory Area End ##### -->

    <!-- ##### CTA Area Start ##### -->
    <div class="cta-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-content bg-img background-overlay" style="background-image: url(img/bg-img/bg-5.jpg);">
                        <div class="h-100 d-flex align-items-center justify-content-end">
                            <div class="cta--text">
                                <h6>-60%</h6>
                                <h2>Global Sale</h2>
                                <a href="#" class="btn essence-btn">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### CTA Area End ##### -->

    <!-- ##### New Arrivals Area Start ##### -->
    <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Popular Products</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="popular-products-slides owl-carousel">

                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="img/product-img/product-1.jpg" alt="">
                                <!-- Hover Thumb -->
                                <img class="hover-img" src="img/product-img/product-2.jpg" alt="">
                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <span>topshop</span>
                                <a href="single-product-details.html">
                                    <h6>Knot Front Mini Dress</h6>
                                </a>
                                <p class="product-price">$80.00</p>

                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
                                        <a href="#" class="btn essence-btn">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="img/product-img/product-2.jpg" alt="">
                                <!-- Hover Thumb -->
                                <img class="hover-img" src="img/product-img/product-3.jpg" alt="">
                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <span>topshop</span>
                                <a href="single-product-details.html">
                                    <h6>Poplin Displaced Wrap Dress</h6>
                                </a>
                                <p class="product-price">$80.00</p>

                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
                                        <a href="#" class="btn essence-btn">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="img/product-img/product-3.jpg" alt="">
                                <!-- Hover Thumb -->
                                <img class="hover-img" src="img/product-img/product-4.jpg" alt="">

                                <!-- Product Badge -->
                                <div class="product-badge offer-badge">
                                    <span>-30%</span>
                                </div>

                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <span>mango</span>
                                <a href="single-product-details.html">
                                    <h6>PETITE Crepe Wrap Mini Dress</h6>
                                </a>
                                <p class="product-price"><span class="old-price">$75.00</span> $55.00</p>

                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
                                        <a href="#" class="btn essence-btn">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="img/product-img/product-4.jpg" alt="">
                                <!-- Hover Thumb -->
                                <img class="hover-img" src="img/product-img/product-5.jpg" alt="">

                                <!-- Product Badge -->
                                <div class="product-badge new-badge">
                                    <span>New</span>
                                </div>

                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <span>mango</span>
                                <a href="single-product-details.html">
                                    <h6>PETITE Belted Jumper Dress</h6>
                                </a>
                                <p class="product-price">$80.00</p>

                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
                                        <a href="#" class="btn essence-btn">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### New Arrivals Area End ##### -->

    <!-- ##### Brands Area Start ##### -->
    <div class="brands-area d-flex align-items-center justify-content-between">
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand1.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand2.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand3.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand4.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand5.png" alt="">
        </div>
        <!-- Brand Logo -->
        <div class="single-brands-logo">
            <img src="img/core-img/brand6.png" alt="">
        </div>
    </div>
    <!-- ##### Brands Area End ##### -->
<!-- закрываем фун-цию контента -->
@endsection