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

    <div class="main-content padding-0">
        <p class="box__title">ایجاد دوره جدید</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('courses.update',$course->id)}}" method="post" class="padding-30"
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <x-input type="hidden" name="id" placeholder="" value="{{$course->id}}"></x-input>
                    <x-input type="text" name="title" placeholder="عنوان دوره" value="{{$course->title}}"></x-input>

                    <x-input type="text" name="slug" class="text-left" placeholder="نام انگلیسی دوره"
                             value="{{$course->slug}}"></x-input>

                    <div class="d-flex multi-text">
                        <div>
                            <x-input type="text" name="position" class="text-left mlg-15"
                                     placeholder="ردیف دوره" value="{{$course->position}}"></x-input>
                        </div>
                        <div>
                            <x-input type="text" name="price" placeholder="مبلغ دوره"
                                     class="text-left mlg-15" value="{{$course->price}}"></x-input>
                        </div>
                        <div>
                            <x-input type="text" name="percent" placeholder="درصد مدرس" value="{{$course->percent}}"
                                     class="text-left"></x-input>
                        </div>
                    </div>
                    <x-select name="teacher_id" class="custom-select-box-js">
                        <option value="">انتخاب مدرس دوره</option>
                        @foreach($teachers as $teacher)
                            <option value="{{$teacher->id}}"
                                    @if($teacher->id == $course->teacher_id) selected @endif>{{$teacher->name}}</option>
                        @endforeach
                    </x-select>


                    <x-tag-select name="tags[]"></x-tag-select>


                    <x-select name="type" class="custom-select-box-js">
                        <option value="0">نوع دوره</option>
                        @foreach(\Course\Models\Course::$types as $type)
                            <option value="{{$type}}" @if($type == $course->type) selected @endif>@lang($type)</option>
                        @endforeach

                    </x-select>


                    <x-select name="status" class="custom-select-box-js">
                        <option value="">وضعیت دوره</option>
                        @foreach(\Course\Models\Course::$statuses as $status)
                            <option value="{{$status}}"
                                    @if($status == $course->status) selected @endif>@lang($status)</option>
                        @endforeach
                    </x-select>


                    <x-select name="category_id" class="custom-select-box-js">
                        <option value="0">دسته بندی</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                    @if($category->id == $course->category_id) selected @endif>{{$category->name}}</option>
                        @endforeach
                    </x-select>


                    <x-file name="banner" placeholder="آپلود بنر دوره" :value="$course->banner"></x-file>

                    <x-textarea placeholder="توضیحات دوره" name="body" class="text h"
                                value="{{$course->body }}"></x-textarea>

                    <button class="btn btn-webamooz_net">ایجاد دوره</button>
                </form>
            </div>
        </div>
    </div>

</x-panel-dashboard>

