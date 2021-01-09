<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lesson') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1>
            Students

        </h1>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <strong>List of students:</strong>
            <form method="post" action="{{route('courses.lessons.save',[$lesson,$course])}}">
               @csrf
                <table>
                    @foreach ($course->users as $user)
                        <tr>
                            <td>
                                Name:{{$user->name}}
                            </td>
                            <td>
                                Pluses:
                                <select name="pluses{{$user->id}}">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                            <td>
                                Presence:
                                <select name="presence{{$user->id}}">
                                    <option value="1">Present</option>
                                    <option value="0">Absent</option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <input type="submit" value="Apply"/>
            </form>

        </div>
    </div>

</x-app-layout>
