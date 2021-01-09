<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lessons') }}
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
                Add date
            </h1>
            <form method="POST" action="{{route('courses.lessons.dates.store',[$course,$lesson])}}">
                @csrf
                <label>Date of lesson:</label>
                <br/>
                <input class="input {{$errors->has('date') ? 'is-danger' : ''}} text-black" type="date" name="date" >
                @if($errors->has('date'))
                    <li class="help is-danger">{{$errors->first('date')}}</li>
                @endif
                <br/>
                <label>Time of lesson:</label>
                <br/>
                <input class="input {{$errors->has('time') ? 'is-danger' : ''}} text-black" type="time" name="time"
                       value="{{now()->hour}}:{{now()->minute}}">
                @if($errors->has('time'))
                    <li class="help is-danger">{{$errors->first('time')}}</li>
                @endif
                <br/>
                <x-button>
                    {{ __('Create') }}
                </x-button>
            </form>
        </div>
    </div>

</x-app-layout>
