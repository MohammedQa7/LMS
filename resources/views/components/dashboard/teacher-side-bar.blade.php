<div>
    <li class="mb-2">
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
            <span
                class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ trans('sidebar-trans.Levels') }}</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
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
            <svg class="w-6 h-6" fill="#000000" height="200px" width="200px" version="1.1" id="Layer_1"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 299.674 299.674" xml:space="preserve">
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
            <span
                class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ trans('sidebar-trans.Classes') }}</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
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


</div>
