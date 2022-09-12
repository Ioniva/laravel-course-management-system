<?php

namespace App\Http\Controllers;

use App\Mail\WorksMailable;
use App\Models\Notification;
use App\Models\Subject;
use App\Models\User;
use App\Models\Work;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class WorkController extends Controller
{
    /**
     * Return array with all subjects
     *
     * @return array
     */
    public function filteredWork(){
        return [
            "students" => User::select('id', 'name', 'surname')->where('role', 'student')->get(),
            "subjects" => Subject::all('id', 'name'),
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $works = Work::all();
        return View::make('work.index', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $works = $this->filteredWork();
        return View::make('work.create', compact('works'));
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
        $user = User::find($request->get('users_id'));
        $work = Work::create($params);

        if ($work) {
            $sendEmail = $this->checkSendEmail($request->get('users_id'));
            if ($sendEmail === true) {
                $correo = new WorksMailable($work, 'create');
                Mail::to($user->email)->send($correo);
            }
            return redirect('/work');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $selectedWork = Work::find($id);
        $works = $this->filteredWork();
        return View::make('work.edit', compact('selectedWork'), compact('works'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $work = Work::find($id);
        $user = User::find($request->get('users_id'));

        $work->users_id = $request->get('users_id');
        $work->subjects_id = $request->get('subjects_id');
        $work->name = $request->get('name');
        $work->mark = $request->get('mark');

        if ($work->save()){
            $sendEmail = $this->checkSendEmail($request->get('users_id'));
            if ($sendEmail === true) {
                $correo = new WorksMailable($work, 'edit');
                Mail::to($user->email)->send($correo);
            }
            return redirect('/work');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy($id)
    {
        $work = Work::find($id);
        $work->delete($id);
        return redirect('/work');
    }

    /**
     * Check if send or not the email to the student
     *
     * @param String $id
     * @return bool|void
     */
    public function checkSendEmail(String $id){
        $notification = Notification::where('users_id', $id)->first();
        if ($notification !== NULL){
            return $notification->work == 1 ? true : false;
        }
    }
}
