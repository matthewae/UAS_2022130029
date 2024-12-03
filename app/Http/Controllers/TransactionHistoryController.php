<?php

namespace App\Http\Controllers;

use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionHistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $transactions = TransactionHistory::where('user_id', $user->id)->get();

        return view('cart.transaction-history', compact('transactions'));
    }
}
