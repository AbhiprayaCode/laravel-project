<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Status') }}
        </h2>
    </x-slot>
    @section('navbar')
    @include('admin.layout.navigation')
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="fs-5 fw-bold text-center mb-3">Orders List</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">Menu</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $orderItem)
                                <tr>
                                    <td>{{ $orderItem->product->name }}</td>
                                    <td>{{ $orderItem->product->description }}</td>
                                    <td>Rp {{ number_format($orderItem->product->price, 0, ',', '.') }}</td>
                                    <td>{{ $orderItem->quantity }}</td>
                                    <td>Rp {{ number_format($orderItem->product->price * $orderItem->quantity, 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('admin.updateOrderStatus', ['id' => $orderItem->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" onchange="this.form.submit()">
                                                <option value="pending" @if($orderItem->order && $orderItem->order->status == 'pending') selected @endif>Pending</option>
                                                <option value="processing" @if($orderItem->order && $orderItem->order->status == 'processing') selected @endif>Processing</option>
                                                <option value="completed" @if($orderItem->order && $orderItem->order->status == 'completed') selected @endif>Completed</option>
                                            </select>
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
