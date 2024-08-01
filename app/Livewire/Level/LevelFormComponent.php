<?php

namespace App\Livewire\Level;

use App\Models\Level;
use Filament\Notifications\Notification;
use Livewire\Component;

class LevelFormComponent extends Component
{
    public $name_ar;
    public $name_en;
    public $slug_ar;
    public $slug_en;
    public $actionType;
    public $level;
    public function mount($level = null)
    {
        if (!is_null($level)) {
            $this->name_ar = Level::gettingDataForEdit($level , 'name' , 'ar');
            $this->name_en = Level::gettingDataForEdit($level , 'name' , 'en');
            $this->slug_ar = Level::gettingDataForEdit($level , 'slug' , 'ar');
            $this->slug_en = Level::gettingDataForEdit($level , 'slug' , 'en');
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
        $level = Level::create([
            'name' => [
                'ar' => $this->name_ar,
                'en' => $this->name_en
            ],
            'slug' => [
                'ar' => $this->slug_ar,
                'en' => $this->slug_en
            ],
        ]);
        if ($level) {
            $this->reset();
            // dd($level);
        } else {
            dd('fail to create level');
        }
    }
    public function update()
    {
        if (!is_null($this->level)) {
            $updated_level = $this->level->update([
                'name' => [
                    'ar' => $this->name_ar,
                    'en' => $this->name_en
                ],
                'slug' => [
                    'ar' => $this->slug_ar,
                    'en' => $this->slug_en
                ],
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
        return view('livewire.level.level-form-component');
    }
}