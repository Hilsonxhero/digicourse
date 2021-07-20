<select name="{{$name}}" class="custom-select-box-js" {{$attributes}}>

    {{$slot}}
</select>
<x-validation-error field="{{$name}}"></x-validation-error>
