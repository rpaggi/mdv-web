<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin'
])->group(function () {

    Route::namespace('App\Http\Controllers\Web')->group(function(){
        Route::get('dashboard', 'HomeController@index')->name('dashboard');
        Route::get('dashboard/exam-by-agent', 'HomeController@examByAgent')->name('dashboard.exam-by-agent');
        Route::resource('agents','AgentController')->except(["show"]);
        Route::resource('products','ProductController')->except(["show"]);
        Route::resource('sells','SellController')->except(["edit", "update", "destroy"]);
        Route::post('sells/{id}/cancel','SellController@cancel')->name("sells.cancel");
        Route::get('exams/multi-print','ExamController@formMultiReport')->name("exams.multi-print");
        Route::resource('exams','ExamController')->except(["edit", "update", "store", "create", "destroy"]);
        Route::get('exams/{id}/print','ExamController@formReport')->name("exams.print");
    });
});
