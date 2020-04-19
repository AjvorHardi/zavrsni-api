<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Image;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $term = request()->input('term');

        if ($term) {
            return Teacher::with('gradebook')->search($term)->get();
        } else {
            return Teacher::with('gradebook')->get();
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
            'firstName' => 'required | max:255',
            'lastName' => 'required | max:255'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        
        $teacher = new Teacher();

        
        // \Log::info( Auth::user()->id);
        // \Log::info( JWTAuth::user()->id);
        

        $teacher->firstName = $request->input('firstName');
        $teacher->lastName = $request->input('lastName');

        $teacher->save();

        $niz = $request->input('url');
        
        $images = new Image(['url' => $niz]);

        $teacher->image()->save($images);


        return $teacher;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Teacher::with(['gradebook', 'image'])->find($id);
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
