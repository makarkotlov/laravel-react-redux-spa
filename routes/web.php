<?php

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

//Route::get('/', function () {return view('welcome');});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'can:access_admin_page'], function () {

        Route::get('tasks/admin/settings', 'EmployeeController@admin_settings')->name('tasks.admin_settings');

        Route::get('tasks/admin/settings/edit-employee/{id}', 'EmployeeController@edit')->name('employee.edit');

        Route::patch('tasks/admin/settings/update{employee}', 'EmployeeController@superupdate')->name('employee.superupdate');
        Route::get('tasks/admin/settings/create-employee', 'EmployeeController@create')->name('employee.create');
        Route::post('tasks/admin/settings/create-employee', 'EmployeeController@store')->name('employee.store');
        Route::delete('tasks/admin/settings/delete-employee/{id}', 'EmployeeController@destroy')->name('employee.destroy');

        Route::get('tasks/admin/departments/edit/{id}', 'DepartmentController@edit')->name('DepartmentController.edit');
        Route::get('tasks/admin/departments/create', 'DepartmentController@create')->name('DepartmentController.create');
        Route::post('tasks/admin/departments/store', 'DepartmentController@store')->name('DepartmentController.store');
        Route::patch('tasks/admin/departments/update/{id}', 'DepartmentController@update')->name('DepartmentController.update');
        Route::delete('tasks/admin/departments/delete/{id}', 'DepartmentController@destroy')->name('DepartmentController.destroy');
        Route::delete('tasks/deleteAllTasks', 'TaskCompleteController@destroyAllTasks');
    });

    Route::get('/account', 'EmployeeController@settings');
    Route::patch('account/update{employee}', 'EmployeeController@update')->name('employee.update');

    Route::resource('tasks', 'TaskController');
    Route::get('tasks/task-view-completed', 'TaskController@index');
    Route::put('tasks{tasks}', 'TaskCompleteController@complete')->name('tasks.complete');

    Route::post('/ajax', 'EmployeeController@ajax');
    Route::post('/ajax/getusers', 'EmployeeController@ajax_getusers');
    Route::post('/ajax/getview', 'EmployeeController@ajax_getview');
    Route::post('/ajax/deleteimage', 'EmployeeController@ajax_image_delete');
    Route::post('/ajax/fortaskedit', 'EmployeeController@ajax_for_task_edit');
    Route::post('/ajax/store', 'TaskController@store');
});
Route::get('/login', 'MyLoginController@index');

Route::view('/{path?}', 'welcome');

Route::group(['middleware' => 'auth'], function () {
    Route::view('/{path?}', 'welcome');
});

Route::get('/tracks/today', 'TaskController@index');
Route::get('/user', 'TaskController@index');
Route::get('/projectList', 'TaskController@index');
Route::get('/taskList', 'TaskController@index');

Route::post('/login', 'EmployeeController@ajax');
Route::post('/addTrack', 'EmployeeController@ajax');
Route::delete('track/delete/{id}', 'TaskCompleteController@destroyAllTasks');
Route::post('track/update/{id}', 'DepartmentController@update');
Route::post('user/update/{id}', 'DepartmentController@update');
