@extends('layouts.dashboard')
@section('title','Create Cateogry')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Create Cateogry</li>
@endsection

@section('content')

    
                  
 <form action="{{route('categories.store')}}" method="post"  enctype="multipart/form-data">
 @csrf

 @include('Categories._form')

</form>

@endsection