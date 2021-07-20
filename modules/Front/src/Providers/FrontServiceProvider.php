<?php

namespace Front\Providers;

use Category\Repostories\CategoryRepo;
use Course\Repositories\CourseRepo;

class FrontServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/front_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'Front');

        \View::composer('Front::layout.header', function ($view) {
            $categories = (new CategoryRepo())->tree();
            $view->with(compact('categories'));
        });

        \View::composer('Front::index', function ($view) {
            $latestCourses = (new CourseRepo())->latestCourse();
            $view->with(compact('latestCourses'));
        });
    }

}
