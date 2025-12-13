@extends('admin.layouts.admin')

@section('title', 'Popular Categories Report')

@section('content')
    <h1>Popular Categories Report</h1>
    <p>Showing categories with more than 2 products.</p>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Category Name</th>
                <th>Total Products</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->products_count }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">No categories found matching the criteria.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
