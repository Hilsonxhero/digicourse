<x-panel-dashboard>
    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="{{route('courses.index')}}" class="is-active">دوره ها</a></li>
                <li><a href="{{route('courses.detail',$season->course_id)}}" class="is-active">سرفصل ها</a></li>
                <li><a href="" class="is-active">{{$season->title}}</a></li>
            </ul>
        </div>
    </x-slot>

    <div class="main-content padding-0">
        <p class="box__title">ویرایش سرفصل </p>
        <div class="row no-gutters bg-white">
            <div class="col-12">
                <form action="{{route('seasons.update',$season->id)}}" method="post" class="padding-30"
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <x-input type="text" name="title" placeholder="عنوان سرفصل" class="text" value="{{$season->title}}"></x-input>
                    <x-input type="text" name="position" placeholder="شماره سرفصل" class="text" value="{{$season->position}}" ></x-input>

                    <button class="btn btn-webamooz_net">ویرایش</button>
                </form>
            </div>
        </div>
    </div>

</x-panel-dashboard>

