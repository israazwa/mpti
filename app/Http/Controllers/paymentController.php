<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function checkout()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Simpan order ke DB
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . uniqid(),
            'subtotal' => 100000,   // tambahkan ini
            'grand_total' => 100000,
            'status' => 'pending',
        ]);

        // Data transaksi
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $order->grand_total,
            ],
            'customer_details' => [
                'first_name' => auth()->name ?? 'HAy',
                'email' => auth()->email ?? 'Hay@example.com',
                'phone' => auth()->phone ?? '08123456789',
            ],
        ];

        // Buat Snap Token
        $snapToken = Snap::getSnapToken($params);
        logger()->info('SnapToken', ['token' => $snapToken]);
        return response()->json(['snapToken' => $snapToken]);
    }

    public function notification(Request $request)
    {
        $payload = $request->all();
        Log::info('Midtrans Notification', $payload);

        $orderId = $payload['order_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;

        if ($orderId) {
            $order = Order::where('order_number', $orderId)->first();
            if ($order) {
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
}