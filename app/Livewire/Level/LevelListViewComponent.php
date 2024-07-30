<?php

namespace App\Livewire\Level;

use App\Models\Level;
use Livewire\Attributes\Computed;
use Livewire\Component;

class LevelListViewComponent extends Component
{
    public $selected_tab = '';
    public function mount()
    {
        $this->selected_tab = Level::first()->name ?? null;
    }

    #[Computed]
    public function Levels()
    {
        $level = Level::get();
        return $level;
    }

    public function SelectTab($tab)
    {
        if (!is_null($tab)) {
            $this->selected_tab = $tab;
        }
    }

    public function delete($slug)
    {
        if (!is_null($slug)) {
            $level = Level::GetLevelBySlug($slug)->first();
            if ($level) {
                $level->delete();
            } else {
                dd('fail');
            }
        }
    }

    public function render()
    {
        return view('livewire.level.level-list-view-component');
    }
}