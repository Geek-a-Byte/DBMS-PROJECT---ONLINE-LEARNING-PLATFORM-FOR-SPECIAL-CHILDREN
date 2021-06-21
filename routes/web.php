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
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseAppointController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\AppBookController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FindcourseController;
use App\Http\Controllers\GivetestController;
use App\Http\Controllers\searchResult;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\viewCourseController;

Route::view('/', 'welcome')->name('welcome');



Route::group(['middleware' => 'PreventBackHistory'], function () {
    Auth::routes();
    Route::get('home', 'App\Http\Controllers\HomeController@index')->name('home');
    Route::get("/chartjs", "App\Http\Controllers\ChildController@Chartjs");
    Route::get('/makeappointment', [AppointmentController::class, 'appointmentcreate'])->name('makeappointment');
    Route::post('/makeappointment', [AppointmentController::class, 'search'])->name('search.date');
    Route::post('/bookedappointment', [AppBookController::class, 'store'])->name('app.book.store');

    Route::get('/post', [PostController::class, 'create'])->name('post.create');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::get('/article/{post:slug}', [PostController::class, 'show'])->name('post.show');
    Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.add');
    Route::post('/reply/store', [CommentController::class, 'replyStore'])->name('reply.add');

    Route::get('redirects', 'App\Http\Controllers\HomeController@index');


    Route::post('/Course/Create', [CourseController::class, 'store'])->name('teacher.create.course.store');
    Route::post('/Test/Create', [TestController::class, 'store'])->name('teacher.create.test.store');
    Route::get('/Test', [TestController::class, 'index'])->name('child.test');
    Route::post('/Test', [FindcourseController::class, 'search'])->name('search.course');
    Route::post('/SearchTest', [GivetestController::class, 'store'])->name('result.store');
    Route::get('/Course/Create', [CourseController::class, 'index'])->name('teacher.create.course');

    Route::get('/Search/Result', [searchResult::class, 'index'])->name('teacher.get.result');
    Route::post('/Search/Result', [searchResult::class, 'search'])->name('teacher.search.result');
    Route::get('/Course/Appoint', [CourseAppointController::class, 'index'])->name('teacher.appoint.course');
    Route::post('/Course/Appoint', [CourseAppointController::class, 'store'])->name('teacher.appoint.course.store');

    Route::post('/Course/Create', [CourseController::class, 'store'])->name('teacher.create.course.store');
    Route::post('/Test/Create', [TestController::class, 'store'])->name('teacher.create.test.store');

    //*Give Test
    Route::get('/Test', [TestController::class, 'index'])->name('child.test');
    Route::get('/Test/Marks', [MarkController::class, 'index'])->name('teacher.give.marks');

    //*student profile
    Route::view('/studentprofile', 'studentprofile')->name('studentprofile');

    //*profile photo upload
    Route::get('profile', [UserController::class, 'profile'])->name('doctor.image.show');
    Route::view('/registerChild', 'guardian/childform')->name('childform');
    Route::post('profile', [UserController::class, 'update_avatar'])->name('doctor.image.upload');
    Route::get('logout', [LoginController::class, 'logout']);


    //*view a single child's result
    Route::get('result', [ResultController::class, 'get_all_results'])->name('result.graph');



    //*getting all the doctor profiles
    Route::get('/doctorProfiles', [App\Http\Controllers\TotalDoctorProfiles::class, 'index']);


    //*profile photo upload
    Route::get('profile', [UserController::class, 'profile'])->name('doctor.image.show');
    Route::get('/registerChild', [ChildController::class, 'childcreate'])->name('childform');
    Route::post('/registerChild', [ChildController::class, 'store'])->name('child.store');
    Route::post('profile', [UserController::class, 'update_avatar'])->name('doctor.image.upload');
    Route::get('logout', [LoginController::class, 'logout']);

    //*viewcourse
    Route::get('viewcourse', [viewCourseController::class, 'index'])->name('student.view.course');
    // Route::get('viewcourse', [viewCourseController::class, 'view_all_course'])->name('student.view_all_course');
});
