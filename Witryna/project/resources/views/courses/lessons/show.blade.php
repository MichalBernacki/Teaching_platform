<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lesson') }}
        </h2>
        @can('give-plusesandpresence',$course)<strong><a href="{{route('courses.lessons.presence',[$course,$lesson])}}">Presence and pluses</a></strong>@endcan
    </x-slot>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 bg-gradient-to-r from-green-400 to-blue-500">


        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden items-center content-center sm:rounded-lg">
            <p>Lesson: {{$lesson->title}} from course: {{$course->name}}</p>
            <p>Description of lesson: {{$lesson->description}}</p>
        </div>

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

          @forelse($lesson->lessonMaterials as $material)
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <a href='{{ asset($material->path) }}'>{{ $material->file_name }}</a>
                @can('lecturer')
                    <form method="POST" action="{{route('courses.lessons.deleteFile',  ['course' => $course, 'lesson' => $lesson, 'material' => $material ])}}">
                        @csrf
                        <x-button >
                            {{ __('Delete file') }}
                        </x-button>
                    </form>
                @endcan('lecturer')
            </div>
            @empty
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <p>Lack of lesson materials</p>
            </div>
            @endforelse



    </div>

</x-app-layout>

