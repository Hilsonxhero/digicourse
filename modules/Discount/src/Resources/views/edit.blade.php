<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="" class="is-active">تخفیف ها</a></li>
                <li><a href="" class="is-active">ویرایش</a></li>
            </ul>
        </div>
    </x-slot>
    <div class="main-content padding-0 discounts">
        <div class="row no-gutters  ">

            <div class="col-4 bg-white">
                <p class="box__title">ایجاد تخفیف جدید</p>
                <form action="{{route('discounts.update',$discount->id)}}" method="post" class="padding-30">
                    @csrf
                    @method('put')
                    <x-input name="id" type="hidden" value="{{$discount->id}}"></x-input>
                    <x-input type="text" placeholder="کد تخفیف" name="code" class="text"
                             value="{{$discount->code}}"></x-input>

                    <x-input type="text" placeholder="درسد تخفیف" name="percent" class="text"
                             value="{{$discount->percent}}"></x-input>

                    <x-input type="text" placeholder="محدودیت افراد" name="usage_limitation" class="text"
                             value="{{$discount->usage_limitation}}"></x-input>


                    <x-input type="text" id="tarikh" placeholder="محدودیت زمانی به ساعت" name="expire_at"
                             class="text"
                             value="{{$discount->expire_at ? \Morilog\Jalali\Jalalian::fromCarbon($discount->expire_at)->toCarbon() : '' }}"></x-input>


                    <p class="box__title">این تخفیف برای</p>
                    <div class="notificationGroup">
                        <input id="discounts-field-1" class="discounts-field-pn" name="type" value="all" type="radio"
                               @if($discount->type == \Discount\Models\Discount::TYPE_ALL) checked @endif
                        />
                        <label for="discounts-field-1">همه دوره ها</label>
                    </div>
                    <div class="notificationGroup">
                        <input id="discounts-field-2" class="discounts-field-pn" name="type" value="special"
                               type="radio"
                               @if($discount->type == \Discount\Models\Discount::TYPE_SPECIAL) checked @endif/>
                        <label for="discounts-field-2">دوره خاص</label>
                    </div>

                    <div id="select-course-js"
                         class="select-course-js {{$discount->type == \Discount\Models\Discount::TYPE_ALL ? 'd-none' : ''}}">
                        <select name="courses[]" class="custom-select2-js" multiple>
                            <option value="">انتخاب دوره</option>
                            @foreach($courses as $course)
                                <option
                                    value="{{$course->id}}"
                                    @if($discount->courses->contains($course->id)) selected @endif>{{$course->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-input type="text" name="link" placeholder="لینک اطلاعات بیشتر" class="text"
                             value="{{$discount->link}}"></x-input>
                    <x-input type="text" name="description" placeholder="توضیحات"
                             class="text margin-bottom-15" value="{{$discount->description}}"></x-input>

                    <button class="btn btn-webamooz_net">اضافه کردن</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot name="style">
        <link rel="stylesheet"
              href="{{asset('panel/assets/vendor/persian-date/css/persian-datepicker-0.4.5.min.css')}}"/>

        <link rel="stylesheet"
              href="{{asset('panel/assets/vendor/select2/css/select2.min.css')}}"/>
    </x-slot>
    <x-slot name="script">
        <script src="{{asset('panel/assets/vendor/select2/js/select2.min.js')}}"></script>

        <script src="{{asset('panel/assets/vendor/persian-date/js/persian-date-0.1.8.min.js')}}"></script>
        <script src="{{asset('panel/assets/vendor/persian-date/js/persian-datepicker-0.4.5.min.js')}}"></script>
        <script>
            $('.custom-select2-js').select2();

            $(document).ready(function () {
                $('#tarikh').persianDatepicker({
                    altFormat: 'X',
                    format: 'YYYY/MM/DD HH:mm ',
                    initialValue: false,
                    timePicker: {
                        enabled: true
                    },
                });
            });
        </script>
    </x-slot>
</x-panel-dashboard>
{{--{{$discount->expire_at ?  \Morilog\Jalali\Jalalian::fromCarbon($discount->expire_at)->format('Y/m/d H:i')  : ''}}--}}
