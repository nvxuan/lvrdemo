@extends('fe.layout')
@section('mt-description')
Thanh Toán
@endsection

@section('mt-keyword')
Thanh toán
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div style="padding: 20px">
            @if (Session::has('error'))
            <div class="">
                <h5><i class="font-italic text-red-500 p-2"></i> Error!</h5>
                {{ Session::get('error') }}
            </div>
            @endif
        </div>
    </div>
</div>
<h4 class="block text-center text-2xl font-bold mt-2 ">Thanh toán</h4>
<form method="POST" action="{{ route('fe.checkout') }}">
    @csrf
    <div class="grid grid-cols-10 mt-10 md:mx-10">
        <div class="col-span-1"></div>
        <div class="col-span-8">
            <table class="table-fixed w-full border p-4 cart-info ">
                <tr class="p-2 border">
                    <th class="p-2 border">Sản phẩm</th>
                    <th class="p-2 border">Số lượng</th>
                    <th class="p-2 border">Đơn giá</th>
                    <th class="p-2 border">Tổng tiền</th>
                    <th class="p-2 border">Hành động</th>
                </tr>

            </table>

            <table class="table-fixed w-full border mt-5 p-6 h-1/2 ">
                <tr class="p-4 mt-5 font-bold">
                    <th>Địa Chỉ Giao Hàng:</th>
                    <td> <input name="address" required
                            class="px-4 py-2 rounded-lg w-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                            type="text"></td>
                </tr>
                <tr class="p-4 mt-5 font-bold">
                    <th>Note:</th>
                    <td> <input name="note" required
                            class="px-4 py-2 rounded-lg w-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                            type="text"></td>
                </tr>
                <tr class="p-4 mt-5 font-bold">
                    <th>Phương Thức Thanh Toán:</th>
                    <td> <select class="font-bold">
                            <option class="font-bold">Thanh Toán Trực Tiếp</option>
                            <option class="font-bold">Thanh Toán Online</option>
                        </select>
                    <td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <button onclick="return confirm('Xác Nhận Đặt Hàng?')" type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-5 rounded right focus:outline-none focus:shadow-outline">Xác
                            Nhận</button>
                    </td>
                </tr>

            </table>
        </div>

    </div>
</form>
<script>
    axios({
            method: 'get',
            url: `{{route('api.cart.items')}}`
        }).then((resp) => {
            const cart = resp.data.cart;
            const cartInfoTable = document.querySelector('.cart-info');
            console.log(cartInfoTable);
            let total = 0;
            for (let i = 0; i <cart.length; i++) {
                const product = cart[i].product;
                const tr = document.createElement('tr');
                tr.classList.add('text-center');
                tr.innerHTML = `<td class="p-2 border">
                 <img src=""/>
                 <span class="font-bold">
                       ${product.name}
                 </span>
             </td>
             <td class="p-2 border">
                 <span class="bi bi-dash cursor-pointer" onclick="updateQuantity(-1,${product.id},${product.price},event)"></span>
                 <input min="1" 
                     type="text" readonly="" class="quantity border rounded w-12 text-center font-medium"
                     value="${cart[i].quantity}">
                 <span onclick="updateQuantity(1,${product.id},${product.price},event)" class="bi bi-plus cursor-pointer"></span>
             </td>
             <td class="font-bold text-red-500 p-2 border">
                ${Intl.NumberFormat('VN-vn', { style: 'currency', currency: 'VND' }).format(product.price)}
             </td>

             <td class="font-bold text-red-500 p-2 total-item-price border">
               ${Intl.NumberFormat('VN-vn', { style: 'currency', currency: 'VND' }).format(product.price * cart[i].quantity)}
             </td>
             <td class="p-2 border"> <button onclick="removeItem(${product.id}, event)" class="rounded-full py-2 px-3 bg-red-500 border" type="button">
             Xóa
             </button></td>`;                       
             total+=product.price * cart[i].quantity
                cartInfoTable.appendChild(tr);
            }            
             const tr2 = document.createElement('tr');
                tr2.classList.add('text-center');
                tr2.innerHTML = `<td class="font-bold text-red-500 p-2 border">  
                    Tổng Thanh Toán
             </td><td></td><td></td>
                <td class="font-bold text-red-500 p-2 total-all-item-price">
                <input name="sub_total"  hidden value="${total}">
               ${Intl.NumberFormat('VN-vn', { style: 'currency', currency: 'VND' }).format(total)}
               </td>
               <td class="p-2 border"> <button onclick="removeAll()" class="rounded-full py-2 px-3 bg-red-500 border" type="button">
                Xóa hết
                </button></td>`;
                cartInfoTable.appendChild(tr2);
        }).catch((error) => {

        });

        async function updateQuantity(quantity, id, price, event) {
            let inputQuantity = parseInt(event.target.parentNode.querySelector('.quantity').value);
            let totalAll = 0;
            if (quantity == 1) {
                inputQuantity += parseInt(quantity);
            } else if (quantity == -1) {
                if (inputQuantity >= 2) {
                    inputQuantity += parseInt(quantity);
                }
            }
            event.target.parentNode.querySelector('.quantity').value = inputQuantity;
            //gửi request lên server để update lại số lượng sp trong giỏ hàng
            try {
                const resp = await axios({
                    method: 'put',
                    url: `/api/cart/items/${id}/${quantity}`
                });
            } catch (e) {

            }
            const newPrice = inputQuantity * price;
            event.target.parentNode.parentNode.querySelector('.total-item-price').innerHTML = Intl.NumberFormat('VN-vn', { style: 'currency', currency: 'VND' }).format(newPrice);
            location.reload();
        //     axios({
        //     method: 'get',
        //     url: `{{route('api.cart.items')}}`
        // }).then((resp) => {
        //     const cart = resp.data.cart;
        //     for (let i = 0; i <cart.length; i++) {
        //         totalAll += cart[i].quantity*price;
        //         event.target.parentNode.parentNode.querySelector('.total-all-item-price').innerHTML = Intl.NumberFormat('VN-vn', { style: 'currency', currency: 'VND' }).format(totalAll);
        //     }})                      
                    }

                    async function removeItem(id, event){
                        try {
                const resp = await axios({
                    method: 'put',
                    url: `/api/cart/item/delete/${id}`
                     });
                    } catch (e) {
                        }
                        event.target.parentNode.parentNode.remove();
                        location.reload();
                            }
                            async function removeAll(){
                        try {
                const resp = await axios({
                    method: 'post',
                    url: `/api/cart/items/clear`
                     });
                    } catch (e) {
                        }
                        location.reload();
                    }
</script>
@endsection