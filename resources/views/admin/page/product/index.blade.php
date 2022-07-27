@extends('admin.page.template')
@section('body')
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0)">Product </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="{{ route('product.index', ['filter' => 'date']) }}">Mới nhất</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="{{ route('product.index', ['filter' => 'sold']) }}">Bán chạy nhất</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="card">
        <h5 class="card-header">Table Basic</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Sold</th>
                        <th>Amount</th>
                        <th>Cost</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data as $index => $item)
                        @if ($item->size->count())
                            @foreach ($item->size as $size)
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong><a
                                                href="{{ route('product', $item->product_id) }}">{{ $item->product_name }}</a></strong>
                                    </td>
                                    <td>{{ $size->size_name }}</td>
                                    <td>{{ $item->product_sold }}</td>
                                    <td>{{ $size->pivot->amount }}</td>
                                    <td>{{ number_format($item->product_cost) }}</td>
                                    <td>{{ number_format($item->product_price) }}</td>
                                    <td><span
                                            class="badge bg-label-{{ $item->product_status == 0 ? 'warning' : 'primary' }} me-1">{{ $item->product_status == 0 ? 'warning' : 'active' }}</span>
                                    </td>
                                    <td class="item flex align-items-center">
                                        <a class="" href="{{ route('product.edit', $item->product_id) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <form action="{{ route('product.destroy', $item->product_id) }}">
                                            <button class="btn btn-outline-primary" type="submit"
                                                href="{{ route('product.destroy', $item->product_id) }}"><i
                                                    class="bx bx-trash me-1"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong><a
                                            href="{{ route('product', $item->product_id) }}">{{ $item->product_name }}</a></strong>
                                </td>
                                <td>//</td>
                                <td>//</td>
                                <td>//</td>
                                <td>{{ number_format($item->product_cost) }}</td>
                                <td>{{ number_format($item->product_price) }}</td>
                                <td><span class="badge bg-label-warning me-1">Hết</span>
                                </td>
                                <td class="item flex align-items-center">
                                    <a class="" href="{{ route('product.edit', $item->product_id) }}"><i
                                            class="bx bx-edit-alt me-1"></i>
                                        Edit</a>
                                    <form action="{{ route('product.destroy', $item->product_id) }}" method="post">
                                        @method('delete')
                                        {{ csrf_field() }}
                                        <button class="btn btn-outline-primary" type="submit"
                                            ><i
                                                class="bx bx-trash me-1"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <style>
        .item {
            display: flex;
        }

        .item a {
            padding: 0 10px;
        }
    </style>
@endsection
