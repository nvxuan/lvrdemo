<!--CARD-->
<div class="fixed bg-blue-200 right-0 top-0  p-2 rounded text-blue-500 hidden toast-success">Thêm vào giỏ hàng thành
    công
</div>
<div class="fixed bg-red-200 right-0 top-0  p-2 rounded text-red-500 hidden toast-failed">Thêm vào giỏ hàng thất
    bại
</div>
@if($item)
<div class="bg-red shadow pb-2 col-span-1">
    <div><a href="{{route('fe.product.detail',['id'=>$item->id])}}">

            @if($item->images && count($item->images)>0)
            <img src="{{asset($item->images[0]->path)}}" class="z-10 w-full h-72 object-cover">
            @else
            <img src="https://via.placeholder.com/150
C/O https://placeholder.com/" class="z-10 w-full h-72 object-cover">
            @endif


            <div class="space-y-4 mt-5 px-4">
                <div class="flex justify-evenly">
                    <h4 href="{{route('fe.product.detail',['id'=>$item->id])}}"
                        class="uppercase font-extrabold text-xl text-right">
                        {{$item->name}} </h4>
                    {{-- <button><i class="bi bi-heart text-xl"></i></button> --}}
                </div>
                <p class="font-bold text-2xl text-red-500 text-center">
                    <span> {{number_format($item->price)}} </span>
                    {{-- <del class="text-gray-800 text-lg">$100</del>--}}
                </p>

                <div class="flex w-full mt-5 items-center justify-center px-2">
                    {{-- <span class="bi bi-dash cursor-pointer"
                        onclick="updateQuantity(-1,{{ $item->id }},event)"></span>
                    <input type="text" readonly="" class="quantity border rounded w-12 text-center font-medium"
                        value="1">
                    <span onclick="updateQuantity(1,{{ $item->id }},event)" class="bi bi-plus  cursor-pointer"></span>
                    --}}
                    <div class="flex justify-center space-x-2">
                        {{-- <button onclick="addItemToCart()" class=" flex-grow-1 cursor-pointer block flex items-center justify-center bg-gray-800 p-3
                text-white font-bold">
                            Add to Cart
                        </button> --}}
                        <button class=" flex-grow-1 cursor-pointer block flex items-center justify-center bg-gray-800 p-3
                text-white font-bold">
                            Chi Tiết
                        </button>
                        {{-- <button
                            class="flex-grow-1 px-4 cursor-pointer block flex items-center justify-center bg-gray-800 p-3 text-white font-bold">
                            <i class="bi bi-share"></i></button> --}}
                    </div>
        </a>
    </div>
</div>
</div>
<!--END CARD-->
</div>
<script>
    async function updateQuantity(quantity, id, event) {
            let inputQuantity = parseInt(event.target.parentNode.querySelector('.quantity').value);
            if (quantity == 1) {
                inputQuantity += parseInt(quantity);
            } else if (quantity == -1) {
                if (inputQuantity >= 2) {
                    inputQuantity += parseInt(quantity);
                }
            }
            event.target.parentNode.querySelector('.quantity').value = inputQuantity;
            try {
                const resp = await axios({
                    method: 'put',
                    url: `/api/cart/items/${id}/${quantity}`
                });
            } catch (e) {

            }
        }

        function addItemToCart() {
            axios({
                method: 'post',
                url: `{{route('api.cart.add',['id'=>$item->id])}}`
            }).then((resp) => {
                console.log(resp.data.msg);
                displayToast(resp.data.msg, '.toast-success');

                const cart = resp.data.cart;
                document.querySelector('.cart-item-counter').innerHTML = cart.length;
            }).catch((error) => {
                displayToast('Thêm vào giỏ hàng thất bại', '.toast-failed');
            });
        }

        function displayToast(msg,selector) {
            const toast = document.querySelector(selector);
            toast.innerHTML = msg;
            toast.classList.remove('hidden');
            toast.classList.add('block');
            setTimeout(() => {
                toast.classList.add('hidden');
                toast.classList.remove('block');
            }, 1000);
        }

</script>
@endif