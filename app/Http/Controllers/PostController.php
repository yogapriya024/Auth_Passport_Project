<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
            $post = Post::all();
        
        return $post;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=array(
            "title"=>"required|min:6|max:10",
            "description"=>"required"
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            $post = new Post;
            $post->title=$request->title;
            $post->description=$request->description;
            $result=$post->save();
            if($result){
                return ["Result"=>"Data has been saved"];
            }
            else{
                return ["Result"=>"Operation Failed"];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=array(
            "title"=>"required|min:6|max:10",
            "description"=>"required"
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $validator->errors();
        }
        else{
            $post =  Post::find($request->id);
            $post->title=$request->title;
            $post->description=$request->description;
            $result=$post->save();
            if($result){
                return ["Result"=>"Data has been updated"];
            }
            else{
                return ["Result"=>"Operation Failed"];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        $result=$post->delete();
        if($result){
         return ["Result"=>"Data has been deleted"];
         }
         else{
             return ["Result"=>"Operation Failed"];
         } 
    }
}
