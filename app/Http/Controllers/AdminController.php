<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){
        return view('admin.home');
    }

    public function storage(Request $request){
        $check = [
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1'
        ];
        
        $Valid = Validator::make($request->all(), $check);
        if($Valid->fails()){
            return redirect()->route('itemPage')->withInput()->withErrors($Valid->errors());
        }
        
        $data = new Product();
        if($request->hasFile('photo')){
            $image = $request->file('photo');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $data->image = $imageName;
            $image->move(public_path('Uploaded_Photo'), $imageName);
        }
        
        $data->name = $request->name;
        $data->price = $request->price;
        $data->save();
        
    }

    public function itemView(){
        $items = Product::orderBy('created_at', 'DESC')->get();
        return view('admin.shop', ['items' => $items]);

    }

// ticket page
public function resetProgress()
{
    // Progress এবং বাটন রিসেটের জন্য এখানে কোড লিখুন
    return response()->json(['message' => 'Progress reset successfully']);
}

}
