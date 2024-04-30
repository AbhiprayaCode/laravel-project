<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    @section('navbar')
    @include('layouts.navigation')
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="fs-5 fw-bold text-center mb-3">Order List</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">description</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart->where('user_id', auth()->id()) as $item)
                                @php
                                    $product = \App\Models\products::find($item->product_id);
                                @endphp
                                @if($product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp {{ number_format($product->price * $item->quantity, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="flex justify-center items-center">
                                            <form action="{{ route('cart.increment', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success font-bold py-1 px-2 rounded">
                                                    +
                                                </button>
                                            </form>
                                            <span class="mx-2">{{ $item->quantity }}</span>
                                            <form action="{{ route('cart.decrement', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger font-bold py-1 px-2 rounded">
                                                    -
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary font-bold py-2 px-4 mx-auto rounded">
                                Checkout
                            </button>
                        </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

