@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Product</h2>
                        <div class="ml-auto">
                            <a href="{{ route('product.create') }}" class="btn btn-outline-secondary">Create Product</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include ('layouts.messages')
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Url</th>
                            <th>Action</th>
                        </tr>
@if (sizeof($products) === 0)
                        <tr>
                            <td colspan="4">
                                No Data, Create One
                            </td>
                        </tr>
@endif
@foreach ($products as $key => $product)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->brand }}</td>
                            <td><a href="{{ $product->url }}" target="_blank">{{ substr($product->url, 0, 25).'...' }}</td>
                            <td>
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-outline-primary float-left">View</a>
                            </td>
                        </tr>
@endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
