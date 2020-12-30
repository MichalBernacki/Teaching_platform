<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1>
            Courses
        </h1>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <a href="{{route('courses.show',Auth::id())}}">My courses</a>
            @foreach ($courses as $course)
                <li>
                    <td>
                        {{$course->name}}
                    </td>
                    <td>
                        {{$course->description}}
                    </td>

                </li>
                <a href="/courses/create">Create new course</a>

            @endforeach
        </div>
    </div>
</x-guest-layout>
