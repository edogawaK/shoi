@extends('client.page.template')
@section('body')
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($data as $item)
                                    @php
                                        $total += $item->product->product_price * $item->cart_amount;
                                    @endphp
                                    <form action="{{ route('cart.update') }}" method="POST">

                                        <tr>
                                            <td class="product__cart__item">
                                                <a href="{{ asset(route('product', $item->product->product_id)) }}">
                                                    <div class="product__cart__item__pic">
                                                        <img src="{{ $item->product->product_avt }}" alt="">
                                                    </div>
                                                    <div class="product__cart__item__text">
                                                        <h6>{{ $item->product->product_name }}</h6>
                                                        <h5>{{ number_format($item->product->product_price) }} VND</h5>
                                                        <input type="hidden" class="cart__priceE"
                                                            value="{{ $item->product->product_price }}">
                                                        <h5 class="cart__size">Size: {{ $item->size->size_name }}</h5>
                                                        <input type="hidden" class="cart__data--size"
                                                            value="{{ $item->size->size_id }}">
                                                        <input type="hidden" class="cart__data--product"
                                                            value="{{ $item->product->product_id }}">
                                                    </div>
                                                </a>
                                            </td>

                                            <td class="quantity__item">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                                <input type="hidden" name="size_id" value="{{ $item->size_id }}">
                                                <div class="quantity">
                                                    <div class="">
                                                        <input class="cart__amount cart__amountE" type="number"
                                                            min="1" max="100" value="{{ $item->cart_amount }}"
                                                            name="amount">
                                                    </div>
                                                </div>
                                                <button class="cart__submit" type="submit"><i class="fa fa-spinner"></i>
                                                    Update</button>
                                            </td>
                                            <td class="cart__price cart__totalE">
                                                {{ number_format($item->product->product_price * $item->cart_amount) }}
                                                VND</td>
                                            <td class="cart__close">
                                                <button class="btn" type="submit"
                                                    formaction="{{ route('cart.delete') }}"><i
                                                        class="fa fa-close"></i></button>
                                            </td>
                                        </tr>
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            {{-- <li>Subtotal <span>{{number_format($total)}} VND</span></li> --}}
                            <li>Total <span class="cart__orderE">{{ number_format($total) }} VND</span></li>
                        </ul>
                        <form action="{{ route('user.order.create') }}" method="get">
                            <input type="submit" class="primary-btn" value="Proceed to checkout" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
<script defer src="{{ asset('js/cart.js') }}"></script>
