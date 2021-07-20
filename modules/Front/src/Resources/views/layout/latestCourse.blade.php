<article class="container blog">
    <div class="box-filter">
        <div class="b-head">
            <h2>جدید ترین دوره ها</h2>
            <a href="all-courses.html">مشاهده همه</a>
        </div>
        <div class="posts">
            @foreach($latestCourses as $latestCourse)

                <div class="col">
                    <a href="{{route('course.page.show',$latestCourse->slug)}}">
                        <div class="course-status">
                           @lang($latestCourse->status)
                        </div>
                        <div class="discountBadge">
                            <p>45%</p>
                            تخفیف
                        </div>
                        <div class="card-img"><img src="{{$latestCourse->banner->thumb()}}" alt="reactjs"></div>
                        <div class="card-title"><h2>{{$latestCourse->title}}</h2></div>
                        <div class="card-body">
                            <img src="{{asset('home/assets/img/profile.jpg')}}" alt="{{$latestCourse->getTeacherName->name}}">
                            <span>{{$latestCourse->getTeacherName->name}}</span>
                        </div>
                        <div class="card-details">
                            <div class="time">{{$latestCourse->formattedDuration()}}</div>
                            <div class="price">
                                <div class="discountPrice">{{number_format($latestCourse->price)}}</div>
                                <div class="endPrice">{{number_format($latestCourse->price)}}</div>
                            </div>
                        </div>
                    </a>
                </div>

            @endforeach


        </div>
    </div>
</article>
