@props([
      'name' , 'options' , 'checked' => false
    ])

@foreach($options as $value => $text)

<div class="form-check form-switch">
  <input  type="radio" name="{{$name}}" role="switch"  :value="$value" 
   @checked(old($name, $checked)  == 'active')
   {{$attributes->class([
              'form-check-input',
              'is-invalid' => $errors->has($name)
        ]) }}
   >
  <label class="form-check-label">{{$text}}</label>
</div>

@endforeach