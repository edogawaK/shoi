@extends('admin.page.template')
@section('body')
    <div class="card">
        <h5 class="card-header">Table Basic</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data as $index => $order)
                    @php
                        switch ($order->order_status) {
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
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $order->order_id }}</strong>
                        </td>
                        <td>{{ $order->user->user_name }}</td>
                        <td>{{ $order->user->user_email }}</td>
                        <td>{{ $order->user->user_phone }}</td>
                        <td>{{ $order->user->user_address }}</td>
                        <td>{{ number_format($order->order_total) }}</td>
                        <td><span class="badge bg-label-{{$alert}} me-1">{{$status}}</span></td>
                        <td class="item">
                            <a class="" href="{{route('order.show',$order->order_id)}}">Show</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <style>
        .item{
            display: flex;
        }
        .item a{
            padding: 0 10px;
        }
        </style>
@endsection
