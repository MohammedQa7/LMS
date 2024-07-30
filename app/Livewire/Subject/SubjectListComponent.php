<?php

namespace App\Livewire\Subject;

use App\Models\Subject;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubjectListComponent extends Component
{


    #[Computed()]
    public function Subjects()
    {
        $subject = Subject::with('level')->get();
        return $subject;
    }


    public function delete($slug)
    {
        if (!is_null($slug)) {
            $subject = Subject::GetSubjectBySlug($slug)->first();
            if ($subject) {
                $subject->delete();
            } else {
                dd('fail');
            }
        }
    }

    public function render()
    {
        return view('livewire.subject.subject-list-component');
    }
}
