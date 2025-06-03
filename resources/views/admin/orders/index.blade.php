@extends('layouts.admin') 

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">📦 All Orders</h2>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="custom-softmax-header text-center">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Discount</th>
                            <th>Payment</th>
                            <th>Payment Method</th> <!-- New column for Payment Method -->
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        @php
                            $paymentColor = $order->payment_status === 'paid' ? 'success' : 'warning';

                            $statusColors = [
                                'pending' => 'warning',
                                'processing' => 'info',
                                'shipped' => 'primary',
                                'delivered' => 'success',
                                'cancelled' => 'danger',
                            ];
                            $badgeColor = $statusColors[strtolower($order->order_status)] ?? 'secondary';

                            // Check payment method and set color accordingly
                            if ($order->payment_method === 'stripe') {
                                $paymentMethodColor = 'bg-primary'; // Blue for Stripe
                            } elseif ($order->payment_method === 'COD') {
                                $paymentMethodColor = 'bg-success'; // Green for COD
                            } else {
                                $paymentMethodColor = 'bg-info'; // Default color
                            }
                        @endphp
                        <tr>
                            <td class="text-center fw-bold">#{{ $order->id }}</td>
                            <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                            <td>${{ number_format($order->total_price, 2) }}</td>
                            <td class="text-center">
                                @if ($order->coupon_code)
                                    <span class="badge bg-info">{{ $order->coupon_code }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            
                            <td class="text-center">
                                <span class="badge bg-{{ $paymentColor }}">{{ ucfirst($order->payment_status) }}</span>
                            </td>
                            <td class="text-center"> <!-- Display Payment Method -->
                                <span class="badge {{ $paymentMethodColor }}">{{ ucfirst($order->payment_method) }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-{{ $badgeColor }}">{{ ucfirst($order->order_status) }}</span>
                            </td>
                            <td class="text-muted">{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary me-1 mb-1">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <a href="{{ route('admin.orders.change-status', $order->id) }}" class="btn btn-sm btn-outline-warning me-1 mb-1">
                                    <i class="bi bi-pencil-square"></i> Status
                                </a>
                                <form action="{{ route('admin.orders.delete', $order->id) }}" method="GET" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this order?')">
                                    <button type="submit" class="btn btn-sm btn-outline-danger mb-1">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    thead.custom-softmax-header th {
        background-color: #EE4266 !important; /* Pink background */
        color: white !important; /* White text */
    }
</style>
