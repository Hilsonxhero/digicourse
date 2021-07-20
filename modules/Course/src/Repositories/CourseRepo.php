<?php


namespace Course\Repositories;


use Course\Models\Course;
use Course\Models\Lesson;

class CourseRepo
{

    public function findById($id)
    {
        return Course::find($id);
    }

    public function store($values)
    {
        Course::query()->create([
            'title' => $values->title,
            'slug' => \Str::slug($values->slug),
            'teacher_id' => $values->teacher_id,
            'category_id' => $values->category_id,
            'position' => $values->position,
            'price' => $values->price,
            'percent' => $values->percent,
            'type' => $values->type,
            'status' => $values->status,
            'body' => $values->body,
            'banner_id' => $values->banner_id,
        ]);

    }

    public function update($values, $course)
    {

        return $course->update([
            'title' => $values->title,
            'slug' => \Str::slug($values->slug),
            'teacher_id' => $values->teacher_id,
            'category_id' => $values->category_id,
            'position' => $values->position,
            'price' => $values->price,
            'percent' => $values->percent,
            'type' => $values->type,
            'status' => $values->status,
            'body' => $values->body,
            'banner_id' => $values->banner_id,
        ]);
    }

    public function paginate()
    {
        return Course::query()->paginate();
    }

    public function updateConfirmationStatus($id, $status)
    {
        return Course::query()->where('id', $id)->update([
            'confirmation_status' => $status
        ]);
    }

    public function updateStatus($id, $status)
    {
        return Course::query()->where('id', $id)->update([
            'status' => $status
        ]);
    }

    public function generatePosition($position)
    {
        $courseRepo = new CourseRepo();
        if (is_null($position)) {
            $position = Course::query()->orderBy('position', 'desc')->firstOrNew([])->position ?: 0;
            $position++;
        }

        return $position;
    }

    public function latestCourse()
    {

        return Course::query()->where('confirmation_status', Course::CONFIRMATION_STATUS_ACCEPTED)
            ->latest()
            ->take(8)
            ->get();
    }

    public function geDuration($id)
    {
        return Lesson::query()->where('course_id', $id)
            ->where('confirmation_status', Lesson::CONFIRMATION_STATUS_ACCEPTED)->sum('time');
    }

    public function getLessonsCount($course)
    {
        return Lesson::query()->where('course_id', $course)->where('confirmation_status', Lesson::CONFIRMATION_STATUS_ACCEPTED)->count();
    }

    public function addStudentToCourse(Course $course, $studentId)
    {
        if (!$this->getCourseStudent($course, $studentId)) {
            $course->students()->attach($studentId);
        }

    }

    public function getCourseStudent(Course $course, $studentId)
    {
        return $course->students()->where("user_id", $studentId)->first();
    }

    public function hasStudent(Course $course, $student_id)
    {
        return $course->students->contains($student_id);
    }


}
