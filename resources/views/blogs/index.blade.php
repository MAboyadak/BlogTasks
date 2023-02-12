@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div class="bg-success text-white p-2 mb-3">
            {{session('success')}}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-danger text-white p-2 mb-3">
            {{session('error')}}
        </div>
    @endif
    <table class="table table-striped">
        <tr>
            <th>Title</th>
            <th>Posted By</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        
        @if (isset($blogs))
                        
        @endif
        @foreach ($blogs as $blog)
            <tr>
                <td>{{$blog->title}}</td>
                <td>{{$blog->user->name}}</td>
                <td>{{$blog->created_at}}</td>
                <td>
                    <a href="{{route('blogs.show', $blog->id)}}" class="btn btn-primary">View</a>
                    <a href="{{route('blogs.edit', $blog->id)}}" class="btn btn-success">Edit</a>
                    @if($blog->trashed())
                        <a onclick="restoreBlog({{$blog->id}})" class="btn btn-warning text-white">Restore</a>
                    @else
                        <a onclick="deleteBlog({{$blog->id}})" class="btn btn-danger">Delete</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    {{ $blogs->links() }}



    <script>
        function deleteBlog(id){
            
            let blogId = id;

            if (confirm("are you sure you wanna delete blog ?") == true) {

                let url = "{{route('blogs.destroy',':id')}}";
                url = url.replace(':id',blogId);

                const CSRF_TOKEN = document.querySelector('[name="csrf-token"]').getAttribute('content');
                
                // console.log(CSRF_TOKEN);

                let response = fetch(`${url}`,{
                    method:'DELETE',
                    headers:{
                        'X-CSRF-TOKEN' : CSRF_TOKEN,
                    },
                }).then((resp)=>{
                    return resp.json();
                }).then((resp)=>{
                    // console.log(resp)
                    if(resp.status){
                    alert(`Blog with id ${resp.data} has been deleted successfully`)
                    document.location = 'http://127.0.0.1:8000/blogs';
                    return;
                    }
                })
            } else {
                console.log('Error');
            }
            
        }

        function restoreBlog(id){
            
            if (confirm("are you sure you wanna restore blog ?") == true) {

                let url = "{{route('blogs.restore',':id')}}";
                url = url.replace(':id',id);

                // console.log(url)

                let response = fetch(`${url}`).then((resp)=>{
                    // console.log(resp)
                    return resp.json();
                }).then((resp)=>{
                    console.log(resp)
                    if(resp.status){
                    alert(`Blog with id ${id} has been restored successfully`)
                    document.location = 'http://127.0.0.1:8000/blogs';
                    return;
                    }
                })
            } else {
                console.log('Error');
            }
            
        }
    </script>
@endsection