<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Product;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home(){
        $items = Product::orderBy('created_at', 'DESC')->get();
        return view('user.index', ['items' => $items]);
    }

    public function product($id){
        $item = Product::find($id);
        if(!$item){
            abort(404);
        }
        return view('user.buy', ['item' => $item]);
    }
    public function ticket(){
        $items = Item::orderBy('created_at', 'DESC')->get();
        return view('user.ticket_cost', ['items' => $items]);
    }

    public function store(Request $request){
        $check = [
            'name' => 'required',
            'number' => 'required',
            'product_name' => 'required',
            'unit_price' => 'required',
            'sum_price' => 'required',
        ];

        $valid = Validator::make($request->all(), $check);
        if($valid->fails()){
            return redirect()->back()->withInput()->withErrors($valid->errors());
        }

        $totalPrice = $request->input('sum_price');

        $paymentStatus = $this->processBkashPayment($totalPrice);

        if ($paymentStatus === 'success') {
            $ticket = new Item();
            $ticket->name = $request->name;
            $ticket->phone = $request->number;
            $ticket->item = $request->product_name;
            // $ticket->quantity = $request->product_quantity;
            $ticket->unit = $request->unit_price;
            $ticket->amount = $request->sum_price;
            $ticket->save();
            return redirect()->route('homepage')->with('success', 'Payment successful! Ticket purchased.');
        } else {
            return redirect()->route('homepage')->with('error', 'Payment failed! Please try again.');
        }

    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric'
        ]);
    
        $paymentStatus = $this->processBkashPayment($request->input('amount'));
    
        if ($paymentStatus === 'success') {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'fail']);
        }
    }
    
    private function processBkashPayment($amount)
    {
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, config('bkash.base_url') . "/checkout/payment/request");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer " . $this->getAccessToken(),
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "amount" => $amount,
            "currency" => "BDT",
            "intent" => "sale",
            // অন্যান্য প্রয়োজনীয় ফিল্ড এখানে যোগ করুন
        ]));
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        $responseData = json_decode($response, true);
    
        // পেমেন্ট সফল হলে 'success' ফিরিয়ে দেবে
        return isset($responseData['paymentStatus']) && $responseData['paymentStatus'] === 'Completed' ? 'success' : 'fail';
    }
    private function getAccessToken()
    {
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, config('bkash.base_url') . "/checkout/token/grant");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Basic " . base64_encode(config('bkash.app_key') . ":" . config('bkash.app_secret')),
        ]);
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        $responseData = json_decode($response, true);
    
        return $responseData['id_token'] ?? null;
    }    
    
    private function callBkashApi($amount)
    {
        // বিকাশ API কলের জন্য প্রয়োজনীয় কোড লিখুন
        // এখানে আমরা একটি সিমুলেটেড রেসপন্স দিচ্ছি
        $response = [
            'status' => 'success', // অথবা 'fail'
            'message' => 'Payment processed successfully' // সিমুলেটেড বার্তা
        ];
    
        return (object)$response; // অ্যারে কে অবজেক্টে রূপান্তর করা
    }




    // ticket page payment system
    public function processPaymentTicket(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'ticketNumber' => 'required|integer|min:1',
        ]);
    
        $ticket = new Ticket();
        $ticket->name = $request->input('name');
        $ticket->phone = $request->input('phone');
        $ticket->ticket_number = $request->input('ticketNumber');
        $ticket->price = 10 * $request->input('ticketNumber'); // প্রতি টিকেটের দাম 10 BDT
        $ticket->save();
    
        return response()->json(['success' => true]);
    }
    

    // error page
    public function error(){
        return view('errors.404');
    }
    
    
}
