<?php

namespace App\Livewire\Class;

use App\Models\Classes;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Validator;

class ClassListComponent extends Component
{
    use WithPagination;
    #[Computed]
    function Classes()
    {
        $classes = Classes::with('sections')->paginate(5);
        return $classes;
    }


    public function delete($slug)
    {
        if (!is_null($slug)) {
            $class = Classes::getClassBySlug($slug)->first();

            if ($class) {
                $class->delete();
            } else {
                dd('fail');
            }
        }
    }
    public function render()
    {
        return view('livewire.class.class-list-component');
    }
}
