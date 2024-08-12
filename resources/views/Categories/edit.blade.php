@extends('layouts.dashboard')
@section('title','Edit Cateogry')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active"> Edit Cateogry </li>

@endsection

@section('content')

    
                  
 <form action="{{route('categories.update',$cateogry->id)}}" method="post"  enctype="multipart/form-data">
 @csrf
 @method('put')
  
  @include('Categories._form',[
    'button_lable' => 'Update'
    ])

</form>

@endsection