@extends('fe.layout')
@section('content')
<!--sp chính-->
<div class="grid grid-cols-10 space-y-10 mt-5 mx-8">
    @if ($user)
    <div class="col-span-2">
        <h4 class="text-2xl font-bold">
            Thông tin tài khoản
        </h4>
        <form method="post" action="{{ route('admin.user.doedit', ['id'=>$user->id]) }}">
            @csrf
            <input name="level" type="hidden" readonly value="{{ $user->level }}">
            <div class="text-gray-700 select-none font-medium">Username:</div><input name="name" required
                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                type="text" value="{{ $user->name }}">
            <div class="text-gray-700 select-none font-medium">Full Name:</div><input name="full_name" required
                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                type="text" value="{{ $user->full_name }}">
            <div class="text-gray-700 select-none font-medium">Email:</div><input name="email" readonly
                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                type="text" value="{{$user->email}}">
            <div>Password:</div><input name="password" required
                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                type="password" value="{{ $user->password }}">
            <div class="text-gray-700 select-none font-medium">Phone:</div><input name="phone" required
                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                type="number" value="{{ $user->phone }}">
            <div><button class="bg-blue-500 hover:bg-blue-400 px-4 py-2 mt-4 text-white" type="submit">Update</button>
            </div>
        </form>
    </div>
    @else
    @php
    redirect(route('auth.login'));
    @endphp
    @endif
    <div class="col-span-8">
        <h4 class="text-2xl font-bold">
            Lịch sử mua hàng...
        </h4>
        <table class="table-fixed w-full mt-10 border p-4">
            <tr class="p-2 border">
                <th>Product</th>
                <th>Note</th>
                <th>Status</th>
            </tr>
            @foreach ($oders as $oder)
            <tr class="p-2 border">
                <td>
                    @foreach ($oderProducts as $oderProduct)
                    @if ($oderProduct->oder_id == $oder->id)
                    {{ $oderProduct->name }} x {{ $oderProduct->quantity }} x {{
                    number_format($oderProduct->price)}}<br>
                    @endif
                    @endforeach
                </td>
                <td>{{ $oder->note }}</td>
                @if ($oder-> status==1)
                <td>Đang chờ giao</td>
                @elseif ($oder-> status==2)
                <td>Đang Giao</td>
                @elseif ($oder-> status==3)
                <td>Đã Thanh Toán</td>
                @elseif ($oder-> status==4)
                <td>Đã Hủy</td>
                @endif
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection