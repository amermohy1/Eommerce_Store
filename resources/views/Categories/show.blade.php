@extends('layouts.dashboard')
@section('title',$cateogry->name)
@section('breadcrumb')
@parent
<li class="breadcrumb-item active"> Categories  </li>
<li class="breadcrumb-item active"> {{$cateogry->name}} </li>

@endsection

@section('content')

    
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>image</th>
            <th>Name</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created At</th>

        </tr>
    </thead>
    <tbody>
        @php $i = 0;
          $products = $cateogry->products()->with('store')->latest()->paginate(3);
        @endphp
        @foreach($products as $product)
        @php $i++; @endphp

         <tr>
            <td>{{$i}} </td>
            <td><img src="{{ asset('storage/'. $cateogry->image) }}" alt="" height="50px"> </td>
            <td>{{$product->name}} </td>
            <td>{{$product->store->name}} </td>
            <td>{{$product->status}}</td>
            <td> {{$product->created_at}}</td>
           

         </tr>
        @endforeach
    </tbody>
</table>          

{{ $products->links() }}
@endsection