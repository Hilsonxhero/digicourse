<div class="col-4 bg-white">
    <p class="box__title">ایجاد دسته بندی جدید</p>
    <form action="{{route('categories.store')}}" method="post" class="padding-30">
        @csrf
        <input type="text" name="name" placeholder="نام دسته بندی" class="text">
        @error('name')
        <div class="error-alert-ui">
            <span>{{$message}}</span>
        </div>
        @enderror
        <input type="text" name="slug" placeholder="نام انگلیسی دسته بندی" class="text">
        @error('slug')
        <div class="error-alert-ui">
            <span>{{$message}}</span>
        </div>
        @enderror
        <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
        <select name="parent_id" class="custom-select-box-js">
            <option value="">ندارد</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
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
