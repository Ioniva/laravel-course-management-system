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

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        return View::make('admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.create');
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
        $params['role'] = 'admin';
        $admin = User::create($params);

        if ($admin){
            return redirect('/admin')->with('success', 'Se ha creado correctamente.');
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
        $admin = User::find($id);
        return View::make('admin.edit', compact('admin'));
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
        $admin = User::find($id);

        $admin->name = $request->get('name');
        $admin->surname = $request->get('surname');
        $admin->username = $request->get('username');
        $admin->email = $request->get('email');
        $admin->telephone = $request->get('telephone');
        $admin->nif = $request->get('nif');
        $admin->password = Hash::make($request->get('pass'));

        $admin->save();

        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy($id)
    {
        $admin = User::find($id);
        $admin->delete($id);
        return redirect('/admin');
    }
}
