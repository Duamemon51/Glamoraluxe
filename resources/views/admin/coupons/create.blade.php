@extends('layouts.admin')

@section('content')
<div class="container mt-5">
        <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">➕ Add Coupon</h2>
       
    </div>

    <div class="card shadow border-0">
        <div class="card-body">
            <form action="{{ route('admin.coupons.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="user_id" class="form-label fw-semibold">👤 Assign to User</label>
                    <select name="user_id" id="user_id" class="form-select rounded-pill" required>
                        <option value="">-- Select User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">🔖 Code</label>
                    <input type="text" name="code" class="form-control rounded-pill" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">📦 Type</label>
                    <select name="type" class="form-select rounded-pill" required>
                        <option value="fixed">Fixed</option>
                        <option value="percent">Percent</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">💰 Value</label>
                    <input type="number" step="0.01" name="value" class="form-control rounded-pill" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">📅 Expires At</label>
                    <input type="datetime-local" name="expires_at" class="form-control rounded-pill">
                </div>

                <div class="form-check mb-4">
                    <input type="checkbox" name="is_active" id="is_active" value="1" class="form-check-input">
                    <label for="is_active" class="form-check-label fw-semibold">Active</label>
                </div>

                <button type="submit" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-plus-circle"></i> Create
                </button>
            </form>
        </div>
    </div>
</div>
@endsection


<style>
    .form-label {
        color: #333;
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(238, 66, 102, 0.25);
        border-color: #EE4266;
    }

    .btn-primary {
        background-color: #EE4266;
        border-color: #EE4266;
    }

    .btn-primary:hover {
        background-color: #d63a5b;
        border-color: #d63a5b;
    }

    .rounded-pill {
        border-radius: 50rem !important;
    }

    .fw-semibold {
        font-weight: 600;
    }
</style>
