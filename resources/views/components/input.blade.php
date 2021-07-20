<input type="{{$type}}" name="{{$name}}" placeholder="{{$placeholder}}"
       {{ $attributes->merge(['class' => 'text']) }} >
<x-validation-error field="{{$name}}"></x-validation-error>
