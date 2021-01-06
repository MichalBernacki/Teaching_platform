<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lessons') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1>
            Lessons
        </h1>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h1>Upcoming lessons for {{$user->name}}</h1> <br>
            <h2>Today's date and time: {{now()}}</h2>
            <table>
                @foreach ($lessonTimes as $key=>$lessonTime)
                    <div clas="w-full py-6 pt-6">
                    <tr>
                        <td>
                            {{$key+1}}
                        </td>
                        <td>
                            {{$lessonTime->lesson->course->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{$lessonTime->lesson->title}}
                        </td>
                        <td>
                            {{$lessonTime->time}}
                        </td>
                        <td>
                            {{$lessonTime->date}}
                        </td>
                    </tr>
                    </div>
                @endforeach
            </table>
        </div>
    </div>

</x-app-layout>
