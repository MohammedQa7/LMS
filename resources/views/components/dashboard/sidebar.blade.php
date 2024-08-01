<div>


    <aside  id="sidebar-multi-level-sidebar"
        class="fixed top-0 left-0 rtl:right-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 "
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{URL('/dashboard')}}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ms-3"> {{ trans('sidebar-trans.Dashboard') }}</span>
                    </a>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            fill="#000000" height="200px" width="200px" version="1.1" id="Layer_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 299.97 299.97" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <g>
                                        <g>
                                            <path
                                                d="M149.985,126.898c34.986,0,63.449-28.463,63.449-63.449C213.435,28.463,184.971,0,149.985,0S86.536,28.463,86.536,63.449 C86.536,98.436,114.999,126.898,149.985,126.898z M149.985,15.15c26.633,0,48.299,21.667,48.299,48.299 s-21.667,48.299-48.299,48.299s-48.299-21.667-48.299-48.299S123.353,15.15,149.985,15.15z">
                                            </path>
                                            <path
                                                d="M255.957,271.919l-20.807-86.313c-2.469-10.244-11.553-17.399-22.093-17.399c-13.216,0-114.332,0-126.145,0 c-10.538,0-19.623,7.155-22.093,17.399l-20.807,86.313c-3.444,14.289,7.377,28.051,22.093,28.051h167.76 C248.563,299.97,259.407,286.229,255.957,271.919z M66.105,284.82c-4.898,0-8.513-4.581-7.364-9.35l20.807-86.314 c0.823-3.415,3.851-5.799,7.365-5.799H121.4l-9.553,67.577c-0.283,2,0.244,4.029,1.464,5.637l21.422,28.249H66.105z M127.291,249.932l9.411-66.574h26.567l9.411,66.574l-22.695,29.927L127.291,249.932z M233.865,284.82h-68.628l21.421-28.248 c1.22-1.609,1.747-3.638,1.464-5.637l-9.553-67.577h34.487c3.513,0,6.542,2.385,7.365,5.8l20.807,86.313 C242.377,280.235,238.769,284.82,233.865,284.82z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ trans('sidebar-trans.Teachers') }}</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-example" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ URL('/teacher') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ trans('sidebar-trans.List-of-all-teachers')}}</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="student-dropdown" data-collapse-toggle="student-dropdown">
                        <svg class="flex-shrink-0 w-6 h-6  text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve"
                            fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <line style="fill:none;stroke:#000000;stroke-width:2;stroke-miterlimit:10;"
                                    x1="3" y1="13" x2="3" y2="24"></line>
                                <circle cx="3" cy="24" r="2"></circle>
                                <polygon style="fill:none;stroke:#000000;stroke-width:2;stroke-miterlimit:10;"
                                    points="16,8.833 3.5,13 16,17.167 28.5,13 "></polygon>
                                <path style="fill:none;stroke:#000000;stroke-width:2;stroke-miterlimit:10;"
                                    d="M7,14.451V20c0,1.657,4.029,3,9,3s9-1.343,9-3 v-5.549"></path>
                            </g>
                        </svg>

                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ trans('sidebar-trans.Students') }}</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="student-dropdown" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ URL('/student') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ trans('sidebar-trans.List-of-all-students') }}</a>
                        </li>
                    </ul>
                </li>

                @role('teacher')
                <x-dashboard.teacher-side-bar></x-dashboard.teacher-side-bar>
                @endrole
                
                @role('student')
                <x-dashboard.student-side-bar></x-dashboard.student-side-bar>
                @endrole


                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="section-dropdown" data-collapse-toggle="section-dropdown">
                        <svg class="w-6 h-6" fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M21,2H3A1,1,0,0,0,2,3V21a1,1,0,0,0,1,1H21a1,1,0,0,0,1-1V3A1,1,0,0,0,21,2ZM8,20H4V10H8Zm6,0H10V10h4Zm6,0H16V10h4ZM20,8H4V4H20Z">
                                </path>
                            </g>
                        </svg>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ trans('sidebar-trans.Sections') }}</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="section-dropdown" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ URL('/section') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ trans('sidebar-trans.List-of-all-sections') }}</a>
                        </li>
                    </ul>
                </li>


                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="subject-dropdown" data-collapse-toggle="subject-dropdown">
                        <svg class="w-6 h-6" fill="#000000" height="200px" width="200px" version="1.1"
                            id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 298.489 298.489"
                            xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <g>
                                        <g>
                                            <path
                                                d="M292.114,197.387h-23.559V52.302c0-3.522-2.853-6.375-6.375-6.375H36.309c-3.521,0-6.375,2.853-6.375,6.375v145.085 H6.375c-3.521,0-6.375,2.853-6.375,6.375v42.425c0,3.522,2.854,6.375,6.375,6.375h285.739c3.522,0,6.375-2.853,6.375-6.375 v-42.425C298.489,200.24,295.636,197.387,292.114,197.387z M42.684,58.677h213.121v138.71H42.684V58.677z M285.739,239.812H12.75 v-29.675c4.069,0,270.478,0,272.989,0V239.812z">
                                            </path>
                                            <path
                                                d="M225.049,92.075h-97.066c-2.564,0-4.877,1.536-5.873,3.897l-18.794,44.547l-6.355-16.635 c-0.944-2.468-3.313-4.1-5.955-4.1H73.441c-3.521,0-6.375,2.853-6.375,6.375c0,3.522,2.854,6.375,6.375,6.375h13.175 l10.452,27.356c2.044,5.351,9.592,5.505,11.829,0.202l23.316-55.268h92.836c3.522,0,6.375-2.853,6.375-6.375 C231.424,94.929,228.569,92.075,225.049,92.075z">
                                            </path>
                                            <path
                                                d="M188.431,123.749c-2.49-2.489-6.526-2.489-9.016,0l-8.209,8.209l-8.209-8.209c-2.491-2.489-6.526-2.489-9.016,0 c-2.49,2.49-2.49,6.526,0,9.016l8.209,8.209l-8.209,8.209c-2.49,2.49-2.49,6.526,0,9.016c2.491,2.49,6.526,2.489,9.016,0 l8.209-8.209l8.209,8.209c2.491,2.49,6.526,2.489,9.016,0c2.49-2.49,2.49-6.526,0-9.016l-8.209-8.209l8.209-8.209 C190.921,130.275,190.921,126.239,188.431,123.749z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ trans('sidebar-trans.Subjects') }}</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="subject-dropdown" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ URL('/subject') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ trans('sidebar-trans.List-of-all-subjects') }}</a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                        <span
                            class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
                    </a>
                </li>

            </ul>
        </div>
    </aside>
</div>
