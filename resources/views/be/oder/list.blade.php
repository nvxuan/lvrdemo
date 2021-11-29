@extends('be.layout')
@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5px">#</th>
                            <th>UserName</th>
                            <th>User ID</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Note</th>
                            <th>Tax</th>
                            <th>Total Pay</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th style="width: 150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                        <tr>
                            <td>{{ $item-> id }}</td>
                            <td>{{ $item-> name}}</td>
                            <td>{{ $item-> user_id}}</td>
                            <td>{{ $item-> address}}</td>
                            <td>{{ $item-> phone}}</td>
                            <td>{{ $item-> note}}</td>
                            <td>{{ $item-> tax}}</td>
                            <td>{{ $item-> sub_total}}</td>
                            @if ($item-> status==1)
                            <td>Đang chờ giao</td>
                            @elseif ($item-> status==2)
                            <td>Đang Giao</td>
                            @elseif ($item-> status==3)
                            <td>Đã Thanh Toán</td>
                            @elseif ($item-> status==4)
                            <td>Đã Hủy</td>
                            @endif
                            <td>{{ $item-> created_at}}</td>
                            <td>{{ $item-> updated_at}}</td>

                            <td>
                                <a class="btn btn-warning"
                                    href="{{ route('admin.oder.edit', ['id' => $item->id]) }}">Edit</a>
                                <a class="btn btn-info"
                                    href="{{ route('admin.oder.detail', ['id' => $item->id]) }}">Detail</a>

                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $list->links() }}
                </div>

            </div>
        </div>
        <!-- /.card -->

    </div>
    @endsection