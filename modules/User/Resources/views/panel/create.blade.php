<div class="col-4 bg-white">
    <p class="box__title">ایجاد کاربر جدید</p>
    <form action="{{route('users.store')}}" method="post" class="padding-30" enctype="multipart/form-data">
        @csrf
        <x-input type="text" name="name" placeholder="نام " class="text"></x-input>
        <x-input type="email" name="email" placeholder="ایمیل" class="text"></x-input>
        <x-input type="text" name="phone" placeholder="شماره موبایل" class="text"></x-input>
        <x-input type="password" name="password" placeholder="رمز عبور جدید" class="text"></x-input>
        <x-input type="password" name="password_confirmation" placeholder="رمز عبور جدید" class="text"></x-input>
        <p class="box__title margin-bottom-15">انتخاب نقش کاربری</p>
        @foreach($roles as $role)

            <label class="ui-checkbox">
                <input type="checkbox" name="roles[{{$role->name}}]" class="sub-checkbox" data-id="1"
                       value="{{$role->name}}"
                >
                <span class="checkmark"></span>
                @lang($role->name)
            </label>
        @endforeach

        <p class="box__title margin-bottom-15">وضعیت کاربر</p>
        <x-select name="status" class="custom-select-box-js">
            @foreach(\User\Models\User::$statuses as $status)
                <option value="{{$status}}">@lang($status)</option>
            @endforeach
        </x-select>
        <x-file name="thumb" placeholder="آپلود تصویر کاربر"></x-file>
        <button class="btn btn-webamooz_net">اضافه کردن</button>
    </form>
</div>
