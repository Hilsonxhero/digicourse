<?php

namespace Course\Providers;

use Course\Models\Lesson;
use Course\Policies\CoursePolisy;
use Course\Models\Course;
use Course\Policies\LessonPolisy;
use Illuminate\Support\Facades\Gate;
use RolePermissions\Models\Permission;

class CourseServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->app->register(EventServiceProvider::class);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/course_routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/season_routes.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/lesson_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadFactoriesFrom(__DIR__ . '/../database/factories');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'Course');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/lang');

        Gate::policy(Course::class, CoursePolisy::class);
        Gate::policy(Lesson::class, LessonPolisy::class);


    }
}
