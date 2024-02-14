@extends('layout')

@section('title', 'Catalog')

@section('content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">Product ID</th>
        <th scope="col">Title</th>
        <th scope="col">Price</th>
        <th scope="col">Available Quantity</th>
        <th scope="col">Cart Quantity</th>

      </tr>
    </thead>
    <tbody>
      @foreach ($sales_line_items as $item)
      <tr>
        <th scope="row">{{$item->product_id}}</th>
        <td>{{$item->title}}</td>
        <td>{{$item->price}}</td>

        @php
        $count = 0;
        @endphp
        

        @foreach ($items as $i)
        @if($i->product_id == $item->product_id)

        @php
        $count++;
        @endphp

        @endif
        @endforeach

        <td> {{$count}} </td>
        <td> <input type='number' name='quantity_of_{{$item->id}}' min=0 max='{{$count}}'> </td>
        
        
      </tr>
      @endforeach
    </tbody>

</table>

<table class="table" id="totals_table">
  <thead>
      <th scope="col">Total Price</th>
      <th scope="col">Total Quantity</th>
  </thead>
  <tbody>
      <tr>
          <td id="total_price">0</td>
          <td id="total_quantity">0</td>
      </tr>
  </tbody>
</table>

<br>
<label for = 'customer_name'> Customer Name </label>
<input type='text' name='customer_name'> <br>
<label for = 'customer_email'> Customer Email </label>
<input type='text' name='customer_email'> <br>
<label for = 'cash'> Cash </label>
<input type='number' name='cash' min=0> <br>
<br>

<div>
<input type='submit' value='Add Quantity'>
<a href='/catalog/create_item'> <input type='submit' value='Create New Product'> </a>
<a href='/catalog/payment'> <input type='submit' value='Apply'> </a>
</div>

@endsection

