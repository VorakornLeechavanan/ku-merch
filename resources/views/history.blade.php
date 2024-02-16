@extends('layout')

@section('title', 'History')

@section('content')

<table class="table" id="totals_table">
<thead>
    <tr>
      <th scope="col">Issue Date</th>
      <th scope="col">Cashier</th>
      <th scope="col">Customer</th>
      <th scope="col"></th>
    </tr>
</thead>
<tbody>
 @foreach($payment as $p)
 <tr>
    <td>{{$p->created_at}}</td>
    @php
    $u = $user->filter(function ($user) use ($p) {
        return $user->id === $p->user_id;
    })->first();

    $c = $customer->filter(function ($customer) use ($p) {
        return $customer->id === $p->customer_id;
    })->first();
    @endphp
    <td>{{$u ? $u->name : ''}}</td>
    <td>{{$c ? $c->name : ''}}</td>
    <td> <a href='history/{{$p->id}}'><input type="submit" value="View" class="btn btn-primary my-3"> </a> </td>
 </tr> 
 @endforeach  
</tbody> 
</table>

@endsection