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
        $sli = SalesLineItem::where('product_id', $request->product_id)->first();
        if ($sli !== null) {
            return redirect('catalog/create_item');
        }

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

    function add_quantity (Request $request) {
        $sli = SalesLineItem::where('product_id', $request->product_id)->first();
        if ($sli == null) {
            return redirect('/catalog/add');
        }
            

        for ($n=0; $n<$request->quantity; $n++) {
            $item_data=[
                'product_id'=>$request->product_id,
            ];
            Item::insert($item_data);
        }

        return redirect('/catalog');

    }

    function remove (Request $request) {
        $sli = SalesLineItem::where('product_id', $request->product_id)->first();
        if ($sli == null) {
            return redirect('/catalog/remove');
        }   
        $count = Item::where('product_id', $request->product_id)->count();
        if ($count < $request->quantity) {
            return redirect('/catalog/remove');
        }

        for ($n=0; $n<$request->quantity; $n++) {
            $item = Item::where('product_id', $request->product_id)->first();
            $item->delete();
        }

        return redirect('/catalog');
    }

    function delete (Request $request) {
        $sli = SalesLineItem::where('product_id', $request->product_id)->first();
        if ($sli == null) {
            return redirect('/catalog/delete');
        }   

        DB::table('items')->where('product_id', $request->product_id)->delete();

        $sli -> delete();

        return redirect('/catalog');

    }
}
