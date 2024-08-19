<?php

namespace App\Traits;

use Filament\Notifications\Notification;

trait NotificationTrait
{


    function success($title, $icon = null, $duration = null)
    {
        return Notification::make()
            ->title($title)
            ->success()
            ->color('success')
            ->icon($icon ?? '')
            ->duration($duration ?? '')
            ->send();
    }

    function failed($title, $icon = null, $duration = null)
    {

        return Notification::make()
            ->title($title)
            ->danger()
            ->color('danger')
            ->icon($icon ?? '')
            ->duration($duration ?? '')
            ->send();

    }

}