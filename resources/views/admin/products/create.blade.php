@extends('admin.layouts.admin')

@section('title', 'Add New Product')

@section('content')
    <h1>Add New Product</h1>

    <div class="card">
        <div class="card-body">
            
            {{-- The form action and cancel button routes are now corrected --}}
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Product Name:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                
                <div class="form-group mb-3">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" class="form-control" step="0.01" required>
                </div>
                
                <div class="form-group mb-3">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" class="form-control" required min="0" value="1">
                </div>
                
                <div class="form-group mb-3">
                    <label for="image">Product Image:</label>
                    <input type="file" id="image" name="image" class="form-control">
                </div>
                
                <div class="form-group mb-3">
                    <label for="category_id">Category:</label>
                    <select id="category_id" name="category_id" class="form-control" required>
                        <option value="">Select a Category</option>
                        
                        @if(isset($categories) && $categories->count() > 0)
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        @else
                            <option value="" disabled>No categories found.</option>
                        @endif
                    </select>
                </div>
                
                <button type="submit" class="btn btn-success">Save Product</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
