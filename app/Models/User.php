<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use HasTranslations;
    use HasRoles;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    //User Type
    const STUDENT = 'student';
    const TEACHER = 'Teacher';


    protected $guarded = [
        'id',
        'created_at',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public $translatable = ['name', 'gender', 'city', 'address'];

    function isStudent()
    {
        return Auth::user()->hasRole('student');
    }


    // Relationships
    function levels()
    {
        return $this->belongsToMany(Level::class, 'teacher_teaching_subjects', 'user_id', 'level_id');
    }

    function classes()
    {
        return $this->belongsToMany(Classes::class, 'teacher_teaching_subjects', 'user_id', 'class_id');
    }

    function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teacher_teaching_subjects', 'user_id', 'subject_id');
    }

    function studentLevelWithClasses()
    {
        return $this->hasOne(StudentClass::class, 'user_id');
    }

    function attendances()
    {
        return $this->hasMany(Attendance::class, 'user_id');
    }

    function chatAsUser()
    {
        return $this->hasMany(Chat::class, 'user_id');
    }

    function chatAsContact()
    {
        return $this->hasMany(Chat::class, 'contact_id');

    }
    function message()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
    //------

    // Scopes
    function scopeSearch($query , $search_query) {
        $query->where('name' , 'LIKE' , "%$search_query%")
        ->orWhere('email' , 'LIKE' , "%$search_query%");
    }
    //------
    public static function gettingDataForEdit($class, $field_name, $locale)
    {
        return $class->getTranslations($field_name)[$locale];
    }





}