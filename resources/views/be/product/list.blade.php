@extends('be.layout')
@section('main-content')
<form method="GET" action="{{ route('admin.product.search') }}">
    <div class="input-group input-group-sm" style="padding: 10px">
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
                            <th style="width: 10px">#</th>
                            <th>Hình ảnh</th>
                            <th>Tên</th>
                            <th>Giá</th>
                            <th>Danh mục</th>
                            <th>Số lượng</th>
                            <th style="width: 250px">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                        <tr>
                            <td>{{ $item-> id}}</td>
                            <td>
                                @if ($item->images && count($item->images)>0)
                                <img width="100px" src="{{ asset($item->images[0]->path)}}" alt="{{ $item->name }}" />
                                @else
                                <img src="" alt="Load Error" />
                                @endif
                            </td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                {{ $item->price }}
                            </td>
                            <td>
                                @if ($item-> category)
                                <span class=" badge badge-primary">{{ $item-> category->name}}</span>
                                @endif
                                @if (!$item-> category)
                                <span class="badge badge-primary">No Category</span>
                                @endif
                            </td>
                            <td>
                                {{ $item->quantity }}
                            </td>
                            <td>
                                <a class="btn btn-warning"
                                    href="{{ route('admin.product.edit', ['id' => $item->id]) }}">Sửa</a>
                                <a class="btn btn-danger" onclick="return confirm('Bạn chắc chắn xóa?')"
                                    href="{{ route('admin.product.delete', ['id' => $item->id]) }}">Xóa</a>
                                {{-- <a class="btn btn-danger" onclick="return confirm('CONFIRM DELETE?')"
                                    href="{{ route('admin.product.detail', ['id' => $item->id]) }}">Detail</a> --}}

                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $list->withQueryString()->links() }}
                </div>

            </div>
        </div>
        <!-- /.card -->

    </div>
    @endsection