
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    @section('navbar')
    @include('admin.layout.navigation')
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="fs-5 fw-bold text-center mb-3">Product List</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">Menu</th>
                                <th scope="col">Description</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td> <!-- Sesuaikan dengan nama kolom di database untuk nama menu -->
                                    <td>{{ $product->description }}</td>
                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td> <!-- Format harga menjadi format rupiah -->
                                    <td class="d-flex gap-2 justify-content-center align-items-center">
                                        <form action="{{ route('admin.deleteProduct', ['id' => $product->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE') <!-- Add this line to specify the DELETE method -->
                                            <input type="hidden" value="{{$product->id}}" name="product_id">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    <form action="{{ route('admin.getProductForUpdate', ['id' => $product->id]) }}">
                                        @csrf
                                        @method('PUT') <!-- Add this line to specify the PUT method -->
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                <a href="{{ route('admin.add') }}" class="btn btn-success">Tambah Produk</a>
                <a href="{{ route('admin.addCategory') }}" class="btn btn-dark">Add Category</a>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
