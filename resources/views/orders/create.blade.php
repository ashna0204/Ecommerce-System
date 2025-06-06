@extends('layouts.app')

@section('content')

<h1 class="mb-4">Create Order</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/orders" novalidate>
    @csrf

    <div class="mb-3">
        <label for="user_id" class="form-label">User:</label>
        <select name="user_id" id="user_id" class="form-select" required>
            <option value="">Select User</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }} ({{ $user->email }})
                </option>
            @endforeach
        </select>
    </div>

    <label class="form-label">Products:</label>
    <div id="items-container" class="mb-3">
        @if(old('items'))
            @foreach(old('items') as $index => $item)
                <div class="product-row d-flex align-items-center gap-2 mb-2">
                    <select name="items[{{ $index }}][product_id]" class="form-select" required style="flex: 2;">
                        <option value="">Select Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ $item['product_id'] == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} (Stock: {{ $product->stock }})
                            </option>
                        @endforeach
                    </select>
                    <input type="number" name="items[{{ $index }}][quantity]" min="1" class="form-control" style="width: 100px;" value="{{ $item['quantity'] }}" required>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeProductRow(this)">Remove</button>
                </div>
            @endforeach
        @else
            <div class="product-row d-flex align-items-center gap-2 mb-2">
                <select name="items[0][product_id]" class="form-select" required style="flex: 2;">
                    <option value="">Select Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }} (Stock: {{ $product->stock }})
                        </option>
                    @endforeach
                </select>
                <input type="number" name="items[0][quantity]" min="1" class="form-control" style="width: 100px;" value="1" required>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeProductRow(this)">Remove</button>
            </div>
        @endif
    </div>

    <button type="button" class="btn btn-secondary mb-3" onclick="addProductRow()">Add Another Product</button><br>

    <button type="submit" class="btn btn-primary">Place Order</button>
</form>
<div class="pt-3">
    <a href="/" class="btn btn-warning">Back to Home</a>
</div>

<!-- Hidden template for new product rows -->
<template id="product-template">
    <div class="product-row d-flex align-items-center gap-2 mb-2">
        <select name="items[][product_id]" class="form-select" required style="flex: 2;">
            <option value="">Select Product</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}">
                    {{ $product->name }} (Stock: {{ $product->stock }})
                </option>
            @endforeach
        </select>
        <input type="number" name="items[][quantity]" min="1" class="form-control" style="width: 100px;" value="1" required>
        <button type="button" class="btn btn-danger btn-sm" onclick="removeProductRow(this)">Remove</button>
    </div>
</template>

<script>
    function addProductRow() {
        const container = document.getElementById('items-container');
        const template = document.getElementById('product-template').content.cloneNode(true);
        
        // Fix the name attributes to have unique indexes to avoid issues on submit
        const index = container.children.length;
        const select = template.querySelector('select');
        select.name = `items[${index}][product_id]`;

        const input = template.querySelector('input[type="number"]');
        input.name = `items[${index}][quantity]`;

        container.appendChild(template);
    }

    function removeProductRow(button) {
        const container = document.getElementById('items-container');
        if(container.children.length > 1) {
            button.closest('.product-row').remove();
        } else {
            alert('At least one product is required.');
        }
    }
</script>

@endsection
