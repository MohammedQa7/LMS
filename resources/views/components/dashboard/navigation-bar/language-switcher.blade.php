<div>
    <form class="max-w-sm mx-auto">
        <div class="flex">
            <button id="states-button" data-dropdown-toggle="dropdown-states"
                class="border text-sm text-gray-700 border-gray-200 shadow-sm px-3 py-2 focus:bg-slate-100 rounded-md hover:bg-gray-100 transition-all"
                type="button">
                <p>{{ LaravelLocalization::getCurrentLocaleNative() }}</p>
            </button>
            <div id="dropdown-states"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="states-button">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>

                            <a class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                                rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                @if ($localeCode == 'ar')
                                    <svg class="w-5 h-5 me-3" enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="256" cy="256" fill="#f0f0f0" r="256" />
                                        <path
                                            d="m155.826 166.957h340.25c-36.17-97.485-130.006-166.957-240.076-166.957-70.694 0-134.687 28.659-181.011 74.989z" />
                                        <path
                                            d="m155.826 345.043h340.25c-36.17 97.485-130.006 166.957-240.076 166.957-70.694 0-134.687-28.659-181.011-74.989z"
                                            fill="#6da544" />
                                        <path
                                            d="m74.98 74.98c-99.974 99.974-99.974 262.065 0 362.04 41.313-41.313 81.046-81.046 181.02-181.02z"
                                            fill="#d80027" />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                    </svg>
                                @elseif($localeCode == 'en')
                                    <svg class="w-5 h-5 me-3" enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="256" cy="256" fill="#f0f0f0" r="256" />
                                        <g fill="#d80027">
                                            <path d="m244.87 256h267.13c0-23.106-3.08-45.49-8.819-66.783h-258.311z" />
                                            <path
                                                d="m244.87 122.435h229.556c-15.671-25.572-35.708-48.175-59.07-66.783h-170.486z" />
                                            <path
                                                d="m256 512c60.249 0 115.626-20.824 159.356-55.652h-318.712c43.73 34.828 99.107 55.652 159.356 55.652z" />
                                            <path
                                                d="m37.574 389.565h436.852c12.581-20.529 22.338-42.969 28.755-66.783h-494.362c6.417 23.814 16.174 46.254 28.755 66.783z" />
                                        </g>
                                        <path
                                            d="m118.584 39.978h23.329l-21.7 15.765 8.289 25.509-21.699-15.765-21.699 15.765 7.16-22.037c-19.106 15.915-35.852 34.561-49.652 55.337h7.475l-13.813 10.035c-2.152 3.59-4.216 7.237-6.194 10.938l6.596 20.301-12.306-8.941c-3.059 6.481-5.857 13.108-8.372 19.873l7.267 22.368h26.822l-21.7 15.765 8.289 25.509-21.699-15.765-12.998 9.444c-1.301 10.458-1.979 21.11-1.979 31.921h256c0-141.384 0-158.052 0-256-50.572 0-97.715 14.67-137.416 39.978zm9.918 190.422-21.699-15.765-21.699 15.765 8.289-25.509-21.7-15.765h26.822l8.288-25.509 8.288 25.509h26.822l-21.7 15.765zm-8.289-100.083 8.289 25.509-21.699-15.765-21.699 15.765 8.289-25.509-21.7-15.765h26.822l8.288-25.509 8.288 25.509h26.822zm100.115 100.083-21.699-15.765-21.699 15.765 8.289-25.509-21.7-15.765h26.822l8.288-25.509 8.288 25.509h26.822l-21.7 15.765zm-8.289-100.083 8.289 25.509-21.699-15.765-21.699 15.765 8.289-25.509-21.7-15.765h26.822l8.288-25.509 8.288 25.509h26.822zm0-74.574 8.289 25.509-21.699-15.765-21.699 15.765 8.289-25.509-21.7-15.765h26.822l8.288-25.509 8.288 25.509h26.822z"
                                            fill="#0052b4" />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                        <g />
                                    </svg>
                                @endif
                                {{ $properties['native'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </form>
</div>
