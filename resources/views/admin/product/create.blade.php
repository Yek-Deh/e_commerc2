<x-app-layout>
    <section class="wsus__product mt_145 pb_100">
        <div class="container">
            <h2 class="p-3 text-center text-primary">Dashboard</h2>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Create Product </h4>
                    <a href="{{route('product.index')}}" class="btn btn-primary">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="image" class="mt-2 mb-2">Image</label>
                            <x-text-input type="file" name="image" id="image"/>
                            @error('image')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="images" class="mt-2 mb-2">Images</label>
                            <x-text-input type="file" name="images[]" id="images" multiple/>
                            @error('images')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="name" class="mt-2 mb-2">Name</label>
                            <x-text-input type="text" name="name" id="name"/>
                            @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="price" class="mt-2 mb-2">Price</label>
                            <x-text-input type="text" name="price" id="price"/>
                            @error('price')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="colors" class="mt-2 mb-2">Colors</label>
                            <x-select-input name="colors[]" id="colors" multiple>
                                <option value="black">Black</option>
                                <option value="green">Green</option>
                                <option value="red">Red</option>
                                <option value="cyan">Cyan</option>
                            </x-select-input>
                            @error('colors')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="short_description" class="mt-2 mb-2">Short Description</label>
                            <x-text-input type="text" name="short_description" id="short_description"/>
                            @error('short_description')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="quantity" class="mt-2 mb-2">Quantity</label>
                            <x-text-input type="text" name="quantity" id="quantity"/>
                            @error('quantity')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="sku" class="mt-2 mb-2">Sku</label>
                            <x-text-input type="text" name="sku" id="sku"/>
                            @error('sku')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="editor" class="mt-2 mb-2">Description</label>
                            <textarea name="description" id="editor"></textarea>
                            @error('description')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <x-primary-button>Create</x-primary-button>
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


