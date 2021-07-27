<?php

namespace Course\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Category\Models\Category;
use Course\Http\Requests\CourseCreateRequest;
use Course\Http\Requests\CourseUpdateRequest;
use Course\Models\Course;
use Course\Repositories\CourseRepo;
use Course\Repositories\LessonRepo;
use Media\Services\MediaFileService;
use Payment\Services\PaymentService;
use User\Repositories\UserRepo;

class CourseController extends Controller
{
    public $CourseRepo;
    public $UserRepo;

    public function __construct(CourseRepo $courseRepo, UserRepo $userRepo)
    {
        $this->CourseRepo = $courseRepo;
        $this->UserRepo = $userRepo;
    }

    public function index()
    {
        $this->authorize('manage', Course::class);
        $courses = $this->CourseRepo->paginate();
        return view('Course::index', compact('courses'));
    }


    public function create()
    {
        $teachers = $this->UserRepo->getTeachers();
        $categories = Category::all();
        return view('Course::create', compact('teachers', 'categories'));
    }

    public function store(CourseCreateRequest $request)
    {
        $request->request->add(['banner_id' => MediaFileService::publicUpload($request->file('banner'))->id]);
        $course = $this->CourseRepo->store($request);
        newFeedback("موفقیت آمیز", "دوره با موفقت ایجاد شد", 'success');
        return redirect()->route('courses.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $course = $this->CourseRepo->findById($id);
        $teachers = $this->UserRepo->getTeachers();
        $categories = Category::all();
        return view('Course::edit', compact('course', 'teachers', 'categories'));
    }


    public function update(CourseUpdateRequest $request, $id)
    {
        $course = $this->CourseRepo->findById($id);
        if ($request->hasFile('banner')) {
            $request->request->add(['banner_id' => MediaFileService::publicUpload($request->file('banner'))->id]);
            $course->banner->delete();
        } else {
            $request->request->add(['banner_id' => $course->banner_id]);
        }
        $this->CourseRepo->update($request, $course);
        newFeedback("موفقیت آمیز", "ویرایش دوره موفقیت آمیز بود", 'success');
        return redirect()->route('courses.index');
    }

    public function destroy($id)
    {
        $course = $this->CourseRepo->findById($id);
        $course->banner->delete();
        $course->delete();
        return back();
    }

    public function accept($id)
    {
        $this->CourseRepo->updateConfirmationStatus($id, Course::CONFIRMATION_STATUS_ACCEPTED);
        return back();
    }

    public function reject($id)
    {
        $this->CourseRepo->updateConfirmationStatus($id, Course::CONFIRMATION_STATUS_REJECTED);
        return back();
    }

    public function lock($id)
    {
        $this->CourseRepo->updateStatus($id, Course::TYPE_LOCKED);
        return back();
    }

    public function detail($id, LessonRepo $lessonRepo)
    {
        $lessons = $lessonRepo->paginate($id);
        $course = $this->CourseRepo->findById($id);
        return view('Course::detail', compact('course', 'lessons'));
    }

    private function courseCanBePruchased($course)
    {
        if ($course->type == Course::TYPE_FREE) {
            newFeedback('عملیات نا موفق', 'دوره های رایگان قابل خریداری نمی باشند', 'error');
            return false;
        }
        if ($course->status == Course::TYPE_LOCKED) {
            newFeedback('عملیات نا موفق', 'دوره های قفل شده قابل خریداری نمی باشند', 'error');
            return false;
        }
        if ($course->confirmation_status != Course::CONFIRMATION_STATUS_ACCEPTED) {
            newFeedback('عملیات نا موفق', 'دوره های تایید نشده قابل خریداری نمی باشند', 'error');
            return false;
        }
        return true;
    }

    private function authUserCanPurchaseCourse($course)
    {
        if (auth()->user()->id == $course->teacher_id) {
            newFeedback('عملیات نا موفق', 'شما مدرس این دوره هستید!', 'error');
            return false;
        }

        if (auth()->user()->can('download',$course)) {
            newFeedback('عملیات نا موفق', 'شما به دوره دسترسی دارید!', 'error');
            return false;
        }

        return true;

    }

    public function buy(Request $request, $course)
    {
        $course = $this->CourseRepo->findById($course);
        if (!$this->courseCanBePruchased($course)) {

            return back();
        }
        if (!$this->authUserCanPurchaseCourse($course)) {
            return back();
        }
        [$amount,$discounts] = $course->getFinalPrice($request->code,true);

        if ($amount <= 0) {
            $this->CourseRepo->addStudentToCourse($course, auth()->user()->id);
            newFeedback();
            return redirect()->to($course->path());
        }

        return PaymentService::generate((integer) $amount, $course, auth()->user(),$course->teacher_id,$discounts);

    }


}
