
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="/admin" class="btn btn-dark mb-3">Back</a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="fs-5 fw-bold text-center mb-3">Product Details</h1>
                    <form action="{{ route('admin.addProducts') }}" method="post">
                        @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                      </div>
                      <div class="mb-3">
                        <label for="description" class="form-label">Product description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                      </div>
                      <div class="mb-3">
                        <label for="category" class="form-label">Categories</label>
                        <select class="form-select" id="category" name="category" aria-label="Default select example">
                            <option selected>Select Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price">
                      </div>
                      <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

