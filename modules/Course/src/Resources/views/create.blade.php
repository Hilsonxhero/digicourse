<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="" class="is-active">دوره ها</a></li>
            </ul>
        </div>
    </x-slot>

    <div class="main-content padding-0">
        <p class="box__title">ایجاد دوره جدید</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('courses.store')}}" method="post" class="padding-30"
                      enctype="multipart/form-data">
                    @csrf
                    <x-input type="text" name="title" placeholder="عنوان دوره" value="{{old('title')}}"></x-input>

                    <x-input type="text" name="slug" class="text-left" placeholder="نام انگلیسی دوره"
                             value="{{old('slug')}}"></x-input>

                    <div class="d-flex multi-text">
                        <div>
                            <x-input type="text" name="position" class="text-left mlg-15"
                                     placeholder="ردیف دوره" value="{{old('position')}}"></x-input>
                        </div>
                        <div>
                            <x-input type="text" name="price" placeholder="مبلغ دوره"
                                     class="text-left mlg-15" value="{{old('price')}}"></x-input>
                        </div>
                        <div>
                            <x-input type="text" name="percent" placeholder="درصد مدرس" class="text-left"
                                     value="{{old('percent')}}"></x-input>
                        </div>
                    </div>
                    <x-select name="teacher_id" class="custom-select-box-js">
                        <option value="">انتخاب مدرس دوره</option>
                        @foreach($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                        @endforeach
                    </x-select>


                    <x-tag-select name="tags[]"></x-tag-select>


                    <x-select name="type" class="custom-select-box-js">
                        <option value="0">نوع دوره</option>
                        @foreach(\Course\Models\Course::$types as $type)
                            <option value="{{$type}}">@lang($type)</option>
                        @endforeach

                    </x-select>


                    <x-select name="status" class="custom-select-box-js">
                        <option value="">وضعیت دوره</option>
                        @foreach(\Course\Models\Course::$statuses as $status)
                            <option value="{{$status}}">@lang($status)</option>
                        @endforeach
                    </x-select>


                    <x-select name="category_id" class="custom-select-box-js">
                        <option value="0">دسته بندی</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </x-select>


                    <x-file name="banner" placeholder="آپلود بنر دوره"></x-file>

                    <x-textarea placeholder="توضیحات دوره" name="body" class="text h" value="{{old('body')}}"></x-textarea>

                    <button class="btn btn-webamooz_net">ایجاد دوره</button>
                </form>
            </div>
        </div>
    </div>

</x-panel-dashboard>

