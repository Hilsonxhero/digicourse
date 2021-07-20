<?php


namespace Course\Repositories;


use Course\Models\Course;
use Course\Models\Season;

class SeasonRepo
{

    public function findById($id)
    {
        return Season::find($id);
    }

    public function findByIdandCourseId($seasonId, $courseId)
    {
        return Season::query()->where('course_id', $courseId)->where('id', $seasonId)->first();
    }

    public function store($id, $values)
    {
        Season::query()->create([
            'course_id' => $id,
            'user_id' => auth()->user()->id,
            'title' => $values->title,
            'position' => $this->generatePosition($values->position, $id),
            'confirmation_status' => Season::CONFIRMATION_STATUS_PENDING
        ]);

    }

    public function update($season, $values)
    {

        return $season->update([
            'title' => $values->title,
            'position' => $this->generatePosition($values->position, $season->course_id),
        ]);
    }

    public function paginate()
    {
        return Course::query()->paginate();
    }

    public function updateConfirmationStatus($id, $status)
    {
        return Season::query()->where('id', $id)->update([
            'confirmation_status' => $status
        ]);
    }

    public function updateStatus($id, $status)
    {
        return Course::query()->where('id', $id)->update([
            'status' => $status
        ]);
    }

    /**
     * @param $values
     * @param CourseRepo $courseRepo
     * @param $id
     * @return int|mixed
     */
    public function generatePosition($position, $courseId)
    {
        $courseRepo = new CourseRepo();
        if (is_null($position)) {
            $position = $courseRepo->findById($courseId)->seasons()->orderBy('position', 'desc')->firstOrNew([])->position ?: 0;
            $position++;
        }

        return $position;
    }

}
