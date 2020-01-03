<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Str;

class PostController extends Controller
{
    Public function WritePost() {

        $category=DB::table('categories')->get();
        return view('post.writepost',compact('category'));
    }


    Public function StorePost(Request $request) {

        $validatedData = $request->validate([
            'title' => 'required|max:125|',
            'details' => 'required|max:400',
            'image' => 'required | mimes:jpeg,jpg,png,PNG,JPG | max:1000',
        ]);

        $data=array();
        $data['title']=$request->title;
        $data['category_id']=$request->category_id;
        $data['details']=$request->details;

        $image=$request->file('image');
        if ($image) {
            $image_name=Str::random(10);
            //$image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='frontend/image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['image']=$image_url;
            DB::table('posts')->insert($data);
            $notification=array(
                'message'=>'Successfully Post Inserted',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            DB::table('posts')->insert($data);
            $notification=array(
                'message'=>'Successfully Post Inserted',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }

        //return view('post.writepost',compact('category'));
    }

    Public function AllPost() {

        //$post=DB::table('posts')->get();
        $post=DB::table('posts')
             ->join('categories','posts.category_id','categories.id')
             ->select('posts.*','categories.name')
             ->get();

        //return response()->json($post);
        return view('post.allpost',compact('post'));
    }

    public function ViewPost($id) {

        $post=DB::table('posts')
             ->join('categories','posts.category_id','categories.id')
             ->select('posts.*','categories.name')
             ->where('posts.id',$id)
             ->first();

             //return response()->json($post);


        return view('post.viewpost',compact('post'));


    }

    public function EditPost($id) {

        $category=DB::table('categories')->get();

        $post=DB::table('posts')
            ->where('id',$id)
            ->first();
            return view('post.editpost',compact('post','category'));
    }

    public function UpdatePost(Request $request, $id) {

        $validatedData = $request->validate([
            'title' => 'required|max:125',
            'details' => 'required|max:400',
            'image' => 'mimes:jpeg,jpg,png,PNG | max:1000',
        ]);

        $data=array();
        $data['title']=$request->title;
        $data['category_id']=$request->category_id;
        $data['details']=$request->details;

        // return response()->json($data);

        $image=$request->file('image');
        if ($image) {
            $image_name=Str::random(10);
            //$image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='frontend/image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['image']=$image_url;
            unlink($request->old_photo);
            DB::table('posts')->where('id',$id)->update($data);
            $notification=array(
                'message'=>'Successfully Post Inserted',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.post')->with($notification);
        }else{
            $data['image']=$request->old_photo;
            DB::table('posts')->where('id',$id)->update($data);
            $notification=array(
                'message'=>'Successfully Post Inserted',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.post')->with($notification);
        }
    }

    public function DeletePost($id) {

        $post=DB::table('posts')->where('id',$id)->first();
        $image=$post->image;
        $delete=DB::table('posts')->where('id',$id)->delete();
        if($delete) {
            unlink($image);
            $notification=array(
                'message'=>'Successfully Post Deleted',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.post')->with($notification);
        }else{
            $notification=array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return Redirect()->route('all.post')->with($notification);
        }
    }

    public function ShowAllPost() {
        $post=DB::table('posts')
             ->join('categories','posts.category_id','categories.id')
             ->select('posts.*','categories.name','categories.slug')
             ->simplePaginate(4);

        return view('pages.index',compact('post'));
    }

}
