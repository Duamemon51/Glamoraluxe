@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow border-0">
        <div class="card-header bg-pink text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0"><i class="bi bi-receipt"></i> Order #{{ $order->id }} Details</h4>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
                    <p><strong>Email:</strong> {{ $order->email }}</p>
                    <p><strong>Phone:</strong> {{ $order->phone }}</p>
                    <p><strong>Address:</strong> {{ $order->address }}, {{ $order->state }}, {{ $order->country }}</p>
                    <p><strong>Total Price:</strong> 
                        <span class="text-success fw-bold">${{ number_format($order->total_price, 2) }}</span>
                    </p>
                </div>

            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.orders.list') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Back
                </a>
            </div>
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

        .btn-outline-secondary {
            border-radius: 20px;
        }

        .badge {
            font-size: 1.1rem;
        }

        .text-primary {
            color: #333;
        }
    </style>

