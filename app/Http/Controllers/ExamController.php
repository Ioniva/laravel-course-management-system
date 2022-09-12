<?php

namespace App\Http\Controllers;

use App\Mail\ExamsMailable;
use App\Models\Exam;
use App\Models\Notification;
use App\Models\Subject;
use App\Models\User;
use App\Models\Work;
use Cassandra\Bigint;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Ramsey\Uuid\Type\Integer;

class ExamController extends Controller
{
    /**
     * Return array with all subjects
     *
     * @return array
     */
    public function filteredExams(){
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
        $exams = Exam::all();
        return View::make('exam.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $exams = $this->filteredExams();
        return View::make('exam.create', compact('exams'));
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
        $exam = Exam::create($params);

        if ($exam){
            $sendEmail = $this->checkSendEmail($request->get('users_id'));
            if ($sendEmail === true) {
                $correo = new ExamsMailable($exam, 'create');
                Mail::to($user->email)->send($correo);
            }
            return redirect('/exam');
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
        $selectedExam = Exam::find($id);
        $exams = $this->filteredExams();
        return View::make('exam.edit', compact('selectedExam'), compact('exams'));
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
        $exam = Exam::find($id);
        $user = User::find($request->get('users_id'));

        $exam->users_id = $request->get('users_id');
        $exam->subjects_id = $request->get('subjects_id');
        $exam->name = $request->get('name');
        $exam->mark = $request->get('mark');

        if ($exam->save()){
            $sendEmail = $this->checkSendEmail($request->get('users_id'));
            if ($sendEmail === true){
                $correo = new ExamsMailable($exam, 'edit');
                Mail::to($user->email)->send($correo);
            }
            return redirect('/exam');
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
        $exam = Exam::find($id);
        $exam->delete($id);
        return redirect('/exam');
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
            return $notification->exam == 1 ? true : false;
        }
    }
}
