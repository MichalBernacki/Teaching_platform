<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1>
            {{$course->name}}
        </h1>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h1>List of participants:</h1> <br>
            <ul>
               @foreach($courseusers as $usr)
                    <li>
                        <td>{{$usr->user_id}}</td>
                        <td>{{DB::table('users')->where('id',$usr->user_id)->pluck('name')->first()}}</td>
                        <td>{{DB::table('users')->where('id',$usr->user_id)->pluck('email')->first()}}</td>
                        <td><strong>{{$usr->confirmed?'confirmed':'unconfirmed'}}</strong></td>
                        @if(!$usr->confirmed)
                            <a href="confirm/{{$usr->user_id}}">Confirm</a>
                        @endif
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
</x-guest-layout>
