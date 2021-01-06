<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lessons') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-lg font-semibold m-4">Upcoming lessons for {{$user->name}}</h1>
                <h2 class="text-lg m-4">Today's date and time: {{now()}}</h2>


                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Course
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Lesson
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Time
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($lessonTimes as $key=>$lessonTime)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{route('courses.show', [$lessonTime->lesson->course])}}"
                               class="text-indigo-600 hover:text-indigo-900">
                                {{$lessonTime->lesson->course->name}}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{route('courses.lessons.show', [$lessonTime->lesson->course, $lessonTime->lesson])}}"
                               class="text-indigo-600 hover:text-indigo-900">
                                {{$lessonTime->lesson->title}}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{$lessonTime->date}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{$lessonTime->time}}</div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</x-app-layout>
