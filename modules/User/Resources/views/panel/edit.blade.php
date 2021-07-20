<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="" class="is-active">ویرایش کاربر</a></li>
                <li><a href="" class="is-active">{{$user->name}}</a></li>
            </ul>
        </div>
    </x-slot>
    <div class="main-content padding-0 categories">
        <div class="row no-gutters">
            <div class="col-4 bg-white">
                <p class="box__title">ویرایش کاربر</p>
                <form action="{{route('users.update',$user->id)}}" method="post" class="padding-30" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <x-input type="text" name="name" placeholder="نام " class="text" value="{{$user->name}}"></x-input>
                    <x-input type="email" name="email" placeholder="ایمیل" class="text" value="{{$user->email}}"></x-input>
                    <x-input type="text" name="phone" placeholder="شماره موبایل" class="text" value="{{$user->phone}}"></x-input>
                    <x-input type="password" name="password" placeholder="رمز عبور جدید" class="text" value=""></x-input>
                    <x-input type="password" name="password_confirmation" placeholder="رمز عبور جدید" class="text" value=""></x-input>
                    <p class="box__title margin-bottom-15">انتخاب نقش کاربری</p>
                    @foreach($roles as $role)

                        <label class="ui-checkbox">
                            <input type="checkbox" name="roles[{{$role->name}}]" class="sub-checkbox" data-id="1"
                                   value="{{$role->name}}"
                                   @if($user->hasRole($role->name)) checked @endif
                            >
                            <span class="checkmark"></span>
                            @lang($role->name)
                        </label>
                    @endforeach

                    <p class="box__title margin-bottom-15">وضعیت کاربر</p>
                    <x-select name="status" class="custom-select-box-js">
                        @foreach(\User\Models\User::$statuses as $status)
                            <option value="{{$status}}" @if($status == $user->status) selected @endif>@lang($status)</option>
                        @endforeach
                    </x-select>
                    <x-file name="thumb" placeholder="آپلود تصویر کاربر" :value="$user->thumb"></x-file>
                    <button class="btn btn-webamooz_net">ویرایش</button>
                </form>
            </div>
        </div>
    </div>


</x-panel-dashboard>

