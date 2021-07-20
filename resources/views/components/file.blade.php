<div class="file-upload">
    <div class="i-file-upload">
        <span>{{$placeholder}}</span>
        <input type="file" class="file-upload" id="files" name="{{$name}}"/>
    </div>
    <span class="filesize"></span>

    @if(isset($value))
        <img style="display: block" width="200" src="{{$value->thumb()}}">

    @else
        <span class="selectedFiles">فایلی انتخاب نشده است</span>
    @endif

    <x-validation-error field="{{$name}}"></x-validation-error>
</div>
