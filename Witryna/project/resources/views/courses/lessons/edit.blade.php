<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lessons') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1>
            Lesson editing
        </h1>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{route('courses.lessons.update',[$course,$lesson])}}">
                @csrf
                @method('PUT')
                <label for="title">Title</label>
                <br/>
                <input class="input {{$errors->has('title') ? 'is-danger' : ''}}" type="text" name="title" value="{{$lesson->title}}">
                @if ($errors->has('title'))
                    <li class="help is-danger">{{$errors->first('title')}}</li>
                @endif
                <br/>
                <label for="description">Description:</label>
                <br/>
                <input class="input {{$errors->has('description') ? 'is-danger' : ''}}" type="text" name="description" value="{{$lesson->description}}">
                @if($errors->has('description'))
                    <li class="help is-danger">{{$errors->first('description')}}</li>
                @endif
                <br/>
                <x-button>
                    {{ __('Update') }}
                </x-button>
            </form>
        </div>
    </div>

</x-app-layout>
