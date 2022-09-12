<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\Percentage;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Models\Work;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use JeroenNoten\LaravelAdminLte\View\Components\Widget\Alert;
use Ramsey\Uuid\Type\Integer;

class ExpedientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $expedients = [];
        $workTotalMark = 0;
        $examTotalMark = 0;
        $courseId = 0;
        $loggedUser = Auth::user()->id;
        $enrollments = Enrollment::where('users_id', $loggedUser);

        foreach ($enrollments->get('courses_id') as $enrollment) {
            $subject = Subject::where('courses_id', $enrollment->courses_id);
            $course = Course::where('id', $enrollment->courses_id);
            $work = Work::where('users_id', $loggedUser);
            $exam = Exam::where('users_id', $loggedUser);
            $percentage = Percentage::where('courses_id', $enrollment->courses_id);

            $workPercentage = $percentage->value('continuous_assessment');
            $examPercentage = $percentage->value('exams');

            $workMark = $work->value('mark') * $workPercentage / 100;
            $examMark = $exam->value('mark') * $examPercentage / 100;
            $total    = $workMark + $examMark;

            if (!empty($subject)) {
                $expedients[] = [
                    'course'   => $course->value('name'),
                    'subject'  => $subject->value('name'),
                    'workName' => $work->value('name'),
                    'workMark' => $work->value('mark'),
                    'examName' => $exam->value('name'),
                    'examMark' => $exam->value('mark'),
                    'workCA'   => $workMark,
                    'examCA'   => $examMark,
                    'totalCA'  => $total
                ];
            }
        }

        return View::make('expedient.index', compact('expedients'));
    }
}
