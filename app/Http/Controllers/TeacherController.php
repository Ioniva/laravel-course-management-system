<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use JeroenNoten\LaravelAdminLte\View\Components\Widget\Alert;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $teachers = User::where('role', 'teacher')->get();
        return View::make('teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('teacher.create');
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
        $params['password'] = Hash::make($request->get('pass'));
        $params['role'] = 'teacher';
        $teacher = User::create($params);

        if ($teacher){
            return redirect('/teacher')->with('success', 'Se ha creado correctamente.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return "Showing post: " . $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $teacher = User::find($id);
        return View::make('teacher.edit', compact('teacher'));
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
        $teacher = User::find($id);

        $teacher->name = $request->get('name');
        $teacher->surname = $request->get('surname');
        $teacher->username = $request->get('username');
        $teacher->email = $request->get('email');
        $teacher->telephone = $request->get('telephone');
        $teacher->nif = $request->get('nif');
        $teacher->password = Hash::make($request->get('pass'));

        $teacher->save();

        return redirect('/teacher');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy($id)
    {
        $teacher = User::find($id);
        $teacher->delete($id);
        return redirect('/teacher');
    }
}
