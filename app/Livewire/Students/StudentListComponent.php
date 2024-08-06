<?php

namespace App\Livewire\Students;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;

class StudentListComponent extends Component
{
    #[Computed]
    function Students()
    {
        $students = User::role('student')->with('studentLevelWithClasses.level' ,'studentLevelWithClasses.class')->paginate(5);
        return $students;
    }
    public function render()
    {
        return view('livewire.students.student-list-component');
    }
}
