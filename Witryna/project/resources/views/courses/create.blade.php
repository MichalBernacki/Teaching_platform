<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1>
            Create new course
        </h1>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{route('courses.store')}}">
                @csrf

                <div class="field">
                    <label class="label" for="name">Type course name</label>

                    <div class="control">
                        <input class="input {{ $errors->has('name') ? 'is-danger' : '' }}" type="text" name="name" id="name" value="{{ old('name') }}">

                        @if($errors->has('name'))
                            <li class="help is-danger">{{ $errors->first('name') }}</li>
                        @endif

                    </div>

                </div>

                <div class="field">
                    <label class="label" for="description">Describe your  course</label>

                    <div class="control">
                        <input class="input {{ $errors->has('description') ? 'is-danger' : '' }}" type="text" name="description" id="description" value="{{ old('description') }}">

                        @if($errors->has('description'))
                            <li class="help is-danger">{{ $errors->first('description') }}</li>
                        @endif
                    </div>
                </div>

                <div class="flex items-center justify-start mt-4 px-4 pb-5">
                        <x-button class="ml-4">
                            {{ __('Create') }}
                        </x-button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
