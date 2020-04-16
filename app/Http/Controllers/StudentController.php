<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Image;
use App\Gradebook;

class StudentController extends Controller
{
    public function store(Request $request, $gradebook_id)
    {
        $request->validate([
            'firstName' => 'required | max:255',
            'lastName' => 'required | max:255'
        ]);

        $student = new Student();

        $student->firstName = $request->input('firstName');
        $student->lastName = $request->input('lastName');
        $student->gradebook_id = $gradebook_id;

        $student->save();

        $url = $request->input('url');
        $photo = new Image(['url' => $url]);
        $student->image()->save($photo);

        $gradebook = Gradebook::find($student->gradebook_id);
        $gradebook->student()->save($student);

        return $student;
    }
}
