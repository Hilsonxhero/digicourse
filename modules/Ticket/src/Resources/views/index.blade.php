<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="" class="is-active">تیکت ها</a></li>
            </ul>
        </div>
    </x-slot>

    <div class="main-content tickets">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="tickets.html">همه تیکت ها</a>
                <a class="tab__item " href="tickets.html">جدید ها (خوانده نشده)</a>
                <a class="tab__item " href="tickets.html">پاسخ داده شده ها</a>
                <a class="tab__item " href="{{route('tickets.create')}}">ارسال تیکت جدید</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="" onclick="event.preventDefault();">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی در تیکت ها">
                        <div class="t-header-search-content ">
                            <input type="text" class="text" placeholder="ایمیل">
                            <input type="text" class="text " placeholder="نام و نام خانوادگی">
                            <input type="text" class="text margin-bottom-20" placeholder="تاریخ">
                            <btutton class="btn btn-webamooz_net">جستجو</btutton>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>عنوان تیکت</th>
                    <th>نام ارسال کننده</th>
                    <th>ایمیل ارسال کننده</th>
                    <th>آخرین بروزرسانی</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $ticket)
                    <tr role="row">
                        <td><a href="">{{$loop->index+1}}</a></td>
                        <td><a href="{{route('tickets.show',$ticket->id)}}">{{$ticket->title}}</a></td>
                        <td><a href="">{{$ticket->user->name}}</a></td>
                        <td><a href="">{{$ticket->user->email}}</a></td>
                        <td>{{$ticket->created_at}}</td>
                        <td class="text-info">{!! $ticket->status() !!}</td>
                        <td>
                            <a href="#">
                                <form action="{{route('tickets.destroy',$ticket->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="icon-ui item-delete mlg-15" title="حذف"></button>
                                </form>
                            </a>
                            <a href="#">
                                <form action="{{route('tickets.reject',$ticket->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="icon-ui item-reject mlg-15" title="رد"></button>
                                </form>
                            </a>
                            <a href="{{route('tickets.show',$ticket->id)}}" target="_blank" class="item-eye mlg-15"
                               title="مشاهده"></a>
                            <a href="edit-comment.html" class="item-edit " title="ویرایش"></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-panel-dashboard>
