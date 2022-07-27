@extends('admin.page.template')
@section('body')
    <div class="row">
        <!-- Basic Layout -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Basic Layout</h5>
                    <small class="text-muted float-end">Default label</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Product name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="basic-default-name" placeholder="Enter name"
                                    value="" name="product_name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-company">Product cost</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="basic-default-company"
                                    placeholder="Enter cost" name="product_cost">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-email">Product price</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input type="text" id="basic-default-email" class="form-control"
                                        placeholder="Enter price" name="product_price">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Product avt</label>
                            <div class="col-sm-10">
                                <input type="file" id="basic-default-phone" class="form-control phone-mask"
                                    placeholder="Upload image" name="product_avt">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Description</label>
                            <div class="col-sm-10">
                                <textarea id="basic-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"
                                    aria-label="Hi, Do you have a moment?" aria-describedby="basic-icon-default-message2" name="product_description"></textarea>
                            </div>
                        </div>
                        <div class="product__store2">

                        </div>
                        <div class="row mb-3 order__size">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Category</label>
                            <div class="col-sm-4">
                                <select id="cars" name="category">
                                    @foreach ($category as $item)
                                        <option value="{{$item->category_id}}">{{$item->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @foreach ($size as $item)
                            <div class="row mb-3 order__size">
                                <label class="col-sm-2 col-form-label" for="basic-default-message">Size
                                    {{ $item->size_name }}</label>
                                <div class="col-sm-4">
                                    <input type="number" id="basic-default-phone" class="form-control phone-mask"
                                        placeholder="Amount" name="size[{{ $item->size_id }}]">
                                </div>
                            </div>
                        @endforeach
                        <div class="product__store">

                        </div>
                        <div class="row mb-3 product__image">
                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Product image</label>
                            <div class="col-sm-10">
                                <input type="file" id="basic-default-phone" class="form-control phone-mask"
                                    placeholder="Upload image" name="product_image[0]">
                            </div>
                        </div>
                        <div class="row justify-content-end mb-3 product__button">
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-primary">Thêm ảnh phụ</button>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let button = document.querySelector('.product__button');
        let node;
        let store = document.querySelector('.product__store');
        let image = document.querySelector('.product__image');
        let i = 1;
        button.addEventListener('click', (e) => {
            node = image.cloneNode(true);
            node.querySelector('input').name = `product_image[${i++}]`;
            store.appendChild(node);
        })

        // let button2 = document.querySelector('.product__button2');
        // let node2;
        // let store2 = document.querySelector('.product__store2');
        // let image2 = document.querySelector('.order__size');
        // let i2 = 1;
        // button2.addEventListener('click', (e) => {
        //     node2 = image2.cloneNode(true);
        //     // node.querySelector('input').name = `product_image[${i++}]`;
        //     store2.appendChild(node2);
        // })
    </script>
@endsection
