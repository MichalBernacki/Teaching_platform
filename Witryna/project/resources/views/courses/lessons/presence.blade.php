<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Lesson') }}
    </h2>
</x-slot>
<div class="py-12  bg-gradient-to-r from-green-400 to-blue-500">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-lg font-semibold m-4">Presence and pluses</h2>
        <form method="post" action="{{route('courses.lessons.save',[$course,$lesson])}}">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Pluses
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Presence
                    </th>
                </tr>
                </thead>

                @csrf
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($course->users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{$user->name}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select class="w-16 border bg-white rounded px-3 py-2 outline-none" name="pluses{{$user->id}}">
                                <option value="0"{{\DB::table('lesson_time_user')->where([['user_id','=',$user->id],['lesson_time_id','=',$lessonTime->id]])->pluck('pluses')->first()==0?'selected':''}}>0</option>
                                <option value="1"{{\DB::table('lesson_time_user')->where([['user_id','=',$user->id],['lesson_time_id','=',$lessonTime->id]])->pluck('pluses')->first()==1?'selected':''}}>1</option>
                                <option value="2"{{\DB::table('lesson_time_user')->where([['user_id','=',$user->id],['lesson_time_id','=',$lessonTime->id]])->pluck('pluses')->first()==2?'selected':''}}>2</option>
                                <option value="3"{{\DB::table('lesson_time_user')->where([['user_id','=',$user->id],['lesson_time_id','=',$lessonTime->id]])->pluck('pluses')->first()==3?'selected':''}}>3</option>
                                <option value="4"{{\DB::table('lesson_time_user')->where([['user_id','=',$user->id],['lesson_time_id','=',$lessonTime->id]])->pluck('pluses')->first()==4?'selected':''}}>4</option>
                                <option value="5"{{\DB::table('lesson_time_user')->where([['user_id','=',$user->id],['lesson_time_id','=',$lessonTime->id]])->pluck('pluses')->first()==5?'selected':''}}>5</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select class="w-28 border bg-white rounded px-3 py-2 outline-none" name="presence{{$user->id}}">
                                <option value="1" {{\DB::table('lesson_time_user')->where([['user_id','=',$user->id],['lesson_time_id','=',$lessonTime->id]])->pluck('presence')->first()==1?'selected':''}}>Present</option>
                                <option value="0" {{\DB::table('lesson_time_user')->where([['user_id','=',$user->id],['lesson_time_id','=',$lessonTime->id]])->pluck('presence')->first()==0?'selected':''}}>Absent</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
            </table>
            @if(!$course->users->isEmpty())
            <x-button class="ml-4">
                {{ __('Apply') }}
            </x-button>
            @endif
        </form>
    </div>
</div>

</x-app-layout>
