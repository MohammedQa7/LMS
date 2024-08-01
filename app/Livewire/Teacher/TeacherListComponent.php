<?php

namespace App\Livewire\Teacher;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class TeacherListComponent extends Component
{
    use WithPagination;

    #[Computed]
    function Teachers()
    {
        $teachers = User::with('levels' ,'classes' , 'subjects')->paginate(5);
        return $teachers;
    }
    public function render()
    {
        return view('livewire.teacher.teacher-list-component');
    }
}