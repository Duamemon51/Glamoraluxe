@extends('layouts.admin')

@section('content')
<div class="container mt-5">
        <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">✏️ Edit Coupon</h2>
      
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-body">
            <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="user_id" class="form-label fw-semibold">👤 User</label>
                    <select name="user_id" id="user_id" class="form-select rounded-pill" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $coupon->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="code" class="form-label fw-semibold">🔖 Coupon Code</label>
                    <input type="text" name="code" id="code" class="form-control rounded-pill" value="{{ $coupon->code }}" required>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label fw-semibold">📦 Type</label>
                    <select name="type" id="type" class="form-select rounded-pill" required>
                        <option value="fixed" {{ $coupon->type === 'fixed' ? 'selected' : '' }}>Fixed</option>
                        <option value="percent" {{ $coupon->type === 'percent' ? 'selected' : '' }}>Percent</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="value" class="form-label fw-semibold">💰 Value</label>
                    <input type="number" name="value" id="value" step="0.01" class="form-control rounded-pill" value="{{ $coupon->value }}" required>
                </div>

                <div class="mb-3">
                    <label for="expires_at" class="form-label fw-semibold">📅 Expires At</label>
                    <input type="datetime-local" name="expires_at" id="expires_at" class="form-control rounded-pill"
                        value="{{ $coupon->expires_at ? \Carbon\Carbon::parse($coupon->expires_at)->format('Y-m-d\TH:i') : '' }}">
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $coupon->is_active ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="is_active"> Active</label>
                </div>

                <button type="submit" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-check-circle"></i> Update
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

