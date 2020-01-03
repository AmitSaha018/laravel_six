<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function AddCategory() {
        return view ('post.add_category');
    }

    public function StoreCategory(Request $request) {

        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:25|min:4',
            'slug' => 'required|unique:categories|max:25|min:4',

        ]);

        $data=array();
        $data['name']= $request->name;
        $data['slug']= $request->slug;
        $category=DB::table('categories')->insert($data);

        if($category) {
            $notification=array(
                'message'=>'Successfully Category Inserted',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.category')->with($notification);

        }else {
            $notification=array(
                'message'=>'Something went wrong!',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);

        }

        //return view ('post.store_category');
    }

    public function AllCategory() {
        $category=DB::table('categories')->get();

        return view('post.all_category',compact('category'));

        //return response()->json($category);
    }


    public function ViewCategory($id) {

        $category=DB::table('categories')->where('id',$id)->first();

        return view('post.categoryview')->with('cat',$category);


        //return response()->json($category);
    }


    public function DeleteCategory($id) {

        $delete=DB::table('categories')->where('id',$id)->delete();

            $notification=array(
                'message'=>'Successfully Category Deleted',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);


        //return response()->json($category);
    }


    public function EditCategory($id) {


        $category=DB::table('categories')->where('id',$id)->first();

        return view('post.editcategory',compact('category'));

        //return response()->json($category);
    }


    public function UpdateCategory(Request $request,$id) {

        $validatedData = $request->validate([
            'name' => 'required|max:25|min:4',
            'slug' => 'required|max:25|min:4',

        ]);

        $data=array();
        $data['name']= $request->name;
        $data['slug']= $request->slug;
        $category=DB::table('categories')->where('id', $id)->update($data);

        if($category) {
            $notification=array(
                'message'=>'Successfully Category Updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('all.category')->with($notification);

        }else {
            $notification=array(
                'message'=>'Nothing Updated!',
                'alert-type'=>'error'
            );
            return Redirect()->route('all.category')->with($notification);

        }


        //$category=DB::table('categories')->where('id',$id)->first();

        //return view('post.editcategory',compact('category'));

        //return response()->json($category);
    }


}
