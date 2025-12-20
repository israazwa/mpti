<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
class paymentController extends Controller
{
    // Payment Notification dari Midtrans
    public function notification(Request $request)
    {
        $payload = $request->all();
        Log::info('Midtrans Notification', $payload);

        $orderId = $payload['order_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;

        if ($orderId) {
            $order = Order::where('id', $orderId)->first();
            if ($order) {
                // Update status order sesuai status Midtrans
                if ($transactionStatus === 'settlement') {
                    $order->update(['status' => 'paid']);
                } elseif ($transactionStatus === 'pending') {
                    $order->update(['status' => 'pending']);
                } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                    $order->update(['status' => 'failed']);
                }
            }
        }

        return response()->json(['message' => 'Notification handled']);
    }

    // Recurring Notification (optional)
    public function recurring(Request $request)
    {
        Log::info('Midtrans Recurring', $request->all());
        return response()->json(['message' => 'Recurring handled']);
    }

    // Pay Account Notification (optional)
    public function accountStatus(Request $request)
    {
        Log::info('Midtrans Account Status', $request->all());
        return response()->json(['message' => 'Account status handled']);
    }

    // Redirect jika pembayaran sukses
    public function finish(Request $request)
    {
        return view('payment.finish', ['data' => $request->all()]);
    }

    // Redirect jika pembayaran tidak selesai
    public function unfinish(Request $request)
    {
        return view('payment.unfinish', ['data' => $request->all()]);
    }

    // Redirect jika error
    public function error(Request $request)
    {
        return view('payment.error', ['data' => $request->all()]);
    }
}

