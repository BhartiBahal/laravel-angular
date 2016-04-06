<?php
use \App\Todo;
use Illuminate\Support\Facades\Input;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('index');
    });

    Route::get('todos', function () {
       return Todo::all();
    });

    Route::post('todos', function () {
        $todo = Input::all();
        if(isset($todo['id']))
        {
            $todoToUpdate = Todo::find($todo['id']);
            $todoToUpdate->update($todo);

        } else {
            return
                Todo::create($todo); //Can use Request::all()
        }
    });

    Route::delete('todos', function() {

        $todo = Input::all();
        Todo::destroy($todo['id']);
    });

});
