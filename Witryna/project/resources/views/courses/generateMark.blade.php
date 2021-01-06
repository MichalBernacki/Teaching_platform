<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1>
            Generate Marks
        </h1>
        @foreach ( $course->courseUser as $key => $user )
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <p> {{$user->name}}</p>
                <p>Pluses from every lesson: {{$pluses[$key]}}</p>
                <p>Presence from every lesson: {{$presence[$key]}}</p>
                <p>Average pluses per lesson: {{$averagepluses[$key]}}</p>
                <p>Presence: {{$percentagepresence[$key]}}%</p>
                <p>Last given mark of 0 if not set: {{$user->pivot->mark}}</p>

                <form method="GET" action="{{ route('courses.saveMark',  [$course, $user] ) }}">
                    @csrf

                    <div class="field">
                        <label class="label" for="mark">Type mark below</label>

                        <div class="control">
                            <input class="input {{ $errors->has('mark') ? 'is-danger' : '' }}" type="text" name="mark"
                                   id="mark">

                            @if($errors->has('mark'))
                                <li class="help is-danger">{{ $errors->first('mark') }}</li>
                            @endif

                        </div>
                    </div>





                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-link" type="submit">Save mark</button>
                        </div>
                    </div>

                </form>
            </div>
        @endforeach


    </div>


</x-app-layout>
