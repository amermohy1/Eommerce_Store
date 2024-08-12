@extends('layouts.dashboard')
@section('title','Edit Profile')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active"> Edit Profile </li>

@endsection

@section('content')

    
                  
 <form action="{{route('dashboard.profile.update')}}" method="post"  enctype="multipart/form-data">
 @csrf
 @method('patch')
  
  <div class="form-row">
      <div class="col-md-6">
          <x-form.input name="first_name" lable="first_name" :value="$user->profile->first_name"/>
      </div>
      <div class="col-md-6">
      <x-form.input name="last_name" lable="last_name" :value="$user->profile->last_name"/>
      </div>
  </div>
  <div class="form-row">
      <div class="col-md-6">
          <x-form.input name="birthday" lable="birthday" type="date" :value="$user->profile->birthday"/>
      </div>
      <div class="col-md-6">
      <x-form.radio name="gender" lable="gender" :options="['male'=.'Male','female'=>'Female']" :checked="$user->profile->gender"/>
      </div>
  </div> 
  <div class="form-row">
      <div class="col-md-4">
      <x-form.radio name="street_address" lable="street address" :value="$user->profile->street_address" />
      </div>
      <div class="col-md-4">
      <x-form.input name="city" lable="city" :value="$user->profile->city" />
      </div>
      <div class="col-md-4">
      <x-form.input name="state" lable="state"  :value="$user->profile->state"/>
      </div>
  </div> 
  <!-- <div class="form-row">
      <div class="col-md-4">
      <x-form.radio name="postal_code" lable="postal code" :value="$user->profile->postal_code"/>
      </div>
      <div class="col-md-4">
      <x-form.select name="country" lable="country" :options="$countries" :selected="$user->profile->country" />
      </div>
      <div class="col-md-4">
      <x-form.select name="local" lable="local"  :options="$locales" :selected="$user->profile->locale"/>
      </div>
  </div>  -->
</form>

@endsection