@extends('layouts.admin')

@section('content')
<div class="container mt-5">
        <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>
    </div>
  <div class="d-flex justify-content-between align-items-center mb-3 bg-pink-header rounded p-3">
    <h2 class="fw-bold text-white mb-0">➕ Add User</h2>
</div>
<style>
    .form-label {
        color: #3D3F45;
    }

    .form-control:focus, .form-select:focus {
        border-color: #EE4266;
        box-shadow: 0 0 0 0.2rem rgba(238, 66, 102, 0.25);
    }

 

    .btn-outline-secondary:hover {
        background-color: #f3f3f3;
    }

    .bg-pink-header {
        background-color: #EE4266;
    }

    .bg-pink-header h2 {
        color: white;
    }
</style>


    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="card shadow-sm p-4 border-0">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label fw-semibold">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label fw-semibold">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label fw-semibold">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3">{{ old('address') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="avatar" class="form-label fw-semibold">Avatar</label>
            <input type="file" class="form-control" id="avatar" name="avatar">
        </div>

        <div class="text-end">
                   <button type="submit" class="btn btn-success rounded-pill btn-sm-custom">
        <i class="bi bi-check-circle"></i> Save
    </button>
        </div>
    </form>
</div>
@endsection
