<x-app-layout>
    <x-slot name="title">صفحه مدرس | {{$tutor->name}}</x-slot>
    <x-header></x-header>

    <main id="index">
        <div class="bt-0-top article mr-202"></div>
        <div class="bt-1-top">
            <div class="container">
                <div class="tutor">
                    <div class="tutor-item">
                        <div class="tutor-avatar">
                            <span class="tutor-image" id="tutor-image"><img src="{{$tutor->image()}}"
                                                                            class="tutor-avatar-img"></span>
                            <div class="tutor-author-name">
                                <a id="tutor-author-name" href="" title="محمد نیکو">
                                    <h3 class="title"><span class="tutor-author--name">{{$tutor->name}}</span></h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tutor-item">
                        <div class="stat">
                            <span class="tutor-number tutor-count-courses">{{count($tutor->courses)}} </span>
                            <span class="">تعداد دوره ها</span>
                        </div>
                        <div class="stat">

                            <span class="tutor-number">{{$tutor->studentsCount()}} </span>
                            <span class="">تعداد  دانشجویان</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="box-filter">
                <div class="b-head">
                    <h2>دوره های {{$tutor->name}}</h2>
                </div>
                <div class="posts">
                    @foreach($tutor->courses as $courseItem)
                        <div class="col">
                            <a href="{{$courseItem->path()}}">
                                <div class="course-status">
                                    @lang($courseItem->status)
                                </div>
                                <div class="discountBadge">
                                    <p>45%</p>
                                    تخفیف
                                </div>
                                <div class="card-img"><img src="{{$courseItem->banner->thumb()}}" alt="reactjs"></div>
                                <div class="card-title"><h2>{{$courseItem->title}}</h2></div>
                                <div class="card-body">
                                    <img src="{{$courseItem->teacher->image()}}" alt="{{$courseItem->teacher->name}}">
                                    <span>{{$courseItem->teacher->name}}</span>
                                </div>
                                <div class="card-details">
                                    <div class="time">{{$courseItem->formattedDuration()}}</div>
                                    <div class="price">
                                        <div class="discountPrice">{{number_format($courseItem->price)}}</div>
                                        <div class="endPrice">{{number_format($courseItem->price)}}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>


            <div class="pagination">
                <a href="" class="pg-prev"></a>
                <a href="" class="page current">1</a>
                <a href="" class="page ">2</a>
                <a href="" class="page ">3</a>
                <a href="" class="page ">4</a>
                <a href="" class="page ">5</a>
                <a href="" class="page ">6</a>
                <a href="" class="page ">7</a>
                <a href="" class="page ">...</a>
                <a href="" class="page ">100</a>
                <a href="" class="pg-next"></a>
            </div>
        </div>
    </main>

    <x-footer></x-footer>
</x-app-layout>
