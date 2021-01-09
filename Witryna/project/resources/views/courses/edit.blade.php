<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 bg-gradient-to-r from-green-400 to-blue-500">

        <div class="flex items-stretch">
            <div class="py-4 w-1/2">
            </div>
            <div class="py-4 w-1/4">
                <img class="object-fill" src="/svg/001-work-space.svg" alt="01">
            </div>
            <div class="py-4 w-1/2">
            </div>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-black shadow-md overflow-hidden sm:rounded-lg text-white">
            <h1 class="font-mono">
                Course editing
            </h1>
            <form method="POST" action="{{route('courses.update',$course)}}">
                @csrf
                @method('PUT')
                <label for="name">Name</label>
                <br/>
                <input class="input {{$errors->has('name') ? 'is-danger' : ''}} text-black" type="text" name="name" value="{{$course->name}}">
                @if ($errors->has('name'))
                    <li class="help is-danger">{{$errors->first('name')}}</li>
                    @endif
                    <br/>
                    <label for="description">Description</label>
                    <br/>
                    <input class="input {{$errors->has('description') ? 'is-danger' : ''}} text-black" type="text" name="description" value="{{$course->description}}" >
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
