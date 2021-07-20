
<x-app-layout>
    <x-slot name="title">صفحه اصلی</x-slot>
    <x-header></x-header>
    <main id="index">
        <article class="container article">
            @include('Front::layout.header-ads')

            @include('Front::layout.top-info')

            @include('Front::layout.latestCourse')

            @include('Front::layout.popularCourses')

            @include('Front::layout.latestArticles')
        </article>

    </main>
    <x-footer></x-footer>
    <x-slot name="script">
        <script>

        </script>
    </x-slot>
</x-app-layout>
