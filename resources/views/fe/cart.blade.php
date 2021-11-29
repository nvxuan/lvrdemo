@extends('fe.layout')
@section('mt-description')
Giỏ hàng
@endsection

@section('mt-keyword')
Giỏ hàng
@endsection
@section('content')
<h4 class="block text-center text-2xl font-bold mt-2 ">Giỏ hàng</h4>

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
        <a href="{{ route('auth.checkout') }}" type="button"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-5 rounded right focus:outline-none focus:shadow-outline">Thanh
            Toán</a>
    </div>
    <script>
        axios({
            method: 'get',
            url: `{{route('api.cart.items')}}`
        }).then((resp) => {
            let total = 0;
            const cart = resp.data.cart;
            const cartInfoTable = document.querySelector('.cart-info');
            console.log(cartInfoTable);
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
            console.log(event.target.parentNode.parentNode.parentNode.querySelector('.total-all-item-price'));
            const newPrice = inputQuantity * price;
            event.target.parentNode.parentNode.querySelector('.total-item-price').innerHTML = Intl.NumberFormat('VN-vn', { style: 'currency', currency: 'VND' }).format(newPrice);
            //location.reload();
        //     axios({
        //     method: 'get',
        //     url: `{{route('api.cart.items')}}`
        // }).then((resp) => {
        //     const cart = resp.data.cart;
        //     for (let i = 0; i <cart.length; i++) {
        //         totalAll += cart[i].quantity*price;
        axios({
            method: 'get',
            url: `{{route('api.cart.items')}}`
        }).then((resp) => {
            let total = 0;
            const cart = resp.data.cart;
            const cartInfoTable = document.querySelector('.cart-info');
            console.log(cartInfoTable);
            for (let i = 0; i <cart.length; i++) {
                const product = cart[i].product;
                total+=product.price * cart[i].quantity
            }
            console.log(total);
            event.target.parentNode.parentNode.parentNode.querySelector('.total-all-item-price').innerHTML = Intl.NumberFormat('VN-vn', { style: 'currency', currency: 'VND' }).format(total);            
        }).catch((error) => {

        });
            
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