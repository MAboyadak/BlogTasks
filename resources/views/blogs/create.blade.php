@extends('layouts.app')

@section('content')
    <h2>Blog Info</h2>

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    {{-- @if ($errors->any())
        {{dd($errors)}}
    @endif --}}
    <form action="{{route('blogs.store')}}" method="post">
        @csrf
        <div class="form-group mt-4">
            {{-- @if($errors->has('title'))
                <div class="error">{{ $errors->first('title') }}</div>
            @endif --}}
            <label for="" class="mb-2">Title</label>
            <input class="form-control" name="title"/>
        </div>

            {{-- @if($errors->has('body'))
                <div class="error">{{ $errors->first('body') }}</div>
            @endif --}}
        <div class="form-group mt-4">
            <label for="" class="mb-2">Body</label>
            <textarea class="form-control" name="body"></textarea>
        </div>

        <div class="form-group mt-4">
            <label for="" class="mb-2">Author</label>
            <select class="form-control" name="user_id">
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success mt-3">Submit</button>
            

    </form>

@endsection