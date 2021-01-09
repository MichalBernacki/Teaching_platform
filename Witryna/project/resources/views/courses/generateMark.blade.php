<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-r from-green-400 to-blue-500">
        <h1>
            Generate Marks
        </h1>
        @forelse ($course->users as $key => $user )

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden items-center sm:rounded-lg">
                <p> {{$user->name}}</p>
                <p>Pluses from all lessons: {{$pluses[$key]}}</p>
                <p>Presence from all lessons: {{$presence[$key]}}</p>
                <br/>
                <p>Presence: {{$percentagepresence[$key]}}%</p>
                <p>Average pluses per lesson: {{$averagepluses[$key]}}</p>

                <br/>

                <form method="GET" action="{{ route('courses.saveMark',  ['course' => $course, 'user' => $user]) }}">
                    @csrf

                    <div class="field">
                        <label class="label" for="mark">Last given mark or 0 if not set:</label>

                        <div class="control">
                            <input class="input {{ $errors->has('mark') ? 'is-danger' : '' }}" type="text" name="mark"
                                   id="mark" value="{{$user->pivot->mark}}">

                            @if($errors->has('mark'))
                                <li class="help is-danger">{{ $errors->first('mark') }}</li>
                            @endif

                        </div>
                    </div>
                    <div class="flex items-center justify-start mt-4 px-4 pb-5">
                            <x-button class="ml-4">
                                {{ __('Save mark') }}
                            </x-button>
                    </div>
                </form>
            </div>
        @empty
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden items-center sm:rounded-lg">
                <p>No students in this course</p>
            </div>
        @endforelse


    </div>


</x-app-layout>
