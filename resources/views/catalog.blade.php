@extends('layout')

@section('title', 'Catalog')

@section('content')
<form method="POST" action='/apply'>
  @csrf
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
        <td> <input type='number' name='{{$item->product_id}}' min=0 max='{{$count}}'> </td>
        
        
      </tr>
      @endforeach
    </tbody>

</table>

<br>
<label for = 'customer_name'> Customer Name </label>
<input type='text' name='customer_name' required> <br>
<label for = 'customer_email'> Customer Email </label>
<input type='text' name='customer_email' required> <br>
<label for = 'cash' required> Cash </label>
<input type='number' name='cash' min=1 required> <br>
<br>

<br> <input type='submit' value='Apply'> <br>
</form>
<br>
<a href='/catalog/add'> <input type='submit' value='Add Quantity'> </a>
<a href='/catalog/remove'> <input type='submit' value='Remove Quantity'> </a>
 <a href='/catalog/create_item'> <input type='submit' value='Create New Product'> </a> 
 <a href='/catalog/delete'> <input type='submit' value='Delete Product'> </a>
 <br>
@endsection

