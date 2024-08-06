<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Material;
use App\Models\TeacherTeachingSubject;
use App\Policies\MaterialPolicy;
use App\Policies\TeacherLevelAndClasses;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Material::class => MaterialPolicy::class,
        TeacherTeachingSubject::class => TeacherLevelAndClasses::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
