@extends('layouts.app')

@section('content')
    <h2>Blog Info</h2>

    <form action="{{route('blogs.update',$blog->id)}}" method="post">
        @method('PUT')
        @csrf

        <div class="form-group mt-4">
            <label for="" class="mb-2">Title</label>
            <input class="form-control" name="title" value="{{$blog->title}}"/>
        </div>

        <div class="form-group mt-4">
            <label for="" class="mb-2">Body</label>
            <textarea class="form-control" name="body">{{$blog->body}}</textarea>
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

    <script>
        const postedBy = '{{$blog->posted_by}}';
        let options = document.querySelector(`[name="posted_by"]`).options;

        for(let i=0; i<options.length; i++){

            if(options[i].value == postedBy){
                options[i].selected = true
                break
            }
        }
    </script>
@endsection