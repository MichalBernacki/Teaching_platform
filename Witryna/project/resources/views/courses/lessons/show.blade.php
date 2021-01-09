<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lesson') }}
        </h2>
    </x-slot>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

    @can('lecturer')

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden items-center content-center sm:rounded-lg">
            <p>Time to teach new stuff</p>
        </div>
    @endcan('lecturer')

    @can('student')
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden items-center content-center sm:rounded-lg">
            <p>Time to learn new stuff</p>
        </div>
    @endcan('student')

    @can('lecturer')

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{route('courses.lessons.upload',  ['course' => $course, 'lesson' => $lesson])}}"  role="form" enctype="multipart/form-data">
                @csrf
                <div class="field">
                    <label class="label" for="file">Upload file here</label>
                    <div class="control">
                        <input class="input {{ $errors->has('file') ? 'is-danger' : '' }}" type="file" name="file" id="file" value="{{ old('file') }}">
                        @if($errors->has('file'))
                            <li class="help is-danger">{{ $errors->first('file') }}</li>
                        @endif
                    </div>
                </div>
                <div class="flex items-center justify-start mt-4 px-4 pb-5">
                    <x-button class="ml-4">
                        {{ __('Upload file') }}
                    </x-button>
                </div>
            </form>
        </div>

    @endcan('lecturer')

    </div>

</x-app-layout>




