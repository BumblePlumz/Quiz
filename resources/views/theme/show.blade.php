<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Liste des Thèmes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-6 px-4 sm:px-6 lg:px-8">
                    {{-- <h2 class="text-center text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                        {{ __('Liste des Thèmes') }}
                    </h2> --}}

                    <ul class="space-y-4 flex flex-col justify-center text-center">
                        @foreach ($themes as $theme)
                            <li
                                class="flex justify-center items-center max-w-[100px] mx-auto p-4 bg-white shadow rounded-lg dark:bg-gray-800 dark:text-white">
                                <button id={{ $theme['id'] }} data-name={{ $theme['name'] }} class="btnTheme text-center text-lg font-semibold">
                                    {{ $theme['name'] }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

@vite(['resources/js/theme/themeShow.js'])