<div class="col-4 bg-white">
    <p class="box__title">ایجاد تخفیف جدید</p>
    <form action="{{route('discounts.store')}}" method="post" class="padding-30">
        @csrf
        <x-input type="text" placeholder="کد تخفیف" name="code" class="text"></x-input>
        <x-input type="text" placeholder="درسد تخفیف" name="percent" class="text"></x-input>
        <x-input type="text" placeholder="محدودیت افراد" name="usage_limitation" class="text"></x-input>
        <x-input type="text" id="tarikh" placeholder="محدودیت زمانی به ساعت" name="expire_at" class="text"></x-input>
        <p class="box__title">این تخفیف برای</p>
        <div class="notificationGroup">
            <input id="discounts-field-1" class="discounts-field-pn" name="type" value="all" type="radio"/>
            <label for="discounts-field-1">همه دوره ها</label>
        </div>
        <div class="notificationGroup">
            <input id="discounts-field-2" class="discounts-field-pn" name="type" value="special"
                   type="radio"/>
            <label for="discounts-field-2">دوره خاص</label>
        </div>

        <div id="select-course-js" class="d-none select-course-js">
            <select name="courses[]" class="custom-select2-js" multiple>
                <option value="">انتخاب دوره</option>
                @foreach($courses as $course)
                    <option value="{{$course->id}}">{{$course->title}}</option>
                @endforeach
            </select>
        </div>
        <x-input type="text" name="link" placeholder="لینک اطلاعات بیشتر" class="text"></x-input>
        <x-input type="text" name="description" placeholder="توضیحات" class="text margin-bottom-15"></x-input>

        <button class="btn btn-webamooz_net">اضافه کردن</button>
    </form>
</div>
