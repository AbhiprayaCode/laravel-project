

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Status') }}
        </h2>
    </x-slot>

    @section('navbar')
    @include('layouts.navigation')
    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="fs-5 fw-bold text-center mb-3">Orders Status List</h1>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $orderItem)
                            <tr>
                              <td>{{ $orderItem->product ? $orderItem->product->name : 'N/A' }}</td>
                              <td>{{ $orderItem->product ? $orderItem->product->description : 'N/A' }}</td>
                              <td>{{ $orderItem->quantity }}</td>
                              <td>
                               Rp. {{ $orderItem->product ? number_format($orderItem->product->price * $orderItem->quantity, 0, ',', '.') : 'N/A' }}
                              </td>
                              <td>
                                @if($orderItem->order && $orderItem->order->status)
                                  {{ $orderItem->order->status }}
                                @else
                                  No Order Status
                                @endif
                              </td>
                              <td>
                                <form action="{{ route('orders.cancel', ['id' => $orderItem->id]) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger">Cancel</button>
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
