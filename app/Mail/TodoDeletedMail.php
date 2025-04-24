<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ToDo;

class ToDoDeletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $todo;

    public function __construct(ToDo $todo)
    {
        $this->todo = $todo;
    }

    public function build()
    {
        return $this->subject('Your ToDo has been deleted')
                    ->markdown('emails.todos.deleted');
    }
}
