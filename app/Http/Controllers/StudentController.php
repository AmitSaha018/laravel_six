<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student=Student::all();
        return view('student.index',compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:25',
            'phone' => 'required|max:12|min:9|unique:students',
            'email' => 'required|unique:students',
        ]);

        // Query Builder----------
        // $data=array();
        // $data['name']=$request->name;
        // $data['email']=$request->email;
        // $data['phone']=$request->phone;

        // DB::table('students')->insert($data);

        //Eloquent ORM-------------
        $student = new Student;
        $student->name=$request->name;
        $student->email=$request->email;
        $student->phone=$request->phone;

        // return response()->json($student);
        $student->save();

        $notification=array(
            'message'=>'Student details successfully Inserted',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //DB::table('students')->where('id',$id)->first();

        $student=Student::findorfail($id);
        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student=Student::findorfail($id);
        return view('student.edit',compact('student'));
        //return response()->json($student);
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
        $student = Student::findorfail($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;

        //DB::table('students')->where('id',$id)->update($data);
        $student->save();

        $notification=array(
            'message'=>'Student Updated Successfully',
            'alert-type'=>'info'
        );
        return Redirect()->to('student')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student=Student::findorfail($id);
        $student->delete();

        //DB::table('students')->where('id',$id)->delete();

        $notification=array(
            'message'=>'Student details Deleted',
            'alert-type'=>'success'
        );
        return Redirect()->to('student')->with($notification);
    }
}
