@props([
       ' name' , 'value' => ''
    ])

<textarea 
       name="{{$name}}"   
       value="{{old($name,$value)  }}" 
       {{$attributes ->class([
              'form-control',
              'is-invalid' => $errors->has($name)
        ])}} 
>
{{old($name,$value)}}
</textarea>
  @error('name')
  <div class="text-danger">
   {{$message}}
  </div>
  @enderror