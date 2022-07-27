@extends('admin.page.template')
@section('body')
    <div class="card">
        <h5 class="card-header">Table Basic</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product_id</th>
                        <th>Product_name</th>
                        <th>Size</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data->detail as $item)
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{ $item->product->product_id }}</strong>
                            </td>
                            <td>
                                <a href="{{ route('product', $item->product->product_id) }}">
                                    <div class="row mb-3 flex align-items-center">
                                        {{ $item->product->product_name }}
                                        <img class="col-2" src="{{ $item->product->product_avt }}">
                                    </div>
                                    <a>
                            </td>
                            <td>{{ $item->size->size_name }}</td>
                            <td>{{ $item->detail_amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mb-12 order__size">
        @php
                        switch ($data->order_status) {
                            case 0:
                                $status="Đã hủy";
                                $alert="warning";
                                break;
                            case 1:
                                $status="Đang xử lý";
                                $alert="info";
                                break;
                            case 2:
                                $status="Đang giao";
                                $alert="primary";
                                break;
                            case 3:
                                $status="Đã giao";
                                $alert="success";
                                break;
                            default:
                                $status="Lỗi";
                                $alert="warning";
                                break;
                        }
        @endphp
        <label class="col-sm-4 col-form-label" for="basic-default-message">Order status: <span class="badge bg-label-{{$alert}} me-1">{{$status}}</span></label>
    </div>
    <form action="{{route('order.update',$data->order_id)}}" method="POST">
        @method('put')
        {{ csrf_field() }}
        <div class="row mb-12 order__size">
            <label class="col-sm-2 col-form-label" for="basic-default-message">UPdate status</label>
            <div class="col-sm-12">
                <select id="cars" name="order_status">
                        <option value="1" {{$data->order_status==1?"selected":""}}>Xác nhận</option>
                        <option value="2" {{$data->order_status==2?"selected":""}}>Đang giao</option>
                        <option value="3" {{$data->order_status==3?"selected":""}}>Đã giao</option>
                        <option value="0" {{$data->order_status==0?"selected":""}}>Hủy</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Update</button>
        </div>
    </form>
    <style>
        .item {
            display: flex;
        }

        .item a {
            padding: 0 10px;
        }
    </style>
@endsection
