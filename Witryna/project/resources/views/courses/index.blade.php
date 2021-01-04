<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1>
            Courses
        </h1>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <a href="{{route('courses.mine')}}">My courses</a>
            <table>
            @foreach ($courses as $course)
                <tr>
                    <td>
                        <a href="{{route('courses.lessons.index',$course)}}"> <strong>{{$course->name}}</strong></a>
                    </td>
                    <td>
                        {{$course->description}}
                    </td>
                </tr>
            @endforeach
            </table>
            @can('lecturer')
                <a href="/courses/create">Create new course</a>
            @endcan
        </div>
    </div>
</x-guest-layout>
