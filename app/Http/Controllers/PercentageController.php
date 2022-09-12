<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Percentage;
use App\Models\Subject;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;

class PercentageController extends Controller
{
    /**
     * Return array with all subjects
     *
     * @return array
     */
    public function filteredPercentage()
    {
        return [
            "courses" => Course::all('id', 'name'),
            "subjects" => Subject::all('id', 'name')
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $percentages = Percentage::all();
        return View::make('percentage.index', compact('percentages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $percentages = $this->filteredPercentage();
        return View::make('percentage.create', compact('percentages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {

        $params = $request->all();

        $percentage = Percentage::create($params);

        if ($percentage) {
            return redirect('/percentage');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $selectedPercentage = Percentage::find($id);
        $percentages = $this->filteredPercentage();
        return View::make('percentage.edit', compact('selectedPercentage'), compact('percentages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|Redirector|RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $mytime = Carbon::now(new \DateTimeZone('Europe/Paris'));

        $percentage = Percentage::find($id);

        $percentage->courses_id = $request->get('courses_id');
        $percentage->subjects_id = $request->get('subjects_id');
        $percentage->continuous_assessment = $request->get('continuous_assessment');
        $percentage->exams = $request->get('exams');
        $percentage->updated_at = $mytime;
        $percentage->save();

        return redirect('/percentage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|Redirector|RedirectResponse
     */
    public function destroy($id)
    {
        $percentage = Percentage::find($id);
        $percentage->delete($id);
        return redirect('/percentage');
    }
}
