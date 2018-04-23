<?php

namespace App\Mail;
use Illuminate\Mail\Mailable;

class ConcursoMail extends Mailable
{
    public function build() {
        return $this->view("mail.nuevo_concurso");
    }

}