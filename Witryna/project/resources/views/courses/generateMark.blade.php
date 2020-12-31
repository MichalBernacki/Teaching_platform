<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1>
            Generate Marks
        </h1>
        @foreach ( $users as $key => $user )
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <p> {{$user->name}}</p>
                <p>Pluses from every lesson: {{$pluses[$key]}}</p>
                <p>Presence from every lesson: {{$presence[$key]}}</p>
                <p>Average pluses per lesson: {{$averagepluses[$key]}}</p>
                <p>Presence: {{$percentagepresence[$key]}}%</p>
                <form method="GET" action="">
                    @csrf

                    <div class="field">
                        <label class="label" for="mark">Type mark</label>

                        <div class="control">
                            <input class="input {{ $errors->has('mark') ? 'is-danger' : '' }}" type="text" name="mark" id="mark" >

                            @if($errors->has('mark'))
                                <li class="help is-danger">{{ $errors->first('mark') }}</li>
                            @endif

                        </div>
                    </div>

                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-link" type="submit">Save mark</button>
                        </div>
                    </div>

                </form>
            </div>
        @endforeach



    </div>
</x-guest-layout>
