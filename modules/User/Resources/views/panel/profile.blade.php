<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="" class="is-active">پروفایل کاربری</a></li>
            </ul>
        </div>
    </x-slot>
    <div class="main-content">
        <div class="user-info bg-white padding-30 font-size-13">
            <form action="{{route('dashboard.user.profile')}}" method="post" enctype="multipart/form-data">
                @csrf
                <x-user-photo></x-user-photo>
                <x-input type="hidden" name="id" placeholder="" value="{{auth()->user()->id}}"></x-input>
                <x-input type="text" name="name" class="text" placeholder="نام کاربری"
                         value="{{auth()->user()->name}}"></x-input>
                <x-input type="email" class="text-left" name="email" placeholder="ایمیل"
                         value="{{auth()->user()->email}}"></x-input>
                <x-input type="text" class="text-left" name="phone" placeholder="شماره موبایل"
                         value="{{auth()->user()->phone}}"></x-input>
                <x-input type="password" name="password" class="text text-left" placeholder="رمز عبور"></x-input>
                <x-input type="password" name="password_confirmation" class="text text-left" placeholder="تکرار رمز عبور"></x-input>
                <br>
                <br>
                <button type="submit" class="btn btn-webamooz_net">ذخیره تغییرات</button>
            </form>
        </div>

    </div>

</x-panel-dashboard>

