<?php

namespace App\Livewire\Section;

use App\Models\Level;
use App\Models\Section;
use Filament\Notifications\Notification;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SectionFormComponent extends Component
{
    public $all_levels = [];
    public $section;
    public $actionType;
    #[Validate('required|exists:levels,id')]
    public $selected_level;
    #[Validate('required|min:5')]
    public $name_ar;
    #[Validate('required|min:5')]
    public $name_en;
    #[Validate('required|min:5')]
    public $slug_ar;
    #[Validate('required|min:5')]
    public $slug_en;

    public function mount($section = null)
    {
        if (!is_null($section)) {
            $this->selected_level = $this->section->level->id;
            $this->name_ar = Section::gettingDataForEdit($section , 'name' , 'ar');
            $this->name_en = Section::gettingDataForEdit($section , 'name' , 'en');
            $this->slug_ar = Section::gettingDataForEdit($section , 'slug' , 'ar');
            $this->slug_en = Section::gettingDataForEdit($section , 'slug' , 'en');
        }
        $this->all_levels = Level::get();
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
        $section = Section::create([
            'name' => [
                'ar' => $this->name_ar,
                'en' => $this->name_en,
            ],
            'slug' => [
                'ar' => $this->slug_ar,
                'en' => $this->slug_en,
            ],

            'level_id' => $this->selected_level
        ]);

        if ($section) {
            $this->reset();
        } else {
            dd('fail to create section');
        }
    }

    public function update()
    {
        if (!is_null($this->section)) {
            $updated_level = $this->section->update([
                'name' => [
                    'ar' => $this->name_ar,
                    'en' => $this->name_en
                ],
                'slug' => [
                    'ar' => $this->slug_ar,
                    'en' => $this->slug_en
                ],
                'level_id' => $this->selected_level
            ]);
            if ($updated_level) {
                Notification::make()
                ->title('Saved successfully')
                ->success()
                ->body('Changes to the Class have been saved.')
                ->duration(5000)
                ->send();
            }else{
                Notification::make()
                ->title('Something went wrong')
                ->color('danger')
                ->danger()
                ->iconColor('success')
                ->duration(5000)
                ->send();
            }
        }
    }

    public function render()
    {

        return view('livewire.section.section-form-component');
    }
}