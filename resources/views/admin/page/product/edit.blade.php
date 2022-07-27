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
                    <form action="{{route('product.update',$data->product_id)}}" method="POST">
                        {{ csrf_field() }}
                        @method('put')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Product name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="basic-default-name" placeholder="Enter name"
                                    value="{{ $data->product_name }}" name="product_name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-company">Product cost</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="basic-default-company"
                                    placeholder="Enter cost" value="{{ $data->product_cost }}" name="product_cost">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-email">Product price</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input type="text" id="basic-default-email" class="form-control"
                                        placeholder="Enter price" value="{{ $data->product_price }}" name="product_price">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-phone">Product avt</label>
                            <div class="col-sm-10">
                                <input type="text" id="basic-default-phone" class="form-control phone-mask"
                                    placeholder="Enter link" value="{{ $data->product_avt }}" name="product_avt">
                            </div>
                            <img class="col-4 m-auto" src="{{ $data->product_avt }}">
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-message">Description</label>
                            <div class="col-sm-10">
                                <p>{!! $data->product_description !!}</p>
                                {{-- <textarea id="basic-default-message" class="form-control" ></textarea> --}}
                            </div>
                        </div>
                        @foreach ($data->size as $index=>$item)
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Size
                                    {{ $item->size_name }}</label>
                                <div class="col-sm-10">
                                    <input type="text" id="basic-default-phone" class="form-control phone-mask"
                                        placeholder="Enter link" value="{{ $item->pivot->amount }}" name="size[{{$item->size_id}}]">
                                </div>
                            </div>
                        @endforeach
                        @foreach ($data->image as $index=>$item)
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Image</label>
                                <div class="col-sm-10">
                                    <input type="text" id="basic-default-phone" class="form-control phone-mask"
                                        placeholder="Enter link" value="{{ $item->image_link }}" name="image[{{$item->image_id}}]">
                                    <img class="col-2 m-auto" src="{{ $item->image_link }}">
                                </div>
                            </div>
                        @endforeach 
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
@endsection
