<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1>
            All your courses
        </h1>


            @foreach ($courses as $course)
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <p>course name:   {{$course->name}}</p>

                <p>course description:   {{$course->description}}</p>

            </div>
            @endforeach
            <a href="/courses/create">Create new course</a>

    </div>
</x-guest-layout>
