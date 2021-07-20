<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="{{route('courses.index')}}" class="is-active">دوره ها</a></li>
                <li><a href="{{route('courses.detail',$course->id)}}" class="is-active">{{$course->title}}</a></li>
                <li><a href="{{route('courses.detail',$course->id)}}" class="is-active">جلسه ها</a></li>
                <li><a href="" class="is-active">ویرایش جلسه </a></li>
            </ul>
        </div>
    </x-slot>
    <div class="main-content padding-0">
        <p class="box__title">ویرایش جلسه </p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('lessons.update',[$course->id,$lesson->id])}}" method="post" class="padding-30"
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <x-input type="text" name="title" placeholder="عنوان درس" value="{{$lesson->title}}"></x-input>
                    <x-input type="text" name="slug" class="text-left" placeholder="نام انگلیسی درس اختیاری"
                             value="{{$lesson->slug}}"></x-input>
                    <x-input type="number" name="time" class="text-left" placeholder="مدت زمان جلسه" value="{{$lesson->time}}"></x-input>
                    <x-input type="number" name="position" class="text-left" placeholder="ردیف" value="{{$lesson->position}}"></x-input>
                    <x-select name="season_id">
                        <option value="">انتخاب سرفصل</option>
                        @foreach($seasons as $season)
                            <option value="{{$season->id}}" @if($season->id == $lesson->season_id) selected @endif>{{$season->title}}</option>
                        @endforeach
                    </x-select>

                    <p class="box__title">ایا این درس رایگان است ؟ </p>
                    <div class="w-50">
                        <div class="notificationGroup">
                            <input id="lesson-upload-field-1" name="free" value="0" type="radio" @if(!$lesson->free) checked @endif/>
                            <label for="lesson-upload-field-1">خیر</label>
                        </div>
                        <div class="notificationGroup">
                            <input id="lesson-upload-field-2" name="free" value="1" type="radio" @if($lesson->free) checked @endif/>
                            <label for="lesson-upload-field-2">بله</label>
                        </div>
                    </div>
                    <x-file name="attachment" placeholder="آپلود درس" :value="$lesson->media"></x-file>

                    <x-textarea name="body" placeholder="توضیحات دوره" class="text h" value="{{$lesson->body}}"></x-textarea>
                    <button class="btn btn-webamooz_net">ویرایش جلسه</button>
                </form>
            </div>
        </div>
    </div>

</x-panel-dashboard>

