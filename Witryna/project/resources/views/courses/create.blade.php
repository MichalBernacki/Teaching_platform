<x-guest-layout>
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
                    <label class="label" for="lecturer_id">Type your id</label>

                    <div class="control">
                        <input class="input {{ $errors->has('lecturer_id') ? 'is-danger' : '' }}" type="text" name="lecturer_id" id="lecturer_id" value="{{ old('lecturer_id') }}">

                        @if($errors->has('lecturer_id'))
                            <li class="help is-danger">{{ $errors->first('lecturer_id') }}</li>
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

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link" type="submit">Create</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</x-guest-layout>
