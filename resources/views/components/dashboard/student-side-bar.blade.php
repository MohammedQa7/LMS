<div>
    <li class="mb-2">
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