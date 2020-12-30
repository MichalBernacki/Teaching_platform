<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1>
            Generate Marks
        </h1>
        @foreach ($users as $user)
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <p> {{$user->id}}</p>
                <p> {{$user->name}}</p>
            </div>
        @endforeach

    </div>
</x-guest-layout>
