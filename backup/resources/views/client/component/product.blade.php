<div class="col-lg-{{$size}} col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
    <div class="product__item sale">
        <a href="{{asset(route('product',$data->product_id))}}">
        <div class="product__item__pic set-bg" data-setbg={{ $data->product_avt }}>
            <span class="label">Sale</span>
        </div>
        </a>
        <div class="product__item__text">
            <h6><a href="{{asset(route('product',$data->product_id))}}">{{$data->product_name}}</a></h6>
            <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
            </div>
            <h5>{{number_format($data->product_price)}} VND</h5>
            <div class="product__color__select">
                <label for="pc-7">
                    <input type="radio" id="pc-7">
                </label>
                <label class="active black" for="pc-8">
                    <input type="radio" id="pc-8">
                </label>
                <label class="grey" for="pc-9">
                    <input type="radio" id="pc-9">
                </label>
            </div>
        </div>
    </div>
</div>