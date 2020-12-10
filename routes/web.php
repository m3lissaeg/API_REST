<?php

use App\Models\Student;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;
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

Route::get('students', function() {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    return Student::all();
});
 
Route::get('students/{id}', function($id) {
    return Student::find($id);
});

Route::post('students', function(Request $request) {
    return Student::create($request->all);
});

Route::put('students/{id}', function(Request $request, $id) {
    $article = Student::findOrFail($id);
    $article->update($request->all());

    return $article;
});

Route::delete('students/{id}', function($id) {
    Student::find($id)->delete();

    return 204;
});
// Route::get('students', 'StudentController@index');
// Route::get('students/{student}', 'StudentController@show');
// Route::post('students', 'StudentController@store');
// Route::put('students/{student}', 'StudentController@update');
// Route::delete('students/{student}', 'StudentController@delete');
// Route::post('register', 'Auth\RegisterController@register');
// Route::post('login', 'Auth\LoginController@login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

