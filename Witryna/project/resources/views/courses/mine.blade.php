<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-r from-green-400 to-blue-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-lg font-semibold m-4">{{$user->name}} courses:</h1>
                @can('lecturer')
                    <div class="flex items-stretch bg-gradient-to-r from-green-400 to-blue-500">
                        <div class="py-4 w-1/2">
                        </div>
                        <div class="py-4 w-1/4">
                            <form method="get"  action="{{route('courses.create')}}">
                                <x-button class="ml-4">
                                    {{ __('Create course') }}
                                </x-button>
                            </form>
                        </div>
                        <div class="py-4 w-1/2">
                        </div>
                    </div>
                @endcan('lecturer')
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 w-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Course name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description
                            </th>
                            @can('lecturer')
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            @endcan('lecturer')
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($courses as $key=>$course)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{$key+1}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{route('courses.lessons.index', [$course])}}"
                                       class="text-indigo-600 hover:text-indigo-900">
                                        {{$course->name}}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{$course->description}}
                                </td>
                                @can('lecturer')
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{route('courses.listparticipants',$course)}}"><strong>List of students</strong></a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{route('courses.edit',$course)}}"><strong>Edit course</strong></a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{route('courses.generateMark',$course)}}"><strong>Generate marks</strong></a>
                                </td>
                                @endcan('lecturer')
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>

</x-app-layout>
