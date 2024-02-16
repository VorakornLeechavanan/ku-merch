@extends('layout')

@section('title', 'Receipt')

@section('content')
@php
$total_price = 0;
$total_quantity = 0;
@endphp
<table class="table" id="totals_table">
    <thead>
        <tr>
          <th scope="col">Product ID</th>
          <th scope="col">Title</th>
          <th scope="col">Quantity</th>
          <th scope="col">Price</th>
        </tr>
    </thead>
    <tbody>
     @foreach($unique_cart_item as $u)
     @php
      $count = 0;
      $price = 0;
     @endphp
     <tr>
        <td> {{$u->product_id}} </td>
        <td> {{$u->title}} </td>
        @foreach($cart_item as $c)
         @if($c->product_id===$u->product_id)
          @php
           $count++;
           $total_quantity++;
           $price += $c->price;
           $total_price += $c->price;
          @endphp 
         @endif
        @endforeach
        <td> {{$count}} </td>
        <td> {{$price}} </td>
     </td> 
     @endforeach  
    </tbody> 
    </table>

    <table class="table" id="totals_table">
        <thead>
            <tr>
              <th scope="col">Total Price</th>
              <th scope="col">Total Quantity</th>
              <th scope="col">Cash</th>
              <th scope="col">Change</th>
            </tr>
        </thead>
        <tbody> 
            <tr>
                <td> {{$total_price}} </td>
                <td> {{$total_quantity}} </td>
                <td> {{$payment->cash}} </td>
                <td> {{$payment->cash - $total_price}} </td>
            </tr>
        </tbody> 
    </table>

    <p> Issue Date: {{$payment->created_at}} </p>
    <p> Cashier: {{$user->name}} </p>
    <p> Customer: {{$customer->name}} </p>
    <p> Customer E-Mail: {{$customer->email}} </p>

@endsection