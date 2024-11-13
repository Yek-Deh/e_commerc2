<x-app-layout>
    <section class="wsus__product mt_145 pb_100">
        <div class="container">
            <h2 class="p-3 text-center text-primary">Dashboard</h2>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>All Products</h4>
                    <a href="{{route('product.create')}}" class="btn btn-outline-primary">Create New</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered ">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>
                                    <img  style="width:250px  !important;" src="{{asset($product->image)}}" alt="no image" >
                                </td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td class="d-flex justify-content-around">
                                    <a href="{{route('product.edit',$product->id)}}" class="btn btn-outline-primary">Edit</a>
                                    <form action="{{route('product.destroy',$product->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger" >Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
