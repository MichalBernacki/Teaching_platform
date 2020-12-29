<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1>
            Courses
        </h1>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h1>{{$user->name}} courses:</h1> <br>
            <table>
            @foreach ($courses as $key=>$course)
                <tr>
                    <td>
                        {{$key+1}}
                    </td>
                    <td>
                        {{$course->name}}
                    </td>
                    <td>
                        {{$course->description}}
                    </td>
                    <td>
                        <a href="">List of students</a>
                    </td>
                    <td>
                        <a href="{{route('courses.edit',$course->id)}}"><strong>Edit course</strong></a>
                    </td>
                </tr>
            @endforeach
            </table>
        </div>
    </div>
</x-guest-layout>
