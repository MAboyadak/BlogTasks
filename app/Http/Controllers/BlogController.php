<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::withTrashed()->orderBy('id','desc')->paginate(10);
        // dd($blogs);
        return view('blogs.index')->with('blogs',$blogs);
    }

    public function show($id){
        $blog = Blog::findOrFail($id);
        return view('blogs.show')->with('blog',$blog);
    }

    public function destroy($id){
        // return $id;
        // $blogDeleted = DB::delete('delete from blogs where id = :id', ['id' => $id]);

        $blogDeleted = Blog::destroy($id);

        if($blogDeleted){
            return response()->json([
                'status' => true,
                'data' => $id,
                'msg' => 'blog has been deleted successfully'
            ]);
        }
        return response()->json([
            'status' => false,
            'msg' => 'blog has not deleted'
        ]);
    }

    public function restore($id){
        Blog::where('id',$id)->restore();
        return response()->json([
            'status' => true,
            'msg' => 'blog has been restored successfully'
        ]);
    }

    public function create(){
        $users = DB::select('select * from users');
        return view('blogs.create',compact('users'));
    }

    public function store(Request $request){

        BlogController::validateBlog($request);


        $title = $request->title;
        $body = $request->body;
        $user_id = $request->user_id;

        $blogs = DB::select('select count(id) from blogs where user_id=:user_id',['user_id'=>$user_id]);

        if ($blogs > 3){
            return redirect('/blogs')->with('error', 'You Have reached the limit of 3 posts');
        }

        try{
            // $blog = DB::insert('insert into blogs(title,body,user_id) values(:title, :body, :user_id)',[
            //     'title' => $title,
            //     'body' => $body,
            //     'user_id' => $user_id
            // ]);

            $blog = Blog::create(array(
                'title' => $title,
                'body' => $body,
                'user_id' => $user_id
            ));

            if($blog){
                return redirect('/blogs')->with('success', 'Blog has been created successfully');                
            }else{
                return redirect('/blogs')->with('error', 'Blog has not been created');
            }
            // return response()->json([
            //     'status' => true,
            //     'data' => $post,
            //     'msg' => 'blog has been created successfully'
            // ]);

        }catch(Exception $e){
            return redirect('/blogs')->with('error',$e->getMessage());
            
            // return response()->json([
            //     'status' => false,
            //     'msg' => 'Error : '. $e->getMessage(),
            // ]);
        }
        
    }
    
    public function edit($id){
        $blog = Blog::find($id);
        $users = DB::select('select * from users');
        return view('blogs.edit',compact('blog','users'));
    }

    public function update($id, Request $request){

        BlogController::validateBlog($request);

        $title = $request->title;
        $body = $request->body;
        $user_id = $request->user_id;


        // $blog = DB::select('select * from blogs where id = :id',['id'=>$id]);

        try{
            // $blog = DB::update('update blogs set title=:title, body=:body, user_id=:user_id where id=:id',[
            //     'title' => $title,
            //     'body' => $body,
            //     'user_id' => $user_id,
            //     'id' => $id
            // ]);

            $blog = Blog::where('id',$id)->update([
                'title' => $title,
                'body' => $body,
                'user_id' => $user_id,
            ]);

            // dd($blog);
            if($blog){
                return redirect()->route('blogs.index')->with('success', 'Blog has been updated successfully');
            }else{
                return redirect()->route('blogs.index')->with('error', 'Blog has not been updated');
            }

        }catch(Exception $e){
            return redirect()->route('blogs.index')->with('error',$e->getMessage());
        }
        
    }


    static function validateBlog(Request $req){
        Validator::make($req->all(), [
            'title' => 'required',
            'body' => 'required',
            'user_id' => 'required'
        ])->validate();
    }
}
