<?php

namespace App\Livewire\Level;

use App\Models\Level;
use App\Models\TeacherTeachingSubject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class TeacherLevelListComponent extends Component
{
    public $selected_tab = '';
    public function mount()
    {
        $this->selected_tab =
            Level::with('user')
                ->whereHas('user', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->first()->id ?? null;
    }
    #[Computed]
    function LevelTabs()
    {
        $level = Level::with('user')
            ->whereHas('user', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->get();
        return $level;
    }

    #[Computed]
    function TeacherLevels()
    {
        $level = TeacherTeachingSubject::with('class', 'subject')
            ->where('user_id', Auth::user()->id)
            ->where('level_id', $this->selected_tab)
            ->get();
        return $level;
    }

    public function SelectTab($tab)
    {
        if (!is_null($tab)) {
            $this->selected_tab = $tab;
        }
    }
    public function render()
    {
        return view('livewire.level.teacher-level-list-component');
    }
}