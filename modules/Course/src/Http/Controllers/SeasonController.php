<?php

namespace Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Course\Http\Requests\SeasonCreateRequest;
use Course\Models\Season;
use Course\Repositories\SeasonRepo;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public $SeasonRepo;

    public function __construct(SeasonRepo $seasonRepo)
    {
        $this->SeasonRepo = $seasonRepo;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(SeasonCreateRequest $request, $id)
    {
        $this->SeasonRepo->store($id, $request);
        return back();
    }

    public function show(Season $season)
    {
        //
    }

    public function edit($id)
    {
        $season = $this->SeasonRepo->findById($id);
        return view('Course::seasons.edit', compact('season'));
    }

    public function update(Request $request, $id)
    {
        $season = $this->SeasonRepo->findById($id);
        $this->SeasonRepo->update($season, $request);
        newFeedback();
        return redirect()->route('courses.detail', $season->course_id);

    }

    public function accept($id)
    {
        $this->SeasonRepo->updateConfirmationStatus($id, Season::CONFIRMATION_STATUS_ACCEPTED);
        newFeedback();
        return back();
    }

    public function reject($id)
    {
        $this->SeasonRepo->updateConfirmationStatus($id, Season::CONFIRMATION_STATUS_REJECTED);
        newFeedback();
        return back();
    }

    public function destroy($id)
    {
        $season = $this->SeasonRepo->findById($id);
        $season->delete();
        newFeedback();
        return back();
    }
}
