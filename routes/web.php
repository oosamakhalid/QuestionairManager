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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::GET('/questionairs', 'QuestionairController@index');
Route::GET('/questionairCreate','QuestionairController@createQuestionair');
Route::POST('/saveQuestionair','QuestionairController@saveQuestionair');
Route::GET('/deleteQuestionair','QuestionairController@deleteQuestionair');
Route::POST('/updateQuestionair','QuestionairController@updateQuestionair');
Route::GET('editQuestionair/{id}','QuestionairController@editQuestionair');
Route::GET('/addQuestion/{id}','QuestionairController@addQuestion');
Route::GET('/saveQuestions','QuestionairController@saveQuestions');
Route::Get('/deleteChoice','QuestionairController@deleteChoice');
Route::Get('/deleteQuestion','QuestionairController@deleteQuestion');