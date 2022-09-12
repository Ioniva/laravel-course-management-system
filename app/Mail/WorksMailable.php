<?php

namespace App\Mail;

use App\Models\Exam;
use App\Models\Work;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WorksMailable extends Mailable
{
    use Queueable, SerializesModels;

    protected Work $work;
    protected String $template;
    public $subject = "Nota de la tarea";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Work $work, String $template)
    {
        $this->work = $work;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.works.'.$this->template)->with([
            'work' => $this->work
        ]);
    }
}
