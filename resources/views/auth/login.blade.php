@extends('fe.layout')
@section('mt-description')
Đăng Nhập
@endsection

@section('mt-keyword')
Đăng Nhập
@endsection
@section('content')

<div class="grid grid-cols-10 mt-10 md:mx-10">
    <div class="col-span-1">
        {{-- <ul class="font-semibold">
            <li>
            <li>
                <a href="{{route('fe.category',['id'=>-1])}}">All</a>
        </li>
        </li>
        @foreach($allCategory as $cat)
        <li>
            <a href="{{route('fe.category',['id'=>$cat->id])}}">{{$cat->name}}</a>
        </li>
        @endforeach
        </ul> --}}
    </div>
    <div class="col-span-9">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="font-extrabold text-5xl text-blue-700">
                    Đăng Nhập</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div style="padding: 20px">
                @if (Session::has('error'))
                <div class="flex bg-orange-200 p-4">
                    <div class="shadow bg-white rounded-full" role="alert">
                        <div class="p-4 flex">
                            <div class="w-24 bg-red-500 flex items-center text-white rounded-full justify-center">
                                <i class="material-icons">Lỗi</i>
                            </div>
                            <div class="pl-2 text-red-600">
                                <p class="font-bold">{{ Session::get('error') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>
                {{ Session::get('success') }}
            </div>
            @endif
        </div>
        <div class="w-full max-w-xs">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST"
                action="{{ route('auth.dologin') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Email
                    </label>
                    <input name="email"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="email" type="text" placeholder="Email">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Mật Khẩu
                    </label>
                    <input name="password"
                        class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" type="password" placeholder="******************">
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Đăng Nhập
                    </button>
                    {{-- <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                        Forgot Password?
                    </a> --}}
                </div>
            </form>
        </div>
    </div>
    <!-- /.card -->
</div>
<!--/.col (left) -->
<!-- right column -->
<div class="col-md-6">

</div>
</div><!-- /.container-fluid -->
@endsection