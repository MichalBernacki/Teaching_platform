<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses list') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-r from-green-400 to-blue-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="text-lg font-semibold m-4">Your courses</h2>

                <div class="flex items-center justify-start mt-4 px-4 pb-5">
                    <form method="get" action="{{route('courses.mine')}}">
                        <x-button class="ml-4">
                            {{ __('My courses') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="py-12 bg-gradient-to-r from-green-400 to-blue-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="text-lg font-semibold m-4">Available courses</h2>

                @if($courses->isEmpty())
                    <p class="p-6">No courses in database.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Lecturer
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Enter</span>
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Join course</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($courses as $course)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 font-bold	">{{$course->name}}</div>
                                </td>
                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900 ">{{ $course->description }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $course->lecturer->name}}</div>
                                </td>
                                @can('enter-course',$course)
                                    <td class="px-6 py-4 text-right text-sm font-medium">
                                        <a href="{{route('courses.lessons.index', $course)}}"
                                           class="text-indigo-600 hover:text-indigo-900">Details</a>
                                    </td>

{{--                                    Znaczy, ze juz jest zapisany i nie moze się zapisać--}}
                                    @can('student')
                                        <td class="px-6 py-4 text-right text-sm font-medium">
                                            <p class="text-gray-300">Already joined</p>
                                        </td>
                                    @endcan
                                    @can('lecturer')
                                        <td class="px-6 py-4 text-right text-sm font-medium">
                                            <p class="text-gray-300">Your course</p>
                                        </td>
                                    @endcan
                                @endcan
                                @cannot('enter-course',$course)
                                    <td class="px-6 py-4 text-right text-sm font-medium">
                                        <p class="text-gray-300">Details</p>
                                    </td>

                                    @can('student')
                                        <td class="px-6 py-4 text-right text-sm font-medium">
                                            <a href="{{route('courses.join', $course)}}"
                                               class="text-indigo-600 hover:text-indigo-900">Join course</a>
                                        </td>
                                    @endcan

                                    @can('lecturer')
                                        <td class="px-6 py-4 text-right text-sm font-medium">
                                            <p class="text-gray-300">Can't access</p>
                                        </td>
                                    @endcan
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    {{--        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">--}}
    {{--            <a href="{{route('courses.mine')}}">My courses</a>--}}
    {{--            <table>--}}
    {{--                @foreach ($courses as $course)--}}
    {{--                    <tr>--}}
    {{--                        <td>--}}
    {{--                            <a href="{{route('courses.lessons.index',$course)}}"> <strong>{{$course->name}}</strong></a>--}}
    {{--                        </td>--}}
    {{--                        <td>--}}
    {{--                            {{$course->description}}--}}
    {{--                        </td>--}}
    {{--                    </tr>--}}
    {{--                @endforeach--}}
    {{--            </table>--}}
    {{--            @can('lecturer')--}}
    {{--                <a href="/courses/create">Create new course</a>--}}
    {{--            @endcan--}}
    {{--        </div>--}}

</x-app-layout>
