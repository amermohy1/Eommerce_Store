@extends('layouts.dashboard')
@section('title','Categories')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories </li>
@endsection

@section('content')


<x-alert type="add"/>
<x-alert type="delete"/>
<x-alert type="updated"/>


<div class="mb-d">
<a class="btn btn-primary" href="{{route('categories.create')}}" role="button">Add Categories</a>
<a class="btn btn-primary" href="{{route('categories.trash')}}" role="button">Trash</a>

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
            <th>image</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Products</th>
            <th>Status</th>
            <th>Created At</th>
            <th></th>

        </tr>
    </thead>
    <tbody>
       @php $i = 0; @endphp
        @foreach($categories as $cateogry)
        @php $i++; @endphp

         <tr>
            <td>{{$i}} </td>
            <td><img src="{{ asset('storage/'. $cateogry->image) }}" alt="" height="50px"> </td>
            <td><a href="{{route('categories.show', $cateogry->id)}}">{{$cateogry->name}} </a></td>
            <td>{{$cateogry->parent->name }} </td>
            <td>{{$cateogry->products_number}}</td>
            <td>{{$cateogry->status}}</td>
            <td> {{$cateogry->created_at}}</td>
            <td>
            <a href="{{route('categories.edit',$cateogry->id)}}"  class="btn btn-outline-success">Edit</a>
            </td>
            <td>
            <form action="{{route('categories.destroy',$cateogry->id)}}" method="post">
                   @method('delete')
                @csrf
                          <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>
           </td>

         </tr>
        @endforeach
    </tbody>
</table>
{{$categories->withQueryString()->links()}}
@endsection