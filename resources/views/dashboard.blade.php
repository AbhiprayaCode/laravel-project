

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @section('navbar')
    @include('layouts.navigation')
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
                                <th scope="col">Name</th>
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
                                    <td>
                                        <form action="{{ route('cart.add', ['id' => $product->id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{$product->id}}" name="product_id">
                                            <button type="submit" class="btn btn-primary">Tambah</button>
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
    </div>
</x-app-layout>
