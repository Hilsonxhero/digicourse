<x-panel-dashboard>

    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="" class="is-active">کاربران</a></li>
            </ul>
        </div>
    </x-slot>

    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">کاربران</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>تاریخ عضویت</th>
                            <th>آی پی</th>
                            <th>وضعیت حساب کاربر</th>
                            <th>نقش های کاربری</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr role="row" class="">
                                <td>{{$loop->index +1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->getCreateAtInJalali()}}</td>
                                <td>{{$user->ip}}</td>
                                <td>{!! $user->isVerify() !!}</td>
                                <td>
                                    <ul>
                                        @foreach($user->roles as $UserRole)
                                            <li>@lang($UserRole->name)</li>
                                        @endforeach
                                    </ul>

                                </td>
                                <td>
                                    <span>
                                        <form action="{{route('users.verify.email',$user->id)}}"
                                              method="post">
                                        @csrf
                                        <button type="submit" class="item-confirm mlg-15"></button>
                                        </form>
                                    </span>

                                    <span>
                                        <form action="{{route('users.destroy',$user->id)}}"
                                              method="post">
                                        @csrf
                                            @method('delete')
                                        <button type="submit" class="item-delete mlg-15" title="حذف"></button>
                                        </form>
                                    </span>

                                    <a href="{{route('users.edit',['user' => $user->id])}}"
                                       class="item-edit " title="ویرایش"></a>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            @include('User::panel.create')
        </div>
    </div>
    <x-slot name="script">

    </x-slot>

</x-panel-dashboard>
