<x-app-layout>
    <x-slot name="title">دوره {{$course->title}}</x-slot>
    <x-header></x-header>

    <main id="single">
        <div class="content">

            <div class="container">
                <article class="article">
                    <div class="ads mb-10">
                        <a href="" rel="nofollow noopener"><img src="{{$course->banner->thumb()}}}" alt=""></a>
                    </div>
                    <div class="h-t">
                        <h1 class="title">
                            {{$course->title}}
                        </h1>
                        <div class="breadcrumb">
                            <ul>
                                <li><a href="" title="خانه">خانه</a></li>
                                @if($course->category->parent)
                                    <li><a href="" title="برنامه نویسی">{{$course->category->parent->name}}</a></li>
                                @endif

                                <li><a href="" title="وب">{{$course->category->name}}</a></li>
                            </ul>
                        </div>
                    </div>

                </article>
            </div>


            <div class="main-row container">
                <div class="sidebar-right">
                    <div class="sidebar-sticky">
                        <div class="product-info-box">


                            @auth
                                @if(auth()->user()->id == $course->teacher_id)
                                    <p class="mycourse">شما مدرس این دوره هستید</p>
                                @elseif(auth()->user()->can('download',$course))
                                    <p class="mycourse">شما این دوره رو خریداری کرده اید</p>
                                @else
                                    <div class="discountBadge">
                                        <p>45%</p>
                                        تخفیف
                                    </div>
                                    <div class="sell_course">
                                        <strong>قیمت :</strong>
                                        <del class="discount-Price">{{number_format($course->price)}}</del>
                                        <p class="price">
                        <span class="woocommerce-Price-amount amount">{{number_format($course->price)}}
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                                        </p>
                                    </div>
                                    <button class="btn buy btn-buy">خرید دوره</button>


                                @endif

                            @else
                                <div class="discountBadge">
                                    <p>45%</p>
                                    تخفیف
                                </div>
                                <div class="sell_course">
                                    <strong>قیمت :</strong>
                                    <del class="discount-Price">{{number_format($course->price)}}</del>
                                    <p class="price">
                        <span class="woocommerce-Price-amount amount">{{number_format($course->price)}}
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                                    </p>
                                </div>
                                <button class="btn buy">خرید دوره</button>
                            @endauth

                            <div class="average-rating-sidebar">
                                <div class="rating-stars">
                                    <div class="slider-rating">
                                        <span class="slider-rating-span slider-rating-span-100" data-value="100%"
                                              data-title="خیلی خوب"></span>
                                        <span class="slider-rating-span slider-rating-span-80" data-value="80%"
                                              data-title="خوب"></span>
                                        <span class="slider-rating-span slider-rating-span-60" data-value="60%"
                                              data-title="معمولی"></span>
                                        <span class="slider-rating-span slider-rating-span-40" data-value="40%"
                                              data-title="بد"></span>
                                        <span class="slider-rating-span slider-rating-span-20" data-value="20%"
                                              data-title="خیلی بد"></span>
                                        <div class="star-fill"></div>
                                    </div>
                                </div>

                                <div class="average-rating-number">
                                    <span class="title-rate title-rate1">امتیاز</span>
                                    <div class="schema-stars">
                                        <span class="value-rate text-message"> 4 </span>
                                        <span class="title-rate">از</span>
                                        <span class="value-rate"> 555 </span>
                                        <span class="title-rate">رأی</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-info-box">
                            <div class="product-meta-info-list">
                                <div class="total_sales">
                                    تعداد دانشجو : <span>{{count($course->students)}}</span>
                                </div>
                                <div class="meta-info-unit one">
                                    <span class="title">تعداد جلسات منتشر شده :  </span>
                                    <span class="vlaue">{{$course->lessonsCount()}}</span>
                                </div>
                                <div class="meta-info-unit two">
                                    <span class="title">مدت زمان دوره تا الان : </span>
                                    <span class="vlaue">{{$course->formattedDuration()}}</span>
                                </div>
                                <div class="meta-info-unit three">
                                    <span class="title">مدت زمان کل دوره : </span>
                                    <span class="vlaue">-</span>
                                </div>
                                <div class="meta-info-unit four">
                                    <span class="title">مدرس دوره : </span>
                                    <span class="vlaue">{{$course->getTeacherName->name}}</span>
                                </div>
                                <div class="meta-info-unit five">
                                    <span class="title">وضعیت دوره : </span>
                                    <span class="vlaue">@lang($course->status)</span>
                                </div>
                                <div class="meta-info-unit six">
                                    <span class="title">پشتیبانی : </span>
                                    <span class="vlaue">دارد</span>
                                </div>
                            </div>
                        </div>
                        <div class="course-teacher-details">
                            <div class="top-part">
                                <a href="{{route('tutor.page.show',$course->teacher->name)}}"><img alt="محمد نیکو"
                                                                                                   class="img-fluid lazyloaded"
                                                                                                   src="{{$course->teacher->image()}}"
                                                                                                   loading="lazy">
                                    <noscript>
                                        <img class="img-fluid" src="{{$course->teacher->image()}}" alt="محمد نیکو">
                                    </noscript>
                                </a>
                                <div class="name">
                                    <a href="{{route('tutor.page.show',$course->teacher->name)}}" class="btn-link">
                                        <h6>{{$course->getTeacherName->name}}</h6>
                                    </a>
                                    <span class="job-title">مدرس و توسعه دهنده</span>
                                </div>
                            </div>
                            <div class="job-content">
                                <!--                        <p>عاشق برنامه نویسی</p>-->
                            </div>
                        </div>
                        <div class="short-link">
                            <div class="">
                                <span>لینک کوتاه</span>
                                <input class="short--link" value="webamooz.net/c/Y33x3">
                                <a href="" class="short-link-a" data-link="https://webamooz.net/c/Y33x3"></a>
                            </div>
                        </div>
                        <di class="sidebar-banners">

                            <div class="sidebar-pic">
                                <a href=""><img src="{{asset('panel/assets/img/telgram.png')}}" alt="کانال تلگرام"></a>
                            </div>

                            <div class="sidebar-pic">
                                <a href=""><img src="{{asset('panel/assets/img/podcast.png')}}" alt="وبلاگ وب آموز"></a>
                            </div>
                            <div class="sidebar-pic">
                                <a href=""><img src="{{asset('panel/assets/img/workinja.png')}}" alt="کانال تلگرام"></a>
                            </div>
                            <div class="sidebar-pic">
                                <a href=""><img src="{{asset('panel/assets/img/blog-pic.png')}}" alt="کانال تلگرام"></a>
                            </div>
                        </di>

                    </div>
                </div>
                <div class="content-left">
                    <div class="preview">
                        <video width="100%" controls>
                            <source src="" type="video/mp4">
                        </video>
                    </div>
                    <a href="#" class="episode-download">دانلود این قسمت (قسمت 1)</a>
                    <div class="course-description">

                        <div class="course-description-title">توضیحات دوره
                            <div class="study-mode"></div>
                        </div>
                        {{$course->body}}
                        <div class="tags">
                            <ul>
                                <li><a href="">ری اکت</a></li>
                                <li><a href="">reactjs</a></li>
                                <li><a href="">جاوااسکریپت</a></li>
                                <li><a href="">javascript</a></li>
                                <li><a href="">reactjs چیست</a></li>
                            </ul>
                        </div>
                    </div>
                    @include('Front::layout.episodes-list')
                </div>
            </div>
            <div class="container">
                <div class="comments">
                    <div class="comment-main">
                        <div class="ct-header">
                            <h3>نظرات ( 180 )</h3>
                            <p>نظر خود را در مورد این مقاله مطرح کنید</p>
                        </div>
                        <form action="" method="post">
                            <div class="ct-row">
                                <div class="ct-textarea">
                                    <textarea class="txt ct-textarea-field"></textarea>
                                </div>
                            </div>
                            <div class="ct-row">
                                <div class="send-comment">
                                    <button class="btn i-t">ثبت نظر</button>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="comments-list">
                        <div id="Modal2" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <p>ارسال پاسخ</p>
                                    <div class="close">&times;</div>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="">
                                        <textarea class="txt hi-220px" placeholder="متن دیدگاه"></textarea>
                                        <button class="btn i-t">ثبت پاسخ</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <ul class="comment-list-ul">
                            <div class="div-btn-answer">
                                <button class="btn-answer">پاسخ به دیدگاه</button>
                            </div>
                            <li class="is-comment">
                                <div class="comment-header">
                                    <div class="comment-header-avatar">
                                        <img src="img/profile.jpg">
                                    </div>
                                    <div class="comment-header-detail">
                                        <div class="comment-header-name">کاربر : گوگل گوگل گوگل گوگل</div>
                                        <div class="comment-header-date">10 روز پیش</div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                        برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                                        کاربردی می باشد.
                                    </p>
                                </div>
                            </li>
                            <li class="is-answer">
                                <div class="comment-header">
                                    <div class="comment-header-avatar">
                                        <img src="img/laravel-pic.png">
                                    </div>
                                    <div class="comment-header-detail">
                                        <div class="comment-header-name">مدیر سایت : محمد نیکو</div>
                                        <div class="comment-header-date">10 روز پیش</div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                        برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                                        کاربردی می باشد.
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                        برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                                        کاربردی می باشد.
                                    </p>
                                </div>
                            </li>
                            <li class="is-comment">
                                <div class="comment-header">
                                    <div class="comment-header-avatar">
                                        <img src="img/profile.jpg">
                                    </div>
                                    <div class="comment-header-detail">
                                        <div class="comment-header-name">کاربر : گوگل</div>
                                        <div class="comment-header-date">10 روز پیش</div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                        برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                                        کاربردی می باشد.
                                    </p>
                                </div>
                            </li>

                        </ul>
                        <ul class="comment-list-ul">
                            <div class="div-btn-answer">
                                <button class="btn-answer">پاسخ به دیدگاه</button>
                            </div>
                            <li class="is-comment">
                                <div class="comment-header">
                                    <div class="comment-header-avatar">
                                        <img src="img/profile.jpg">
                                    </div>
                                    <div class="comment-header-detail">
                                        <div class="comment-header-name">کاربر : گوگل</div>
                                        <div class="comment-header-date">10 روز پیش</div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                        برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                                        کاربردی می باشد.
                                    </p>
                                </div>
                            </li>
                            <li class="is-answer">
                                <div class="comment-header">
                                    <div class="comment-header-avatar">
                                        <img src="img/laravel-pic.png">
                                    </div>
                                    <div class="comment-header-detail">
                                        <div class="comment-header-name">مدیر سایت : محمد نیکو</div>
                                        <div class="comment-header-date">10 روز پیش</div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                        برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                                        کاربردی می باشد.
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                        برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                                        کاربردی می باشد.
                                    </p>
                                </div>
                            </li>

                        </ul>


                    </div>
                </div>
            </div>
        </div>
        <div id="Modal-buy" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <p>کد تخفیف را وارد کنید</p>
                    <div class="close">&times;</div>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('courses.buy',$course->id)}}">
                        @csrf
                        <div>
                            <input type="text" name="code" id="code" class="txt"
                                   placeholder="کد تخفیف را وارد کنید">
                            <p id="response"></p>
                        </div>
                        <button type="button" class="btn i-t "
                                onclick="checkDiscountCode()">اعمال
                            <img src="/img/loading.gif" alt="" id="loading"
                                 class="loading d-none">
                        </button>
                        <table class="table text-center table-bordered table-striped">
                            <tbody>
                            <tr>
                                <th>قیمت کل دوره</th>
                                <td> {{number_format($course->price)}} تومان</td>
                            </tr>
                            <tr>
                                <th>درصد تخفیف</th>
                                <td><span id="discountPercent"
                                          data-value="{{$course->getDiscountPercent()}}">{{$course->getDiscountPercent()}}</span>%
                                </td>
                            </tr>
                            <tr>
                                <th> مبلغ تخفیف</th>
                                <td class="text-red"><span
                                        id="discountAmount"
                                        data-value="{{$course->getDiscountAmount()}}"> {{$course->getDiscountAmount()}}</span>
                                    تومان
                                </td>
                            </tr>
                            <tr>
                                <th> قابل پرداخت</th>
                                <td class="text-blue"><span
                                        id="payableAmount"
                                        data-value="{{number_format($course->getFinalPrice())}}">{{number_format($course->getFinalPrice())}}</span>
                                    تومان
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn i-t ">پرداخت آنلاین</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <div class="toast">
        <div>
            <div class="toast__icon"></div>
            <div class="toast__message"></div>
            <div class="toast__close" onclick="toast__close()"></div>
        </div>


    </div>
    <x-footer></x-footer>
    <x-slot name="style">
        <link rel="stylesheet" href="{{asset('home/assets/css/modal.css')}}">
    </x-slot>

    <x-slot name="script">
        <script src="{{asset('home/assets/js/modal.js')}}"></script>
    </x-slot>
</x-app-layout>
