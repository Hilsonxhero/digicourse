<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="" class="is-active">ویرایش دسته بندی</a></li>
                <li><a href="" class="is-active"></a></li>
            </ul>
        </div>
    </x-slot>
    <div class="main-content padding-0 categories">
        <div class="row no-gutters">
            <div class="col-4 bg-white">
                <p class="box__title">ایجاد دسته بندی جدید</p>
                <form action="{{route('role-permissions.update',$role->id)}}" method="post" class="padding-30">
                    @csrf
                    @method('put')
                    <input type="text" name="name" placeholder="نام دسته بندی" class="text" value="{{$role->name}}">
                    @error('name')
                    <div class="error-alert-ui">
                        <span>{{$message}}</span>
                    </div>
                    @enderror

                    <p class="box__title margin-bottom-15">انتخاب مجوز ها</p>
                    @foreach($permissions as $permission)

                        <label class="ui-checkbox">
                            <input type="checkbox" name="permissions[{{$permission->name}}]" class="sub-checkbox"
                                   data-id="1"
                                   value="{{$permission->name}}"
                                   @if($role->hasPermissionTo($permission->name)) checked @endif
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
        </div>
    </div>


</x-panel-dashboard>

