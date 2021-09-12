<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ApplyTeacher;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ApplyTeacherRequests;


class TeacherController extends Controller
{


    public function request_for_apply_teacher(ApplyTeacherRequests $request)
    {
        // Retireve the validated input data 
        $validated = $request->validated();

        if(ApplyTeacher::where('user_id', Auth::id())->count()){
            return response()->json([
                'message' => 'شما قبلا درخواست ارسال کرده اید.',
            ]);
        }

        $documents = $request->file('documents')->store('doucments', 'public');

        $url = Storage::url($documents);


        ApplyTeacher::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => Auth::user()->name,
            'user_id' => Auth::id(),
            'description' => $request->description,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'documents' => $url,
        ]);

        return response()->json([
            'message' => 'send request successfuly',
            'url' => $url,
        ], 200);
    }
}
