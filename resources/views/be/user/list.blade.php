@extends('be.layout')
@section('main-content')
<form method="GET" action="{{ route('admin.user.search') }}">
    <div class="input-group input-group-sm" style="margin: 10px">
        <input class="form-control form-control-navbar" type="search" placeholder="Tìm Kiếm" name="q">
        <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5px">#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Fullname</th>
                            <th>Phone</th>
                            <th style="width: 150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                        <tr>
                            <td>{{ $item-> id}}</td>
                            <td>{{ $item-> name}}</td>
                            <td>{{ $item-> email}}</td>
                            <td>{{ $item-> full_name}}</td>
                            <td>{{ $item-> phone}}</td>
                            <td>
                                <a class="btn btn-warning"
                                    href="{{ route('admin.user.edit', ['id' => $item->id]) }}">Edit</a>
                                <a class="btn btn-danger" onclick="return confirm('CONFIRM DELETE?')"
                                    href="{{ route('admin.user.delete', ['id' => $item->id]) }}">Delete</a>

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