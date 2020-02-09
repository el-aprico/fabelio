@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h1>Produk <i>{{ $product->name }}</i></h1>
                        <div class="ml-auto">
                            <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Nama</th>
                            <th>{{ $product->name }}</th>
                        </tr>
                        <tr>
                            <td>Url</td>
                            <td>{{ $product->url }}</td>
                        </tr>
                        <tr>
                            <td>SKU</td>
                            <td>{{ $product->sku }}</td>
                        </tr>
                        <tr>
                            <td>Brand</td>
                            <td>{{ $product->brand  }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{!! nl2br($product->description) !!}</td>
                        </tr>
                        <tr>
                            <td>Initial Price</td>
                            <td>IDR {{ number_format($product->price) }}</td>
                        </tr>
                        <tr>
                            <td>Images</td>
                            <td>
@foreach ($images as $key => $val)
                                <a href="{{ $val->full }}" target="_blank"><img src="{{ $val->thumb }}"></a>&nbsp;
@endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Created At</td>
                            <td>{{ $product->created_at }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
