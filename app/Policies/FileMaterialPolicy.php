<?php

namespace App\Policies;

use App\Models\FileMaterial;
use App\Models\Material;
use App\Models\TeacherTeachingSubject;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FileMaterialPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FileMaterial $fileMaterial): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FileMaterial $fileMaterial): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FileMaterial $fileMaterial): bool
    {
        $material = Material::where('id', $fileMaterial->material_id)->first();
        return TeacherTeachingSubject::where('user_id', $user->id)
            ->where('class_id', $material->class_id)
            ->where('subject_id', $material->subject_id)->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FileMaterial $fileMaterial): bool
    {
        $material = Material::where('id', $fileMaterial->material_id)->first();
        return TeacherTeachingSubject::where('user_id', $user->id)
            ->where('class_id', $material->class_id)
            ->where('subject_id', $material->subject_id)->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FileMaterial $fileMaterial): bool
    {
        //
    }
}