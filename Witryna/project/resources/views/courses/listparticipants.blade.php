<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 bg-gradient-to-r from-green-400 to-blue-500">
        <h1 class="font-mono">
            {{$course->name}}
        </h1>
        <h1 class="font-mono">
            List of participants:
        </h1>
        <div class="bg-white shadow-md overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                @foreach($course->users as $usr)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{$usr->id}}</td>
                        <td class="px-6 py-4 whitespace-nowrap"> {{$usr->name}}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{$usr->email}}</td>
                        <td class="px-6 py-4 whitespace-nowrap"><strong>{{$usr->pivot->confirmed?'confirmed':'unconfirmed'}}</strong></td>
                        @if(!$usr->pivot->confirmed)
                            <td class="px-6 py-4 whitespace-nowrap">  <a href="{{route('courses.confirm',[$course->id,$usr->id])}}">Confirm</a></td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

</x-app-layout>
