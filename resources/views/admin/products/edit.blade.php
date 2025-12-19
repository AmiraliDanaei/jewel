@extends('admin.layouts.admin')

@section('title', 'Edit Product: ' . $product->name)

@section('content')
    <h1>Edit Product: {{ $product->name }}</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH') {{-- Important: Tells Laravel this is an UPDATE request --}}

                <div class="form-group mb-3">
                    <label for="name">Product Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                </div>
                
                <div class="form-group mb-3">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" class="form-control" step="0.01" value="{{ old('price', $product->price) }}" required>
                </div>
                
                <div class="form-group mb-3">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required min="0">
                </div>
                
                <div class="form-group mb-3">
                    <label for="image">Product Image:</label>
                    <input type="file" id="image" name="image" class="form-control">
                    <small class="form-text text-muted">Leave blank to keep the current image.</small>
                    <img src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}" width="100" class="mt-2">
                </div>
                
                <div class="form-group mb-3">
                    <label for="category_id">Category:</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <button type="submit" class="btn btn-success">Update Product</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
