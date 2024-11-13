<x-app-layout>
    <section class="wsus__product mt_145 pb_100">
        <div class="container">
            <h2 class="p-3 text-center text-primary">Dashboard</h2>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Edit Product </h4>
                    <a href="{{route('product.index')}}" class="btn btn-primary">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                            <div style="width:50%">
                                <img style="width: 50% !important" src="{{asset($product->image)}}" alt="no image">
                            </div>
                            <label for="image" class="mt-2 mb-2">Image</label>
                            <x-text-input type="file" name="image" id="image" value="{{$product->image}}" />
                            @error('image')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <div class="d-flex justify-content-between mt-2" >
                            @foreach($product->images as $image)
                                <img style="width: 20% !important;" src="{{asset($image->path)}}" alt="no image">
                            @endforeach
                            </div>
                            <label for="images" class="mt-2 mb-2">Images</label>
                            <x-text-input type="file" name="images[]" id="images" multiple/>
                            @error('images')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="name" class="mt-2 mb-2">Name</label>
                            <x-text-input type="text" name="name" id="name" value="{{$product->name}}"/>
                            @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="price" class="mt-2 mb-2">Price</label>
                            <x-text-input type="text" name="price" id="price" value="{{$product->price}}"/>
                            @error('price')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="colors" class="mt-2 mb-2">Colors</label>
                            <x-select-input name="colors[]" id="colors" multiple>
                                <option @selected(in_array('black',$colors)) value="black">Black</option>
                                <option @selected(in_array('green',$colors)) value="green">Green</option>
                                <option @selected(in_array('red',$colors)) value="red">Red</option>
                                <option @selected(in_array('cyan',$colors)) value="cyan">Cyan</option>
                            </x-select-input>
                            @error('colors')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="short_description" class="mt-2 mb-2">Short Description</label>
                            <x-text-input type="text" name="short_description" id="short_description"
                                          value="{{$product->short_description}}"/>
                            @error('short_description')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="quantity" class="mt-2 mb-2">Quantity</label>
                            <x-text-input type="text" name="quantity" id="quantity" value="{{$product->quantity}}"/>
                            @error('quantity')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="sku" class="mt-2 mb-2">Sku</label>
                            <x-text-input type="text" name="sku" id="sku" value="{{$product->sku}}"/>
                            @error('sku')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="editor" class="mt-2 mb-2">Description</label>
                            <textarea name="description" id="editor">{!! $product->description !!}</textarea>
                            @error('description')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <x-primary-button>Update</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            tinymce.init({
                selector: 'textarea#editor',
                height: 500,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
            });
        </script>
    @endpush
</x-app-layout>


