@extends('layouts.app')

@section('content')

<h1 class="mb-4">Create Product</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/products" novalidate>
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price:</label>
        <input type="number" step="0.01" id="price" name="price" class="form-control" value="{{ old('price') }}" required>
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label">Stock:</label>
        <input type="number" id="stock" name="stock" class="form-control" value="{{ old('stock') }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Create Product</button>
</form>
<div class="pt-3"> 
<a href="/" class="btn btn-secondary">Back to Home</a>
</div>
@endsection
