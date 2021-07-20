<x-panel-dashboard>

    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="" class="is-active">نقش های کاربری</a></li>
            </ul>
        </div>
    </x-slot>

    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">نقش های کاربری</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نقش کاربری</th>
                            <th>مجوز ها</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr role="row" class="">
                                <td><a href="">1</a></td>
                                <td><a href="">{{$role->name}}</a></td>
                                <td>
                                    <ul>
                                        @foreach($role->permissions as $permission)
                                            <li>@lang($permission->name)</li>
                                        @endforeach
                                    </ul>

                                </td>
                                <td>
                                    <span>
                                        <form action="{{route('role-permissions.destroy',$role->id)}}" method="post">
                                        @csrf
                                                             @method('delete')
                                        <button type="submit" class="item-delete mlg-15" title="حذف"></button>
                                        </form>
                                    </span>

                                    <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                    <a href="{{ route('role-permissions.edit',$role->id) }}"
                                       class="item-edit " title="ویرایش"></a>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            @include('RolePermissions::create')
        </div>
    </div>
</x-panel-dashboard>
