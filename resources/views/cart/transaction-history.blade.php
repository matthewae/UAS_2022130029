@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Transaction History</h1>

    @if ($transactions->isEmpty())
        <div class="alert alert-info">
            You have no transaction history yet.
        </div>
    @else
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
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
                    <tr>
                        <td class="text-center">{{ $transaction->id }}</td>
                        <td class="text-center">{{ $transaction->order_id }}</td>
                        <td class="text-right">{{ number_format($transaction->amount, 2) }}</td>
                        <td class="text-center">{{ $transaction->paymentMethod->name }}</td>
                        <td class="text-center">{{ $transaction->status }}</td>
                        <td class="text-center">{{ $transaction->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
