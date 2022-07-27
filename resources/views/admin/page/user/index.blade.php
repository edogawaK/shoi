@extends('admin.page.template')
@section('body')
    <div class="card">
        <h5 class="card-header">Table Basic</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data as $index => $user)
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $user->user_name }}</strong>
                        </td>
                        <td>{{ $user->user_email }}</td>
                        <td>{{ $user->user_phone }}</td>
                        <td>{{ $user->user_address }}</td>
                        <td><span class="badge bg-label-{{$user->user_status==0?"warning":"primary"}} me-1">{{$user->user_status==0?"warning":"active"}}</span></td>
                        <td class="item">
                            <a class="" href="javascript:void(0);"><i
                                class="bx bx-edit-alt me-1"></i>
                            Edit</a>
                            <a class="" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                Delete</a>
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
