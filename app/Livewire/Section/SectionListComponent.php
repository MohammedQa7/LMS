<?php

namespace App\Livewire\Section;

use App\Models\Level;
use App\Models\Section;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SectionListComponent extends Component
{

    #[Computed]
    public function Sections()
    {
        $section = Section::with('level')->get();
        return $section;
    }


    public function delete($slug)
    {
        if (!is_null($slug)) {
            $section = Section::getSectionBySlug($slug)->first();
            if ($section) {
                $section->delete();
            } else {
                dd('fail');
            }
        }
    }

    public function render()
    {
        return view('livewire.section.section-list-component');
    }
}