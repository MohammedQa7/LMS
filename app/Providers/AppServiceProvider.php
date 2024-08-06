<?php

namespace App\Providers;

use App\Models\Material;
use App\Models\TeacherTeachingSubject;
use App\Models\User;
use App\Policies\MaterialPolicy;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate::define('view-materials' , function(User $user , TeacherTeachingSubject $material){
        //     dd('test');
        // });

        // gate that points to material policy (createMaterial Function)
        Gate::define('create-material', function (User $user , $class_id , $subject_id) {
            return app(MaterialPolicy::class)->createMaterial($user , $class_id , $subject_id);
        });


        Blade::component('notify-messages', \Mckenziearts\Notify\View\Components\NotifyMessages::class);
    }
}
