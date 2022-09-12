<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $events = [];
        $enrollments = Enrollment::where('users_id', Auth::user()->id);

        foreach ($enrollments->get('courses_id') as $course) {

            $subject = Subject::where('courses_id', $course->courses_id);
            $schedule = Schedule::where('id', $subject->get('schedules_id')->toArray());

            if (!empty($subject)) {
                $events[] = [
                    'title' => $subject->value('name'),
                    'start' => $schedule->value('day') . 'T' . $schedule->value('time_start'),
                    'end' => $schedule->value('day') . 'T' . $schedule->value('time_end'),
                    'color' => $subject->value('color')
                ];
            }

        }

        return View::make('calendar.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
