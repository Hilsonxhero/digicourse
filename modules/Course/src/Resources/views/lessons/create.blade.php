<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="{{route('courses.index')}}" class="is-active">دوره ها</a></li>
                <li><a href="{{route('courses.detail',$course->id)}}" class="is-active">{{$course->title}}</a></li>
                <li><a href="" class="is-active">ایجاد درس جدید</a></li>
            </ul>
        </div>
    </x-slot>
    <div class="main-content padding-0">
        <p class="box__title">ایجاد دوره جدید</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('lessons.store',$course->id)}}" method="post" class="padding-30" enctype="multipart/form-data">
                    @csrf
                    <x-input type="text" name="title" placeholder="عنوان درس"></x-input>
                    <x-input type="text" name="slug" class="text-left" placeholder="نام انگلیسی درس اختیاری"></x-input>
                    <x-input type="number" name="time" class="text-left" placeholder="مدت زمان جلسه"></x-input>
                    <x-input type="number" name="position" class="text-left" placeholder="ردیف"></x-input>
                    <x-select name="season_id">
                        @foreach($seasons as $season)
                            <option value="{{$season->id}}">{{$season->title}}</option>
                        @endforeach
                    </x-select>

                    <p class="box__title">ایا این درس رایگان است ؟ </p>
                    <div class="w-50">
                        <div class="notificationGroup">
                            <input id="lesson-upload-field-1" name="free" value="0" type="radio" checked/>
                            <label for="lesson-upload-field-1">خیر</label>
                        </div>
                        <div class="notificationGroup">
                            <input id="lesson-upload-field-2" name="free" value="1" type="radio"/>
                            <label for="lesson-upload-field-2">بله</label>
                        </div>
                    </div>
                    <x-file name="attachment" placeholder="آپلود درس"></x-file>

                    <x-textarea name="body" placeholder="توضیحات دوره" class="text h"></x-textarea>
                    <button class="btn btn-webamooz_net">آپلود درس</button>
                </form>
            </div>
        </div>
    </div>

</x-panel-dashboard>

