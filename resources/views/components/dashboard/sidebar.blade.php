<div>


    <aside id="sidebar-multi-level-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 "
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


                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="level-dropdown" data-collapse-toggle="level-dropdown">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M6.00001 2C6.00001 1.44772 6.44773 1 7.00001 1C7.5523 1 8.00001 1.44772 8.00001 2V5.14641C9.44326 5.57824 10.4951 6.91628 10.4951 8.50002C10.4951 10.0837 9.44326 11.4218 8.00001 11.8536V22C8.00001 22.5523 7.5523 23 7.00001 23C6.44773 23 6.00001 22.5523 6.00001 22V11.8565C4.55177 11.4278 3.49515 10.0873 3.49515 8.50002C3.49515 6.91273 4.55177 5.57223 6.00001 5.14351V2ZM6.99515 10.0049C6.16404 10.0049 5.49029 9.33113 5.49029 8.50002C5.49029 7.6689 6.16404 6.99515 6.99515 6.99515C7.82626 6.99515 8.50001 7.6689 8.50001 8.50002C8.50001 9.33113 7.82626 10.0049 6.99515 10.0049Z"
                                    fill="#0F0F0F"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M18 18.8565C19.4483 18.4278 20.5049 17.0873 20.5049 15.5C20.5049 13.9127 19.4483 12.5722 18 12.1435V2C18 1.44772 17.5523 1 17 1C16.4477 1 16 1.44772 16 2V12.1464C14.5568 12.5782 13.5049 13.9163 13.5049 15.5C13.5049 17.0837 14.5568 18.4218 16 18.8536V22C16 22.5523 16.4477 23 17 23C17.5523 23 18 22.5523 18 22V18.8565ZM17.0049 17.0049C16.1738 17.0049 15.5 16.3311 15.5 15.5C15.5 14.6689 16.1738 13.9951 17.0049 13.9951C17.836 13.9951 18.5097 14.6689 18.5097 15.5C18.5097 16.3311 17.836 17.0049 17.0049 17.0049Z"
                                    fill="#0F0F0F"></path>
                            </g>
                        </svg>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ trans('sidebar-trans.Levels') }}</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="level-dropdown" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ URL('/level/create') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ trans('sidebar-trans.Add-new-level') }}</a>
                        </li>

                        <li>
                            <a href="{{ URL('/level') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                {{ trans('sidebar-trans.List-of-all-levels') }}</a>
                        </li>
                    </ul>
                </li>


                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="class-dropdown" data-collapse-toggle="class-dropdown">
                        <svg class="w-6 h-6" fill="#000000" height="200px" width="200px" version="1.1"
                            id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 299.674 299.674"
                            xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <g>
                                        <g>
                                            <path
                                                d="M293.071,248.837h-14.654v-21.111v-96.227h14.654c6.303,0,9.021-8.05,3.982-11.863L153.819,11.262 c-2.356-1.782-5.609-1.782-7.965,0L2.621,119.635c-5.042,3.814-2.316,11.863,3.982,11.863h14.655v96.227v21.111H6.603 c-3.645,0-6.6,2.954-6.6,6.6v27.711c0,3.646,2.955,6.6,6.6,6.6H293.07c3.646,0,6.6-2.954,6.6-6.6v-27.711 C299.671,251.791,296.716,248.837,293.071,248.837z M149.837,24.802l123.572,93.497c-7.501,0-225.637,0-247.144,0L149.837,24.802 z M265.216,234.326v14.511H34.457v-14.511C45.142,234.326,255.883,234.326,265.216,234.326z M34.457,221.126v-89.627h29.308 v89.627H34.457z M76.966,221.126v-89.627h45.016v89.627H76.966z M135.182,221.126v-89.627h29.308v89.627H135.182z M177.691,221.126v-89.627h45.016v89.627H177.691z M235.907,221.126v-89.627h29.309v89.627H235.907z M13.203,276.548v-14.511 c10.492,0,264.313,0,273.267,0v14.511H13.203z">
                                            </path>
                                            <path
                                                d="M149.837,60.966c-11.16,0-20.24,9.079-20.24,20.24c0,11.16,9.08,20.24,20.24,20.24c11.161,0,20.24-9.079,20.24-20.24 C170.077,70.045,160.998,60.966,149.837,60.966z M149.837,88.246c-3.882,0-7.04-3.158-7.04-7.04c0-3.883,3.158-7.04,7.04-7.04 c3.882,0,7.04,3.158,7.04,7.04C156.877,85.087,153.719,88.246,149.837,88.246z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ trans('sidebar-trans.Classes') }}</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="class-dropdown" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ URL('class/create') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ trans('sidebar-trans.Add-new-class') }}</a>
                        </li>
                        <li>
                            <a href="{{ URL('class') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ trans('sidebar-trans.List-of-all-classes') }}</a>
                        </li>
                    </ul>
                </li>


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
