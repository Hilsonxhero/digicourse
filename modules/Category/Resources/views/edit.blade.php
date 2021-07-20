
<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="" class="is-active">ویرایش دسته بندی</a></li>
                <li><a href="" class="is-active">{{$category->name}}</a></li>
            </ul>
        </div>
    </x-slot>
    <div class="main-content padding-0 categories">
        <div class="row no-gutters">
            <div class="col-4 bg-white">
                <p class="box__title">ایجاد دسته بندی جدید</p>
                <form action="{{route('categories.update',['category' => $category->id])}}" method="post" class="padding-30">
                    @csrf
                    @method('put')
                    <input type="text" name="name" placeholder="نام دسته بندی" class="text" value="{{$category->name}}">
                    @error('name')
                    <div class="error-alert-ui">
                        <span>{{$message}}</span>
                    </div>
                    @enderror
                    <input type="text" name="slug" placeholder="نام انگلیسی دسته بندی" class="text" value="{{$category->slug}}">
                    @error('slug')
                    <div class="error-alert-ui">
                        <span>{{$message}}</span>
                    </div>
                    @enderror
                    <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
                    <select name="parent_id" id="custom-select-box-js">
                        <option value="">ندارد</option>
                        @foreach($categories as $item)
                            <option value="{{$item->id}}" @if($item->id == $category->parent_id) selected @endif>{{$item->name}}</option>
                        @endforeach
                    </select>

                    @error('parent_id')
                    <div class="error-alert-ui">
                        <span>{{$message}}</span>
                    </div>
                    @enderror
                    <button class="btn btn-webamooz_net">اضافه کردن</button>
                </form>
            </div>
        </div>
    </div>


</x-panel-dashboard>

