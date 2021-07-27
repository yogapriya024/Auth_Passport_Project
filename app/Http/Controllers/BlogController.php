<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
class BlogController extends Controller
{
    public function getBlog($id=null){
        if($id){
            $blog = Blog::find($id);
        }else{
            $blog = Blog::all();
        }
        return $blog;
    }
    public function addBlog(Request $request)
    {
        $rules=array(
            "title"=>"required|min:6|max:10",
            "details"=>"required"
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            $blog = new Blog;
            $blog->title=$request->title;
            $blog->details=$request->details;
            $result=$blog->save();
            if($result){
                return ["Result"=>"Data has been saved"];
            }
            else{
                return ["Result"=>"Operation Failed"];
            }
        }
    }
    public function updateBlog(Request $request)
    {
        $rules=array(
            "title"=>"required|min:6|max:10",
            "details"=>"required"
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            $blog =  Blog::find($request->id);
            $blog->title=$request->title;
            $blog->details=$request->details;
            $result=$blog->save();
            if($result){
                return ["Result"=>"Data has been updated"];
            }
            else{
                return ["Result"=>"Operation Failed"];
            }
        }
    }
    public function deleteBlog($id)
    {
        $blog=Blog::find($id);
        $result=$blog->delete();
        if($result){
         return ["Result"=>"Data has been deleted"];
         }
         else{
             return ["Result"=>"Operation Failed"];
         } 
    
    }
    public function searchBlog($title)
    {
       return Blog::where("title","like","%".$title."%")->get();
    }
}
