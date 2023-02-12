@extends('layouts.app')
<style>
    span{
        display: inline-block;
        width:10%;
        font-weight: bold        
    }
</style>
@section('content')
    <h2>Blog Info</h2>

    @error('name')
        <div class="mb-3 alert alert-danger">{{ $message }}</div>
    @enderror

    @if (session()->has('error'))
        <div class="mb-3  alert alert-danger">{{ session()->get('error') }}</div>
    @endif

    @if (session()->has('success'))
        <div class="mb-3 alert alert-success">{{ session()->get('success') }}</div>
    @endif

    <div class="card shadow my-4">
        <div class="card-header py-3">
            <div class="card-title">
                Blog Info    
            </div>
        </div>

        <div class="card-body">

            <div class="row">
                <p><span>Title:</span>{{$blog->title}}</p>
                <p><span>Description:</span> {{$blog->body}}</p>
            </div>

        </div>

    </div>

    <div class="card shadow my-4">
        <div class="card-header py-3">
            <div class="card-title">
                Blog Contact Info    
            </div>
        </div>

        <div class="card-body">

            <div class="row">
                <p><span>Name:</span>{{$blog->posted_by}}</p>
                <p><span>Email:</span>abc@xyz.com</p>
                <p><span>Created at:</span>{{$blog->created_at}}</p>
            </div>

        </div>

    </div>

@endsection