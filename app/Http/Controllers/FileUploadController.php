<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;
class FileUploadController extends Controller
{
    public function getFile($id=null){
        if($id){
            $blog = Blog::find($id);
        }else{
            $blog = Blog::all();
        }
        return $blog;
    }
    public function fileupload(Request $request){
        $rules=array(
            "title"=>"required|min:6|max:10",
            "details"=>"required",
          "file"=>"required"
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            $uploaded_files=$request->file->store('public/fileDocs');
            $blog = new Blog;
            $blog->title=$request->title;
            $blog->details=$request->details;
            $blog->user_id=$request->user_id;
            $blog->blog_image=$request->file->hashName();
            $result=$blog->save();
            if($result){
                return ["Result"=>"Data has been saved"];
            }
            else{
                return ["Result"=>"Operation Failed"];
            }
        }
    }
    public function updatefile(Request $request, $id)
    {
        
        $rules=array(
            "title"=>"required|min:6|max:10",
            "details"=>"required",
          "file"=>"required"
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            $uploaded_files=$request->file->store('public/fileDocs');
            $blog =  Blog::find($request->id);
            $blog->title=$request->title;
            $blog->details=$request->details;
            $blog->blog_image=$request->file->hashName();
            $result=$blog->save();
            if($result){
                return ["Result"=>"Data has been updated"];
            }
            else{
                return ["Result"=>"Operation Failed"];
            }
        }
    }
    public function deletefile($id)
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
}
