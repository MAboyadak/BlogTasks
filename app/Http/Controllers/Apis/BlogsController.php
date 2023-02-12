<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Traits\Responses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
    use Responses;

    public function index()
    {
        return BlogResource::collection(Blog::all());
    }

    public function store(StoreBlogRequest $request)
    {
        $request->validated($request->all());

        $newBlog = Blog::create([
            'title'     => $request->title,
            'body'      => $request->body,
            'user_id'   => Auth::user()->id,
        ]);

        // return $this->success([
        //     'data' => $newBlog
        // ],'Blog Has been created successfully', 200);

        return BlogResource::make($newBlog);
    }

    public function show(Blog $blog)
    {
        return BlogResource::make($blog);
    }

    public function update(Request $request,Blog $blog)
    {
        if(Auth::user()->id != $blog->user_id){
            return $this->error([], 'You are not authorized to update this Blog', 401);
        }

        $blog->update($request->all());

        return BlogResource::make($blog);
    }

    public function destroy(Blog $blog)
    {
        if(Auth::user()->id != $blog->user_id){
            return $this->error([], 'You are not authorized to delete this Blog', 401);
        }

        $blog->delete();
        return $this->success([],'Blog has been deleted succefully',200);
    }
}
