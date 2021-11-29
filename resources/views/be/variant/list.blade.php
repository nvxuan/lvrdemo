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
                            <th>Name</th>
                            <th style="width: 150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                        <tr>
                            <td>{{ $item-> id}}</td>
                            <td>{{ $item-> name}}</td>
                            <td>
                                <a class="btn btn-warning"
                                    href="{{ route('admin.variant.edit', ['id' => $item->id]) }}">Edit</a>
                                <a class="btn btn-danger" onclick="return confirm('CONFIRM DELETE?')"
                                    href="{{ route('admin.variant.delete', ['id' => $item->id]) }}">Delete</a>

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