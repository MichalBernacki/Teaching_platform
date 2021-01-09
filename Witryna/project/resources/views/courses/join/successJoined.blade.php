<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Successfully joined the course') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-r from-green-400 to-blue-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg justify-center">
                <h2 class="text-lg font-semibold m-4">{{"Joined the course ".$course->name}}</h2>

                <div class="flex items-center justify-center mt-4 px-4 pb-5">
                    <form method="get"  action="{{route('courses.mine')}}">
                        <x-button class="ml-4">
                            {{ __('My courses') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
