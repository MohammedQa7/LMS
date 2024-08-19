<div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
    <ul class="space-y-2 font-medium">
        <li>
            <a href="{{ route('student-portal.index') }}"
                class="flex items-center p-2  text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                    <path
                        d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                    <path
                        d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                </svg>
                <span class="ms-3"> {{ trans('sidebar-trans.Dashboard') }}</span>
            </a>
        </li>

        <li>
            <a href="{{ URL('/dashboard') }}"
                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    fill="#6b727f" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg" stroke="#6b727f">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M219.03 0v464.314h-56.515c-31.196 0-56.515 25.299-56.515 56.47 0 31.172 25.319 56.47 56.515 56.47h56.514v338.824h-56.514c-31.196 0-56.515 25.3-56.515 56.471 0 31.172 25.319 56.47 56.515 56.47h56.514v338.824h-56.514c-31.196 0-56.515 25.299-56.515 56.47 0 31.172 25.319 56.471 56.515 56.471h56.514V1920h1582.412V0H219.03Zm960.578 338.824v112.94H671.373v677.648h677.647V734.118h112.94v508.235H558.432v-903.53h621.177Zm207.326 75.817 79.85 79.85-432.452 432.451-224.866-224.979 79.85-79.85 145.016 145.13 352.602-352.602Z"
                            fill-rule="evenodd"></path>
                    </g>
                </svg>
                <span class="ms-3"> {{ trans('sidebar-trans.Grades') }}</span>
            </a>
        </li>
    </ul>
</div>
