<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\projects;
use validator;

class ProjectController extends Controller
{
    //

    public function create(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'emailId' => 'required|email',
        //     'password' => 'required',
        //     'password' => 'required|same:password',
        // ]);

        // if($validator->fails()){
        //     return $this->sendError('Validation Error.', $validator->errors());
        // }

        $input = $request->all();
        $project = projects::create($input);

        return ('Project registered successfully.');
    }

    public function getProject()
    {
        $data = DB::table('projects')->get();
        return $data;
    }

    public function getProjectDetail($id)
    {
        $project = DB::table('projects')->where('id', $id )->get();

        return $project;
    }
}
