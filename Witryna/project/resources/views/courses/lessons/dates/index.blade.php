<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dates') }}
        </h2>
    </x-slot>
    <div class="py-12 bg-gradient-to-r from-green-400 to-blue-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="text-lg font-semibold m-4">{{$course->name}}</h2>

                <div class="flex items-center justify-start mt-4 px-4 pb-5">
                    <div class="flex-1">
                        {{$course->description}}
                    </div>
                </div>
                    <div class="flex items-stretch bg-gradient-to-r from-green-400 to-blue-500">
                        <div class="py-4 w-1/2">
                        </div>
                        <div class="py-4 w-1/4">
                            <form method="get"  action="{{route('courses.lessons.dates.create',[$course,$lesson])}}">
                                <x-button class="ml-8">
                                    {{ __('Add new date') }}
                                </x-button>
                            </form>
                        </div>
                        <div class="py-4 w-1/2">
                        </div>
                    </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Time</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Edit!</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Delete!</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($lesson->lessonTimes as $date)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                    {{$date->date}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{$date->time}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{route('courses.lessons.dates.edit',[$course,$lesson,$date])}}"><strong>Edit</strong></a>
                            </td>
                                <td>
                                    <form method="post" action="{{ route('courses.lessons.dates.destroy',[$course,$lesson,$date]) }}">
                                        @csrf
                                        @method("DELETE")
                                        <x-button class="ml-4">
                                            {{ __('Delete') }}
                                        </x-button>
                                    </form>
                                </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
