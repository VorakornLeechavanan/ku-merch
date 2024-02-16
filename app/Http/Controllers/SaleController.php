<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customer;
use App\Models\CartItem;
use App\Models\SalesLineItem;

class SaleController extends Controller
{

   public function __construct()
   {
       $this->middleware('auth');
   }
    //
    function add_cart_item (Request $request) {
       $count = 0;
       $payment_is_already_created = false;
       $items = Item::all();
       $sales_line_items = SalesLineItem::all();

       foreach ($sales_line_items as $sli) {
         $a = $sli->product_id;
         $count += $sli->price * $request->$a;
      }

      if ($request->cash < $count) {
         return view('catalog', compact('sales_line_items', 'items'));
      }

       foreach ($sales_line_items as $sli) {

         $a = $sli->product_id;

         for ($n=0; $n<$request->$a; $n++) {

            if (!$payment_is_already_created) {

               $customer_data = [
                  'name'=>$request->customer_name,
                  'email'=>$request->customer_email
               ];

               $customer = Customer::create($customer_data);
           
               $payment_data = [
                  'cash'=>$request->cash,
                  'user_id'=>Auth::user()->id,
                  'customer_id'=>$customer->id,
               ];

               $payment = Payment::create($payment_data);
               $payment_is_already_created = true;
            }

         $object = Item::where('product_id', $a)->first();

         $object_data = [
            'product_id'=>$object->product_id,
            'title'=>$sli->title,
            'price'=>$sli->price,
            'payment_id'=>$payment->id
         ];
 
         CartItem::insert($object_data);

         $object->delete();
       }
    }
    if (!$payment_is_already_created) {
      return view('catalog', compact('sales_line_items', 'items'));
    }

    $payments =  Payment::all();
      $payment = $payments->filter(function ($payments) {
         return $payments->user_id === Auth::user()->id;
     });
      $user = User::all();
      $customer = Customer::all();
      return view('history', compact('payment', 'user', 'customer'));
}

   function display (Request $request) {
      $payments =  Payment::all();
      $payment = $payments->filter(function ($payments) {
         return $payments->user_id === Auth::user()->id;
     });
      $user = User::all();
      $customer = Customer::all();
      return view('history', compact('payment', 'user', 'customer'));
   }

   function receipt ($id) {
      $payment = Payment::where('id', $id)->first();
      if (is_null($payment)) {
         return redirect('/');
      }
      $cart_items = CartItem::all();
      $cart_item = $cart_items->filter(function ($cart_items) use ($id) {
         return $cart_items->payment_id == $id;
     });
      $unique_cart_item = $cart_item->unique('product_id');
      
     $user = User::where('id', $payment->user_id)->first();
     $customer = Customer::where('id', $payment->customer_id)->first();
     if ($user->id === Auth::user()->id) {
      return view('receipt', compact('payment', 'unique_cart_item', 'cart_item', 'user', 'customer'));
     }
     return redirect('/');
   } 
}
