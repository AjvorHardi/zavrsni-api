<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Gradebook;

class GradebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $term = request()->input('term');
        $skip = request()->input('skip', 0);
        $take = request()->input('take', Gradebook::get()->count());

        if ($term) {
            return Gradebook::with('teacher', 'student', 'comment')->search($term)->skip($skip)->take($take)->get();
        } else {
            return Gradebook::with('teacher', 'student', 'comment')->skip($skip)->take($take)->get();
        }
        

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
        $request->validate([
            'title' => 'required | min:2 | max:255'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
    }

        $gradebook = new Gradebook();

        $gradebook->title = $request->input('title');

        $gradebook->teacher_id = $request->input('teacher_id');

        $gradebook->save();

        return $gradebook;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Gradebook::with(['teacher', 'comment', 'student'])->find($id);
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
        $gradebook = Gradebook::find($id);
        $gradebook->title = $request->input('title');
        $gradebook->teacher_id = $request->input('teacher_id');

        $gradebook->save();

        return $gradebook;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gradebook = Gradebook::find($id);

        $gradebook->delete();

        return new JSONResponse(true);
    }
}
