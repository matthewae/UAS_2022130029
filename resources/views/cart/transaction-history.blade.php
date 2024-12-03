@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center fw-bold" style="color: #6c757d;">Transaction History</h1>

    @if ($transactions->isEmpty())
        <div class="alert alert-info text-center">
            <strong>No transaction history found.</strong> You have not made any transactions yet.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">Transaction ID</th>
                        <th class="text-center">Order ID</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Payment Method</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr class="{{ $transaction->status == 'Completed' ? 'table-success' : ($transaction->status == 'Pending' ? 'table-warning' : 'table-danger') }}">
                            <td class="text-center">{{ $transaction->id }}</td>
                            <td class="text-center">{{ $transaction->order_id }}</td>
                            <td class="text-right text-success">
                                <strong>Rp. {{ number_format($transaction->amount, 2) }}</strong>
                            </td>
                            <td class="text-center">
                                <i class="fas fa-credit-card"></i> {{ $transaction->paymentMethod->name }}
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $transaction->status == 'Completed' ? 'bg-success' : ($transaction->status == 'Pending' ? 'bg-warning' : 'bg-danger') }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td class="text-center">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
