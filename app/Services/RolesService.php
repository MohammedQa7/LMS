<?php

namespace App\Services;

use App\Helpers\globalFunctionsHelper;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesService
{

    public function rolesForm(Form $form): Form
    {

        return $form
            ->schema([
                TextInput::make('role_name')
                    ->label(trans('subject-content-modal.role-name'))
                    ->rules([
                        'required',
                        Rule::unique('roles', 'name')
                    ]),
                Select::make('permission_name')
                    ->label(trans('subject-content-modal.permissions-name'))
                    ->options(
                        Permission::get()->pluck('name', 'id')
                    )
                    ->multiple()
                    ->native(false)
                    ->searchable()
                    ->required(),
                Select::make('user_id')
                    ->options([
                        'Teachers' => User::role('teacher')->get()->pluck('email', 'id')->toArray(),
                        'Students' => User::role('student')->get()->pluck('email', 'id')->toArray(),
                    ])
                    ->label('Select User')
                    ->placeholder('Select a user')
                    ->searchable()
                    ->native(false)
                    ->required()
                    ->columnSpanFull(),
            ])
            ->columns(2)
            ->statePath('data');
    }

    public function permissionsForm(Form $form): Form
    {

        return $form
            ->schema([
                Select::make('role_name')
                    ->label(trans('subject-content-modal.role-name'))
                    ->options(
                        Role::whereHas('permissions')->get()->pluck('name', 'id')
                    )
                    ->native(false)
                    ->searchable()
                    ->required(),
                Select::make('permission_name')
                    ->label(trans('subject-content-modal.permissions-name'))
                    ->options(
                        Permission::get()->pluck('name', 'id')
                    )
                    ->multiple()
                    ->native(false)
                    ->searchable()
                    ->required(),
            ])
            ->columns(2)
            ->statePath('data');
    }

}