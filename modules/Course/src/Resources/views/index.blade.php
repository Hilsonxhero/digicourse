<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="" class="is-active">دوره ها</a></li>
            </ul>
        </div>
    </x-slot>

    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="courses.html">لیست دوره ها</a>
                <a class="tab__item" href="approved.html">دوره های تایید شده</a>
                <a class="tab__item" href="new-course.html">دوره های تایید نشده</a>
                <a class="tab__item" href="{{route('courses.create')}}">ایجاد دوره جدید</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="" onclick="event.preventDefault();">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی دوره">
                        <div class="t-header-search-content ">
                            <input type="text" class="text" placeholder="نام دوره">
                            <input type="text" class="text" placeholder="ردیف">
                            <input type="text" class="text" placeholder="قیمت">
                            <input type="text" class="text" placeholder="نام مدرس">
                            <input type="text" class="text margin-bottom-20" placeholder="دسته بندی">
                            <btutton class="btn btn-webamooz_net">جستجو</btutton>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table__box">
            <table class="table">

                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>ردیف</th>
                    <th>تصویر</th>
                    <th>عنوان</th>
                    <th>مدرس دوره</th>
                    <th>قیمت (تومان)</th>
                    <th>جزئیات</th>
                    <th>تراکنش ها</th>
                    <th>نظرات ( 0 )</th>
                    <th>تعداد دانشجویان</th>
                    <th>وضعیت تایید</th>
                    <th>درصد مدرس</th>
                    <th>وضعیت دوره</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr role="row">
                        <td><a href="">1</a></td>
                        <td><a href="">1</a></td>
                        <td><img width="150" src="{{$course->banner->thumb()}}" alt=""></td>
                        <td><a href="">{{$course->title}}</a></td>
                        <td><a href="">{{$course->getTeacherName->name}}</a></td>
                        <td>{{number_format($course->price)}}</td>
                        <td><a href="{{route('courses.detail',$course->id)}}" class="color-2b4a83">مشاهده</a></td>
                        <td><a href="course-transaction.html" class="color-2b4a83">مشاهده</a></td>
                        <td><a href="" class="color-2b4a83">مشاهده</a></td>
                        <td>120</td>
                        <td>@lang($course->confirmation_status)</td>
                        <td>{{$course->percent}}%</td>
                        <td>@lang($course->status)</td>
                        <td>
                            <span>
                                <form action="{{route('courses.destroy',$course->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="item-delete mlg-15" title="حذف"></button>
                                </form>
                            </span>
                            <a href="{{route('courses.reject',$course->id)}}" class="item-reject mlg-15" title="رد"></a>
                            <a href="{{route('courses.lock',$course->id)}}" class="item-lock mlg-15" title="قفل دوره"></a>
                            <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                            <a href="{{route('courses.accept',$course->id)}}" class="item-confirm mlg-15"
                               title="تایید"></a>
                            <a href="{{route('courses.edit',$course->id)}}" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

</x-panel-dashboard>

