<header class="t-header">
    <div class="campaign" style="display:block; !important;">
        <div class="container">
            <a class="message">تخفیف «۳۰٪» همه دوره‌ها فقط تا</a>
            <div id="count-down-timer" data-countdown="2021-07-8 00:00:00" class="count-down-timer"></div>
        </div>
    </div>

    <div class="container">
        <div class="t-header-row">
            <div class="t-header-right">
                <div class="t-header-logo"><a href="index.html"></a></div>
                <div class="t-header-search">
                    <div class="t-header-searchbox">
                        <input type="text" placeholder="جستجو دوره / مقاله / مدرس">
                        <div class="t-header-search-content">
                            <div class="t-header-search-result-filters">
                                <div class="t-header-search-filter-item f-all active"><span>همه (20)</span></div>
                                <div class="t-header-search-filter-item f-courses "><span>دوره ها (13)</span></div>
                                <div class="t-header-search-filter-item f-article "><span>مقاله ها (5)</span></div>
                                <div class="t-header-search-filter-item f-teacher "><span>مدرسین (2)</span></div>
                            </div>
                            <div class="t-header-search-result">
                                <a href="">
                                    <div class="t-header-search-result-right">
                                        <p>دوره ساخت فریم ورک مشابه لاراول</p>
                                        <p class="t-header-search-result-right-info">
                                            مدرس دوره : محمد نیکو
                                        </p>
                                    </div>
                                    <div class="t-header-search-result-left">
                                        <img src="img/banner/laravel-payment-processing.jpg" alt="">
                                    </div>
                                </a>
                                <a href="">
                                    <div class="t-header-search-result-right">
                                        <p>laravel course</p>
                                        <p class="t-header-search-result-right-info">
                                            مدرس دوره : محمد نیکو
                                        </p>
                                    </div>
                                    <div class="t-header-search-result-left">
                                        <img src="img/banner/laravel-payment-processing.jpg" alt="">
                                    </div>
                                </a>
                                <a href="">
                                    <div class="t-header-search-result-right">
                                        <p>دوره ساخت فریم ورک مشابه لاراول</p>
                                        <p class="t-header-search-result-right-info">
                                            مدرس دوره : محمد نیکو
                                        </p>
                                    </div>
                                    <div class="t-header-search-result-left">
                                        <img src="img/banner/laravel-payment-processing.jpg" alt="">
                                    </div>
                                </a>
                                <a href="">
                                    <div class="t-header-search-result-right">
                                        <p>دوره ساخت فریم ورک مشابه لاراول</p>
                                        <p class="t-header-search-result-right-info">
                                            مدرس دوره : محمد نیکو
                                        </p>
                                    </div>
                                    <div class="t-header-search-result-left">
                                        <img src="img/banner/laravel-payment-processing.jpg" alt="">
                                    </div>
                                </a>
                                <a href="">
                                    <div class="t-header-search-result-right">
                                        <p>دوره ساخت فریم ورک مشابه لاراول</p>
                                        <p class="t-header-search-result-right-info">
                                            مدرس دوره : محمد نیکو
                                        </p>
                                    </div>
                                    <div class="t-header-search-result-left">
                                        <img src="img/banner/laravel-payment-processing.jpg" alt="">
                                    </div>
                                </a>
                                <a href="">
                                    <div class="t-header-search-result-right">
                                        <p>دوره ساخت فریم ورک مشابه لاراول</p>
                                        <p class="t-header-search-result-right-info">
                                            مدرس دوره : محمد نیکو
                                        </p>
                                    </div>
                                    <div class="t-header-search-result-left">
                                        <img src="img/banner/laravel-payment-processing.jpg" alt="">
                                    </div>
                                </a>
                                <a href="">
                                    <div class="t-header-search-result-right">
                                        <p>دوره ساخت فریم ورک مشابه لاراول</p>
                                        <p class="t-header-search-result-right-info">
                                            مدرس دوره : محمد نیکو
                                        </p>
                                    </div>
                                    <div class="t-header-search-result-left">
                                        <img src="img/banner/laravel-payment-processing.jpg" alt="">
                                    </div>
                                </a>
                                <a href="">
                                    <div class="t-header-search-result-right">
                                        <p>دوره ساخت فریم ورک مشابه لاراول</p>
                                        <p class="t-header-search-result-right-info">
                                            مدرس دوره : محمد نیکو
                                        </p>
                                    </div>
                                    <div class="t-header-search-result-left">
                                        <img src="img/banner/laravel-payment-processing.jpg" alt="">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="t-header-left">
                <div class="icons">
                    <div class="search-icon"></div>
                    <div class="menu-icon"></div>
                </div>

                @auth
                    <div class="user-menu-account">
                        <div class="user-image">
                            <img src="{{auth()->user()->image()}}" alt="desction">
                        </div>

                        <span>پروفایل کاربری من </span>
                        <div class="user-menu-account-dropdown">
                            <ul>
                                <li><a href="">مشاهده پروفایل</a></li>
                                <li><a href="">خرید های من</a></li>
                                <li><a href="">داشبورد</a></li>
                                <li><a href="{{route('logout')}}">خروج</a></li>
                            </ul>
                        </div>

                    </div>
                @endauth

                @guest
                    <div class="login-register-btn ">
                        <div><a class="btn-login" href="{{route('login')}}">ورود</a></div>
                        <div><a class="btn-register" href="{{route('register')}}">ثبت نام</a></div>
                    </div>
                @endguest


            </div>
        </div>
    </div>
    <nav id="navigation" class="navigation">
        <div class="login-register-btn d-none">
            <div><a class="btn-login" href="{{route('login')}}">ورود</a></div>
            <div><a class="btn-register" href="{{route('register')}}">ثبت نام</a></div>
        </div>
        <div class="container">
            <ul class="nav">
                @foreach($categories as $category)
                    <li class="main-menu {{count($category->sub) ? 'has-sub' : '' }}"><a
                            href="#">{{$category->name}}</a>
                        @if(count($category->sub))
                            <div class="sub-menu">
                                <div class="container">
                                    @foreach($category->sub as $sub)
                                        <div><a href="">{{$sub->name}}</a></div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="triangle"></div>
                        @endif
                    </li>
                @endforeach
                <li class="main-menu d-none"><a href="#">درباره ما</a></li>
                <li class="main-menu"><a href="contact-us.html">تماس ما</a></li>
                <li class="main-menu join-teachers-li"><a href="become-a-teacher.html">تدریس در وب آموز</a></li>
                <li class="main-menu"><a href="https://www.webamooz.net/blog">مقالات</a></li>
            </ul>

            <div class="dark-light">
                <svg class="moon" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                </svg>
                <svg class="sun" fill="#ffce45" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M277.3 32h-42.7v64h42.7V32zm129.1 43.7L368 114.1l29.9 29.9 38.4-38.4-29.9-29.9zm-300.8 0l-29.9 29.9 38.4 38.4 29.9-29.9-38.4-38.4zM256 128c-70.4 0-128 57.6-128 128s57.6 128 128 128 128-57.6 128-128-57.6-128-128-128zm224 106.7h-64v42.7h64v-42.7zm-384 0H32v42.7h64v-42.7zM397.9 368L368 397.9l38.4 38.4 29.9-29.9-38.4-38.4zm-283.8 0l-38.4 38.4 29.9 29.9 38.4-38.4-29.9-29.9zm163.2 48h-42.7v64h42.7v-64z"></path>
                </svg>
            </div>

            </ul>
        </div>
    </nav>
</header>
