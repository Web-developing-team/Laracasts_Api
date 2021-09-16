<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\ApplyTeacher;
use App\Models\Teacher;
use App\Http\Resources\TeacherResource;
use App\Http\Resources\TeacherCollection;

class TeacherController extends Controller
{

    public function request_teachers()
    {
        $teachers = ApplyTeacher::select('id', 'username', 'description')->get();


        return Inertia::render('Teachers/Requests', [ 'users' => $teachers]);
    }

    public function answer_request(ApplyTeacher $request)
    {
       $request->user; 
       return Inertia::render('Teachers/AnswerRequest', [
           'request' => $request
       ]); 
    }


    public function reject_request(ApplyTeacher $request)
    {
        $request->delete();

        return redirect()->route('teacher.requests');
    }

    public function accept_request(ApplyTeacher $request)
    {
        Teacher::create([
            'uuid' => Str::uuid(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'user_id' => $request->user_id,
            'slug' => Str::slug($request->username),
            'description' => $request->description,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
        ]);

        $request->forceDelete();

        return redirect()->route('teachers.index');
    }

    public function rejected_requests()
    {
        $requests = ApplyTeacher::onlyTrashed()->select('id','username', 'description')->get();
        return Inertia::render('Teachers/RejectedRequests', ['requests' => $requests]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Teachers/Index', [
            'teachers' => new TeacherCollection(Teacher::all())
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
