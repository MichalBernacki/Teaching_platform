<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <h1>
            Course editing
        </h1>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{route('courses.update',$course)}}">
                @csrf
                @method('PUT')
                <label for="name">Name</label>
                <input class="input {{$errors->has('name') ? 'is-danger' : ''}}" type="text" name="name" value="{{$course->name}}">
                @if ($errors->has('name'))
                    <li class="help is-danger">{{$errors->first('name')}}</li>
                @endif
                </br>
                <label for="description">Description</label>
                <input class="input {{$errors->has('description') ? 'is-danger' : ''}}" type="text" name="description" value="{{$course->description}}" >
                @if($errors->has('description'))
                    <li class="help is-danger">{{$errors->first('description')}}</li>
                @endif
                </br>
                <input type="submit" name="update" value="Update">
            </form>
        </div>
    </div>
</x-guest-layout>
<?php
