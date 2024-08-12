
@if ($errors->any())
    <div class="alert alert-danger">
    <h1> Error</h1>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="exampleInputEmail1" class="form-label">Cateogry Name</label>
    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"   value="{{old('name',$cateogry->name)  }}" id="exampleInputEmail1" >
  @error('name')
  <div class="text-danger">
   {{$message}}
 </div>
  @enderror
</div>
  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label">Cateogry Parent</label>
    <select class="form-control form-select" aria-label="Small select example" name="parent_id">
  <option value="">Cateogry</option>
  @foreach($parents as $parent)
  <option value="{{$parent->id}}" @selected(old('parent_id', $cateogry->parent_id) == $parent->id)>{{$parent->name}}</option>
  @endforeach
</select>
 </div>
 <div class="form-group">
    <label for="exampleInputEmail1" class="form-label">Description</label>
    <textarea class="form-control" name="description" id="" cols="5" rows="3">{{old('description',$cateogry->description)}}</textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label">Image</label>
    <input type="file" name="image" id=""class="form-control" accept="image/*"><br>
    @if($cateogry->image)
    <img src="{{ asset('storage/'. $cateogry->image) }}" alt="" height="60px"> 

    @endif
</div>
<div class="form-group">
    <label for="" class="form-label">Status</label>
    <div class="form-check form-switch">
  <input class="form-check-input" type="radio" name="status" role="switch"  value="active"  @checked(old('status', $cateogry->status) == 'active')>
  <label class="form-check-label">Active</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="radio" name="status"  value="archived"  @checked(old('status', $cateogry->status) == 'archived')>
  <label class="form-check-label" >Archived</label>
</div>
</div>
<div class="form-group">
<button type="submit" class="btn btn-primary form-control" >{{$button_lable ?? 'Save'}}</button>
</div>