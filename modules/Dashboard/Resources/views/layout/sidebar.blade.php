<div class="sidebar__nav border-top border-left">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href="https://webamooz.net"></a>
    <x-user-photo></x-user-photo>

    <ul>

        <li class="item-li i-dashboard @if(request()->is('dashboard') ) is-active @endif"><a
                href="{{route('dashboard.index')}}">پیشخوان</a></li>
        @if(auth()->user()->hasPermissionTo(\RolePermissions\Models\Permission::PERMISSION_MANAGE_COURSES)
|| auth()->user()->hasPermissionTo(\RolePermissions\Models\Permission::PERMISSION_SUPER_ADMIN))

            <li class="item-li i-courses @if(request()->is('dashboard/courses') || request()->is('dashboard/courses/*') ) is-active @endif ">
                <a href="{{route('courses.index')}}">دوره ها</a></li>
        @endif
        <li class="item-li i-users  @if(request()->is('dashboard/users') || request()->is('dashboard/users/*') ) is-active @endif">
            <a href="{{route('users.index')}}"> کاربران</a></li>

        <li class="item-li i-role-permissions @if(request()->is('dashboard/role-permissions') || request()->is('dashboard/role-permissions/*') ) is-active @endif">
            <a href="{{route('role-permissions.index')}}"> نقش های کاربری</a></li>

        <li class="item-li i-my__purchases @if(request()->is('dashboard/purchases') || request()->is('dashboard/purchases/*') ) is-active @endif"
        "><a href="{{route('purchases.index')}}">خرید های من</a></li>
        <li class="item-li i-transactions @if(request()->is('dashboard/payments') || request()->is('dashboard/payments/*') ) is-active @endif">
            <a href="{{route('payments.index')}}">تراکنش ها</a></li>

        <li class="item-li i-categories @if(request()->is('dashboard/categories') || request()->is('dashboard/categories/*') ) is-active @endif">
            <a href="{{route('categories.index')}}">دسته بندی ها</a></li>


        <li class="item-li i-checkouts @if(request()->is('dashboard/settlements') || request()->is('dashboard/settlements/*') ) is-active @endif ">
            <a href="{{route('settlements.index')}}">تسویه حساب ها</a></li>

        <li class="item-li i-checkout__request @if(request()->is('dashboard/settlements/create')) is-active @endif "><a
                href="{{route('settlements.create')}}">درخواست تسویه </a></li>


        <li class="item-li i-tickets @if(request()->is('dashboard/tickets') || request()->is('dashboard/tickets/*') ) is-active @endif"><a href="{{route('tickets.index')}}"> تیکت ها</a></li>

        <li class="item-li i-discounts @if(request()->is('dashboard/discounts') || request()->is('dashboard/discounts/*') ) is-active @endif"><a href="{{route('discounts.index')}}">تخفیف ها</a></li>

        <li class="item-li i-user__inforamtion @if(request()->is('dashboard/user/profile') || request()->is('dashboard/user/profile/*') ) is-active @endif">
            <a href="{{route('dashboard.user.profile')}}">اطلاعات کاربری</a></li>


        <li class="item-li i-slideshow"><a href="slideshow.html">اسلایدشو</a></li>
        <li class="item-li i-banners"><a href="banners.html">بنر ها</a></li>
        <li class="item-li i-articles"><a href="articles.html">مقالات</a></li>
        <li class="item-li i-ads"><a href="ads.html">تبلیغات</a></li>
        <li class="item-li i-comments"><a href="comments.html"> نظرات</a></li>




        <li class="item-li i-my__peyments"><a href="mypeyments.html">پرداخت های من</a></li>
        <li class="item-li i-notification__management"><a href="notification-management.html">مدیریت اطلاع رسانی</a>
        </li>

    </ul>

</div>
