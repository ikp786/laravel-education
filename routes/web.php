<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EducationStreamController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TopicController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix'=>"admin",'as' => 'admin.','namespace' => 'App\Http\Controllers\Admin','middleware' => ['auth','AdminPanelAccess']], function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('/users', 'UserController');
    Route::resource('/roles', 'RoleController');
    Route::resource('/permissions', 'PermissionController')->except(['show']);
    Route::resource('/products', 'ProductController');
    Route::post('user-status-change', [UserController::class, 'userStatusChange'])->name('userStatusChange');
    // education route
    Route::resource('/educationstreams', 'EducationStreamController');
    Route::get('educationstream/delete/{id}', [EducationStreamController::class, 'delete'])->name('educationstream.delete');
    Route::get('educationstream/trash-data', [EducationStreamController::class, 'trashData'])->name('educationstream.trash-data');
    Route::get('educationstream/restore/{id}', [EducationStreamController::class, 'restore'])->name('educationstream.restore'); 
    Route::get('educationstream/force-delete/{id}', [EducationStreamController::class, 'permanetDelete'])->name('educationstream.force-delete');  
    // education route end

    // subjects route start
    Route::resource('/subjects', 'SubjectController');

    Route::get('subject/delete/{id}', [SubjectController::class, 'delete'])->name('subject.delete');
    Route::get('subject/trash-data', [SubjectController::class, 'trashData'])->name('subject.trash-data');
    Route::get('subject/restore/{id}', [SubjectController::class, 'restore'])->name('subject.restore'); 
    Route::get('subject/force-delete/{id}', [SubjectController::class, 'permanetDelete'])->name('subject.force-delete');  
    // subjects route end




    // topics route start
    Route::resource('/topics', 'TopicController');

    Route::get('topic/delete/{id}', [TopicController::class, 'delete'])->name('topic.delete');
    Route::get('topic/trash-data', [TopicController::class, 'trashData'])->name('topic.trash-data');
    Route::get('topic/restore/{id}', [TopicController::class, 'restore'])->name('topic.restore'); 
    Route::get('topic/force-delete/{id}', [TopicController::class, 'permanetDelete'])->name('topic.force-delete');  
    // topics route end


});



