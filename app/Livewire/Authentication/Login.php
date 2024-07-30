<?php

namespace App\Livewire\Authentication;

use App\Models\User;
use Livewire\Component;

class Login extends Component
{
    public $login_text_btn;
    public $login_as;
    public $login_route;

    function mount()
    {
        $this->login_text_btn = User::STUDENT ?? null;
        $this->login_as = User::TEACHER ?? null;
        $this->login_route = route('teacher-login');
    }

    function SwitchLogin()
    {
        if ($this->login_text_btn == User::TEACHER) {
            // if we choosed to login as teacher we should replace the $login_as to be teacher and switch the text button to student
            $this->login_text_btn = User::STUDENT ?? null;
            $this->login_as = User::TEACHER ?? null;
            $this->login_route = route('teacher-login');
        } else {
            $this->login_text_btn = User::TEACHER ?? null;
            $this->login_as = User::STUDENT ?? null;
            $this->login_route = route('student-login');
        }
    }
    public function render()
    {
        return view('livewire.authentication.login');
    }
}
