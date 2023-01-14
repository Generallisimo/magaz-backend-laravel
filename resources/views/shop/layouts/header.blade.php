<!-- подключаем отдельно шапку -->
    <!-- ##### Header Area начало ##### -->
    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <a class="nav-brand" href="index.html"><img src="img/core-img/logo.png" alt=""></a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav начало -->
                    <div class="classynav">
                        <ul>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="{{route('home')}}">Home</a></li>
                                    <li><a href="{{route('shop')}}">Shop</a></li>
                                    <li><a href="{{route('productdetails')}}">Product Details</a></li>
                                    <li><a href="{{route('checkout')}}">Checkout</a></li>
                                    <li><a href="{{route('blog')}}">Blog</a></li>
                                    <li><a href="{{route('single-blog')}}">Single Blog</a></li>
                                    <li><a href="{{route('regular-page')}}">Regular Page</a></li>
                                    <li><a href="{{route('contact')}}">Contact</a></li>
                                </ul>
                            </li>
                            <li><a href="{{route('shop')}}">Shop</a>
                                <div class="megamenu">
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Women's Collection</li>
                                        <li><a href="#">Dresses</a></li>
                                        <li><a href="#">Blouses &amp; Shirts</a></li>
                                        <li><a href="#">T-shirts</a></li>
                                        <li><a href="#">Rompers</a></li>
                                        <li><a href="#">Bras &amp; Panties</a></li>
                                    </ul>
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Men's Collection</li>
                                        <li><a href="#">T-Shirts</a></li>
                                        <li><a href="#">Polo</a></li>
                                        <li><a href="#">Shirts</a></li>
                                        <li><a href="#">Jackets</a></li>
                                        <li><a href="#">Trench</a></li>
                                    </ul>
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Kid's Collection</li>
                                        <li><a href="#">Dresses</a></li>
                                        <li><a href="#">Shirts</a></li>
                                        <li><a href="#">T-shirts</a></li>
                                        <li><a href="#">Jackets</a></li>
                                        <li><a href="#">Trench</a></li>
                                    </ul>
                                    <div class="single-mega cn-col-4">
                                        <img src="img/bg-img/bg-6.jpg" alt="">
                                    </div>
                                </div>
                            </li>
                            <li><a href="{{route('blog')}}">Blog</a></li>
                            <li><a href="{{route('contact')}}">Contact</a></li>
                        </ul>
                    </div>
                    <!-- Nav конец -->
                </div>
            </nav>

            <!-- Header справо начало -->
            <div class="header-meta d-flex clearfix justify-content-end">
                
                <!-- Поиск -->
                <!-- <div class="search-area">
                    <form action="#" method="post">
                        <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div> -->
               
                <!-- Избранные -->
                <!-- <div class="favourite-area">
                    <a href="#"><img src="img/core-img/heart.svg" alt=""></a>
                </div> -->
               
                <!-- Аутентификация-->
                <div class="user-login-info">
                    <a href="{{route('account')}}"><img src="img/core-img/user.svg" alt=""></a>
                </div>
                <!-- Карзина в закрытом виде -->
                <div class="cart-area">
                    <!-- подключаем сессию для корзины -->
                    <a href="#" id="essenceCartBtn"><img src="img/core-img/bag.svg" alt=""> <span>{{\Cart::session(\Illuminate\Support\Facades\Session::getId())->getTotalQuantity();}}</span></a>
                </div>
            </div>

        </div>
    </header>
    <!-- Конец шапки  -->

    <!-- Карзина в открытом виде -->
    <div class="cart-bg-overlay"></div>

    <div class="right-side-cart-area">

        <!-- Cart Button -->
        <div class="cart-button">
            <a href="#" id="rightSideCart"><img src="img/core-img/bag.svg" alt=""> <span>{{\Cart::session(\Illuminate\Support\Facades\Session::getId())->getTotalQuantity();}}</span></a>
        </div>

        <div class="cart-content d-flex">

            <!-- Контейнер для товаров -->
            <div class="cart-list">
                <!-- Товар и фун-ия для добавления в карзину  -->
                @foreach($cart as $item)
                <div class="single-cart-item">
                    <a href="#" class="product-image">
                        <!-- ??? не добавляется картинка ??? -->
                        <img src="img/product-img/product-1.jpg" class="cart-thumb" alt="">
                        <!-- Описание товаров -->
                        <div class="cart-item-desc">
                            <!-- удаление из корзины -->
                          <span class="product-remove"><a href="{{route('removecart', ['id' => $item->id])}}"><i class="fa fa-close" aria-hidden="true"></i></a></span>
                            <span class="badge">Ksyusha Beauty</span>
                            <!-- выводим имя товара -->
                            <h6>{{$item->name}}</h6>
                            <!-- вовдим кол-во товара -->
                            <p class="size">Qty: {{$item->quantity}}</p>
                            <!-- выводим цену товара -->
                            <p class="price">${{$item->price}}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <!-- Карзина подсчета-->
            <div class="cart-amount-summary">

                <h2>Summary</h2>
                <ul class="summary-table">
                    <!-- общая сумма товара -->
                    <li><span>subtotal:</span> <span>{{$sum}}</span></li>
                    <li><span>delivery:</span> <span>Free</span></li>
                    <li><span>discount:</span> <span>-</span></li>
                    <li><span>total:</span> <span>$ - {{$sum}}</span></li>
                </ul>
                <div class="checkout-btn mt-100">
                    <a href="{{route('checkout')}}" class="btn essence-btn">check out</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Right Side Cart End ##### -->