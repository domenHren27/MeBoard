<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// \App\Project::created(function ($project) { //Sproži event ko smo dali create na Project modelu !
//     \App\Activity::create([
//         'project_id' => $project->id,
//         'description' => 'created'
//     ]);
// });

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    // Route::get('/projects', 'ProjectsController@index');
    // Route::get('/projects/create', 'ProjectsController@create');
    // Route::get('/projects/{project}', 'ProjectsController@show');
    // Route::get('/projects/{project}/edit', 'ProjectsController@edit');
    // Route::patch('/projects/{project}', 'ProjectsController@update');
    // Route::post('/projects', 'ProjectsController@store');
    // Route::delete('/projects/{project}', 'ProjectsController@destroy');
    Route::resource('projects', 'ProjectsController'); //TO deluje, ker upoštevamo zgoraj naštete konvencije !!
    
    Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
    Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksController@update');

    Route::post('/projects/{project}/invitations', 'ProjectInvitationsController@store');

    Route::get('/home', 'HomeController@index')->name('home');
});



Auth::routes();


