<x-panel-dashboard>

    <x-slot name="breadcrumb">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{route('dashboard.index')}}">پیشخوان</a></li>
                <li><a href="" class="is-active">دسته بندی ها</a></li>
            </ul>
        </div>
    </x-slot>

    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">دسته بندی ها</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نام دسته بندی</th>
                            <th>نام انگلیسی دسته بندی</th>
                            <th>دسته پدر</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr role="row" class="">
                                <td><a href="">1</a></td>
                                <td><a href="">{{$category->name}}</a></td>
                                <td>{{$category->slug}}</td>
                                <td>{{$category->getParentName()}}</td>
                                <td>
                                    <span>
                                        <form action="{{route('categories.destroy',['category' => $category->id])}}" method="post">
                                        @csrf
                                                             @method('delete')
                                        <button type="submit" class="item-delete mlg-15" title="حذف"></button>
                                        </form>
                                    </span>

                                    <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                    <a href="{{route('categories.edit',['category' => $category->id])}}"
                                       class="item-edit " title="ویرایش"></a>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            @include('Category::create')
        </div>
    </div>
</x-panel-dashboard>
