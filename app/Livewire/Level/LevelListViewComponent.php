<?php

namespace App\Livewire\Level;

use App\Models\Level;
use App\Traits\NotificationTrait;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\LivewireFilepond\WithFilePond;

class LevelListViewComponent extends Component
{

    use NotificationTrait;
    #[Computed]
    public function Levels()
    {

        $level = Level::with('classes')->get();
        return $level;
    }

    public function delete($slug)
    {
        if (!is_null($slug)) {
            $level = Level::GetLevelBySlug($slug)->first();
            if ($level) {
                $level->delete();
                $this->success('Level Deleted Successfully');
            } else {
                $this->failed('Something went wrong while trying to delete level');
            }
        }
    }

    public function render()
    {
        return view('livewire.level.level-list-view-component');
    }
}