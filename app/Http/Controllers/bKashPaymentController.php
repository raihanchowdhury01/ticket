<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class bKashPaymentController extends Controller
{
    public function pay(Request $request)
    {
        $ticketNumber = $request->input('ticketNumber');
        $totalAmount = $ticketNumber * 10; // প্রতি টিকিট ১০ টাকা

        // Dummy API call to simulate bKash payment verification
        $response = $this->dummyBkashAPI($totalAmount);

        if ($response['status'] == 'success') {
            // পেমেন্ট সফল হলে ডাটাবেজে সেভ
            // টিকিট ক্রয়ের ডাটা সেভ করুন, উদাহরণস্বরূপ:

            // Ticket::create([
            //     'name' => $request->input('name'),
            //     'phone' => $request->input('phone'),
            //     'ticketNumber' => $ticketNumber,
            //     'amount' => $totalAmount,
            // ]);

            return response()->json([
                'message' => 'Payment Successful',
                'progress' => $this->calculateProgress($totalAmount)
            ]);
        } else {
            return response()->json(['message' => 'Payment Failed'], 400);
        }
    }

    // Dummy function to simulate bKash API
    private function dummyBkashAPI($amount)
    {
        if ($amount <= 50) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'failed'];
        }
    }

    private function calculateProgress($amount)
    {
        return min(100, ($amount / 50) * 100);
    }
}
