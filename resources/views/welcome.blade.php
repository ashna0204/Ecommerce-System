@extends('layouts.app')
@section('content')
  <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="text-center">
      <h1 class="mb-4">Create New Entities</h1>
      <div class="d-flex flex-column gap-3 mx-auto" style="max-width: 300px;">
        <a href="/users/create" class="btn btn-primary btn-lg">Create User</a>
        <a href="/products/create" class="btn btn-success btn-lg">Create Product</a>
        <a href="/orders/create" class="btn btn-warning btn-lg text-white">Create Order</a>
      </div>
    </div>
  </div>
@endsection
