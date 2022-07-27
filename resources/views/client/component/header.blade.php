{{-- {{ var_dump($categor) }} --}}
<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__option">
        <div class="offcanvas__links">
            <a href="#">Sign in</a>
            <a href="#">FAQs</a>
        </div>
        <div class="offcanvas__top__hover">
            <span>Usd <i class="arrow_carrot-down"></i></span>
            <ul>
                <li>USD</li>
                <li>EUR</li>
                <li>USD</li>
            </ul>
        </div>
    </div>
    <div class="offcanvas__nav__option">
        <a href="#" class="search-switch"><img src="{{ asset('storage/img/icon/search.png') }}"
                alt=""></a>
        <a href="#"><img src="{{ asset('storage/img/icon/heart.png') }}" alt=""></a>
        <a href="#"><img src="{{ asset('storage/img/icon/cart.png') }}" alt=""> <span>0</span></a>
        <div class="price">$0.00</div>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__text">
        <p>Free shipping, 30-day return or refund guarantee.</p>
    </div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p>Free shipping, 30-day return or refund guarantee.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            <a href="#">FAQs</a>
                        </div>
                        @auth
                            <div class="header__top__hover">
                                <span><a href="#">{{ $user->user_name }}</a> <i
                                        class="arrow_carrot-down"></i></span>
                                <ul>
                                    <li><a href="{{ route('profile') }}">Profile</a></li>
                                    <li><a href="{{ route('logout') }}">Logout</a></li>
                                </ul>
                            </div>
                        @endauth
                        @guest
                            <div class="header__top__links">
                                <a href={{ route('login') }}>Login</a>
                            </div>
                        @endguest
                        <style>
                            a:hover {
                                color: black;
                            }

                            a {
                                color: black;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('storage/img/logo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        {{-- <li class="active"><a href="./index.html">Home</a></li> --}}
                        @foreach ($category as $item)
                            <li><a href="">{{ $item->category_name }}</a>
                                @if ($item->child->count())
                                    <ul class="dropdown">
                                        @foreach ($item->child as $sub)
                                            <li><a
                                                    href={{ asset(route('shop', $sub->category_id)) }}>{{ $sub->category_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                        <li><a href="./contact.html">More</a>
                            <ul class="dropdown">
                                <li><a href="./about.html">About</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    <a href="#" class="search-switch"><img src="{{ asset('storage/img/icon/search.png') }}"
                            alt=""></a>
                    <a href="#"><img src="{{ asset('storage/img/icon/heart.png') }}" alt=""></a>
                    @auth
                        <a href="{{ route('cart') }}"><img src="{{ asset('storage/img/icon/cart.png') }}"
                                alt="">
                            <span>{{ $user->cart }}</span></a>
                        <div class="price">{{ $user->cart }}</div>
                    @endauth
                    @guest
                        <a href="{{ route('cart') }}"><img src="{{ asset('storage/img/icon/cart.png') }}"
                                alt="">
                            <span>0</span></a>
                        <div class="price">0 VND</div>
                    @endguest
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
