<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1>
            {{$course->name}}
        </h1>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h1>List of participants:</h1> <br>
            <ul>
                @foreach($course->users as $usr)
                    <li>
                        <td>{{$usr->id}}</td>
                        <td>{{$usr->name}}</td>
                        <td>{{$usr->email}}</td>
                        <td><strong>{{$usr->pivot->confirmed?'confirmed':'unconfirmed'}}</strong></td>
                        @if(!$usr->pivot->confirmed)
                            <a href="{{route('courses.confirm',[$course->id,$usr->id])}}">Confirm</a>
                        @endif
                    </li>
                @endforeach

            </ul>
        </div>
    </div>


</x-app-layout>
