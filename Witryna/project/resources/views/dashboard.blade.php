<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-r from-green-400 to-blue-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">Welcome to a Learning Platform!</h1>

                    <div class="flex rounded-lg">
                        <div class="flex-1 flex justify-center flex-wrap container bg-gradient-to-r from-green-400 to-blue-500 rounded-l-lg">
                            <div class="flex justify-center align-middle object-center self-center m-4 p-5 w-max opacity-100">
                                <form method="get" action="{{route('courses.index')}}">
                                    <x-button class="m-4 object-center align-middle self-center">
                                        {{ __('View courses') }}
                                    </x-button>
                                </form>
                            </div>
                        </div>
                        <div class="flex-1 rounded-l-lg">
                            <img class="rounded-r-lg" src="https://zapodaj.net/images/46511902694bb.jpg" alt="Happy Platform"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
