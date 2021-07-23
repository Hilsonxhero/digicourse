<input type="{{$type}}" name="{{$name}}" placeholder="{{$placeholder}}"
    {{ $attributes->merge(['class' => 'text']) }} >
<x-validation-error field='{{str_replace("]","",str_replace("[",".",$name)) }}'></x-validation-error>
