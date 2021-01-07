<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lessons') }}
        </h2>
    </x-slot>

    @can('lecturer')

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden items-center content-center sm:rounded-lg">
            <p>Time to teach new stuff</p>
        </div>
    @endcan('lecturer')

    @can('student')
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden items-center content-center sm:rounded-lg">
            <p>Time to learn new stuff</p>
        </div>
    @endcan('student')

</x-app-layout>
