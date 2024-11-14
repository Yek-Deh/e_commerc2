<x-app-layout>
    <!--============================
           PRODUCT DETAILS START
       =============================-->
    <section class="wsus__product_details mt_170 mb_100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5 wow fadeInLeft">
                    <div class="wsus__product_details_slider_area">
                        <div class="row slider-forFive">
                            <div class="col-xl-12">
                                <div class="wsus__product_details_slide_show_img">
                                    <img src="{{asset($product->image)}}" alt="product" class="img-fluid w-100">
                                </div>
                            </div>
                            @foreach($product->images as $image)
                                <div class="col-xl-12">
                                    <div class="wsus__product_details_slide_show_img">
                                        <img src="{{asset($image->path)}}" alt="product" class="img-fluid w-100">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="wsus__product_details_slider">
                            <div class="row slider-navFive">
                                <div class="col-xl-2">
                                    <div class="wsus__product_details_slider_img">
                                        <img src="{{asset($product->image)}}" alt="product"
                                             class="img-fluid w-100">
                                    </div>
                                </div>
                                @foreach($product->images as $image)
                                    <div class="col-xl-2">
                                        <div class="wsus__product_details_slider_img">
                                            <img src="{{asset($image->path)}}" alt="product"
                                                 class="img-fluid w-100">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-7 wow fadeInRight">
                    <div class="wsus__product_summary">
                        <h2>{{$product->name}}</h2>
                        <span>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <b>8k+ reviews</b>
                        </span>
                        <h6>${{$product->price}}</h6>
                        <p>{{$product->short_description}}</p>

                        <h6 class="mt_30">Color</h6>
                        <select class="select_2 color" name="color">
                            <option value="">Select Color</option>
                            @foreach($product->colors as $color)
                                <option value="{{$color->name}}">{{$color->name}}</option>
                            @endforeach
                        </select>


                        <div class="wsus__product_add_cart">
                            <div class="wsus__product_quantity">
                                <button class="minus decrement" type="submit"><i class="far fa-minus"></i></button>
                                <input type="text" placeholder="01" value="1" min="1" class="quantity">
                                <button class="plus increment" type="submit"><i class="far fa-plus"></i></button>
                            </div>
                            <div class="wsus__buy_cart_button">

                                <a href="" class="common_btn add-to-cart" data-id="{{$product->id}}">Add To Cart</a>
                            </div>
                        </div>
                        <ul class="wishlist d-flex flex-wrap">
                            <li><a href="#"><span><i class="fal fa-heart"></i></span>ADD TO WISHLIST</a></li>
                            <li><a href="#"><span><i class="fal fa-share-alt"></i></span>SHARE</a></li>
                        </ul>
                        <ul class="details">
                            <li>SKU:<span>{{$product->sku}}</span></li>
                            <li>Categories:<span>Casual, walk, run, brand</span></li>
                            <li>Tags:<span>gym, health, run, style</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="wsus__product_details_menu_contant">
                        <div class="wsus__product_description wow fadeInUp">
                            {!!$product->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
       PRODUCT DETAILS END
    =============================-->
    @push('scripts')
        <script>


            $(document).ready(function () {
                $(".add-to-cart").on("click", function (e) {
                    e.preventDefault();
                    let id = $(this).data('id');
                    let color = $('.color').val();
                    let quantity=$('.quantity').val();
                    $.ajax({
                        method: 'POST',
                        url: "{{route('add-to-cart',':id')}}".replace(':id', id),
                        data: {
                            _token: "{{csrf_token()}}",
                            color: color,
                            quantity:quantity
                        },
                        beforeSend: function () {
                            if (validation()) return false;
                        },
                        success: function (data) {
                            if (data.status=== 'success'){
                                $('.cart-count').html(data.cart_count);
                                notyf.success('Product Added To Cart');
                            }
                        },
                        error: function (xhr, status, error) {
                        },
                    })
                });
                function validation() {
                    let color=$('.color').val();
                    if (color ===""){
                        notyf.error('Please Select a Color');
                        return true;
                    }
                    return false;
                }
                $('.increment').on('click', function () {
                    let quantity = $(".quantity").val();
                    quantity = parseInt(quantity) + 1;
                    $('.quantity').val(quantity);

                });
                $('.decrement').on('click', function () {
                    let quantity = $(".quantity").val();
                    if (quantity > 1) {
                        quantity = parseInt(quantity) - 1;
                        $('.quantity').val(quantity);
                    }

                });
            })
        </script>
    @endpush
</x-app-layout>