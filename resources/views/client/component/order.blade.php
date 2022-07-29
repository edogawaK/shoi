<div class="order__container">
    <article class="order__card">
        <header class="order__card-header"> My Orders / Tracking </header>
        <div class="card-body">
            <h6>Order ID: {{ $data->order_id }}</h6>
            <article class="order__card">
                <div class="card-body row">
                    <div class="col"> <strong>Estimated Delivery time:</strong> <br>{{ $data->order_date }}</div>
                    <div class="col"> <strong>Shipping BY:</strong> <br> BLUEDART, | <i class="fa fa-phone"></i>
                        +1598675986 </div>
                    <div class="col"> <strong>Status:</strong> <br>
                        {{ $data->order_status == 0 ? 'Đã hủy' : ($data->order_status >= 4 ? 'Đã giao' : 'Đang xử lý') }} </div>
                    <div class="col"> <strong>Tracking #:</strong> <br> {{ $data->order_id }}</div>
                </div>
            </article>
            <div class="track">
                <div class="step {{ $data->order_status >= 1 ? 'active' : '' }}"> <span class="icon"> <i
                            class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                <div class="step {{ $data->order_status >= 2 ? 'active' : '' }}"> <span class="icon"> <i
                            class="fa fa-user"></i> </span> <span class="text">
                        Picked by courier</span> </div>
                <div class="step {{ $data->order_status >= 3 ? 'active' : '' }}"> <span class="icon"> <i
                            class="fa fa-truck"></i> </span> <span class="text"> On
                        the way </span> </div>
                <div class="step {{ $data->order_status >= 4 ? 'active' : '' }}"> <span class="icon"> <i
                            class="fa fa-user"></i> </span> <span class="text">Ready
                        for pickup</span> </div>
            </div>
            <hr>
            <ul class="row">
                @foreach ($data->detail as $index => $item)
                    <li class="col-md-4">
                        <a href="{{ route('product', $item->product_id) }}">
                            <figure class="itemside mb-3">
                                <div class="aside"><img src="{{ $item->product->product_avt }}" class="img-sm border">
                                </div>
                                <figcaption class="info align-self-center">
                                    <p class="title">{{ $item->product->product_name }} <br> Size:
                                        {{ $item->size->size_name }} <br> SL: {{ $item->detail_amount }}</p> <span
                                        class="text-muted">{{ number_format($item->product->product_price) }} VND
                                    </span>
                                </figcaption>
                            </figure>
                        </a>
                    </li>
                @endforeach
            </ul>
            <hr>
            @if ($data->order_status ==1 )
                <form action="{{ route('order.cancel', $data->order_id) }}" method="POST">
                    {{ csrf_field() }}
                    @method('put')
                    <button href="" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i>
                        Cancel
                        </button>
                </form>
            @endif
        </div>
    </article>
</div>

<style>
    /* @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap'); */

    body {
        /* background-color: #eeeeee; */
        /* font-family: 'Open Sans', serif */
    }

    .order__container {
        margin-top: 50px;
        margin-bottom: 50px
    }

    .order__card {
        width: 90%;
        margin: 0 auto;
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.4);
        border-radius: 0.10rem
    }

    .order__card-header:first-child {
        border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
    }

    .order__card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1)
    }

    .track {
        position: relative;
        background-color: #ddd;
        height: 7px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 60px;
        margin-top: 50px
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative
    }

    .track .step.active:before {
        background: #000
    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px
    }

    .track .step.active .icon {
        background: #000;
        color: #fff
    }

    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #ddd
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000
    }

    .track .text {
        display: block;
        margin-top: 7px
    }

    .itemside {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        width: 100%
    }

    .itemside .aside {
        position: relative;
        -ms-flex-negative: 0;
        flex-shrink: 0
    }

    .img-sm {
        width: 80px;
        height: 80px;
        padding: 7px
    }

    ul.row,
    ul.row-sm {
        list-style: none;
        padding: 0
    }

    .itemside .info {
        padding-left: 15px;
        padding-right: 7px
    }

    .itemside .title {
        display: block;
        margin-bottom: 5px;
        color: #212529
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem
    }

    .btn-warning {
        color: #ffffff;
        background-color: #000;
        border-color: #000;
        border-radius: 1px
    }

    .btn-warning:hover {
        color: #ffffff;
        background-color: #ff2b00;
        border-color: #ff2b00;
        border-radius: 1px
    }
</style>
