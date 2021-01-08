<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lessons') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="text-lg font-semibold m-4">{{$course->name}}</h2>

                <div class="flex items-center justify-start mt-4 px-4 pb-5">
                    <div class="flex-1">
                        {{$course->description}}
                    </div>
                </div>
            </div>
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
                        Title</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Description</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Join!</th>
                    @can('lecturer')
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Edit!</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Delete!</th>
                    @endcan
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($lessons as $lesson)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @foreach($lesson->lessonTimes as $tmp)
                                {{$tmp->date}}
                                <br/>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @foreach($lesson->lessonTimes as $tmp)
                                {{$tmp->time}}
                                <br/>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{$lesson->title}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{$lesson->description}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{route('courses.lessons.show',[$course,$lesson])}}">Join</a>
                        </td>
                        @can('lecturer')
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{route('courses.lessons.edit',[$course,$lesson])}}"><strong>Edit</strong></a>
                            </td>
                            <td>
                            <form method="post" action="{{ route('courses.lessons.destroy',[$course,$lesson]) }}">
                                @csrf
                                @method("DELETE")
                                <x-button class="ml-4">
                                    {{ __('Delete') }}
                                </x-button>
                            </form>
                            </td>
                        @endcan('lecturer')
                    </tr>
                @endforeach
                </tbody>
            </table>
            @can('lecturer')
                <form method="get"  action="{{route('courses.lessons.create',$course)}}">
                    <x-button class="ml-4">
                        {{ __('Create new lesson') }}
                    </x-button>
                </form>
            @endcan
    </div>

</x-app-layout>
