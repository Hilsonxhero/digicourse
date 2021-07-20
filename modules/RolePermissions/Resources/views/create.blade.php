<div class="col-4 bg-white">
    <p class="box__title">ایجاد نقش کاربری جدید</p>
    <form action="" method="post" class="padding-30">
        @csrf
        <input type="text" name="name" placeholder="عنوان" class="text">
        @error('name')
        <div class="error-alert-ui">
            <span>{{$message}}</span>
        </div>
        @enderror

        <p class="box__title margin-bottom-15">انتخاب مجوز ها</p>
        @foreach($permissions as $permission)

            <label class="ui-checkbox">
                <input type="checkbox" name="permissions[{{$permission->name}}]" class="sub-checkbox" data-id="1"
                       value="{{$permission->name}}"
                       @if(is_array(old('permissions')) && array_key_exists($permission->name,old('permissions'))) checked @endif
                >
                <span class="checkmark"></span>
                @lang($permission->name)
            </label>
        @endforeach


        @error('permissions')
        <div class="error-alert-ui">
            <span>{{$message}}</span>
        </div>
        @enderror
        <button class="btn btn-webamooz_net">اضافه کردن</button>
    </form>
</div>
