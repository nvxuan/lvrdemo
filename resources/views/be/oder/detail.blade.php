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
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th style="width: 150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($oders as $item)
                        <tr>
                            <td>{{ $item-> name}}</td>
                            <td>{{ $item-> price}}</td>
                            <td><input name="quantity" value="{{ $item-> quantity}}"></td>
                            <td>
                                <a class="btn btn-warning"
                                    href="{{ route('admin.oder.update', ['id' => $item->id]) }}">Update</a>
                                <a class="btn btn-info" onclick="return confirm('CONFIRM DELETE?')"
                                    href="{{ route('admin.oder.deleteitem', ['id' => $item->id]) }}">Xóa</a>

                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">


            </div>
        </div>
        <!-- /.card -->

    </div>
    @endsection