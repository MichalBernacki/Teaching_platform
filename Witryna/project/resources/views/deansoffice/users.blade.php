
<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            Newly registered users:
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
           <table>
            @foreach ($users as $user)
               @if ($user->role_id==1)
                       <tr>
                            <th>Name: {{ $user->name }}</th>
                            <th>Email: {{ $user->email }}</th>
                            <th>Role:{{DB::table('roles')->where('id',$user->role_id)->pluck('name')->first()}}</th>
                            <th><a href="/users/{{$user->id}}/edit">Change Role</a></th>
                        </tr>
               @endif
            @endforeach
           </table>
        </div>
        <div>
            Confirmed users:
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <table>
                @foreach ($users as $user)
                    @if ($user->role_id!=1)
                        <tr>
                            <th>Name: {{ $user->name }}</th>
                            <th>Email: {{ $user->email }}</th>
                            <th>Role:{{DB::table('roles')->where('id',$user->role_id)->pluck('name')->first()}}</th>
                            <th><a href="/users/{{$user->id}}/edit">Change Role</a></th>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
    </div>
</x-guest-layout>
