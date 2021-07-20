<div class="col-12 bg-white margin-bottom-15 border-radius-3">
    <p class="box__title">سرفصل ها</p>
    <form action="{{route('seasons.store',$course->id)}}" method="post" class="padding-30">
        @csrf
        <x-input type="text" name="title" placeholder="عنوان سرفصل" class="text"></x-input>
        <x-input type="text" name="position" placeholder="شماره سرفصل" class="text"></x-input>
        <button type="submit" class="btn btn-webamooz_net">اضافه کردن</button>
    </form>
    <div class="table__box padding-30">
        <table class="table">
            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th class="p-r-90">شناسه</th>
                <th>عنوان فصل</th>
                <th>وضعیت تایید</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($course->seasons as $season)
                <tr role="row" class="">
                    <td><a href="">{{$loop->index +1}}</a></td>
                    <td><a href="">{{$season->title}}</a></td>
                    <td><a href="">{!! $season->confiramation_status() !!}</a></td>
                    <td>
                                 <span>
                                <form action="{{route('seasons.destroy',$season->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="item-delete mlg-15" title="حذف"></button>
                                </form>
                            </span>
                        <a href="{{route('seasons.reject',$season->id)}}" class="item-reject mlg-15" title="رد"></a>
                        <a href="{{route('seasons.accept',$season->id)}}" class="item-confirm mlg-15" title="تایید"></a>
                        <a href="{{route('seasons.edit',$season->id)}}" class="item-edit " title="ویرایش"></a>
                    </td>
                </tr>
            @endforeach


            </tbody>
        </table>
    </div>
</div>
