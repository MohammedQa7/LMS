<?php

namespace App\Livewire\Class;
use Livewire\WithFileUploads;

use App\Models\Classes;
use App\Models\Level;
use App\Models\Section;
use Exception;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ClassFormComponent extends Component
{

    public $all_sections = [];
    public $actionType;
    #[Validate('required|exists:sections,id')]
    public $selected_section;
    #[Validate('required|min:3')]
    public $name_ar;
    #[Validate('required|min:3')]
    public $name_en;
    #[Validate('required|min:3')]
    public $slug_ar;
    #[Validate('required|min:3')]
    public $slug_en;

    //this is the passed class from the controller to the component;
    public $class;
    public function mount($class = null)
    {
        if (!is_null($class)) {
            $this->selected_section = $this->class->sections->id;
            $this->name_ar = Classes::gettingDataForEdit($class , 'name' , 'ar');
            $this->name_en = Classes::gettingDataForEdit($class , 'name' , 'en');
            $this->slug_ar = Classes::gettingDataForEdit($class , 'slug' , 'ar');
            $this->slug_en = Classes::gettingDataForEdit($class , 'slug' , 'en');
        }

        $this->all_sections = Section::get();

    }
    public function updated($property)
    {
        // $property: The name of the current property that was updated
        if ($property === 'name_ar') {
            $this->slug_ar = preg_replace('/[\/ ]/u', '-', $this->name_ar);

        } elseif ($property === 'name_en') {
            $this->slug_en = preg_replace('/[\/ ]/u', '-', $this->name_en);
        }

    }

    public function save()
    {
        $this->validate();
        $class = Classes::create([
            'name' => [
                'ar' => $this->name_ar,
                'en' => $this->name_en,
            ],
            'slug' => [
                'ar' => $this->slug_ar,
                'en' => $this->slug_en,
            ],

            'section_id' => $this->selected_section
        ]);
        if ($class) {
            $this->reset('name_ar', 'name_en', 'slug_ar', 'slug_en');
            // dd($level);
        } else {
            dd('fail to create level');
        }
    }

    public function update()
    {
        if (!is_null($this->class)) {
            $updated_class = $this->class->update([
                'name' => [
                    'ar' => $this->name_ar,
                    'en' => $this->name_en,
                ],
                'slug' => [
                    'ar' => $this->slug_ar,
                    'en' => $this->slug_en,
                ],
            ]);
            if ($updated_class) {
            } else {
                dd('fail to update class');
            }
        }
    }

    public function render()
    {
        return view('livewire.class.class-form-component');
    }
}
