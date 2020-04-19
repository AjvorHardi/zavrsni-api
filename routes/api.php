<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::get('user', 'UserController@getAuthenticatedUser');

    Route::resource('gradebooks', 'GradebookController');

    Route::resource('teachers', 'TeacherController')->only([
        'index', 'show', 'store'
    ]);
    
    Route::get('/gradebooks/{gradebook_id}/comments', ['as' => 'gradebook-comments', 'uses' => 'CommentController@index']);
    
    Route::post('/gradebooks/{gradebook_id}/comments', ['as' => 'gradebook-comments-add', 'uses' => 'CommentController@store']);
    
    Route::delete('/gradebooks/{gradebook_id}/comments/{comment_id}', ['as' => 'gradebook-comments-remove', 'uses' => 'CommentController@destroy']);
    
    Route::post('/gradebooks/{gradebook_id}/students/create', ['as' => 'gradebook-students-create', 'uses' => 'StudentController@store']);
    
    

});
