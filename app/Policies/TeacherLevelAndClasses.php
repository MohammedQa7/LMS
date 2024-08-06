<?php

namespace App\Policies;

use App\Models\TeacherTeachingSubject;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TeacherLevelAndClasses
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
    public function view(User $user, TeacherTeachingSubject $teacherTeachingSubject = null): bool
    {
        if ($user->isStudent()) {
            return true;
        } else if (is_null($teacherTeachingSubject)) {
            abort(403);
        } else {
            return ($user->id == $teacherTeachingSubject->user_id && $user->hasRole('teacher') || $user->hasRole('adminstrator'));
        }
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
    public function update(User $user, TeacherTeachingSubject $teacherTeachingSubject): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TeacherTeachingSubject $teacherTeachingSubject): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TeacherTeachingSubject $teacherTeachingSubject): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TeacherTeachingSubject $teacherTeachingSubject): bool
    {
        //
    }
}