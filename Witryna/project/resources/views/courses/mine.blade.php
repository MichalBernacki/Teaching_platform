<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-lg font-semibold m-4">{{$user->name}} courses:</h1>
                @can('lecturer')
                    <div class="flex items-center justify-start mt-4 px-4 pb-5">
                        <form method="get"  action="{{route('courses.create')}}">
                            <x-button class="ml-4">
                                {{ __('Create course') }}
                            </x-button>
                        </form>
                    </div>
                @endcan('lecturer')
                    <x-table.table>
                        <x-table.thead>
                        <x-table.tr>
                            <x-table.th class="w-1">
                            </x-table.th>
                            <x-table.th>
                                Course name
                            </x-table.th>
                            <x-table.th>
                                Description
                            </x-table.th>
                            @can('lecturer')
                                <x-table.th>
                                </x-table.th>

                                <x-table.th>
                                </x-table.th>

                                <x-table.th>
                                </x-table.th>
                            @endcan('lecturer')
                        </x-table.tr>
                        </x-table.thead>
                        <x-table.tbody>
                        @foreach ($courses as $key=>$course)
                                <x-table.tr>
                                    <x-table.td>
                                        {{$key+1}}
                                    </x-table.td>
                                    <x-table.td>
                                        <a href="{{route('courses.show', [$course])}}"
                                           class="text-indigo-600 hover:text-indigo-900">
                                            {{$course->name}}
                                        </a>
                                    </x-table.td>
                                    <x-table.td>
                                        {{$course->description}}
                                    </x-table.td>
                                    @can('lecturer')
                                    <x-table.td>
                                        <a href="{{route('courses.listparticipants',$course->id)}}"><strong>List of students</strong></a>
                                    </x-table.td>
                                    <x-table.td>
                                        <a href="{{route('courses.edit',$course->id)}}"><strong>Edit course</strong></a>
                                    </x-table.td>
                                    <x-table.td>
                                        <a href="{{route('courses.generateMark',$course->id)}}"><strong>Generate marks</strong></a>
                                    </x-table.td>
                                    @endcan('lecturer')
                                </x-table.tr>
                        @endforeach
                        </x-table.tbody>
                    </x-table.table>
            </div>
        </div>
    </div>

</x-app-layout>
