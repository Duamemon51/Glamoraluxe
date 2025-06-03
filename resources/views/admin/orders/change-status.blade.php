@extends('layouts.admin')

@section('content')
<div class="container mt-5">
      <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.orders.list') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="bi bi-arrow-left-circle"></i> Back
        </a>
    </div>
  <div class="card shadow border-0">
    <div class="card-header bg-pink text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0"><i class="bi bi-receipt"></i> Order #{{ $order->id }} Details</h4>
    </div>

    <div class="card-body">
      <div class="row mb-4">
        <div class="col-md-6">
          <h5 class="text-primary">Customer Information</h5>
          <p><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
          <p><strong>Email:</strong> {{ $order->email }}</p>
          <p><strong>Phone:</strong> {{ $order->phone }}</p>
          <p><strong>Address:</strong> {{ $order->address }}, {{ $order->state }}, {{ $order->country }}</p>
        </div>

        <div class="col-md-6">
          <h5 class="text-primary">Order Summary</h5>
          @php
              $statusColors = [
                  'pending' => 'warning',
                  'processing' => 'info',
                  'shipped' => 'primary',
                  'delivered' => 'success',
                  'cancelled' => 'danger',
              ];
              $statusColor = $statusColors[strtolower($order->order_status)] ?? 'secondary';
              $paymentColor = $order->payment_status === 'paid' ? 'success' : 'secondary';
          @endphp

          <p><strong>Status:</strong> 
            <span class="badge bg-{{ $statusColor }}">{{ ucfirst($order->order_status) }}</span>
          </p>
          <p><strong>Payment Status:</strong> 
            <span class="badge bg-{{ $paymentColor }}">{{ ucfirst($order->payment_status) }}</span>
          </p>
          <p><strong>Total Price:</strong> 
            <span class="text-success fw-bold">${{ number_format($order->total_price, 2) }}</span>
          </p>
        </div>
      </div>

      <hr>

      <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}">
        @csrf
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="status" class="form-label">Change Order Status</label>
            <select id="status" name="status" class="form-select">
              <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
              <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
              <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
              <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
              <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
          </div>

          <div class="col-md-6">
            <label for="payment_status" class="form-label">Change Payment Status</label>
            <select id="payment_status" name="payment_status" class="form-select">
              <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
              <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
            </select>
          </div>
        </div>

        <div class="d-flex justify-content-between">
        
          <button type="submit" class="btn btn-success">
            <i class="bi bi-save"></i> Update Status
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection


  <style>
    .bg-pink {
        background-color: #EE4266 !important;
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #EE4266;
        color: white;
        border-radius: 15px 15px 0 0;
    }

    .card-body {
        background-color: #F9F9F9;
        border-radius: 0 0 15px 15px;
    }

    .form-select {
        border-radius: 10px;
    }

    .btn-outline-secondary {
        border-radius: 20px;
    }

    .btn-success {
        border-radius: 20px;
    }

    .badge {
        font-size: 1.1rem;
    }

    .text-primary {
        color: #333;
    }
  </style>

