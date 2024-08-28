<div>
    <div class="relative sm:rounded-lg pt-5">
        <div class=" mb-4 bg-white dark:bg-gray-900 flex justify-between items-center">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative mt-1">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="table-search"
                    class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for items">
            </div>


            <div x-data="{ isOpen: false, openedWithKeyboard: false }" @keydown.esc.window="isOpen = false, openedWithKeyboard = false" <!-- Toggle
                Button -->
                <button type="button" @click="isOpen = ! isOpen" @keydown.space.prevent="openedWithKeyboard = true"
                    @keydown.enter.prevent="openedWithKeyboard = true" @keydown.down.prevent="openedWithKeyboard = true"
                    class="inline-flex cursor-pointer items-center gap-2 whitespace-nowrap rounded-xl border border-slate-300 bg-slate-100 px-4 py-2 text-sm font-medium tracking-wide transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-800 dark:border-slate-700 dark:bg-slate-800 dark:focus-visible:outline-slate-300"
                    :class="isOpen || openedWithKeyboard ? 'text-black dark:text-white' :
                        'text-slate-700 dark:text-slate-300'"
                    :aria-expanded="isOpen || openedWithKeyboard" aria-haspopup="true">
                    Actions
                    <svg aria-hidden="true" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" class="h-4 w-4 rotate-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <!-- Dropdown Menu -->
                <div x-cloak x-show="isOpen || openedWithKeyboard" x-transition x-trap="openedWithKeyboard"
                    @click.outside="isOpen = false, openedWithKeyboard = false"
                    @keydown.down.prevent="$focus.wrap().next()" @keydown.up.prevent="$focus.wrap().previous()"
                    style="display:none;"
                    class="absolute z-50 right-0 mt-2 flex min-w-[12rem] flex-col divide-y divide-slate-300 overflow-hidden rounded-xl border border-slate-300 bg-slate-100 dark:divide-slate-700 dark:border-slate-700 dark:bg-slate-800"
                    role="menu">
                    <!-- Dropdown Section -->
                    <div class="flex flex-col gap-3 py-1.5">
                        <div x-data="{ modelOpen: false }" class="create-btn">
                            <a @click="modelOpen =!modelOpen,  $dispatch('Change',{'form' : 'roles'})""
                                class="w-full text-black inline-flex items-center px-3 py-2 text-sm font-medium text-center  focus:ring-4 focus:ring-primary-300 dark:text-white dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 hover:bg-gray-200 cursor-pointer">
                                <svg class="w-6 h-6 me-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                                {{ trans('generalTrans.PageTitle.new-roles') }}
                            </a>
                            <x-dashboard.modals.RolesModal></x-dashboard.modals.RolesModal>
                        </div>

                        {{-- CANCELED --}}
                        <div x-data="{ modelOpen: false }" class="create-btn w-full">
                            <a @click="modelOpen =!modelOpen, $dispatch('Change',{'form' : 'permissions'})"
                                class="w-full text-black inline-flex items-center px-3 py-2 text-sm font-medium text-center  focus:ring-4 focus:ring-primary-300 dark:text-white dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 hover:bg-gray-200 cursor-pointer">
                                <svg class="w-6 h-6 me-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                                {{ trans('generalTrans.PageTitle.assign-permission') }}
                            </a>
                            <x-dashboard.modals.PermissionsModal></x-dashboard.modals.PermissionsModal>
                        </div>
                        {{-- ----------- --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="border rounded-lg shadow overflow-hidden dark:border-neutral-700 dark:shadow-gray-900">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        role name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Associated User</th>

                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Permissions</th>

                                    {{-- CANCELED --}}
                                    {{-- <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Permissions not associated with roles</th> --}}
                                    <th scope="col"
                                        class=" px-6 py-3 text-start  text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                        Created at</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y  divide-gray-200 dark:divide-neutral-700">
                                @if (sizeof($this->RoleAndPermissions) > 0)
                                    @foreach ($this->RoleAndPermissions as $single_role)
                                        <tr class="hover:bg-gray-100">
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                {{ $single_role->name }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                <ul style="list-style-type: circle">
                                                    @if ($single_role->users)
                                                        @foreach ($single_role->users as $single_user)
                                                            <li>{{ $single_user->name }}</li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </td>

                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                <ul style="list-style-type: circle">
                                                    @if ($single_role->permissions)
                                                        @foreach ($single_role->permissions as $single_permission)
                                                            <li class="flex items-center gap-2">
                                                                {{ $single_permission->name }}
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </td>


                                            {{-- CANCELED --}}

                                            {{-- <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                <ul style="list-style-type: circle">
                                                    @if ($single_role->users)
                                                        @foreach ($single_role->users as $single_user)
                                                            @foreach ($single_user->permissions as $single_permission)
                                                                <li x-data="{ modelOpen: false }"
                                                                    class="flex items-center gap-2">
                                                                    {{ $single_permission->name }}
                                                                    @if (sizeof($single_role->permissions) > 1)
                                                                        <svg @click="modelOpen =!modelOpen"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke-width="1.5" stroke="currentColor"
                                                                            class="size-5 text-red-600 cursor-pointer">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
                                                                                d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                        </svg>
                                                                        </svg>
                                                                     
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </td> --}}


                                            <td
                                                class="px-6 py-4  whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                {{ $single_role->created_at->diffForHumans() }}</td>


                                            <td x-data="{ modelOpen: false }"
                                                class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                {{$single_role->id}}
                                                <button
                                                    wire:click.prevent="OpenEditRoleModal({{$single_role->id}} , {{$single_role->permissions}})"
                                                    type="button"
                                                    class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">Edit</button>

                                                <x-dashboard.roles.edit-role :role_id='$single_role->id' :permissions='$single_role->permissions'
                                                    name="editModal-{{ $single_role->id }}"></x-dashboard.roles.edit-role>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                <button type="button"
                                                    class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            No Roles Were Found</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- <x-DeleteModal :permission='$single_permission->id'
    :user='$single_user->id'></x-DeleteModal> --}}
