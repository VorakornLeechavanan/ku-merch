<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\SalesLineItem;

class ItemManagementController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    function display() { 
        $sales_line_items=DB::table('sales_line_items')->get();
        $items=DB::table('items')->get();
        return view('catalog', compact('sales_line_items', 'items'));
    }

    function insert (Request $request) {
        $request->validate(
            [
                'product_id'=>'required',
                'title'=>'required',
                'price'=>'required',
                'quantity'=>'required'
            ]
        );

        $sli_data=[
            'product_id'=>$request->product_id,
            'title'=>$request->title,
            'price'=>$request->price
        ];

        $item_data=[
            'product_id'=>$request->product_id,
        ];

        SalesLineItem::insert($sli_data);

        for ($n=0; $n<$request->quantity; $n++) {
            Item::insert($item_data);
        }

        return redirect('/catalog');
    }
}
