<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $courses = Course::all();
        return View::make('Welcome', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        // ALmacenar los cursos seleccionados en la BBDD

        // Despues redirigir a la pantalla de inicio
        return redirect('/calendar');
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function assign(Request $request)
    {

        $names = $request->input('courses');
        $courses_id = array();
        foreach ($names as $name) {
            $courses_id[] = Course::where('name', $name)->first()->id;
        }

        $id_student = Auth::user()->id;
        $params['users_id'] = $id_student;
        foreach ($courses_id as $course) {
            $params['courses_id'] = $course;
            $enrollment = Enrollment::create($params);
        }
        if ($enrollment) {
            return redirect('/calendar')->with('success', 'Actualizado correctamente.');
        }

    }
}


