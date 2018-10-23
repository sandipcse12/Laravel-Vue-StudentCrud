<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $data=Student::orderBy('id', 'DESC')->paginate(10);
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
        $record=Student::create($request->all());
         if($record){
             return $data=Student::orderBy('id', 'DESC')->paginate(10);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student,$id)
    {
        return $data=Student::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student,$id)
    {
        $record=Student::find($id);
         $record->std_id=$request->std_id;
         $record->std_name=$request->std_name;
         $record->std_class=$request->std_class;
         $record->std_age=$request->std_age;
         $record->std_address=$request->std_address;
        if($record->save()){
            return $data=Student::orderBy('id', 'DESC')->paginate(10);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student,$id)
    {
        $record = Student::find($id);    
            if($record->delete()){
                return $data=Student::orderBy('id', 'DESC')->paginate(10);
            }
    }
}
