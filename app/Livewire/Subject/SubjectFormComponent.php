<?php

namespace App\Livewire\Subject;

use App\Models\Level;
use App\Models\Subject;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SubjectFormComponent extends Component
{
    public $all_levels = [];
    public $subject;
    public $actionType;
    public $old_selected_level;

    #[Validate('required|exists:levels,id')]
    public $selected_level = [];

    #[Validate('required|min:3')]
    public $name_ar;
    #[Validate('required|min:3')]
    public $name_en;
    #[Validate('required|min:3')]
    public $slug_ar;
    #[Validate('required|min:3')]
    public $slug_en;


    public function mount($subject = null)
    {
        if (!is_null($subject)) {
            $this->old_selected_level = $subject->level;
            // dd($this->selected_level);
            $this->name_ar = Subject::gettingDataForEdit($subject, 'name', 'ar');
            $this->name_en = Subject::gettingDataForEdit($subject, 'name', 'en');
            $this->slug_ar = Subject::gettingDataForEdit($subject, 'slug', 'ar');
            $this->slug_en = Subject::gettingDataForEdit($subject, 'slug', 'en');
        }
        $this->all_levels =  Level::get();
        if ($this->old_selected_level) {
            $this->all_levels = $this->all_levels->diff($this->old_selected_level);
        }
    }
    public function updated($property)
    {
        // $property: The name of the current property that was updated
        if ($property === 'name_ar') {
            $this->slug_ar = preg_replace('/\s+/u', '-', $this->name_ar);
        } elseif ($property === 'name_en') {
            $this->slug_en = preg_replace('/\s+/u', '-', $this->name_en);
        }
    }



    public function save()
    {
        $this->validate();
        $subject = Subject::create([
            'name' => [
                'ar' => $this->name_ar,
                'en' => $this->name_en,
            ],
            'slug' => [
                'ar' => $this->slug_ar,
                'en' => $this->slug_en,
            ],
        ]);

        if ($subject) {
            foreach ($this->selected_level as $single_level) {
                $subject->level()->attach((int) $single_level);
            }
            $this->reset(['name_ar', 'name_en', 'slug_ar', 'slug_en']);
        } else {
            dd('fail to create subject');
        }
    }

    public function update()
    {
        if (!is_null($this->subject)) {
            $updated_subject = $this->subject->update([
                'name' => [
                    'ar' => $this->name_ar,
                    'en' => $this->name_en
                ],
                'slug' => [
                    'ar' => $this->slug_ar,
                    'en' => $this->slug_en
                ],

            ]);
            if ($updated_subject) {
                if (sizeof($this->selected_level) > 0) {
                    foreach ($this->selected_level as $single_level) {
                        $this->subject->level()->attach($single_level);
                    }
                }
                $this->reset(['name_ar', 'name_en', 'slug_ar', 'slug_en', 'selected_level']);
            } else {
                dd('fail to update level');
            }
        }
    }

    function removeSelectedLevel($level_id)
    {
        if ($level_id) {
            $this->subject->level()->detach($level_id);
        }
    }
    public function render()
    {
        return view('livewire.subject.subject-form-component');
    }
}
