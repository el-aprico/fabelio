@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Create Product</h2>
                        <div class="ml-auto">
                            <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="post">
                        @csrf
                        @php
                        @endphp
                        <div class="form-group row">
                            <label for="product-url" class="col-md-5">Url</label>
                            <div class="col-md-7 input-group">
                                <input type="text" name="url" id="product-url" value="{{ old('url') }}" class="form-control {{ $errors->has('url') ? 'is-invalid': '' }}" placeholder="https://fabelio.com/ip/sofa-2-kursi-manu-mystic-new.html">
                                @if ($errors->has('url'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary btn-lg">Create Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
