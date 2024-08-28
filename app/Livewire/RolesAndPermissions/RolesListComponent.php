<?php

namespace App\Livewire\RolesAndPermissions;

use App\Helpers\globalFunctionsHelper;
use App\Models\User;
use App\Services\RolesService;
use App\Traits\NotificationTrait;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use IntlRuleBasedBreakIterator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use RoleAlreadyExists;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesListComponent extends Component implements HasForms
{

    use NotificationTrait;
    use InteractsWithForms;

    public ?array $data = [];

    protected RolesService $rolesService;
    public $form_type;
    public $edit_role_data = null;

    // gettint all the permissions on the edit roles pages
    // so when the user wants to change the current permissions all the permissions will be pre-loaded
    public $all_permissions = [];
    public $new_selected_permissions = [];
    function mount(RolesService $rolesService)
    {
        $this->rolesService = $rolesService;
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        $rolesService = new rolesService;
        $this->rolesService = $rolesService;
        if ($this->form_type == 'roles') {
            return $this->rolesService->rolesForm($form);
        } elseif ($this->form_type == 'permissions') {
            return $this->rolesService->permissionsForm($form);
        }
        return $this->rolesService->rolesForm($form);
    }

    /* CANCELED FOR NOW */
    #[On('Change')]
    function FormChanged($form)
    {
        $this->form_type = $form;
    }

    function submit()
    {
        $data = $this->form->getState();
        try {
            DB::beginTransaction();
            $role = Role::create(['name' => $data['role_name']]);
            $user = User::where('id', $data['user_id'])->first();
            $user->assignRole($role);

            foreach ($data['permission_name'] as $single_permissions) {
                $permission = Permission::where('id', $single_permissions)->first();
                if ($permission) {
                    $permission->assignRole($role);
                }
            }

            DB::commit();
            $this->form->fill([]);
            $this->dispatch('close-modal');
            $this->success('successfully assinged user and role & permissions creation', 'heroicon-o-check-circle', 2000);
        } catch (\Spatie\Permission\Exceptions\RoleAlreadyExists $th) {
            DB::rollBack();
            $this->form->fill([]);
            $this->dispatch('close-modal');
            $this->success('Role already exists, please choose another name name ', 'heroicon-o-x-circle', 3200);
        }
    }

    function assignePermission()
    {

        $data = $this->form->getState();
        try {
            DB::beginTransaction();
            $role = Role::where('id', $data['role_name'])->first();

            foreach ($data['permission_name'] as $single_permissions) {
                $permission = Permission::where('id', $single_permissions)->first();
                if ($permission) {
                    $role->givePermissionTo($permission->name);
                }
            }
            DB::commit();
            $this->form->fill([]);
            $this->dispatch('close-modal');
            $this->success('successfully assinged permissions to the roles', 'heroicon-o-check-circle', 2000);
        } catch (\Spatie\Permission\Exceptions\RoleAlreadyExists $th) {
            DB::rollBack();
            $this->form->fill([]);
            $this->dispatch('close-modal');
            $this->success('Role already exists, please choose another name', 'heroicon-o-x-circle', 3200);
        }
    }

    #[Computed]
    function RoleAndPermissions()
    {
        $role_permissions = Role::
        whereNot(function($query){
            $query->where('name' , User::STUDENT);
            $query->orWhere('name' , User::TEACHER);
            $query->orWhere('name' , User::ADMINISTRATOR);
        })
        ->with('permissions', 'users')->get();
        return $role_permissions;
    }

    function OpenEditRoleModal($role_id, $current_permissions)
    {
        // reseting the data in case the data was still presist in other operations.
        $this->all_permissions = [];
        $this->new_selected_permissions = [];
        /* initate an array with permissions id as keys with a value of null , 
         so when the user selects the new permission we can know the old permission and replace it with the new one
         */
        if ($current_permissions) {
            foreach ($current_permissions as $single_permission) {
                $this->new_selected_permissions[$single_permission['id']] = null;
            }
        }
        $permissions = Permission::get();
        $this->all_permissions = $permissions;
        $this->dispatch('open-modal', name: 'editModal-' . $role_id);
    }

    function RevokePermission($role_id, $permission_id)
    {
        if ($role_id && $permission_id) {
            $object_containe_permission = Role::where('id', $role_id)->first();
            $permission = Permission::where('id', $permission_id)->first();
        }

        if ($object_containe_permission) {
            $object_containe_permission->revokePermissionTo($permission);
            $this->success('Permission revoked successfully', null, 2000);
            // $this->dispatch('close-modal');
        } else {
            $this->failed('Something went wrong while revoking the permission from the user', null, 3200);
            $this->dispatch('close-modal');
        }
    }
    public function render()
    {
        return view('livewire.roles-and-permissions.roles-list-component');
    }
}