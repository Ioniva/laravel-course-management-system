<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use JeroenNoten\LaravelAdminLte\View\Components\Widget\Alert;

class SubjectController extends Controller
{

    /**
     * Return array with all subjects
     *
     * @return array
     */
    public function filteredSubject(){
        return [
            "teachers" => User::select('id', 'name', 'surname')->where('role', 'teacher')->get(),
            "courses" => Course::all('id', 'name'),
            "schedule" => Schedule::all('id', 'time_start', 'time_end', 'day')
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $subjects = Subject::all();
        return View::make('subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $subjects = $this->filteredSubject();
        return View::make('subject.create', compact('subjects'));
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

        $subject = Subject::create($params);

        if ($subject) {
            return redirect('/subject')->with('success', 'Se ha creado correctamente.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return "Showing post: " . $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $selectedSubject = Subject::find($id);
        $subjects = $this->filteredSubject();
        return View::make('subject.edit', compact('selectedSubject'), compact('subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $subject = Subject::find($id);

        $subject->users_id = $request->get('users_id');
        $subject->courses_id = $request->get('courses_id');
        $subject->schedules_id = $request->get('schedules_id');
        $subject->name = $request->get('name');
        $subject->color = $request->get('color');

        if ($subject->save()){
            return redirect('/subject');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy($id)
    {
        $subject = Subject::find($id);
        $subject->delete($id);
        return redirect('/subject');
    }
}
