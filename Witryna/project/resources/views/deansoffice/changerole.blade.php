<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            Changing role of user:
        </div>
        <div class="w-500 sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <ul>
                <li>Name: {{ $user->name }}</li>
                <li>Email: {{ $user->email }}</li>
                <li>Current Role:{{$role->name}}</li>
                <li>New Role:
                    <form method="POST" action="update">
                        @csrf
                        <select name="opt">
                            <option value='2'>Student</option>
                            <option value='3'>Lecturer</option>
                            <option value='4'>Dean's office worker</option>
                        </select>
                        <input type="submit" value="Change">
                    </form>
                </li>
            </ul>
        </div>
    </div>

</x-app-layout>
