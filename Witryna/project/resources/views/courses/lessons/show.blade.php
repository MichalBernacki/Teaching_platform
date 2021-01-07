<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lessons') }}
        </h2>
        <strong><a href="{{route('courses.lessons.presence',[$course,$lesson])}}">Presence and pluses</a></strong>
    </x-slot>


</x-app-layout>
