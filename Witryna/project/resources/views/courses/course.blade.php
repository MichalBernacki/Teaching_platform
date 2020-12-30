<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1>
            Courses
        </h1>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h1>Name: {{$course->name}}</h1>
            <p>Description: {{$course->description}}</p>
            <table>
            @foreach ($lessons as $lesson)
                    <tr>
                        <td>

                        </td>
                        <td>

                        </td>
                    </tr>
            @endforeach
            </table>
            @can('lecturer')
                <a href="">Create new lesson</a>
            @endcan
        </div>
    </div>
</x-guest-layout>
