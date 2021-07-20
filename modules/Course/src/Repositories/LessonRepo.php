<?php


namespace Course\Repositories;

use Course\Models\Course;
use Course\Models\Lesson;
use Course\Models\Season;

class LessonRepo
{

    public function findById($id)
    {
        return Lesson::find($id);
    }

    public function getCourseSeasons($course)
    {
        return Season::query()->where('course_id', $course)
            ->where('confirmation_status', Season::CONFIRMATION_STATUS_ACCEPTED)
            ->orderBy('position')->get();
    }

    public function store($course, $values)
    {
        Lesson::query()->create([
            'title' => $values->title,
            'slug' => $values->slug ? \Str::slug($values->slug) : \Str::slug($values->title),
            'time' => $values->time,
            'free' => $values->free,
            'position' => $this->generatePosition($values->position, $course),
            'season_id' => $values->season_id,
            'media_id' => $values->media_id,
            'course_id' => $course,
            'user_id' => auth()->user()->id,
            'body' => $values->body,
            'attachment' => $values->media_id
        ]);

    }

    public function update($course, $lesson, $values)
    {
        return $lesson->update([
            'title' => $values->title,
            'slug' => $values->slug ? \Str::slug($values->slug) : \Str::slug($values->title),
            'time' => $values->time,
            'free' => $values->free,
            'position' => $this->generatePosition($values->position, $course),
            'season_id' => $values->season_id,
            'media_id' => $values->media_id,
            'course_id' => $course,
            'user_id' => auth()->user()->id,
            'body' => $values->body,
            'attachment' => $values->media_id
        ]);
    }

    public function paginate($course)
    {
        return Lesson::query()->where('course_id', $course)->orderBy('position')->paginate();
    }

    public function updateConfirmationStatus($id, $status)
    {
        return Lesson::query()->where('id', $id)->update([
            'confirmation_status' => $status
        ]);
    }

    public function acceptAll($course)
    {
        return Lesson::query()->where('course_id', $course)->update(['confirmation_status' => Lesson::CONFIRMATION_STATUS_ACCEPTED]);
    }

    public function updateStatus($id, $status)
    {
        return Course::query()->where('id', $id)->update([
            'status' => $status
        ]);
    }

    public function generatePosition($position, $courseId)
    {
        $courseRepo = new CourseRepo();
        if (is_null($position)) {
            $position = $courseRepo->findById($courseId)->lessons()->orderBy('position', 'desc')->firstOrNew([])->position ?: 0;
            $position++;
        }

        return $position;
    }

    public function getAcceptedLessons($course)
    {
        return Lesson::query()->where('course_id',$course)->where('confirmation_status', Lesson::CONFIRMATION_STATUS_ACCEPTED)->get();
    }

}
