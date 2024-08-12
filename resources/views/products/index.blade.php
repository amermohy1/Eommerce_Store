@extends('layouts.dashboard')
@section('title','Products')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Products </li>
@endsection

@section('content')


<x-alert type="add"/>
<x-alert type="delete"/>
<x-alert type="updated"/>


<div class="mb-d">
<a class="btn btn-primary" href="{{route('products.create')}}" role="button">Add Products</a>

</div><br>
<form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
    <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')"/>
    <select name="status" id="" class="form-control mx-2">
        <option value="">All</option>
        <option value="active" @selected(request('status') == 'active')>Active</option>
        <option value="archived" @selected(request('status') == 'archived')>Archived</option>
    </select>
    <button type="submit" class="btn btn-primary">Searsh</button>
</form>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Category</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created At</th>
            <th colspan="2">pro</th>

        </tr>
    </thead>
    <tbody>
       @php $i = 0; @endphp
        @foreach($products as $product)
        @php $i++; @endphp

         <tr>
            <td>{{$i}} </td>
            <td>{{$product->name}} </td>
            <td>{{$product->category->name}} </td>
            <td>{{$product->store->name}} </td>
            <td>{{$product->status}}</td>
            <td> {{$product->created_at}}</td>
            <td>
            <a href="{{route('products.edit',$product->id)}}"  class="btn btn-outline-success">Edit</a>
            </td>
            <td>
            <form action="{{route('products.destroy',$product->id)}}" method="post">
                   @method('delete')
                @csrf
                          <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>
           </td>

         </tr>
        @endforeach
    </tbody>
</table>
{{$products->withQueryString()->links()}}
@endsection