@extends('client.page.template')
@section('body')
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{route('user.order.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                                    here</a> to enter your code</h6>
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Name<span>*</span></p>
                                        <input type="text" value="{{ $user->user_name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" value="{{ $user->user_email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" value="VietNam">
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add"
                                    value="{{ $user->user_address }}">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" value="{{ $user->user_phone }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">Product</div>
                                <ul class="checkout__total__products">
                                    @php
                                        $total=0;
                                    @endphp
                                    @foreach ($data as $index=>$item)
                                        <li class="order__item">
                                            <div>{{ $item->product->product_name }}</div>
                                            <div><span>{{ number_format($item->product->product_price) }} VND</span></div>
                                            <div><span>Size: {{ $item->size->size_name }}x{{$item->cart_amount}}</span></div>
                                        </li>
                                        @php
                                            $total+=($item->product->product_price*$item->cart_amount);
                                        @endphp
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    {{-- <li>Subtotal <span>$750.99</span></li> --}}
                                    <li>Total <span>{{number_format($total)}} VND</span></li>
                                </ul>
                                {{-- <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> --}}
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
