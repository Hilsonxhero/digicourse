<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="{{route('courses.index')}}" class="is-active">دوره ها</a></li>
                <li><a href="" class="is-active">{{$course->title}}</a></li>
            </ul>
        </div>
    </x-slot>

    <div class="main-content padding-0 course__detial">
        <div class="row no-gutters  ">
            <div class="col-8 bg-white padding-30 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="margin-bottom-20 flex-wrap font-size-14 d-flex bg-white padding-0"
                     style="justify-content: space-between">
                    <p class="mlg-15">{{$course->title}}</p>
                    <a class="btn confirm-btn" href="{{route('lessons.create',$course->id)}}">آپلود جلسه جدید</a>
                </div>
                <div class="d-flex item-center flex-wrap margin-bottom-15 operations__btns">
                    <button class="btn all-confirm-btn" onclick="acceptAllLessons('{{route('lessons.acceptAll',$course->id) }}')">تایید همه جلسات</button>
                    <button class="btn confirm-btn" onclick="acceptMultiple('{{route('lessons.acceptMultiple',$course->id) }}')">تایید جلسات</button>
                    <button class="btn reject-btn" onclick="rejectMultiple('{{route('lessons.rejectMultiple',$course->id) }}')">رد جلسات</button>
                    <button class="btn delete-btn"
                            onclick="deleteMultiple('{{route('lessons.destroyMultiple',$course->id) }}')">حذف
                        جلسات
                    </button>

                </div>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th style="padding: 13px 30px;">
                                <label class="ui-checkbox">
                                    <input type="checkbox" class="checkedAll">
                                    <span class="checkmark"></span>
                                </label>
                            </th>
                            <th>شناسه</th>
                            <th>عنوان جلسه</th>
                            <th>عنوان فصل</th>
                            <th>مدت زمان جلسه</th>
                            <th>وضعیت تایید</th>
                            <th>سطح دسترسی</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lessons as $lesson)
                            <tr role="row" class="" data-row-id="{{$lesson->id}}">
                                <td>
                                    <label class="ui-checkbox">
                                        <input type="checkbox" class="sub-checkbox" data-id="{{$lesson->id}}">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td><a href="">{{$loop->index+1}}</a></td>
                                <td><a href="">{{$lesson->title}}</a></td>
                                <td>{{$lesson->season->title}}</td>
                                <td>{{$lesson->time}}دقیقه</td>
                                <td>{!! $lesson->confiramation_status() !!}</td>
                                <td>
                                    {{$lesson->free ? 'همه' : 'شرکت کنندگان'}}
                                </td>
                                <td>
                                    <span>
                                        <form action="{{route('lessons.destroy',$lesson->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="icon-ui item-delete mlg-15" title="حذف"></button>
                                        </form>
                                    </span>
                                    <span>
                                        <form action="{{route('lessons.accept',$lesson->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="icon-ui item-confirm mlg-15" title="حذف"></button>
                                        </form>
                                    </span>
                                    <span>
                                        <form action="{{route('lessons.reject',$lesson->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="icon-ui item-reject mlg-15" title="حذف"></button>
                                        </form>
                                    </span>
                                    <a href="" class="item-lock mlg-15" title="قفل "></a>
                                    <a href="{{route('lessons.edit',[$course->id,$lesson->id])}}" class="item-edit " title="ویرایش"></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4">
                @include('Course::seasons.index')
                <div class="col-12 bg-white margin-bottom-15 border-radius-3">
                    <p class="box__title">اضافه کردن دانشجو به دوره</p>
                    <form action="" method="post" class="padding-30">
                        <select name="" id="">
                            <option value="0">انتخاب کاربر</option>
                            <option value="1">mohammadniko3@gmail.com</option>
                            <option value="2">sayad@gamil.com</option>
                        </select>
                        <input type="text" placeholder="مبلغ دوره" class="text">
                        <p class="box__title">کارمزد مدرس ثبت شود ؟</p>
                        <div class="notificationGroup">
                            <input id="course-detial-field-1" name="course-detial-field" type="radio" checked/>
                            <label for="course-detial-field-1">بله</label>
                        </div>
                        <div class="notificationGroup">
                            <input id="course-detial-field-2" name="course-detial-field" type="radio"/>
                            <label for="course-detial-field-2">خیر</label>
                        </div>
                        <button class="btn btn-webamooz_net">اضافه کردن</button>
                    </form>
                    <div class="table__box padding-30">
                        <table class="table">
                            <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th class="p-r-90">شناسه</th>
                                <th>نام و نام خانوادگی</th>
                                <th>ایمیل</th>
                                <th>مبلغ (تومان)</th>
                                <th>درامد شما</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr role="row" class="">
                                <td><a href="">1</a></td>
                                <td><a href="">توفیق حمزه ای</a></td>
                                <td><a href="">Mohammadniko3@gmail.com</a></td>
                                <td><a href="">40000</a></td>
                                <td><a href="">20000</a></td>
                                <td>
                                    <a href="" class="item-delete mlg-15" title="حذف"></a>
                                    <a href="" class="item-edit " title="ویرایش"></a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-panel-dashboard>
