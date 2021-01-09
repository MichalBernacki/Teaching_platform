<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            Newly registered users:
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <table>
                @foreach ($users->where('role_id', '1') as $user)
                        <tr>
                            <th>Name: {{ $user->name }}</th>
                            <th>Email: {{ $user->email }}</th>
                            <th>Role:{{$roles[$user->role_id-1]->name}}</th>
                            <th><a href="/users/{{$user->id}}/edit">Change Role</a></th>
                        </tr>
                @endforeach
            </table>
        </div>
        <div>
            Confirmed users:
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <table>
                @foreach ($users->where('role_id','!=', '1') as $user)
                        <tr>
                            <th>Name: {{ $user->name }}</th>
                            <th>Email: {{ $user->email }}</th>
                            <th>Role:{{$roles[$user->role_id-1]->name}}</th>
                            <th><a href="/users/{{$user->id}}/edit">Change Role</a></th>
                        </tr>
                @endforeach
            </table>
            {{$users->links()}}
        </div>
    </div>


</x-app-layout>
