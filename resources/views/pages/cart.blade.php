<x-app-layout>

    <!--============================
       CART START
   =============================-->
    <section class="wsus__cart mt_170 pb_100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 wow fadeInUp">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th class="pro_img">Item</th>

                                    <th class="pro_name">Name</th>

                                    <th class="pro_select">Quantity</th>

                                    <th class="pro_tk">Price</th>

                                    <th class="pro_icon">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td class="pro_img">
                                            <img src="{{$product['image']}}" alt="product" class="img-fluid w-100">
                                        </td>

                                        <td class="pro_name">
                                            <a href="#">{{$product['name']}}</a>
                                        </td>

                                        <td class="pro_select">
                                            <div class="quentity_btn">
                                                <button class="btn btn-danger decrement" data-id="{{$product['id']}}"><i class="fal fa-minus"></i></button>
                                                <input type="text" placeholder="1" value="{{$product['quantity']}}" min="1" class="quantity">
                                                <button class="btn btn-success increment" data-id="{{$product['id']}}"><i class="fal fa-plus" ></i></button>
                                            </div>
                                        </td>

                                        <td class="pro_tk">
                                            <h6>${{$product['price'] * $product['quantity']}}</h6>
                                        </td>

                                        <td class="pro_icon">
                                            <form action="{{route('remove-from-cart',$product['id'])}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" style="background-color: white"><i class="fal fa-times"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="wsus__cart_list_bottom">
                        <div class="row justify-content-between">
                            <div class="col-md-6 col-xl-5 ms-auto">
                                <div class="wsus__cart_list_pricing">
                                    @php
                                    $total=0;
                                    foreach ($products as $product){
                                        $total +=$product['price'] * $product['quantity'];
                                    }
                                     @endphp
                                    <h6>Total <span>$ {{$total}}</span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <ul class="wsus__cart_list_bottom_btn">
                        <li><a href="products.html" class="common_btn cont_shop">Continue To Shipping</a>
                        </li>
                        <li><a href="checkout.html" class="common_btn common_btn_2">Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        CART END
    =============================-->
    @push('scripts')
        <script>
            $(document).ready(function () {
                $('.increment').on('click', function () {
                    let quantity = $(this).siblings('.quantity').val();
                    let id=$(this).data('id');
                    quantity = parseInt(quantity) + 1;
                    $(this).siblings('.quantity').val(quantity);
                    $.ajax({
                        method: 'POST',
                        url: "{{route('update-quantity')}}",
                        data: {
                            _token: "{{csrf_token()}}",
                            id:id,
                            quantity:quantity,
                        },
                        success: function (data) {
                            if (data.status === 'success'){
                                window.location.reload();
                            }
                        },
                        error: function (xhr, status, error) {
                        },
                    })

                });
                $('.decrement').on('click', function () {
                    let quantity = $(this).siblings('.quantity').val();
                    let id=$(this).data('id');
                    if (quantity > 1) {
                        quantity = parseInt(quantity) - 1;
                        $(this).siblings('.quantity').val(quantity);
                        $.ajax({
                            method: 'POST',
                            url: "{{route('update-quantity')}}",
                            data: {
                                _token: "{{csrf_token()}}",
                                id:id,
                                quantity:quantity,
                            },
                            success: function (data) {
                                if (data.status === 'success'){
                                    window.location.reload();
                                }
                            },
                            error: function (xhr, status, error) {
                            },
                        })
                    }

                });
            })
        </script>
    @endpush
</x-app-layout>
