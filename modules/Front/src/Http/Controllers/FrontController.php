<?php

namespace Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Course\Models\Course;
use Course\Repositories\LessonRepo;
use Illuminate\Http\Request;
use RolePermissions\Models\Permission;
use User\Models\User;

class FrontController extends Controller
{
    public $LessonRepo;

    public function __construct(LessonRepo $lessonRepo)
    {
        $this->LessonRepo = $lessonRepo;
    }



    public function index()
    {

//        Auth::guard('web')->logout();
        return view('Front::index');
    }

    public function CoursePage(Course $course)
    {
        $lessons = $this->LessonRepo->getAcceptedLessons($course->id);
        return view('Front::course-page', compact('course', 'lessons'));
    }

    public function tutorPage($name)
    {
        $tutor = User::permission(Permission::PERMISSION_TEACH)->where('name', $name)->first();
        return view('Front::tutor', compact('tutor'));
    }
}
