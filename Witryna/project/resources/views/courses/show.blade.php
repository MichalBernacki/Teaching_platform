<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1>
            Hello course!
        </h1>
        <p>Course: {{$course->name}}</p>
        <p>Lecturer: {{$course->lecturer->name}}</p>
    </div>

</x-app-layout>
