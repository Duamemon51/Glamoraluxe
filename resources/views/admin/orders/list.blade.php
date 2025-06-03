@extends('layouts.admin')

@section('content')
<h2>All Orders</h2>

@if (session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table>
  <thead>
    <tr>
      <th>Order ID</th>
      <th>Customer Name</th>
      <th>Email / Phone</th>
      <th>Total Price</th>
      <th>Payment Status</th>
      <th>Order Status</th>
      <th>Order Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($orders as $order)
    <tr>
      <td>{{ $order->id }}</td>
      <td>{{ $order->first_name }} {{ $order->last_name }}</td>
      <td>{{ $order->email }} / {{ $order->phone }}</td>
      <td>${{ $order->total_price }}</td>
      <td>{{ ucfirst($order->payment_status) }}</td>
      <td>{{ ucfirst($order->order_status) }}</td>
      <td>{{ $order->created_at->format('Y-m-d H:i') }}</td> <!-- Formatting order date -->
      <td>
        <a href="{{ route('admin.orders.show', $order->id) }}">View</a>
        <a href="{{ route('admin.orders.delete', $order->id) }}" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
        <a href="{{ route('admin.orders.changeStatus', $order->id) }}">Change Status</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $orders->links() }}
@endsection
