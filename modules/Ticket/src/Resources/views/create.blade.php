<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="" class="is-active">ثبت تیکت ها</a></li>
            </ul>
        </div>
    </x-slot>

    <div class="main-content padding-0">
        <p class="box__title">ایجاد تیکت جدید</p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('tickets.store')}}" method="post" class="padding-30" enctype="multipart/form-data">
                    @csrf
                    <x-input type="text" name="title" class="text" placeholder="عنوان تیکت"></x-input>
                    <x-textarea name="body" placeholder="متن تیکت" class="text"></x-textarea>

                    <x-file name="attachment" placeholder="فایل"></x-file>
                    <button class="btn btn-webamooz_net">ایجاد مقاله</button>
                </form>
            </div>
        </div>
    </div>

</x-panel-dashboard>
