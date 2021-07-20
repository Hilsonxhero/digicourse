<?php

namespace Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Course\Http\Requests\LessonCreateRequest;
use Course\Models\Course;
use Course\Models\Lesson;
use Course\Repositories\CourseRepo;
use Course\Repositories\LessonRepo;
use Illuminate\Http\Request;
use Media\Services\MediaFileService;

class LessonController extends Controller
{
    public $LessonRepo;
    public $CourseRepo;

    public function __construct(LessonRepo $lessonRepo, CourseRepo $courseRepo)
    {
        $this->LessonRepo = $lessonRepo;
        $this->CourseRepo = $courseRepo;
    }

    public function index()
    {
        //
    }

    public function create($course)
    {
        $seasons = $this->LessonRepo->getCourseSeasons($course);
        $course = $this->CourseRepo->findById($course);
        return view("Course::lessons.create", compact('seasons', 'course'));
    }

    public function store(LessonCreateRequest $request, $course)
    {

        $request->request->add(['media_id' => MediaFileService::privateUpload($request->file('attachment'))->id]);

        $this->LessonRepo->store($course, $request);
        newFeedback();
        return redirect()->route('courses.detail', $course);
    }

    public function show(Lesson $lesson)
    {
        //
    }

    public function edit($courseId, $lesson)
    {
        $lesson = $this->LessonRepo->findById($lesson);
        $seasons = $this->LessonRepo->getCourseSeasons($courseId);
        $course = $this->CourseRepo->findById($courseId);
        return view("Course::lessons.edit", compact('lesson', 'seasons', 'course'));
    }

    public function update(Request $request, $course, $lesson)
    {
        $lesson = $this->LessonRepo->findById($lesson);
        if ($request->has('attachment')) {
            $request->request->add(['media_id' => MediaFileService::privateUpload($request->file('attachment'))->id]);
            $lesson->media ? $lesson->media->delete() : '';
        } else {
            $request->request->add(['media_id' => $lesson->media_id]);
        }
        $this->LessonRepo->update($course, $lesson, $request);
        newFeedback();
        return redirect()->route('courses.detail', $course);
    }

    public function accept($id)
    {
        $this->LessonRepo->updateConfirmationStatus($id, Lesson::CONFIRMATION_STATUS_ACCEPTED);
        newFeedback();
        return back();
    }

    public function acceptAll(Request $request, $course)
    {
        $this->LessonRepo->acceptAll($course);
        newFeedback();
        return back();
    }

    public function acceptMultiple(Request $request, $course)
    {
        $ids = explode(',', $request->ids);
        foreach ($ids as $id) {
//            $lesson = $this->LessonRepo->findById($id);
            $this->LessonRepo->updateConfirmationStatus($id, Lesson::CONFIRMATION_STATUS_ACCEPTED);
        }
        newFeedback();
        return back();
    }

    public function rejectMultiple(Request $request, $course)
    {
        $ids = explode(',', $request->ids);
        foreach ($ids as $id) {
//            $lesson = $this->LessonRepo->findById($id);
            $this->LessonRepo->updateConfirmationStatus($id, Lesson::CONFIRMATION_STATUS_REJECTED);
        }
        newFeedback();
        return back();
    }

    public function reject($id)
    {
        $this->LessonRepo->updateConfirmationStatus($id, Lesson::CONFIRMATION_STATUS_REJECTED);
        newFeedback();
        return back();
    }

    public function destroyMultiple(Request $request)
    {
        $ids = explode(',', $request->ids);
        foreach ($ids as $id) {
            $lesson = $this->LessonRepo->findById($id);
            if ($lesson->media) {
                $lesson->media->delete();
            }
            $lesson->delete();
        }
        newFeedback();
        return back();
    }

    public function destroy($id)
    {
        $lesson = $this->LessonRepo->findById($id);
        if ($lesson->media) {
            $lesson->media->delete();
        }
        $lesson->delete();
        newFeedback();
        return back();

    }
}
