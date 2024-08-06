<?php

namespace App\Policies;

use App\Models\Classes;
use App\Models\Level;
use App\Models\Material;
use App\Models\TeacherTeachingSubject;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MaterialPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Material $material): bool
    {

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Material $material): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {

    }

    public function createMaterial(User $user, $class_id, $subject_id): bool
    {
        // makeing sure that teacher can only access classes that he was assigned to 
        $teacher_level_and_classes = TeacherTeachingSubject::where('class_id', $class_id)->where('subject_id', $subject_id)->first();
        return ($user->hasRole('adminstrator') ||  $user->id == $teacher_level_and_classes->user_id);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Material $material): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Material $material): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Material $material): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Material $material): bool
    {
        //
    }
}