<?php

namespace App\Mail;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExamsMailable extends Mailable
{
    use Queueable, SerializesModels;

    protected Exam $exam;
    protected String $template;
    public $subject = "Nota del examen";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Exam $exam, String $template)
    {
        $this->exam = $exam;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.exams.'.$this->template)->with([
            'exam' => $this->exam
        ]);
    }
}
